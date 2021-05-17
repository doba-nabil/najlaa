<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmptyProductNotification extends Model
{
    public function moderator()
    {
        return $this->belongsTo('App\Moderator');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }
    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
