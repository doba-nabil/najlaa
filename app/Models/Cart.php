<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','token','product_id' , 'size_id' , 'color_id'
    ];

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
