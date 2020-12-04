<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','imageable_id','image'
    ];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        if(isset($this->image)){
            if(\Request::is('api/home/category') || \Request::is('api/all-categories')|| \Request::is('api/categories-page')){
                return  \URL::asset('/pictures/categories/'.$this->image);
            }elseif(\Request::is('api/all-colors') || \Request::is('api/all-subcategories') || \Request::is('api/subcategory/*')
                || \Request::is('api/all-categories/*') || \Request::is('api/all-products/*')|| \Request::is('api/similar/product/*')
                || \Request::is('api/all-types') || \Request::is('api/all-materials')|| \Request::is('api/all-brands')
                || \Request::is('api/all-sizes') || \Request::is('api/home/all_chosen') || \Request::is('api/home/hot_offers')
                || \Request::is('api/home/hot_offers')|| \Request::is('api/home/chosen') || \Request::is('api/home/interests')
                || \Request::is('api/wish-list') || \Request::is('api/home/all_interests') || \Request::is('api/home/all_hot_offers')
                || \Request::is('api/search') || \Request::is('api/orders') || \Request::is('api/pay')  || \Request::is('api/order*') ){
                return  \URL::asset('/pictures/products/'.$this->image);
            }elseif(\Request::is('api/home/sliders')){
                return  \URL::asset('/pictures/sliders/'.$this->image);
            }elseif(\Request::is('api/cat-slider')){
                return  \URL::asset('/pictures/categories_slider/'.$this->image);
            }elseif(\Request::is('api/all-countries')){
                return  \URL::asset('/pictures/countries/'.$this->image);
            }
        }else{
            return null;
        }

    }
}
