<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Notifiable;
    protected $hidden = [
        'created_at', 'updated_at','user_id','city_id','new','status','paid'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\city');
    }
    public function pays()
    {
        return $this->hasMany('App\Models\Pay');
    }
}
