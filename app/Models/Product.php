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
        'name_ar', 'name_en','image', 'images' , 'sizes' ,'colors' , 'category_id','subcategory_id','material_id' ,
        'brand_id' ,'price' ,'discount_price' , 'max_qty' ,'min_qty' , 'code' , 'body_ar' ,'body_en','active','chosen',
        'created_at','updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at','subcategory_id' , 'brand_id' , 'material_id','category_id'
    ];

    protected $appends = ['currency_code' , 'currency_value', 'isFav'];

    public function getCurrencyCodeAttribute()
    {
        $country_id = \request()->header('country_id');
        if(isset($country_id)){
            $currency = \App\Models\Currency::where('country_id' , $country_id)->first();
        }else{
            $country_id = 1;
            $currency = \App\Models\Currency::where('country_id' , $country_id)->first();
        }
        try{
            return $currency->code;
        }catch (\Exception $e){
            $currency = \App\Models\Currency::where('country_id' , 1)->first();
            return $currency->code;
        }
    }
    public function getCurrencyValueAttribute()
    {
        $country_id = \request()->header('country_id');
        if(isset($country_id)){
            $currency = \App\Models\Currency::where('country_id' , $country_id)->first();
        }else{
            $country_id = 1;
            $currency = \App\Models\Currency::where('country_id' , $country_id)->first();
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
                $currency = \App\Models\Currency::where('country_id' , 1)->first();
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

    public function getIsFavAttribute()
    {
        if (\request()->bearerToken()) {
            $user = User::where('api_token', \request()->bearerToken())->first();
            $found = \App\Models\WishList::where('product_id', $this->id)->where('user_id', $user->id)->first();
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
    public function subImages()
    {
        return $this->morphMany('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'sub');
    }
    public function wishes()
    {
        return $this->hasMany('App\Models\WishList');
    }
}
