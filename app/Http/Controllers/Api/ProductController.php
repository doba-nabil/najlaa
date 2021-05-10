<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChooseConuntry;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Recently;
use App\Models\Size;
use App\Models\WishList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('show', 'similar', 'views' ,'types', 'materials' , 'brands',
            'sizes','colors','search','type' , 'material' , 'brand' , 'size' , 'color');
    }

    public function show($id, Request $request)
    {
        try{
            $product = Product::with(array('category' => function ($query) {
                $query->select(
                    'id',
                    'name_' . app()->getLocale() . ' as name'
                )->active();
            }))->with(array('subcategory' => function ($query) {
                $query->select(
                    'id',
                    'name_' . app()->getLocale() . ' as name'
                )->active();
            }))->with(array('material' => function ($query) {
                $query->select(
                    'id',
                    'name_' . app()->getLocale() . ' as name'
                )->active();
            }))->with(array('colors' => function ($query) {
                $query->select(
                    'id',
                    'color',
                    'product_id',
                    'stock_qty'
                )->with(array('sizes' => function ($query) {
                    $query->select(
                        'id',
                        'size',
                        'product_color_id'
                    );
                }));
            }))
                ->where('id', $id)->select(
                    'id',
                    'subcategory_id',
                    'category_id',
                    'brand_id',
                    'material_id',
                    'price',
                    'discount_price',
                    'percentage_discount',
                    'code',
                    'name_' . app()->getLocale() . ' as name',
                    'body_' . app()->getLocale() . ' as body',
                    'chosen'
                )->active()->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->with(array('sizeImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->with(array('subImages' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->first();
            $pro = Product::find($id);
            $pro->views = $pro->views + 1 ;
            $pro->save();
            $products = [];
            if ($request->bearerToken()) {
                $user = User::where('api_token', $request->bearerToken())->first();
                $found = WishList::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if (isset($found)) {
                    $product['isFav'] = true;
                } else {
                    $product['isFav'] = false;
                }
            } else {
                $product['isFav'] = false;
            }
            array_push($products, $product);
            if (isset($product)) {
                $recrntly = new Recently();
                $recrntly->device_token = \Request::header('token');
                $recrntly->kind = 'product';
                $recrntly->product_id = $product->id;
                $recrntly->save();
                return response()->json([
                    'status' => true,
                    'data' => $products,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_product'),
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

    public function similar($id,Request $request)
    {
        try {
            $product = Product::where('id', $id)->first();
            if(isset($product)){
                $similar_products = Product::where('subcategory_id', $product->subcategory_id)->select(
                    'id',
                    'name_' . app()->getLocale() . ' as name',
                    'price',
                    'discount_price',
                    'percentage_discount'
                )->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->active()->where('id', '!=', $id)->orderBy('id', 'desc')->get();
                $products = [];
                foreach($similar_products as $one_product){
                    $product = $one_product;
                    if ($request->bearerToken()) {
                        $user= User::where('api_token', $request->bearerToken())->first();
                        $found = WishList::where('product_id', $one_product->id)->where('user_id', $user->id)->first();
                        if (isset($found)) {
                            $product['isFav'] = true;
                        } else {
                            $product['isFav'] = false;
                        }
                    } else {
                        $product['isFav'] = false;
                    }
                    array_push($products,$product);
                }
                if (count($similar_products) > 0) {
                    return response()->json([
                        'status' => true,
                        'data' => $products,
                        'code' => 200,
                    ]);
                }
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_same_product'),
                    'code' => 400,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_product'),
                    'code' => 400,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }

    }
    public function views($id)
    {
        try {
            $product = Product::where('id', $id)->first();
            $last_views = Product::where('subcategory_id', $product->subcategory_id)->select(
                'id',
                'name_' . app()->getLocale() . ' as name',
                'price',
                'discount_price',
                'percentage_discount'
            )->with(array('mainImage' => function ($query) {
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->active()->where('id', '!=', $id)->orderBy('id', 'desc')->get();
            if (count($last_views) > 0) {
                return response()->json([
                    'status' => true,
                    'data' => $last_views,
                    'code' => 200,
                ]);
            }
            return response()->json([
                'status' => false,
                'msg' => trans('api.no_products'),
                'code' => 400,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }

    }

    public function types()
    {
        try{
            $types = Category::whereNotNull('parent_id')->with(array('subcategory_products'=>function($query){
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
                )->with('wishes')->active();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->get();
            return response()->json([
                'status' => true,
                'data' => $types,
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
    public function type($id)
    {
        try{
            $type = Category::where('id' , $id)->whereNotNull('parent_id')->with(array('subcategory_products'=>function($query){
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
                )->with('wishes')->active();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->first();
            if(isset($type)){
                return response()->json([
                    'status' => true,
                    'data' => $type,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_content'),
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

    public function materials()
    {
        try{
            $materials = Material::with(array('products'=>function($query){
                $query->select(
                    'id',
                    'price',
                    'material_id',
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
                )->with('wishes')->active();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->get();
            return response()->json([
                'status' => true,
                'data' => $materials,
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
    public function material($id)
    {
        try{
            $material = Material::where('id' , $id)->with(array('products'=>function($query){
                $query->select(
                    'id',
                    'price',
                    'material_id',
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
                )->with('wishes')->active();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->first();
            if(isset($material)){
                return response()->json([
                    'status' => true,
                    'data' => $material,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_content'),
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

    public function brands()
    {
        try{
            $brands = Brand::with(array('products'=>function($query){
                $query->select(
                    'id',
                    'price',
                    'brand_id',
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
                )->with('wishes')->active();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->get();
            return response()->json([
                'status' => true,
                'data' => $brands,
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
    public function brand($id)
    {
        try{
            $brand = Brand::where('id' , $id)->with(array('products'=>function($query){
                $query->select(
                    'id',
                    'price',
                    'brand_id',
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
                )->with('wishes')->active();
            }))->select(
                'id',
                'name_'.app()->getLocale().' as name'
            )->active()->first();
            if(isset($brand)){
                return response()->json([
                    'status' => true,
                    'data' => $brand,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_content'),
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


    public function sizes()
    {
        try{
            $categories = ProductColor::with(array('product'=>function($query){
                    $query->select(
                        'id',
                        'price',
                        'brand_id',
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
                    );
            }))->get();
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
    public function size($id)
    {
        try{
            $size = ColorSize::where('id' , $id)->with(array('productDetails'=>function($query){
                $query->select(
                    'id',
                    'product_id',
                    'size_id'
                )->with(array('product'=>function($query){
                    $query->select(
                        'id',
                        'price',
                        'brand_id',
                        'discount_price',
                        'percentage_discount',
                        'min_qty',
                        'max_qty',
                        'code',
                        'name_'.app()->getLocale().' as name',
                        'chosen'
                    )->with(array('mainImage' => function ($query) {
                            $query->select(
                                'image',
                                'imageable_id'
                            );
                        })
                    );
                }));
            }))->active()->first();
            if(isset($size)){
                return response()->json([
                    'status' => true,
                    'data' => $size,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_content'),
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

    public function colors()
    {
        try{
            $categories = ProductColor::select( 'id', 'product_id','color','stock_qty')->with(array('product'=>function($query){
                    $query->select(
                        'id',
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
                    );
            }))->get();
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
    public function color($id)
    {
        try{
            $color = ProductColor::where('id' , $id)->select( 'id', 'product_id','color','stock_qty')->with(array('product'=>function($query){
                    $query->select(
                        'id',
                        'price',
                        'discount_price',
                        'percentage_discount',
                        'min_qty',
                        'max_qty',
                        'code',
                        'name_'.app()->getLocale().' as name',
                        'chosen'
                    )->with(array('mainImage' => function ($query) {
                            $query->select(
                                'image',
                                'imageable_id'
                            );
                        })
                    );
            }))->first();
            if(isset($color)){
                return response()->json([
                    'status' => true,
                    'data' => $color,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_content'),
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

    public function search(Request $request)
    {
        try{
            $word = $request->word;

            $recrntly = new Recently();
            $recrntly->device_token = \Request::header('token');
            $recrntly->kind = 'word';
            $recrntly->word = $word;
            $recrntly->save();

            $products =  Product::where('name_ar', 'LIKE', "%$word%")->orWhere('name_en', 'LIKE', "%$word%")->select(
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
            )->with(array('mainImage' => function ($query) {
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->active()->get();
            if(count($products) > 0){
                return response()->json([
                    'status' => true,
                    'data' => $products,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_content'),
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.no_content'),
                'code' => 400,
            ]);
        }
    }
}
