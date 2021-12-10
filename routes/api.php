<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => ['api', 'logAccess'],
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('profile', 'App\Http\Controllers\AuthController@userProfile');
    Route::put('profile', 'App\Http\Controllers\ProfileController@update');
    Route::put('profile/password', 'App\Http\Controllers\ProfileController@password');
});


Route::group(['middleware' => ['api', 'logAccess'],], function () {

    Route::post('promo', 'App\Http\Controllers\PromoCodeController@promo');
    Route::get('promocode/all', 'App\Http\Controllers\PromoCodeController@list');
    Route::get('promocode/active', 'App\Http\Controllers\PromoCodeController@activeList');
});

Route::group(['middleware' => ['api', 'logAccess', 'role:1'],], function () {

    Route::post('promolocation/add', 'App\Http\Controllers\PromoLocationController@store');
    Route::put('promocode/deactivate', 'App\Http\Controllers\PromoCodeController@deactivate');
    Route::put('promolocation/delete', 'App\Http\Controllers\PromoLocationController@deleteLocation');
});
