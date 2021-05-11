<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductColor extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','product_id','color_id','size_id'
    ];
    protected $appends = ['sizes'];
    public function getSizesAttribute()
    {
        $selected_colors = DB::table('product_colors')->where('product_id' ,$this->product_id)->where('color_id',$this->color_id)
            ->select('color_id')
            ->distinct()
            ->pluck('color_id');
        $sizes = ProductColor::whereIn('color_id' , $selected_colors)->where('product_id' ,$this->product_id)->pluck('size_id');
        $sizess = Size::whereIn('id' ,$sizes)->active()->get();
        return $sizess;
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }
}
