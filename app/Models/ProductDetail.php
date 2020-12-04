<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }
    protected $hidden = [
        'created_at', 'updated_at','type','product_id','color_id' , 'size_id','id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
