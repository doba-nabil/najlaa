<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChooseConuntry extends Model
{
    protected $fillable = [
        'device_token', 'country_id','created_at','updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
