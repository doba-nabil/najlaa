<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','active' ,'color','created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at','active'
    ];

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'Active' : 'Unactive';
    }

    public function productDetails()
    {
        return $this->hasMany('App\Models\ProductDetail','color_id');
    }

}
