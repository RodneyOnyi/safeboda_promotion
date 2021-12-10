<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use App\Models\Service;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }

    /**
     * Show the application welcome.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return view('welcome');
    }
}
