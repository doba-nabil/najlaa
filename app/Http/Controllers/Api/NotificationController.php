<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('');
    }
    public function notifications(Request $request)
    {
        try{
            $user = User::where('api_token' , $request->bearerToken())->first();
            $notifications = DB::table('notifications')->where('notifiable_id' , $user->id)->where('notifiable_type' , 'App\User')->orderBy('created_at' , 'desc')->get();
            $nots = [];
            foreach ($notifications as $notification){
                $ntification = Notification::select('data')->where('id' , $notification->id)->first();
                $ntification['not_id'] = $notification->id;
                $data = json_decode($ntification['data'], true);
                $orderstatus = $data['orderstatus'];
                $ntification['order'] = $orderstatus;

                if ($ntification['order']['status'] == 0) {
                    $ntification['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم استلام الطلب';
                    } else {
                        $ntification['order_status'] = 'signed';
                    }
                } elseif ($ntification['order']['status'] == 1) {
                    $ntification['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التحضير';
                    } else {
                        $ntification['order_status'] = 'processed';
                    }
                } elseif ($ntification['order']['status'] == 2) {
                    $ntification['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري الشحن';
                    } else {
                        $ntification['order_status'] = 'shipped';
                    }
                } elseif ($ntification['order']['status'] == 3) {
                    $ntification['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التوصيل';
                    } else {
                        $ntification['order_status'] = 'out to delivery';
                    }
                } elseif ($ntification['order']['status'] == 4) {
                    $ntification['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم التوصيل';
                    } else {
                        $ntification['order_status'] = 'delivered';
                    }
                }
                array_push($nots , $ntification);
            }
            if(count($nots) > 0){
                return response()->json([
                    "date" => $nots,
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    "msg" => 'لا يوجد اشعارات',
                    'status' => false,
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }
    public function new_notifications(Request $request)
    {
        try{
            $user = User::where('api_token' , $request->bearerToken())->first();
            $notifications = DB::table('notifications')->whereNull('read_at')->where('notifiable_id' , $user->id)->where('notifiable_type' , 'App\User')->orderBy('created_at' , 'desc')->get();
            $nots = [];
            foreach ($notifications as $notification){
                $ntification = Notification::select('data')->where('id' , $notification->id)->first();
                $ntification['not_id'] = $notification->id;
                $data = json_decode($ntification['data'], true);
                $orderstatus = $data['orderstatus'];
                $ntification['order'] = $orderstatus;

                if ($ntification['order']['status'] == 0) {
                    $ntification['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم استلام الطلب';
                    } else {
                        $ntification['order_status'] = 'signed';
                    }
                } elseif ($ntification['order']['status'] == 1) {
                    $ntification['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التحضير';
                    } else {
                        $ntification['order_status'] = 'processed';
                    }
                } elseif ($ntification['order']['status'] == 2) {
                    $ntification['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري الشحن';
                    } else {
                        $ntification['order_status'] = 'shipped';
                    }
                } elseif ($ntification['order']['status'] == 3) {
                    $ntification['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التوصيل';
                    } else {
                        $ntification['order_status'] = 'out to delivery';
                    }
                } elseif ($ntification['order']['status'] == 4) {
                    $ntification['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم التوصيل';
                    } else {
                        $ntification['order_status'] = 'delivered';
                    }
                }
                array_push($nots , $ntification);
            }

            if(count($nots) > 0){
                return response()->json([
                    "date" => $nots,
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    "msg" => 'لا يوجد اشعارات',
                    'status' => false,
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }
    public function recent_notifications(Request $request)
    {
        try{
            $user = User::where('api_token' , $request->bearerToken())->first();
            $notifications = DB::table('notifications')->whereNotNull('read_at')->where('notifiable_id' , $user->id)->where('notifiable_type' , 'App\User')->orderBy('created_at' , 'desc')->get();
            $nots = [];
            foreach ($notifications as $notification){
                $ntification = Notification::select('data')->where('id' , $notification->id)->first();
                $ntification['not_id'] = $notification->id;
                $data = json_decode($ntification['data'], true);
                $orderstatus = $data['orderstatus'];
                $ntification['order'] = $orderstatus;

                if ($ntification['order']['status'] == 0) {
                    $ntification['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم استلام الطلب';
                    } else {
                        $ntification['order_status'] = 'signed';
                    }
                } elseif ($ntification['order']['status'] == 1) {
                    $ntification['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التحضير';
                    } else {
                        $ntification['order_status'] = 'processed';
                    }
                } elseif ($ntification['order']['status'] == 2) {
                    $ntification['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري الشحن';
                    } else {
                        $ntification['order_status'] = 'shipped';
                    }
                } elseif ($ntification['order']['status'] == 3) {
                    $ntification['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التوصيل';
                    } else {
                        $ntification['order_status'] = 'out to delivery';
                    }
                } elseif ($ntification['order']['status'] == 4) {
                    $ntification['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم التوصيل';
                    } else {
                        $ntification['order_status'] = 'delivered';
                    }
                }
                array_push($nots , $ntification);
            }

            if(count($nots) > 0){
                return response()->json([
                    "date" => $nots,
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    "msg" => 'لا يوجد اشعارات',
                    'status' => false,
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }

    public function notification_single($notId , Request $request)
    {
        try{
            $user = User::where('api_token' , $request->bearerToken())->first();
            $notification = DB::table('notifications')->where('id' , $notId)->where('notifiable_id' , $user->id)->where('notifiable_type' , 'App\User')->first();
                $ntification = Notification::select('data')->where('id' , $notification->id)->first();
                $nn = Notification::find($notification->id);
            $nn->read_at = Carbon::now();
            $nn->save();
                $ntification['not_id'] = $notification->id;
                $data = json_decode($ntification['data'], true);
                $orderstatus = $data['orderstatus'];
                $ntification['order'] = $orderstatus;
                if ($ntification['order']['status'] == 0) {
                    $ntification['status_color'] = '#33AFFF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم استلام الطلب';
                    } else {
                        $ntification['order_status'] = 'signed';
                    }
                } elseif ($ntification['order']['status'] == 1) {
                    $ntification['status_color'] = '#9333FF';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التحضير';
                    } else {
                        $ntification['order_status'] = 'processed';
                    }
                } elseif ($ntification['order']['status'] == 2) {
                    $ntification['status_color'] = '#FF33FC';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري الشحن';
                    } else {
                        $ntification['order_status'] = 'shipped';
                    }
                } elseif ($ntification['order']['status'] == 3) {
                    $ntification['status_color'] = '#FF3352';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'جاري التوصيل';
                    } else {
                        $ntification['order_status'] = 'out to delivery';
                    }
                } elseif ($ntification['order']['status'] == 4) {
                    $ntification['status_color'] = '#33FF3C';
                    if (app()->getLocale() == 'ar') {
                        $ntification['order_status'] = 'تم التوصيل';
                    } else {
                        $ntification['order_status'] = 'delivered';
                    }
                }


            return response()->json([
                "date" => $ntification,
                'status' => true,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }
}
