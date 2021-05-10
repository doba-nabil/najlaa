<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','product_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function sizes()
    {
        return $this->hasMany('App\Models\ColorSize');
    }
}
