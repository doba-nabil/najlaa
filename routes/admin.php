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
Auth::routes();
/*******************************************************/
View::creator('backend.layout.header', function ($view) {
    $view->with('admin' , \App\Models\Moderator::find(Auth::user()->id));

    $view->with('ordersNots' , \App\Models\Notification::where('notifiable_id' , Auth::user()->id)->where('type' , 'App\Notifications\NewOrder')->orderBy('created_at' ,'desc')->get());
    $view->with('contactNots' , \App\Models\Notification::where('notifiable_id' , Auth::user()->id)->where('type' , 'App\Notifications\NewContact')->orderBy('created_at' ,'desc')->get());
    $view->with('contactOrderNots' , \App\Models\Notification::where('notifiable_id' , Auth::user()->id)->where('type' , 'App\Notifications\NewContactOrder')->orderBy('created_at' ,'desc')->get());
    $view->with('userNots' , \App\Models\Notification::where('notifiable_id' , Auth::user()->id)->where('type' , 'App\Notifications\NewUser')->orderBy('created_at' ,'desc')->get());
});
/*************** backend routes *************/
Route::get('admin/login', 'Admin\AdminauthController@showLoginFrom')->name('backendLogin');
Route::post('admin/login', 'Admin\AdminauthController@login');
Route::get('admin', 'Admin\AdminauthController@showLoginFrom');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:moderator'], function () {
    /****************** auth routes ****************/
    Route::get('home', 'AdminController@index')->name('backend-home');
    /*********** category route ***********/
    Route::resource('categories', 'CategoryController', ['except' => ['show']]);
    Route::delete('delete_categories', 'CategoryController@delete_categories')->name('delete_categories');

    Route::get('category_discounts/{slug}', 'SubcategoryController@discount')->name('cat_pro_desc');
    Route::post('category_discounts/{id}', 'SubcategoryController@discount_form')->name('cat_pro_desc_form');
    /*********** end category route ***********/
    /*********** subscribers route ***********/
    Route::resource('subscribers', 'SubscriberController', ['only' => ['index' , 'destroy']]);
    Route::delete('delete_subscribers', 'SubscriberController@delete_subscribers')->name('delete_subscribers');
    /*********** end subscribers route ***********/
    /*********** deliveries route ***********/
    Route::resource('deliveries', 'DeliveryController');
    Route::delete('delete_deliveries', 'DeliveryController@delete_deliveries')->name('delete_deliveries');
    /*********** end deliveries route ***********/
    /*********** subcategory route ***********/
    Route::resource('subcategories', 'SubcategoryController', ['except' => ['show']]);
    Route::delete('delete_subcategories', 'SubcategoryController@delete_categories')->name('delete_subcategories');
    /*********** end category route ***********/
    /*********** materials route ***********/
    Route::resource('materials', 'MaterialController', ['except' => ['show']]);
    Route::delete('delete_materials', 'MaterialController@delete_materials')->name('delete_materials');
    /*********** end materials route ***********/
    /*********** colors route ***********/
    Route::resource('colors', 'ColorController', ['except' => ['show']]);
    Route::delete('delete_colors', 'ColorController@delete_colors')->name('delete_colors');
    /*********** end colors route ***********/
    /*********** coupons route ***********/
    Route::resource('coupons', 'CouponController', ['except' => ['show']]);
    Route::delete('delete_coupons', 'CouponController@delete_coupons')->name('delete_coupons');
    /*********** end coupons route ***********/
    /*********** sizes route ***********/
    Route::resource('sizes', 'SizeController', ['except' => ['show']]);
    Route::delete('delete_sizes', 'SizeController@delete_sizes')->name('delete_sizes');
    /*********** end sizes route ***********/
    /*********** brands route ***********/
    Route::resource('brands', 'BrandController', ['except' => ['show']]);
    Route::delete('delete_brands', 'BrandController@delete_brands')->name('delete_brands');
    /*********** end brands route ***********/
    /*********** products route ***********/
    Route::resource('products', 'ProductController');
    Route::get('show/product/{id}', 'ProductController@see_empty_not')->name('see_empty_not');
    Route::get('discounts', 'ProductController@discount')->name('pro_desc');
    Route::post('discounts', 'ProductController@discount_form')->name('pro_desc_form');
    Route::get('products/post/{slug}', 'ProductController@accept')->name('post_product');
    Route::post('delete_products', 'ProductController@delete_products')->name('delete_products');
    Route::get('delete_product_image/{imgID}', 'ProductController@delete_images')->name('delete_product_image');
    /*********** end products route ***********/
    /***********  countries route ***********/
    Route::resource('countries', 'CountryController', ['except' => ['show']]);
    Route::delete('delete_countries', 'CountryController@delete_countries')->name('delete_countries');
    /*********** end countries route ***********/
    /***********  cities route ***********/
    Route::resource('cities', 'CityController');
    Route::delete('delete_cities', 'CityController@delete_cities')->name('delete_cities');
    /*********** end cities route ***********/
    /***********  currencies route ***********/
    Route::resource('currencies', 'CurrencyController', ['except' => ['show']]);
    Route::delete('delete_currencies', 'CurrencyController@delete_currencies')->name('delete_currencies');
    /*********** end currencies route ***********/
    /***********  ad Banners route ***********/
    Route::resource('sliders', 'SliderController');
    Route::delete('delete_sliders', 'SliderController@delete_sliders')->name('delete_sliders');
    Route::delete('delete_slider_product/{id}', 'SliderController@delete_slider_product')->name('delete_slider_product');
    /*********** end ad Banners route ***********/
    /***********  category Banners route ***********/
    Route::resource('category_sliders', 'CategorySliderController', ['except' => ['show']]);
    Route::delete('delete_category_sliders', 'CategorySliderController@delete_category_sliders')->name('delete_category_sliders');
    /*********** end category Banners route ***********/
    /***********  pages route ***********/
    Route::resource('pages', 'PageController', ['except' => ['show']]);
    Route::delete('delete_pages', 'PageController@delete_pages')->name('delete_pages');
    /*********** end pages route ***********/
    /***********  faqs route ***********/
    Route::resource('faqs', 'FaqController', ['except' => ['show']]);
    Route::delete('delete_faqs', 'FaqController@delete_faqs')->name('delete_faqs');
    /*********** end faqs route ***********/
    /***********  addresses route ***********/
    Route::get('addresses/create/{userId}', 'AddressController@create')->name('addresses_create');
    Route::post('addresses/create_form/{userId}', 'AddressController@store')->name('create_form');
    Route::get('addresses/{addressId}/edit', 'AddressController@edit')->name('addresses_edit');
    Route::patch('addresses/edit_form/{addressId}', 'AddressController@update')->name('edit_form');
    Route::delete('addresses/destroy/{addressId}', 'AddressController@destroy')->name('destroy');
    Route::get('addresses/selected/{id}', 'AddressController@selected')->name('selected');
    Route::delete('delete_addresses/{user_id}', 'AddressController@delete_addresses')->name('delete_addresses');
    /*********** end addresses route ***********/
    /***********  users route ***********/
    Route::resource('users', 'UserController');
    Route::get('user_orders/{id}', 'UserController@orders')->name('user_orders');
    Route::get('blocked', 'UserController@blocked')->name('blocked');
    Route::get('users/blocked_btn/{id}', 'UserController@block_user')->name('blocked_btn');
    Route::delete('delete_users', 'UserController@delete_users')->name('delete_users');
    /*********** end users route ***********/
    /***********  orders route ***********/
    Route::resource('orders', 'OrderController', ['only' => ['index','show' ,'update' ,'destroy']]);
    Route::get('old/orders', 'OrderController@old')->name('old_orders');
    Route::get('send_whats_message/{id}', 'OrderController@send_message')->name('send_whats_message');
    Route::get('new/orders', 'OrderController@new')->name('new_orders');
    Route::delete('delete_orders', 'OrderController@delete_orders')->name('delete_orders');
    Route::delete('delete_old_orders', 'OrderController@delete_old_orders')->name('delete_old_orders');
    Route::delete('delete_new_orders', 'OrderController@delete_new_orders')->name('delete_new_orders');
    /*********** end orders route ***********/
    /***********  contact route ***********/
    Route::resource('contacts', 'ContactController', ['only' => ['index', 'show', 'destroy']]);
    Route::delete('delete_contacts', 'ContactController@delete_contacts')->name('delete_contacts');
    /*********** end contact route ***********/
    /***********  order feedback route ***********/
    Route::resource('ordercontacts', 'ContactOrderController', ['only' => ['index', 'show', 'destroy']]);
    Route::delete('delete_ordercontacts', 'ContactOrderController@delete_contacts')->name('delete_ordercontacts');
    /*********** end order feedback route ***********/
    /***********  options route ***********/
    Route::resource('options', 'OptionController', ['only' => ['edit', 'update']]);
    /*********** end options route ***********/
    //*********** start  moderator route ***********/
    /********** amoderators***********/
    Route::resource('moderators', 'ModeratorController', ['except' => ['show']]);
    Route::resource('roles','RoleController');
    //*********** end  moderator route ***********/
    //*********** send message route ***********/
    Route::get('send/page', 'MessageController@message')->name('send_form');
    Route::post('send/message', 'MessageController@send_message')->name('send');

    Route::get('send/users/page', 'MessageController@users_message')->name('send_users_form');
    Route::post('send/users/message', 'MessageController@send_users_message')->name('send_users');

    Route::get('send/subscribers/page', 'MessageController@subscribers_message')->name('send_subscribers_form');
    Route::post('send/subscribers/message', 'MessageController@send_subscribers_message')->name('send_subscribers');
    //*********** end send message route ***********/

    Route::get('chart', 'ChartController@index');

//    reports
    Route::get('yearly/report', 'ReportController@yearlyReport')->name('yearly_report');
    Route::post('yearly/report', 'ReportController@yearlyReport_post')->name('yearly_report_post');
    Route::get('monthly/report', 'ReportController@monthlyReport')->name('monthly_report');
    Route::post('monthly/report', 'ReportController@monthlyReport_post')->name('monthly_report_post');
    Route::get('daily/report', 'ReportController@dailyReport')->name('daily_report');
    Route::post('daily/report', 'ReportController@dailyReport_post')->name('daily_report_post');

    Route::get('all/report', 'ReportController@allReport')->name('all_report');
    Route::post('all/report', 'ReportController@allReport_post')->name('all_report_post');

    Route::get('best_selling', 'ReportController@best_selling')->name('best_selling');
    Route::post('best_selling', 'ReportController@best_selling_post')->name('best_selling_post');

// notifications
    Route::get('send/all/notification', 'FcmController@fcm')->name('fcm');
    Route::post('send-push-all', 'FcmController@sendPushAll')->name('send_push_all');

    Route::get('send/users/notification', 'FcmController@fcm_users')->name('fcm_users');
    Route::post('send-push-users', 'FcmController@sendPushUsers')->name('send_push_users');

    Route::get('send/not_users/notification', 'FcmController@fcm_not_users')->name('fcm_not_users');
    Route::post('send-push-notusers', 'FcmController@sendPushNotUsers')->name('send_push_not_users');

});
/************* ajax select routes ******************/
Route::get('/ajax-subcats', 'Admin\AdminController@getsubcategories');
Route::post('read', 'Admin\AdminController@readNotification');

Route::get('lang/{locale}', 'Admin\AdminController@language')->name('language');


