<?php

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

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:moderator'], function () {
    Route::get('/', 'AdminController@index')->name('backend-home');
    Route::get('login', 'AdminauthController@showLoginFrom')->name('backendLogin');
    Route::get('register', 'AdminauthController@showLoginFrom')->name('backendLogin');
});

