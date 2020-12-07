<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','token','product_id' , 'size_id' , 'color_id'
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

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }
    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }
}
