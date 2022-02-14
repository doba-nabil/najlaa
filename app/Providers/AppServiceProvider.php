<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\EmptyProductNotification;
use App\Models\Moderator;
use App\Models\Option;
use App\Models\Order;
use App\Models\Page;
use App\Models\ProductColor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $coupons = Coupon::all();
        foreach ($coupons as $coupon){
            if($coupon->end_date < Carbon::now()){
                $coupon->active = 0;
                $coupon->save();
            }
        }

        Schema::defaultStringLength(191);
        if(\Schema::hasTable('options')){
            $option = Option::find(1);
//            $order_dates = Order::where('status' , '!=' , '4')->whereDate('updated_at',Carbon::now()->subDay()->toDateString())->get();
//            foreach ($order_dates as $order_date){
//                $to_name = 'Admin';
//                $order_no = $order_date->order_no;
//                $to_email = $option->sys_email;
//                $data = array('name'=>"Najlaa App", "body" => $order_no);
//                Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
//                    $message->to($to_email, $to_name)
//                        ->subject('No action on order');
//                });
//            }

            if(!isset($option)){
                $option = new Option();
                $option->id = 1;
                $option->face = 'facebook.com';
                $option->insta = 'instagram.com';
                $option->phone = '99999900000000';
                $option->whats = '99999900000000';
                $option->email = 'najla@gmail.com';
                $option->address_ar = '123 sharp Rd , Doha , Qatar';
                $option->address_en = '123 sharp Rd , Doha , Qatar';
                $option->ios = 'https://apps.apple.com/';
                $option->andriod = 'https://play.google.com/';
                $option->active = 1;
                $option->save();
            }
//            $admin = Moderator::find(1);
//            if(!isset($admin)){
//                $admin = new Moderator();
//                $admin->id = 1;
//                $admin->name = 'Admin';
//                $admin->email = 'admin@gmail.com';
//                $admin->password = Hash::make('123456789');
//                $admin->status = 1;
//                $admin->save();
//            }
            $page = Page::find(1);
            $page2 = Page::find(2);
            $page3 = Page::find(3);
            if(!isset($page)){
                $page = new Page();
                $page->id = 1;
                $page->name_ar = 'Legal Information';
                $page->name_en = 'Legal Information';
                $page->body_ar = 'Legal Information body';
                $page->body_en = 'Legal Information body';
                $page->slug = 'legal-information';
                $page->active = 1;
                $page->save();
            }
            if(!isset($page2)) {
                $page = new Page();
                $page->id = 2;
                $page->name_ar = 'Privacy Policy';
                $page->name_en = 'Privacy Policy';
                $page->body_ar = 'Privacy Policy body';
                $page->body_en = 'Privacy Policy body';
                $page->slug = 'privacy-policy';
                $page->active = 1;
                $page->save();
            }
            if(!isset($page3)){
                $page = new Page();
                $page->id = 3;
                $page->name_ar = 'Delivery and return info';
                $page->name_en = 'Delivery and return info';
                $page->body_ar = 'Delivery and return info body';
                $page->body_en = 'Delivery and return info body';
                $page->slug = 'delivery-return';
                $page->active = 1;
                $page->save();
            }
            $country = Country::find(1);
            if(!isset($country)){
                $country = new Country();
                $country->id = 1;
                $country->name_ar = 'قطر';
                $country->name_en = 'QATAR';
                $country->code = 'QAR';
                $country->active = 1;
                $country->save();
            }
            $currency = Currency::find(1);
            if(!isset($currency)){
                $currency = new Currency();
                $currency->id = 1;
                $currency->name_ar = 'ريال قطري';
                $currency->name_en = 'Riyal QATAR';
                $currency->code = 'QAR';
                $currency->active = 1;
                $currency->country_id = 1;
                $currency->save();
            }
        }
        if(\Schema::hasTable('empty_product_notifications')){
            $pros = ProductColor::where('stock_qty' , 0)->get();
            foreach ($pros as $pro){
                $found = EmptyProductNotification::where('product_id' , $pro->product_id)->where('color_id' , $pro->color_id)->where('size_id' , $pro->size_id)->first();
                if(!isset($found)){
                    $moderators = Moderator::all();
                    foreach ($moderators as $moderator){
                        $not = new EmptyProductNotification();
                        $not->color_id = $pro->color_id;
                        $not->size_id = $pro->size_id;
                        $not->product_id = $pro->product_id;
                        $not->moderator_id = $moderator->id;

                        $not->save();
                    }
                }
            }
        }
    }
}
