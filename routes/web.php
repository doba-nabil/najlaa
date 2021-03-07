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
    Route::get('login', 'AdminauthController@showLoginFrom')->name('backendLogin');
    Route::get('register', 'AdminauthController@showLoginFrom')->name('backendLogin');
});
Route::get('/', 'User\HomeController@index')->name('home');
Route::post('email', 'User\HomeController@send_email')->name('email');
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('order/{order_id}', 'User\HomeController@share_order')->name('share_order');


Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('auth/facebook', 'Auth\FaceBookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FaceBookController@handleFacebookCallback');


Route::get('all-user-token', 'Admin\UserController@token');

Route::get('/apple-app-site-association', function () {
    $json = file_get_contents('apple-app-site-association.txt');
    return response($json, 200)
        ->header('Content-Type', 'application/json');
});