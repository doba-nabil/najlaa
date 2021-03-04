<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        try{
            $token = \Request::header('token');
            $api_token = $request->bearerToken();
            if(isset($api_token)){
                $user = User::where('api_token' , $request->bearerToken())->first();
                $carts = Cart::where('user_id' , $user->id)->with(array('color' => function ($query) {
                        $query->select(
                            'id',
                            'color',
                            'name_' . app()->getLocale() . ' as name'
                        );
                    })
                )->with(array('size' => function ($query) {
                        $query->select(
                            'id',
                            'code'
                        );
                    })
                )->with(array('product' => function ($query) {
                        $query->select(
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
                        );
                    })
                )->orderBy('id' , 'desc')->get();
                if(count($carts) > 0){
                    return response()->json([
                        'status' => true,
                        'data' => $carts,
                        'code' => 200,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'السلة فارغة',
                        'code' => 400,
                    ]);
                }
            }else{
                $carts = Cart::where('token' , $token)->with(array('color' => function ($query) {
                        $query->select(
                            'id',
                            'color',
                            'name_' . app()->getLocale() . ' as name'
                        );
                    })
                )->with(array('size' => function ($query) {
                        $query->select(
                            'id',
                            'code'
                        );
                    })
                )->with(array('product' => function ($query) {
                        $query->select(
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
                        );
                    })
                )->orderBy('id' , 'desc')->get();
                if(count($carts) > 0){
                    return response()->json([
                        'status' => true,
                        'data' => $carts,
                        'code' => 200,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'السلة فارغة',
                        'code' => 400,
                    ]);
                }
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    public function edit_cart($cartID , Request $request)
    {
        try{
            $token = \Request::header('token');
            $api_token = $request->bearerToken();
            if(isset($api_token)){
                $user = User::where('api_token' , $request->bearerToken())->first();
                $cart = Cart::where('id' , $cartID)->where('user_id' , $user->id)->first();
                if(isset($cart)){
                    $cart->count = $request->count;
                    if(empty($cart->product->discount_price)){
                        $cart->price = $request->count * $cart->product->price;
                    }elseif(!empty($cart->product->discount_price)){
                        $cart->price = $request->count * $cart->product->discount_price;
                    }
                    $cart->save();
                }
            }else{
                $cart = Cart::where('id' , $cartID)->where('token' , $token)->first();
               if(isset($cart)){
                   $cart->count = $request->count;
                   if(empty($cart->product->discount_price)){
                       $cart->price = $request->count * $cart->product->price;
                   }elseif(!empty($cart->product->discount_price)){
                       $cart->price = $request->count * $cart->product->discount_price;
                   }
                   $cart->save();
               }
            }
            if(isset($cart)){
                $cartt = Cart::where('id' , $cart->id)->with(array('color' => function ($query) {
                        $query->select(
                            'id',
                            'color',
                            'name_' . app()->getLocale() . ' as name'
                        );
                    })
                )->with(array('size' => function ($query) {
                        $query->select(
                            'id',
                            'code'
                        );
                    })
                )->with(array('product' => function ($query) {
                        $query->select(
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
                        );
                    })
                )->first();
                return response()->json([
                    'status' => true,
                    'data' => $cartt,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'لا يوجد ما يتم التعديل علية',
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    public function add_cart(Request $request)
    {
        try{
            $token = \Request::header('token');
            $product = Product::where('id' , $request->product_id)->first();
            $api_token = $request->bearerToken();
            if(isset($api_token)){
                $user = User::where('api_token' , $request->bearerToken())->first();
                if(isset($user)){
                    $found = Cart::where('product_id' , $request->product_id)->where('user_id',$user->id)->first();
                }
            }else{
                $found = Cart::where('product_id' , $request->product_id)->where('token',$token)->first();
            }
            if(isset($found)){
                $found->count = $found->count + $request->count;
                if(empty($product->discount_price)){
                    $found->price = $found->count * $product->price;
                }else{
                    $found->price = $found->count * $product->discount_price;
                }
                $found->save();
                $cart = $found;
            }else{
                $cart = new Cart();

                if(isset($api_token)){
                    if(isset($user)){
                        $cart->user_id = $user->id;
                    }
                }else{
                    $cart->token = $token;
                }
                if(empty($product->discount_price)){
                    $cart->price = $request->count * $product->price;
                }elseif(!empty($product->discount_price)){
                    $cart->price = $request->count * $product->discount_price;
                }
                $cart->product_id = $request->product_id;
                $cart->size_id = $request->size_id;
                $cart->color_id = $request->color_id;
                $cart->count = $request->count;
                $cart->save();
            }
            if(isset($api_token)){
                $user = User::where('api_token' , $request->bearerToken())->first();
                if(isset($user)){
                    $cartt = Cart::where('id',$cart->id)->where('user_id' , $user->id)->with(array('color' => function ($query) {
                            $query->select(
                                'id',
                                'color',
                                'name_' . app()->getLocale() . ' as name'
                            );
                        })
                    )->with(array('size' => function ($query) {
                            $query->select(
                                'id',
                                'code'
                            );
                        })
                    )->with(array('product' => function ($query) {
                            $query->select(
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
                            );
                        })
                    )->first();
                }
            }else{
                $cartt = Cart::where('id',$cart->id)->where('token' , $token)->with(array('color' => function ($query) {
                        $query->select(
                            'id',
                            'color',
                            'name_' . app()->getLocale() . ' as name'
                        );
                    })
                )->with(array('size' => function ($query) {
                        $query->select(
                            'id',
                            'code'
                        );
                    })
                )->with(array('product' => function ($query) {
                        $query->select(
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
                        );
                    })
                )->first();
            }
            return response()->json([
                'status' => true,
                'data' => $cartt,
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
    public function remove_single(Request $request , $cartID)
    {
        try{
            $token = \Request::header('token');
            $api_token = $request->bearerToken();
            if(isset($api_token)){
                $user = User::where('api_token' , $request->bearerToken())->first();
                $cart = Cart::where('id' , $cartID)->where('user_id' , $user->id)->first();
                if(isset($cart)){
                    $cart->delete();
                }else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'لا يوجد مايتم حذفة',
                        'code' => 400,
                    ]);
                }
            }else{
                $cart = Cart::where('id' , $cartID)->where('token' , $token)->first();
                if(isset($cart)){
                    $cart->delete();
                }else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'لا يوجد مايتم حذفة',
                        'code' => 400,
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'msg' => 'تم الحذف من السلة بنجاح',
                'code' => 200,
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    public function remove_all(Request $request)
    {
        try{
            $token = \Request::header('token');
            $api_token = $request->bearerToken();
            if(isset($api_token)){
                $user = User::where('api_token' , $request->bearerToken())->first();
                if(isset($user)){
                    $carts = Cart::where('user_id' , $user->id)->get();
                }
            }else{
                $carts = Cart::where('token' , $token)->get();
            }
            foreach ($carts as $cart){
                $cart->delete();
            }
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف محتوى العربة بنجاح',
                'code' => 200,
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
}
