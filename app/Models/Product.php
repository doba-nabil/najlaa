<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;

class Product extends Model
{
    use Sluggable;
    protected $appends = ['currency' , 'currency_count'];
    public function getCurrencyAttribute()
    {
        $country_id = app('request')->header('country_id');
        if(isset($country_id)){
            $country_id = $country_id;
        }else{
            $country_id = 2;
        }
        $currency = Currency::where('country_id' , $country_id)->first();
        if(!empty($currency->code)){
            return $currency->code;
        }else{
            return null;
        }
    }
    public function getCurrencyCountAttribute()
    {
        $country_id = app('request')->header('country_id');
        if(isset($country_id)){
            $country_id = $country_id;
        }else{
            $country_id = 2;
        }
        $currency = Currency::where('country_id' , $country_id)->first();
        $fromCurrency = $currency->code;
        $toCurrency = 'QAR';
        if($fromCurrency == $toCurrency){
            $result =  1;
            return "$result";
        }else{
            try{
                $url = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
                $get = file_get_contents($url);
                $data = preg_split('/\D\s(.*?)\s=\s/',$get);
                $exhangeRate = (float) substr($data[1],0,7);
                $result = round($exhangeRate , 3);
                return "$result";
            }catch (\Exception $e){
                return null;
            }
        }
    }
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
        'created_at', 'updated_at','subcategory_id' , 'brand_id' , 'material_id'
    ];

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
