<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Notifiable;
    protected $hidden = [
        'created_at', 'updated_at','user_id','city_id','new','paid','processed','shipped','out_to_delivery','delivered'
    ];

    protected $appends = ['currency_code' , 'currency_value'];

    public function getCurrencyCodeAttribute()
    {
        $country_id = \request()->header('country_id');
        if(isset($country_id)){
            $currency = Currency::where('country_id' , $country_id)->first();
        }else{
            $country_id = 1;
            $currency = Currency::where('country_id' , $country_id)->first();
        }
        try{
            return $currency->code;
        }catch (\Exception $e){
            $currency = Currency::where('country_id' , 1)->first();
            return $currency->code;
        }
    }
    public function getCurrencyValueAttribute()
    {
        $country_id = \request()->header('country_id');
        if(isset($country_id)){
            $currency = Currency::where('country_id' , $country_id)->first();
        }else{
            $country_id = 1;
            $currency = Currency::where('country_id' , $country_id)->first();
        }
        if(empty($currency->equal)){
            try{
                $fromCurrency = $currency->code;
                $toCurrency = 'QAR';
                if($fromCurrency == $toCurrency){
                    return $result =  1;
                }else{
                    try{
                        $url = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
                        $get = file_get_contents($url);
                        $data = preg_split('/\D\s(.*?)\s=\s/',$get);
                        $exhangeRate = (float) substr($data[1],0,7);
                        $result = round($exhangeRate , 3);
                        return $result;
                    }catch (\Exception $e){
                        return 1;
                    }
                }
            }catch (\Exception $e){
                $currency = Currency::where('country_id' , 1)->first();
                $fromCurrency = $currency->code;
                $toCurrency = 'QAR';
                if($fromCurrency == $toCurrency){
                    return 1;
                }else{
                    try{
                        $url = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
                        $get = file_get_contents($url);
                        $data = preg_split('/\D\s(.*?)\s=\s/',$get);
                        $exhangeRate = (float) substr($data[1],0,7);
                        $result = round($exhangeRate , 3);
                        return $result;
                    }catch (\Exception $e){
                        return 1;
                    }
                }
            }
        }else{
            return $currency->equal;
        }
    }

    public function getPaidType()
    {
        return  $this->paid == 1 ? 'E-payment' : 'Payment on Receipt';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function pays()
    {
        return $this->hasMany('App\Models\Pay');
    }
}
