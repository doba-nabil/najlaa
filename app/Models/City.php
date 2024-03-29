<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','country_id', 'active' ,'created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at','country_id',
    ];
    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'Active' : 'Unactive';
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
