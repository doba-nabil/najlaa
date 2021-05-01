<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    public function slider()
    {
        return $this->belongsTo('App\Models\Slider');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product')->active();
    }
}
