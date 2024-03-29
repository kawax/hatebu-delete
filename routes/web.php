<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;

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
