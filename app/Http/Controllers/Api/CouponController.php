<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartCoupon;
use App\Models\Coupon;
use App\Models\CouponUse;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function check_coupon(Request $request){
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $carts = Cart::where('user_id' , $user->id)->get();
            if(count($carts)){
                $coupon = Coupon::where('code' , $request->code)->first();
                if(isset($coupon)){
                    $mytime = Carbon::now();
                    if($coupon->end_date >= $mytime){
                        $co = $coupon->select('id','code','value as percent')->first();
                        $coupon_user_usess = CouponUse::where('cobone_id' , $coupon->id)->where('user_id' , $user->id)->get();
                        if($coupon->user_used_count >= count($coupon_user_usess)){
                            if($coupon->active == 1){
                                if($coupon->used_count > 0){
                                    $coupon->used_count = $coupon->used_count - 1;
                                    $coupon->save();

                                    $coupon_uses = new CouponUse();
                                    $coupon_uses->user_id = $user->id;
                                    $coupon_uses->cobone_id = $coupon->id;
                                    $coupon_uses->save();

                                    $coupon_order = new CartCoupon();
                                    $coupon_order->user_id = $user->id;
                                    $coupon_order->cobone_id = $coupon->id;
                                    $coupon_order->save();

                                    foreach ($carts as $cart){
                                        $cart->cobone_id = $coupon->id;
                                        $cart->save();
                                    }

                                    return response()->json([
                                        'status' => true,
                                        'data' => $co,
                                        'code' => 200,
                                    ]);
                                }else{
                                    return response()->json([
                                        'status' => false,
                                        'msg' => 'تم استنفاذ مرات استخدام الكوبون',
                                        'code' => 400,
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'status' => false,
                                    'msg' => 'كوبون غير فعال',
                                    'code' => 400,
                                ]);
                            }
                        }else{
                            return response()->json([
                                'status' => false,
                                'msg' => 'تم نفاذ المرات المحددة لك لاستخدام الكوبون',
                                'code' => 400,
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status' => false,
                            'msg' => 'كوبون منتهي',
                            'code' => 400,
                        ]);
                    }
                }else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'كود خاطئ',
                        'code' => 400,
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'السلة فارغة',
                    'code' => 400,
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }

    public function delete_coupon(Request $request,$id){
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $carts = Cart::where('user_id' , $user->id)->get();
            if(count($carts)){
                $coupon = Coupon::where('id' , $id)->first();
                if(isset($coupon)){
                    $coupon->used_count = $coupon->used_count + 1;
                    $coupon->save();

                    $coupon_uses = CouponUse::where('cobone_id' , $coupon->id)->orderBy('id' , 'desc')->first();
                    $coupon_uses->delete();

                    $coupon_order = CartCoupon::where('cobone_id' , $coupon->id)->orderBy('id' , 'desc')->first();
                    $coupon_order->delete();

                    foreach ($carts as $cart){
                        $cart->cobone_id = null;
                        $cart->save();
                    }

                    return response()->json([
                        'status' => true,
                        'data' => 'تم حذف الكوبون بنجاح',
                        'code' => 200,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'كود خاطئ',
                        'code' => 400,
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'السلة فارغة',
                    'code' => 400,
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
}
