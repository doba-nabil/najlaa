<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySlider;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('auth:api')->except('index' , 'show' , 'subcategories' , 'subcategory',
            'category_sliders','categories_page','all_cats');
    }
    public function category_sliders()
    {
        try{
            $sliders = CategorySlider::select(
                'id',
                'title_'.app()->getLocale().' as title',
                'category_id',
                'subtitle_'.app()->getLocale().' as subtitle'
            )->active()->with(array('mainImage'=>function($query){
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->get();
            $sliderss = [];
            foreach ($sliders as $slider){
                if(!empty($slider->category_id)){
                    $category = Category::where('id' , $slider->category_id)->first();
                    if($category->active == 1){
                        array_push($sliderss , $slider);
                        if(empty($category->parent_id)){
                            $slider['link'] = \Request::root().'/api/all-categories/' . $slider->category_id;
                            $slider['kind'] = 'category';
                        }elseif(!empty($category->parent_id)){
                            $slider['link'] = \Request::root().'/api/subcategory/' . $slider->category_id;
                            $slider['kind'] = 'subcategory';
                        }
                    }
                }else{
                    array_push($sliderss , $slider);
                }
            }
            if(count($sliderss) > 0){
                return response()->json([
                    'status' => true,
                    'data' => $sliderss,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_offers'),
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
    public function index()
    {
        try{
            $categories = Category::whereNull('parent_id')->with(array('mainImage'=>function($query){
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->withCount('category_products')->get();
            return response()->json([
                'status' => true,
                'categories_count' => $categories->count(),
                'data' => $categories,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
    public function all_cats()
    {
        try{
            $categories = Category::whereNull('parent_id')->with(array('category_products'=>function($query){
                $query->select(
                    'id',
                    'category_id',
                    'price',
                    'discount_price',
                    'percentage_discount',
                    'code',
                    'name_'.app()->getLocale().' as name',
                    'chosen'
                )->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->active()->get();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->withCount('category_products')->get();
            return response()->json([
                'status' => true,
                'data' => $categories,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
    public function categories_page()
    {
        try{
            $categories = Category::whereNull('parent_id')->with(array('mainImage'=>function($query){
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->with(array('subCategories'=>function($query){ $query->select(
                'id',
                'parent_id',
                'name_'.app()->getLocale().' as name'
            )->active();}))->withCount('category_products')->get();
            return response()->json([
                'status' => true,
                'categories_count' => $categories->count(),
                'data' => $categories,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
    public function show($id)
    {
        $categoryy = Category::find($id);
        if(\Request::is('api/all-categories/*')){
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
                    'msg' => trans('api.no_category'),
                    'code' => 400,
                ]);
            }
        }elseif(\Request::is('api/home-category/*')){
            $category = Category::whereNull('parent_id')->with(array('category_products'=>function($query){
                $query->select(
                    'id',
                    'category_id',
                    'price',
                    'discount_price',
                    'percentage_discount',
                    'code',
                    'name_'.app()->getLocale().' as name',
                    'chosen'
                )->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->active()->paginate(5);
            }))
                ->where('id',$id)->select(
                    'id',
                    'name_'.app()->getLocale().' as name'
                )->active()->withCount('category_products')->first();
            if(isset($category)) {
                return response()->json([
                    'status' => true,
                    'data' => $category,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_category'),
                    'code' => 400,
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'msg' => trans('api.no_content'),
                'code' => 400,
            ]);
        }
    }

    public function subcategories()
    {

            $categories = Category::whereNotNull('parent_id')->with(array('subcategory_products'=>function($query){
                $query->select(
                    'id',
                    'subcategory_id',
                    'price',
                    'discount_price',
                    'percentage_discount',
                    'code',
                    'name_'.app()->getLocale().' as name',
                    'chosen'
                )->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->active()->paginate(10);
            }))->select(
                    'id',
                    'name_'.app()->getLocale().' as name'
            )->active()->withCount('subcategory_products')->get();
            return response()->json([
                'status' => true,
                'data' => $categories,
                'code' => 200,
            ]);

    }

    public function subcategory($id)
    {
        try{
            $category = Category::where('id' , $id)->whereNotNull('parent_id')->with('subcategory_products.wishes')->with(array('subcategory_products'=>function($query){
                    $query->select(
                        'id',
                        'subcategory_id',
                        'price',
                        'discount_price',
                        'percentage_discount',
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
                'msg' => trans('api.no_category'),
                'code' => 400,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
}
