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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@registerapi');
Route::post('login', 'Auth\LoginController@loginapi');

Route::group(['namespace' => 'Api', 'middleware' => 'localization'], function () {
    Route::resource('page', 'PageController', ['only' => ['index', 'show']]);
    Route::resource('all-categories', 'CategoryController', ['only' => ['index', 'show']]);
    Route::get('all-subcategories', 'CategoryController@subcategories');
    Route::get('subcategory/{id}', 'CategoryController@subcategory');
    Route::get('home/category', 'HomeController@categories');
    Route::get('home/sliders', 'HomeController@sliders');
    Route::resource('all-products', 'ProductController');
    Route::get('similar/product/{id}', 'ProductController@similar');
    Route::get('last-views/product/{id}', 'ProductController@views');

    Route::get('all-types', 'ProductController@types');
    Route::get('all-materials', 'ProductController@materials');
    Route::get('all-brands', 'ProductController@brands');
    Route::get('all-sizes', 'ProductController@sizes');
    Route::get('all-colors', 'ProductController@colors');
});
