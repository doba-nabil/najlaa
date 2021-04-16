<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChoseCountry extends Model
{
    protected $fillable = [
        'user_id', 'country_id','created_at','updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
