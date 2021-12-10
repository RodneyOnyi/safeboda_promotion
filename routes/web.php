<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email', function () {
    return view('emails.register');
});

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@welcome');
Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth','logAccess','role:1,2']], function () {
    Route::get('/client/search', 'App\Http\Controllers\UserController@search');
    Route::get('/mechanic/search', 'App\Http\Controllers\UserController@searchMechanic');
    Route::get('users/{type}', ['as' => 'users.type','uses' => 'App\Http\Controllers\UserController@users']);
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['delete']]);
    Route::put('user/delete', ['as' => 'user.delete', 'uses' => 'App\Http\Controllers\UserController@destroy']);

    Route::resource('rights', 'App\Http\Controllers\RightsGroupController', ['except' => ['delete']]);
    Route::put('rights/delete', ['as' => 'rights.delete', 'uses' => 'App\Http\Controllers\RightsGroupController@destroy']);

    Route::resource('garages', 'App\Http\Controllers\GarageController', ['except' => ['delete']]);
    Route::put('garage/delete', ['as' => 'garage.delete', 'uses' => 'App\Http\Controllers\GarageController@destroy']);

    Route::put('payment/delete', ['as' => 'payment.delete', 'uses' => 'App\Http\Controllers\PaymentController@destroy']);

    Route::get('invoices', 'App\Http\Controllers\InvoiceController@index')->name('invoices');
    Route::get('receipts', 'App\Http\Controllers\InvoiceController@receipts')->name('receipts');
    Route::get('invoice/{invoice}/generate', ['as' => 'invoice.id.generate','uses' => 'App\Http\Controllers\InvoiceController@create']);
});

Route::group(['middleware' => ['auth','logAccess','role:1,2,3']], function () {
    Route::get('stock/search', 'App\Http\Controllers\StockController@search');
    Route::resource('stocks', 'App\Http\Controllers\StockController', ['except' => ['delete']]);
    Route::put('stock/delete', ['as' => 'stock.delete', 'uses' => 'App\Http\Controllers\StockController@destroy']);

    Route::get('service_type/search', 'App\Http\Controllers\ServiceTypeController@search');
    Route::resource('service_type', 'App\Http\Controllers\ServiceTypeController', ['except' => ['delete']]);
    Route::put('service_type/delete', ['as' => 'service_type.delete', 'uses' => 'App\Http\Controllers\ServiceTypeController@destroy']);

    Route::get('invoice/{invoice}/generate', ['as' => 'invoice.id.generate','uses' => 'App\Http\Controllers\InvoiceController@create']);
    Route::resource('payments', 'App\Http\Controllers\PaymentController', ['except' => ['delete']]);
    Route::post('payment', 'App\Http\Controllers\PaymentController@store')->name('payment');

    Route::get('monthly/payments', 'App\Http\Controllers\PaymentController@paymentsMonthly');
    Route::get('monthly/users', 'App\Http\Controllers\UserController@usersMonthly');

    Route::get('service/search', 'App\Http\Controllers\ServiceController@search');
    Route::resource('service', 'App\Http\Controllers\ServiceController', ['except' => ['delete']]);
    Route::post('service_stock', 'App\Http\Controllers\ServiceController@storeStock')->name('service_stock');
    Route::post('service/stock', 'App\Http\Controllers\ServiceController@addStock')->name('service.stock');
    Route::post('service/complete', 'App\Http\Controllers\ServiceController@completeService')->name('service.complete');
    Route::put('service/delete', ['as' => 'service.delete', 'uses' => 'App\Http\Controllers\ServiceController@destroy']);
    Route::put('service/stock/delete', ['as' => 'service.stock.delete', 'uses' => 'App\Http\Controllers\ServiceController@deleteStock']);

    Route::get('brand/search', 'App\Http\Controllers\VehicleController@searchBrand');
    Route::get('vehicles/search', 'App\Http\Controllers\VehicleController@search');
    Route::resource('vehicle', 'App\Http\Controllers\VehicleController', ['except' => ['delete']]);
    Route::put('vehicle/delete', ['as' => 'vehicle.delete', 'uses' => 'App\Http\Controllers\VehicleController@destroy']);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
