<?php

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

Route::namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::get('callback', 'LoginController@callback')->name('callback');
    Route::any('logout', 'LoginController@logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('delete', 'DeleteController')->name('delete');
    Route::get('config', 'ConfigController@edit')->name('config.edit');
    Route::post('config', 'ConfigController@update')->name('config.update');
});

Route::get('/home', 'HomeController')->name('home');
