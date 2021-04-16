<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    protected $fillable = [
        'name_ar', 'name_en','image', 'active' ,'created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }
    public function getActive()
    {
        return  $this->active == 1 ? 'Active' : 'Unactive';
    }
    public function mainImage()
    {
        return $this->morphOne('App\Models\Image', 'imageable', 'imageable_type', 'imageable_id')->where('type' , 'main');
    }


    public function products()
    {
        return $this->hasMany('App\Models\Product' , 'brand_id' , 'id');
    }
}
