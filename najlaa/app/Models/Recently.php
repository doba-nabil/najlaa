<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recently extends Model
{
    public function products()
    {
        return $this->belongsTo('App\Models\Product' , 'product_id' , 'id')->active();
    }
}
