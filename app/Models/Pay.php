<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use Notifiable;
    protected $hidden = [
        'created_at', 'updated_at','order_id','color_id' , 'size_id','product_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
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
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

}
