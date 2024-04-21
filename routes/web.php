<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('callback', [LoginController::class, 'callback'])->name('callback');
});

Route::middleware('auth')->group(function () {
    Route::view('home', 'home')->name('home');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
