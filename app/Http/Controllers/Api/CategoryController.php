<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('auth:api')->except('index' , 'show' , 'subcategories' , 'subcategory');
    }
    public function index()
    {
        try{
            $categories = Category::whereNull('parent_id')->with(array('subCategories'=>function($query){ $query->select(
                'id',
                'parent_id',
                'name_'.app()->getLocale().' as name'
            )->active();}))->with(array('mainImage'=>function($query){
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->get();
            return response()->json([
                'status' => true,
                'data' => $categories,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    public function show($id)
    {
        $category = Category::whereNull('parent_id')->with(array('subCategories'=>function($query){ $query->select(
            'id',
            'parent_id',
            'name_'.app()->getLocale().' as name'
        )->active();}))
            ->where('id',$id)->select(
            'id',
            'name_'.app()->getLocale().' as name'
        )->active()->first();
        if(isset($category)) {
            return response()->json([
                'status' => true,
                'data' => $category,
                'code' => 200,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'تصنيف غير موجودة',
                'code' => 400,
            ]);
        }
    }

    public function subcategories()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->with(array('subcategory_products'=>function($query){
                $query->select(
                    'id',
                    'subcategory_id',
                    'price',
                    'discount_price',
                    'percentage_discount',
                    'min_qty',
                    'max_qty',
                    'code',
                    'name_'.app()->getLocale().' as name',
                    'chosen'
                )->with('wishes')->active();
            }))->select(
                    'id',
                    'name_'.app()->getLocale().' as name'
            )->active()->get();
            return response()->json([
                'status' => true,
                'data' => $categories,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }

    public function subcategory($id)
    {
        try{
            $category = Category::where('id' , $id)->whereNotNull('parent_id')->with('products.wishes')->with(array('subcategory_products'=>function($query){
                    $query->select(
                        'id',
                        'subcategory_id',
                        'price',
                        'discount_price',
                        'percentage_discount',
                        'min_qty',
                        'max_qty',
                        'code',
                        'name_'.app()->getLocale().' as name',
                        'chosen'
                    )->active()->with(array('mainImage'=>function($query){
                            $query->select(
                                'image',
                                'imageable_id'
                            );
                        })
                    );
                })
            )->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->first();
            if(isset($category)){
                return response()->json([
                    'status' => true,
                    'data' => $category,
                    'code' => 200,
                ]);
            }
            return response()->json([
                'status' => false,
                'msg' => 'تصنيف غير موجود',
                'code' => 400,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
}
