<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\CommissionController;

Route::get('/verify', function () { return view('auth.OTP'); });

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () { return view('auth.Login'); })->name('login');
    Route::get('/signup', function () { return view('auth.Register'); });
    Route::post('/loggedin', [UserController::class, 'Login'])->name('loggedin');
    Route::post('/register', [UserController::class, 'Register'])->name('Register');
    Route::post('/signin', [UserController::class, 'Signin'])->name('Signin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); });
    Route::post('/logout', [UserController::class, 'Logout'])->name('logout');

    Route::get('/retailers', [RetailerController::class, 'Retailers'])->name('retailers');
    Route::post('/register_retailer', [RetailerController::class, 'New_Retailer'])->name('register_retailer');

    Route::get('/commissions', [CommissionController::class, 'commissions'])->name('commissions');
    Route::post('/register_commission', [CommissionController::class, 'New_Commissions'])->name('register_commission');

    Route::post('/service_list', [CommissionController::class, 'services'])->name('service_list');
    // Route::get('/services', function () { return view('commission.services'); })->name('services');
    Route::post('/register_services', [CommissionController::class, 'New_Services'])->name('register_services');
});

