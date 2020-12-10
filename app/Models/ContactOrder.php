<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactOrder extends Model
{
    protected $fillable = [
        'id','name', 'email','phone','type_id','order_id','message','created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at','type_id','order_id','user_id'
    ];
    public function getType()
    {
        if($this->type_id == 1){
            return 'Complaint';
        }elseif($this->type_id == 2){
            return 'Suggestion';
        }elseif($this->type_id == 3){
            return 'Evaluation';
        }
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
