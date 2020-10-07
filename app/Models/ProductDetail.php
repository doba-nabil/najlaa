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
}
