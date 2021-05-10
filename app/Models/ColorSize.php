<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','product_color_id'
    ];
    public function color()
    {
        return $this->belongsTo('App\Models\ProductColor','product_color_id');
    }
}
