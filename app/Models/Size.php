<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'code','active' ,'created_at' , 'updated_at'
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
        return $this->hasMany('App\Models\ProductColor','size_id');
    }

    public function pays()
    {
        return $this->hasMany('App\Models\Pay');
    }

}
