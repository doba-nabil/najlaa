<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title_ar', 'title_en','subtitle_ar', 'subtitle_en','image','link', 'active' ,'created_at' , 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at','link'
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
    public function offer_products()
    {
        return $this->hasMany('App\Models\OfferProduct' , 'slider_id' , 'id');
    }
}
