<?php

namespace App\Providers;

use App\Models\Option;
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
        $option = Option::find(1);
        if(!isset($option)){
            $option = new Option();
            $option->id = 1;
            $option->face = 'facebook.com';
            $option->insta = 'instagram.com';
            $option->phone = '99999900000000';
            $option->whats = '99999900000000';
            $option->ios = 'https://apps.apple.com/';
            $option->andriod = 'https://play.google.com/';
            $option->active = 1;
            $option->save();
        }
    }
}
