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


Route::group(['middleware' => 'localization'], function () {
    Route::post('login', 'Auth\LoginController@loginapi');
    Route::post('register', 'Auth\RegisterController@registerapi');
    /********* logout **************/
    Route::post('/logout', 'Auth\LoginController@logoutapi');
    /****** reset pass *******/
    Route::post('reset/code', 'Auth\AccountsController@sendReseteCode');
    Route::post('check/reset/code', 'Auth\AccountsController@checkReseteCode');
    Route::post('reset/password', 'Auth\AccountsController@resetPass');
});
Route::group(['namespace' => 'Api', 'middleware' => 'localization'], function () {
    Route::resource('page', 'PageController', ['only' => ['index', 'show']]);
    Route::get('faq', 'PageController@faq');
    Route::resource('all-categories', 'CategoryController', ['only' => ['index', 'show']]);
    Route::get('categories-page', 'CategoryController@categories_page');
    Route::get('home-category/{id}', 'CategoryController@show');
    Route::get('all-subcategories', 'CategoryController@subcategories');
    Route::get('subcategory/{id}', 'CategoryController@subcategory');
    Route::get('home/category', 'HomeController@categories');
    Route::get('home/sliders', 'HomeController@sliders');
    Route::get('offers/{slider_id}', 'HomeController@slider_offers');
    Route::post('filter', 'HomeController@filter');

    Route::resource('all-products', 'ProductController');

    Route::get('similar/product/{id}', 'ProductController@similar');
    Route::get('last-views/product/{id}', 'ProductController@views');

    Route::get('cart', 'CartController@cart');

    Route::get('all-types', 'ProductController@types');
    Route::get('all-types/{id}', 'ProductController@type');
    Route::get('all-materials', 'ProductController@materials');
    Route::get('all-materials/{id}', 'ProductController@material');
    Route::get('all-brands', 'ProductController@brands');
    Route::get('all-brands/{id}', 'ProductController@brand');
    Route::get('all-sizes', 'ProductController@sizes');
    Route::get('all-sizes/{id}', 'ProductController@size');
    Route::get('all-colors', 'ProductController@colors');
    Route::get('all-colors/{id}', 'ProductController@color');
    Route::get('categories-nav', 'CategoryController@all_cats');

    /******** new get **************/
    Route::get('privacy', 'HomeController@privacy');
    Route::get('legal', 'HomeController@legal');
    Route::get('delivery-return', 'HomeController@delivery_return');
    Route::get('home/hot_offers', 'HomeController@hot_offers');
    Route::get('home/all_hot_offers', 'HomeController@all_hot_offers');
    Route::get('home/chosen', 'HomeController@chosen');
    Route::get('home/all_chosen', 'HomeController@all_chosen');
    Route::get('home/interests', 'HomeController@interests');
    Route::get('home/all_interests', 'HomeController@all_interests');
    Route::get('wish-list', 'WishListController@favourites');
    Route::get('whatsapp', 'OptionsController@whatsapp');
    Route::get('facebook', 'OptionsController@facebook');
    Route::get('instagram', 'OptionsController@insta');
    Route::get('social', 'OptionsController@social');
    /* address */
    Route::get('addresses', 'AddressController@index');
    Route::get('address/{id}', 'AddressController@show');
    Route::get('contact-address', 'HomeController@contact_address');
    Route::get('contact-email', 'HomeController@contact_email');
    Route::get('contact-phone', 'HomeController@contact_phone');
    Route::get('all-cities', 'CountriesController@cities');
    Route::get('all-countries', 'CountriesController@index');
    Route::get('cat-slider', 'CategoryController@category_sliders');
    /******** post ************************************************************/
    /* add and delet from wishlist */
    Route::post('add_delete_wishlist', 'WishListController@add_delete_wishlist');
    /* address */
    Route::get('main/address', 'AddressController@main_address');
    Route::post('add/address', 'AddressController@store');
    Route::post('edit/address/{id}', 'AddressController@update');
    Route::post('delete/address/{id}', 'AddressController@destroy');
    Route::post('delete/addresses', 'AddressController@delete_all');
    Route::post('main/address/{id}', 'AddressController@main');
    /* profile */
    Route::post('edit/profile', 'ProfileController@edit_info');
    Route::get('get/profile', 'ProfileController@get_info');
    Route::post('contact', 'HomeController@contact');
    /************* order feedback *************/
    Route::post('order/feedback', 'ContactOrderController@contact');
    Route::get('feedback/types', 'ContactOrderController@types');
    /*** password *****/
    Route::post('change_password', 'ProfileController@change_pass');
    /* search */
    Route::post('search', 'ProductController@search');
    /* country */
    Route::post('chose_country', 'CountriesController@choose_country');
    Route::get('check_country', 'CountriesController@check_country');

    /************ pay / orders ************/
    Route::post('pay', 'PayController@pay_product');
    Route::get('re-order/{orderId}', 'PayController@repay_product');
    Route::get('orders', 'PayController@orders');
    Route::get('pending/orders', 'PayController@pending_orders');
    Route::get('confirmed/orders', 'PayController@confirmed_orders');
    Route::get('order/{orderID}', 'PayController@order');
    Route::get('truck_order/{orderID}', 'PayController@truck_order');
    /************ currencies ************/
    Route::get('currencies_api', 'CountriesController@currencies_api');
    /************ cart ************/
    Route::post('add/cart', 'CartController@add_cart');
    Route::get('cart', 'CartController@cart');
    Route::post('edit/cart/{cartID}', 'CartController@edit_cart');
    Route::get('remove/all-cart', 'CartController@remove_all');
    Route::get('remove/single-cart/{cartID}', 'CartController@remove_single');
    /************ verified ************/
    Route::get('check/verified', 'VerifiedController@check_verified');
    Route::post('verified', 'VerifiedController@verified');
    Route::get('send/verified/code', 'VerifiedController@verified_code');
    /******** recentrly **********/
    Route::get('recently/search', 'HomeController@recently_search');
    Route::get('delete/recently/search', 'HomeController@delete_recently_search');

    Route::get('recently/products', 'HomeController@recently_products');
    Route::get('delete/recently/products', 'HomeController@delete_recently_products');

    Route::get('delete/recently/{id}', 'HomeController@delete_recently');

    Route::post('add_coupon', 'CouponController@check_coupon');
    Route::post('delete_coupon/{id}', 'CouponController@delete_coupon');
    /******** notifications **********/
    Route::get('notifications', 'NotificationController@notifications');
    Route::get('new/notifications', 'NotificationController@new_notifications');
    Route::get('recent/notifications', 'NotificationController@recent_notifications');
    Route::get('notification/single/{notId}', 'NotificationController@notification_single');

    Route::get('notifications_status', 'NotificationController@notifications_status');
    Route::get('products_notify', 'NotificationController@products_notify');
    Route::get('orders_notify', 'NotificationController@orders_notify');

    Route::post('social', 'SocialController@social');


//    try apis
    Route::get('try/users', 'TryController@users');
    Route::get('try/delete_tokens', 'TryController@delete_tokens');
});
