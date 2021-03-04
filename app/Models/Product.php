<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;

class Product extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }
    protected $fillable = [
        'name_ar', 'name_en','image','size_image', 'images' , 'sizes' ,'colors' , 'category_id','subcategory_id','material_id' ,
        'brand_id' ,'price' ,'discount_price' , 'max_qty' ,'min_qty' , 'code' , 'body_ar' ,'body_en','active','chosen',
        'created_at','updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at','subcategory_id' , 'brand_id' , 'material_id','category_id'
    ];

    protected $appends = ['in_stock','currency_code' , 'currency_value' , 'isFav'];

    public function getInStockAttribute()
    {
        if($this->max_qty > 0){
            return true;
        }else{
            return false;
        }
    }
    public function getCurrencyCodeAttribute()
    {
        $user = User::where('api_token', \request()->bearerToken())->first();
        if(isset($user)){
            $old_chose = ChoseCountry::where('user_id' , $user->id)->first();
            if(isset($old_chose)){
                $currency = Currency::where('country_id' , $old_chose->country_id)->first();
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
        }else{
            $country_id = 1;
            $currency = Currency::where('country_id' , $country_id)->first();
            return $currency->code;
        }

    }
    public function getCurrencyValueAttribute()
    {
        $user = User::where('api_token', \request()->bearerToken())->first();
        if(isset($user)){
            $old_chose = ChoseCountry::where('user_id' , $user->id)->first();
            if(isset($old_chose)){
                $currency = Currency::where('country_id' , $old_chose->country_id)->first();
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
                            $apikey = 'd1ded944220ca6b0c442';
                            $from_Currency = $currency->code;
                            $to_Currency = 'QAR';
                            $query = "{$from_Currency}_{$to_Currency}";
                            $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
                            $obj = json_decode($json, true);
                            return round($obj[$query], 3);
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
                            $apikey = 'd1ded944220ca6b0c442';
                            $from_Currency = $currency->code;
                            $to_Currency = 'QAR';
                            $query = "{$from_Currency}_{$to_Currency}";
                            $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
                            $obj = json_decode($json, true);
                            return round($obj[$query], 3);
                        }catch (\Exception $e){
                            return 1;
                        }
                    }
                }
            }else{
                return $currency->equal;
            }
        }else{
            $country_id = 1;
            $currency = Currency::where('country_id' , $country_id)->first();
            if(empty($currency->equal)){
                try{
                    $fromCurrency = $currency->code;
                    $toCurrency = 'QAR';
                    if($fromCurrency == $toCurrency){
                        return $result =  1;
                    }else{
                        try{
                            $apikey = 'd1ded944220ca6b0c442';
                            $from_Currency = $currency->code;
                            $to_Currency = 'QAR';
                            $query = "{$from_Currency}_{$to_Currency}";
                            $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
                            $obj = json_decode($json, true);
                            return round($obj[$query], 3);
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
                            $apikey = 'd1ded944220ca6b0c442';
                            $from_Currency = $currency->code;
                            $to_Currency = 'QAR';
                            $query = "{$from_Currency}_{$to_Currency}";
                            $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
                            $obj = json_decode($json, true);
                            return round($obj[$query], 3);
                        }catch (\Exception $e){
                            return 1;
                        }
                    }
                }
            }else{
                return $currency->equal;
            }
        }
    }

    public function getIsFavAttribute()
    {
        if (\request()->bearerToken()) {
            $user = User::where('api_token', \request()->bearerToken())->first();
            $found = WishList::where('product_id', $this->id)->where('user_id', $user->id)->first();
            if (isset($found)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'Active' : 'Unactive';
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id' , 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Category' , 'subcategory_id' , 'id');
    }
    public function material()
    {
        return $this->belongsTo('App\Models\Material' , 'material_id' , 'id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand' , 'brand_id' , 'id');
    }
    public function colors()
    {
        return $this->hasMany('App\Models\ProductDetail')->where('type' , 'color');
    }
    public function sizes()
    {
        return $this->hasMany('App\Models\ProductDetail')->where('type' , 'size');
    }

    public function mainImage()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'main');
    }
    public function sizeImage()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'size');
    }
    public function subImages()
    {
        return $this->morphMany('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'sub');
    }
    public function wishes()
    {
        return $this->hasMany('App\Models\WishList');
    }
    public function pays()
    {
        return $this->hasMany('App\Models\Pay');
    }
}
