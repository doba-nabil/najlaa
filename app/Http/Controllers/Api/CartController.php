<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        try{
            $token = \Request::header('token');

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

            $cart = Cart::where('id' , $cartID)->where('token' , $token)->first();
            $cart->count = $request->count;
            if(empty($cart->product->discount_price)){
                $cart->price = $request->count * $cart->product->price;
            }elseif(!empty($cart->product->discount_price)){
                $cart->price = $request->count * $cart->product->discount_price;
            }
            $cart->save();

            $cartt = Cart::where('id' , $cart->id)->where('token' , $token)->with(array('color' => function ($query) {
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
            if(isset($cartt)){
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
            $cart = new Cart();
            if(empty($product->discount_price)){
                $cart->price = $request->count * $product->price;
            }elseif(!empty($product->discount_price)){
                $cart->price = $request->count * $product->discount_price;
            }
            $cart->product_id = $request->product_id;
            $cart->size_id = $request->size_id;
            $cart->color_id = $request->color_id;
            $cart->count = $request->count;
            $cart->token = $token;
            $cart->save();

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
    public function remove_single($cartID)
    {
        try{
            $token = \Request::header('token');
            $cart = Cart::where('id' , $cartID)->where('token' , $token)->first();
            $cart->delete();
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
    public function remove_all()
    {
        try{
            $token = \Request::header('token');
            $carts = Cart::where('token' , $token)->get();
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
