<?php

namespace App\Http\Controllers\Api;

use App\Mail\Orderscc;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartCoupon;
use App\Models\Coupon;
use App\Models\CouponUse;
use App\Models\Moderator;
use App\Models\Product;
use App\Models\ProductColor;
use App\Notifications\NewOrder;
use App\User;
use App\Models\Order;
use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function pay_product(Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $main_address = Address::where(['user_id' => $user->id, 'active' => 1])->first();
            $mytime = Carbon::now();
            if (isset($main_address)) {
                $order = new Order();
                $order->order_no = rand();
                /*******************/
                $order->status = 0;
                $order->processed = Carbon::now();
                /******** address **********/
                $order->fullname = $main_address->fullname;
                $order->street_address = $main_address->street_address;
                $order->building_no = $main_address->building_no;
                $order->city_id = $main_address->city_id;
                $order->area = $main_address->area;
                $order->phone = $main_address->phone;
                /******** end address **********/
                $order->time = $mytime->toTimeString();
                $order->date = $mytime->toDateString();
                $order->user_id = $user->id;
                /********************** price ************/
                $carts = Cart::where('user_id', $user->id)->get();
                $total = 0;
                if (count($carts) > 0) {
                    foreach ($carts as $cart) {
                        $color_product = ProductColor::where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->where('product_id',$cart->product_id)->first();
                        if(isset($color_product)){
                            $product = Product::find($cart->product_id);
                            if($color_product->stock_qty >= $cart->count){
                                $total+= $cart->price * $cart->count;
                                if(empty($cart->cobone_id)){
                                    $order->total_price = $total;
                                }else{
                                    $cobone = Coupon::where('id' , $cart->cobone_id)->first();
                                    $dis = ($cobone->value / 100) * $total;
                                    $order->total_price = $total - $dis;
                                    $order->cobone_id = $cart->cobone_id;
                                    $order->cobone_code = $cobone->code;
                                    $order->cobone_value = $cobone->value;
                                }
                            }else{
                                return response()->json([
                                    'status' => false,
                                    'msg' => trans('api.product_big')  . ' ' . $product['name_'.app()->getLocale()] ,
                                    'code' => 400,
                                ]);
                            }
                        }
                    }
                } else {
                    $order->total_price = 0;
                }
                /********************** end price ************/
                $order->save();
                /****** pay table get products *******/
                $productIds = [];
                if (count($carts) > 0) {
                    foreach ($carts as $value) {
                        $pay = new Pay();
                        $pay->order_id = $order->id;
                        $pay->product_id = $value->product_id;
                        $pay->count = $value->count;
                        $pay->color_id = $value->color_id;
                        $pay->size_id = $value->size_id;
                        $pay->save();

                        array_push($productIds, $value['id']);

                        $color_product_found = ProductColor::where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->where('product_id',$cart->product_id)->first();
                        $color_product_found->stock_qty = $color_product_found->stock_qty - $value->count;
                        $color_product_found->save();

                        $value->delete();
                    }
                } else {
                    $order->delete();
                    return response()->json([
                        'status' => false,
                        'msg' => trans('api.empty_cart'),
                        'code' => 400,
                    ]);
                }
                $admins = Moderator::where('status' , 1)->get();
                foreach ($admins as $admin){
                    $admin->notify(new NewOrder($order,$user));
                }
                $order = Order::where('id', $order->id)->with(array('pays' => function ($query) {
                        $query->select(
                            'id',
                            'count',
                            'order_id',
                            'color_id',
                            'size_id',
                            'product_id'
                        )->with(array('color' => function ($query) {
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
                        );
                    })
                )->with(array('city' => function ($query) {
                        $query->select(
                            'id',
                            'name_' . app()->getLocale() . ' as name'
                        );
                    })
                )->first();
                if ($order->status == 0) {
                    $order['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم استلام الطلب';
                    } else {
                        $order['status'] = 'signed';
                    }
                } elseif ($order->status == 1) {
                    $order['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التحضير';
                    } else {
                        $order['status'] = 'processed';
                    }
                } elseif ($order->status == 2) {
                    $order['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري الشحن';
                    } else {
                        $order['status'] = 'shipped';
                    }
                } elseif ($order->status == 3) {
                    $order['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التوصيل';
                    } else {
                        $order['status'] = 'out to delivery';
                    }
                } elseif ($order->status == 4) {
                    $order['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم التوصيل';
                    } else {
                        $order['status'] = 'delivered';
                    }
                }
                if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if ($order->status == 3 || $order->status == 4) {
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if ($order->status == 4) {
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
                $userr = User::find($order->user_id);
                \Mail::to($userr->email)->send(new Orderscc($order));
                return response()->json([
                    'status' => true,
                    'data' => $order,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_selected_address'),
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

    public function repay_product($orderId,Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $main_address = Address::where(['user_id' => $user->id, 'active' => 1])->first();
            $mytime = Carbon::now();
            $old_order = Order::find($orderId);
            if (isset($main_address)) {

                foreach ($old_order->pays as $value) {
                    $color_product = ProductColor::where('color_id' , $value->color_id)->where('size_id' , $value->size_id)->where('product_id',$value->product_id)->first();
                    if(isset($color_product)) {
                        $product = Product::find($value->product_id);
                        if($color_product->stock_qty >= $value->count){
                        }else{
                            return response()->json([
                                'status' => false,
                                'msg' => trans('api.product_big')  . ' ' . $product['name_'.app()->getLocale()] ,
                                'code' => 400,
                            ]);
                        }
                    }
                }

                $order = new Order();
                $order->order_no = rand();
                /*******************/
                $order->status = 0;
                $order->processed = Carbon::now();
                /******** address **********/
                $order->fullname = $main_address->fullname;
                $order->street_address = $main_address->street_address;
                $order->building_no = $main_address->building_no;
                $order->city_id = $main_address->city_id;
                $order->area = $main_address->area;
                $order->phone = $main_address->phone;
                /******** end address **********/
                $order->time = $mytime->toTimeString();
                $order->date = $mytime->toDateString();
                $order->user_id = $user->id;
                /********************** price ************/
                if(isset($old_order->old_price)){
                    $order->total_price = $old_order->old_price;
                }else{
                    $order->total_price = $old_order->total_price;
                }
                /********************** end price ************/
                $order->save();
                $admins = Moderator::where('status' , 1)->get();
                foreach ($admins as $admin){
                    $admin->notify(new NewOrder($order,$user));
                }
                /****** pay table get products *******/
                $productIds = [];
                foreach ($old_order->pays as $value) {
                    $pay = new Pay();
                    $pay->order_id = $order->id;
                    $pay->product_id = $value->product_id;
                    $pay->count = $value->count;
                    $pay->color_id = $value->color_id;
                    $pay->size_id = $value->size_id;
                    $pay->save();

                    $color_product_found = ProductColor::where('color_id' , $value->color_id)->where('size_id' , $value->size_id)->where('product_id',$value->product_id)->first();
                    $color_product_found->stock_qty = $color_product_found->stock_qty - $value->count;
                    $color_product_found->save();

                    array_push($productIds, $value['id']);
                }
                $order = Order::where('id', $order->id)->with(array('pays' => function ($query) {
                        $query->select(
                            'id',
                            'count',
                            'order_id',
                            'color_id',
                            'size_id',
                            'product_id'
                        )->with(array('color' => function ($query) {
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
                        );
                    })
                )->with(array('city' => function ($query) {
                        $query->select(
                            'id',
                            'name_' . app()->getLocale() . ' as name'
                        );
                    })
                )->first();
                if ($order->status == 0) {
                    $order['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم استلام الطلب';
                    } else {
                        $order['status'] = 'signed';
                    }
                } elseif ($order->status == 1) {
                    $order['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التحضير';
                    } else {
                        $order['status'] = 'processed';
                    }
                } elseif ($order->status == 2) {
                    $order['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري الشحن';
                    } else {
                        $order['status'] = 'shipped';
                    }
                } elseif ($order->status == 3) {
                    $order['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التوصيل';
                    } else {
                        $order['status'] = 'out to delivery';
                    }
                } elseif ($order->status == 4) {
                    $order['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم التوصيل';
                    } else {
                        $order['status'] = 'delivered';
                    }
                }
                if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if ($order->status == 3 || $order->status == 4) {
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if ($order->status == 4) {
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
                return response()->json([
                    'status' => true,
                    'data' => $order,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_selected_address'),
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

    public function orders(Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $orders = Order::where('user_id', $user->id)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'count',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
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
                    );
                })
            )->with(array('city' => function ($query) {
                    $query->select(
                        'id',
                        'name_' . app()->getLocale() . ' as name'
                    );
                })
            )->orderBy('id', 'desc')->get();
            foreach ($orders as $order) {
                if ($order->status == 0) {
                    $order['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم استلام الطلب';
                    } else {
                        $order['status'] = 'signed';
                    }
                } elseif ($order->status == 1) {
                    $order['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التحضير';
                    } else {
                        $order['status'] = 'processed';
                    }
                } elseif ($order->status == 2) {
                    $order['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري الشحن';
                    } else {
                        $order['status'] = 'shipped';
                    }
                } elseif ($order->status == 3) {
                    $order['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التوصيل';
                    } else {
                        $order['status'] = 'out to delivery';
                    }
                } elseif ($order->status == 4) {
                    $order['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم التوصيل';
                    } else {
                        $order['status'] = 'delivered';
                    }
                }
                if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if ($order->status == 3 || $order->status == 4) {
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if ($order->status == 4) {
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
            }
            if (count($orders) > 0) {
                return response()->json([
                    'status' => true,
                    'data' => $orders,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_orders'),
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

    public function confirmed_orders(Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $orders = Order::where('status', 4)->where('user_id', $user->id)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'count',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
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
                    );
                })
            )->with(array('city' => function ($query) {
                    $query->select(
                        'id',
                        'name_' . app()->getLocale() . ' as name'
                    );
                })
            )->orderBy('id', 'desc')->get();
            foreach ($orders as $order) {
                if ($order->status == 0) {
                    $order['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم استلام الطلب';
                    } else {
                        $order['status'] = 'signed';
                    }
                } elseif ($order->status == 1) {
                    $order['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التحضير';
                    } else {
                        $order['status'] = 'processed';
                    }
                } elseif ($order->status == 2) {
                    $order['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري الشحن';
                    } else {
                        $order['status'] = 'shipped';
                    }
                } elseif ($order->status == 3) {
                    $order['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التوصيل';
                    } else {
                        $order['status'] = 'out to delivery';
                    }
                } elseif ($order->status == 4) {
                    $order['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم التوصيل';
                    } else {
                        $order['status'] = 'delivered';
                    }
                }
                if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if ($order->status == 3 || $order->status == 4) {
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if ($order->status == 4) {
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
            }
            if (count($orders) > 0) {
                return response()->json([
                    'status' => true,
                    'data' => $orders,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_orders'),
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

    public function pending_orders(Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $orders = Order::where('status', '!=', 4)->where('user_id', $user->id)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'count',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
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
                    );
                })
            )->with(array('city' => function ($query) {
                    $query->select(
                        'id',
                        'name_' . app()->getLocale() . ' as name'
                    );
                })
            )->orderBy('id', 'desc')->get();
            foreach ($orders as $order) {
                if ($order->status == 0) {
                    $order['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم استلام الطلب';
                    } else {
                        $order['status'] = 'signed';
                    }
                } elseif ($order->status == 1) {
                    $order['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التحضير';
                    } else {
                        $order['status'] = 'processed';
                    }
                } elseif ($order->status == 2) {
                    $order['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري الشحن';
                    } else {
                        $order['status'] = 'shipped';
                    }
                } elseif ($order->status == 3) {
                    $order['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'جاري التوصيل';
                    } else {
                        $order['status'] = 'out to delivery';
                    }
                } elseif ($order->status == 4) {
                    $order['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $order['status'] = 'تم التوصيل';
                    } else {
                        $order['status'] = 'delivered';
                    }
                }
                if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if ($order->status == 3 || $order->status == 4) {
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if ($order->status == 4) {
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
            }
            if (count($orders) > 0) {
                return response()->json([
                    'status' => true,
                    'data' => $orders,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_orders'),
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

    public function order($orderID, Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $order = Order::where('user_id', $user->id)->where('id', $orderID)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'count',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
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
                    );
                })
            )->with(array('city' => function ($query) {
                    $query->select(
                        'id',
                        'name_' . app()->getLocale() . ' as name'
                    );
                })
            )->first();
            if ($order->status == 0) {
                $order['status_color'] = '#33AFFF';
                if (app()->getLocale() == 'ar') {
                    $order['status'] = 'تم استلام الطلب';
                } else {
                    $order['status'] = 'signed';
                }
            } elseif ($order->status == 1) {
                $order['status_color'] = '#9333FF';
                if (app()->getLocale() == 'ar') {
                    $order['status'] = 'جاري التحضير';
                } else {
                    $order['status'] = 'processed';
                }
            } elseif ($order->status == 2) {
                $order['status_color'] = '#FF33FC';
                if (app()->getLocale() == 'ar') {
                    $order['status'] = 'جاري الشحن';
                } else {
                    $order['status'] = 'shipped';
                }
            } elseif ($order->status == 3) {
                $order['status_color'] = '#FF3352';
                if (app()->getLocale() == 'ar') {
                    $order['status'] = 'جاري التوصيل';
                } else {
                    $order['status'] = 'out to delivery';
                }
            } elseif ($order->status == 4) {
                $order['status_color'] = '#33FF3C';
                if (app()->getLocale() == 'ar') {
                    $order['status'] = 'تم التوصيل';
                } else {
                    $order['status'] = 'delivered';
                }
            }
            if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
            }
            if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
            }
            if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
            }
            if ($order->status == 3 || $order->status == 4) {
                $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
            }
            if ($order->status == 4) {
                $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
            }
            if (isset($order)) {
                return response()->json([
                    'status' => true,
                    'data' => $order,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_order'),
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
    public function truck_order($orderID, Request $request)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->first();
            $order = Order::where('user_id', $user->id)->where('id', $orderID)->select('status','order_no')->first();
            if ($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
            }
            if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) {
                $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
            }
            if ($order->status == 2 || $order->status == 3 || $order->status == 4) {
                $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
            }
            if ($order->status == 3 || $order->status == 4) {
                $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
            }
            if ($order->status == 4) {
                $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
            }
            if (isset($order)) {
                return response()->json([
                    'status' => true,
                    'data' => $order->makeHidden('currency_value','currency_code','old_price','use_coupon','price_after_discount','discount_value','pays'),
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.no_order'),
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
}

