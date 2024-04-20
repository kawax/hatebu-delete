<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('callback', [LoginController::class, 'callback'])->name('callback');
});

Route::middleware('auth')->group(function () {
    Route::view('home', 'home')->name('home');

    Route::singleton('config', ConfigController::class)->except('show');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
