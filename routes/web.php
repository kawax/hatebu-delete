<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware('guest')
    ->controller(LoginController::class)
    ->group(function () {
        Route::get('login', 'login')->name('login');
        Route::get('callback', 'callback')->name('callback');
    });

Route::middleware('auth')->group(function () {
    Route::view('home', 'home')->name('home');

    Route::post('logout', LogoutController::class)->name('logout');
});
