<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Moderator;
use App\Models\Option;
use App\Models\Page;
use Illuminate\Support\Facades\Hash;
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
        Schema::defaultStringLength(191);
        if(\Schema::hasTable('options')){
            $option = Option::find(1);
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
            $admin = Moderator::find(1);
            if(!isset($admin)){
                $admin = new Moderator();
                $admin->id = 1;
                $admin->name = 'Admin';
                $admin->email = 'admin@gmail.com';
                $admin->password = Hash::make('123456789');
                $admin->status = 1;
                $admin->save();
            }
            $page = Page::find(1);
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
    }
}
