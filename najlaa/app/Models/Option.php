<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'face', 'insta','whats','snapchat','twitter' ,'phone' , 'active' , 'ios' , 'andriod','email','address_ar','address_en','created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
