<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Product;
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
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $main_address = Address::where(['user_id' => $user->id, 'active' => 1])->first();
            $mytime = Carbon::now();
            if (isset($main_address)) {
                $order = new Order();
                $order->order_no = rand();
                /*******************/
                $order->status = 1;
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
                $order->total_price = $request->total_price;
                $order->save();
                /****** pay table get products *******/
                $productIds = [];
                $products = $request->products;
                $json = $products;
                foreach ($json as $value) {
                    $pay = new Pay();
                    $pay->order_id = $order->id;
                    $pay->product_id = $value['id'];
                    $pay->count = $value['count'];
                    $pay->color_id = $value['color_id'];
                    $pay->size_id = $value['size_id'];
                    $pay->save();
                    array_push($productIds, $value['id']);
                }
                $order = Order::where('id', $order->id)->with(array('pays' => function ($query) {
                        $query->select(
                            'id',
                            'order_id',
                            'color_id',
                            'size_id',
                            'product_id'
                        )->with(array('color' => function ($query) {
                                $query->select(
                                    'id',
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
                return response()->json([
                    'status' => true,
                    'data' => $order,
                    'code' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'لا يوجد عنوان محدد',
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

    public function orders(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $orders = Order::where('user_id', $user->id)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
                            $query->select(
                                'id',
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
            foreach($orders as $order){
                if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if($order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if($order->status == 3 || $order->status == 4){
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if($order->status == 4){
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
            }
            if(count($orders) > 0){
                return response()->json([
                    'status' => true,
                    'data' => $orders,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'لا يوجد طلبات',
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
    public function confirmed_orders(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $orders = Order::where('status' , 4)->where('user_id', $user->id)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
                            $query->select(
                                'id',
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
            foreach($orders as $order){
                if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if($order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if($order->status == 3 || $order->status == 4){
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if($order->status == 4){
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
            }
            if(count($orders) > 0){
                return response()->json([
                    'status' => true,
                    'data' => $orders,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'لا يوجد طلبات',
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
    public function pending_orders(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $orders = Order::where('status','!=' , 4)->where('user_id', $user->id)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
                            $query->select(
                                'id',
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
            foreach($orders as $order){
                if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                    $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
                }
                if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                    $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
                }
                if($order->status == 2 || $order->status == 3 || $order->status == 4){
                    $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                    $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
                }
                if($order->status == 3 || $order->status == 4){
                    $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                    $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
                }
                if($order->status == 4){
                    $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                    $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
                }
            }
            if(count($orders) > 0){
                return response()->json([
                    'status' => true,
                    'data' => $orders,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'لا يوجد طلبات',
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
    public function order($orderID , Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $order = Order::where('user_id', $user->id)->where('id',$orderID)->with(array('pays' => function ($query) {
                    $query->select(
                        'id',
                        'order_id',
                        'color_id',
                        'size_id',
                        'product_id'
                    )->with(array('color' => function ($query) {
                            $query->select(
                                'id',
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
            if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                $order['signed_date'] = Carbon::parse($order->date)->format('d M Y');
                $order['signed_time'] = Carbon::parse($order->time)->format('h:i A');
            }
            if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4){
                $order['processed_date'] = Carbon::parse($order->processed)->format('d M Y');
                $order['processed_time'] = Carbon::parse($order->processed)->format('h:i A');
            }
            if($order->status == 2 || $order->status == 3 || $order->status == 4){
                $order['shipped_date'] = Carbon::parse($order->shipped)->format('d M Y');
                $order['shipped_time'] = Carbon::parse($order->shipped)->format('h:i A');
            }
            if($order->status == 3 || $order->status == 4){
                $order['out_to_delivery_date'] = Carbon::parse($order->out_to_delivery)->format('d M Y');
                $order['out_to_delivery_time'] = Carbon::parse($order->out_to_delivery)->format('h:i A');
            }
            if($order->status == 4){
                $order['delivered_date'] = Carbon::parse($order->delivered)->format('d M Y');
                $order['delivered_time'] = Carbon::parse($order->delivered)->format('h:i A');
            }
            if(isset($order)){
                return response()->json([
                    'status' => true,
                    'data' => $order,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'طلب غير موجود',
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
}
