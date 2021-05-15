<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Notifiable , \Reportable\Traits\Reportable;
    protected $hidden = [
        'created_at', 'updated_at','user_id','city_id','new','paid','processed','shipped','out_to_delivery','delivered','delivery_id',
        'cobone_id','cobone_code','cobone_value'
    ];

    protected $appends = ['currency_code' , 'currency_value','old_price','use_coupon','price_after_discount','discount_value'];

    public function getOldPriceAttribute(){
            $total = 0;
            foreach($this->pays as $pay){
                if(!empty($pay->product->discount_price)){
                    $total+= $pay->product->discount_price * $pay->count;
                }else{
                    $total+= $pay->product->price * $pay->count;
                }
            }
            return $total;
    }
    public function getPriceAfterDiscountAttribute(){
        if(!empty($this->cobone_code)){
            return $this->old_price - (($this->old_price * $this->cobone_value) / 100);
        }else{
            return $this->old_price;
        }
    }
    public function getDiscountValueAttribute(){
        if(!empty($this->cobone_code)){
            return $this->cobone_value .'%';
        }else{
            return null;
        }
    }
    public function getUseCouponAttribute(){
        if(!empty($this->cobone_code)){
            return true;
        }else{
            return false;
        }
    }

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
