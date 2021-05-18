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
                    "msg" => trans('api.no_nots'),
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
                    "msg" => trans('api.no_nots'),
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
                    "msg" => trans('api.no_nots'),
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
    public function notifications_status(Request $request)
    {
        try {
            $user = User::where('api_token' , $request->bearerToken())->first();
            if($user->products_notify == 0){
                $products_notify = false;
            }else{
                $products_notify = true;
            }
            if($user->orders_notify == 0){
                $orders_notify = false;
            }else{
                $orders_notify = true;
            }
            return response()->json([
                "data" => [
                    'products_notify' => $products_notify,
                    'orders_notify' => $orders_notify,
                ],
                'status' => true,
                'code' => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }
    public function orders_notify(Request $request)
    {
        try {
            $user = User::where('api_token' , $request->bearerToken())->first();
            if($user->orders_notify == 0){
                $user->orders_notify = 1;
                $user->save();

                $firebaseTokens = DB::table('token_users')->where('user_id' , $user->id)->get();
                if($firebaseTokens->count() > 0){
                    foreach ($firebaseTokens as $firebaseToken){
                        if($firebaseToken->lang == 'en'){
                            $title = 'Activate Notifications';
                            $body = 'Activate Sales Notifications Successfully.';
                        }else{
                            $title = 'تفعيل الاشعارات';
                            $body = 'تم تفعيل اشعارات التخفيضات بنجاح.';
                        }
                        $data = [
                            "to" => $firebaseToken->device_token,
                            "notification" =>
                                [
                                    "title" => $title,
                                    "body" => $body,
                                    "icon" => url('/logo.png'),
                                    "sound" => 'default',
                                ],
                        ];
                        $dataString = json_encode($data);

                        $headers = [
                            'Authorization: key=AAAAH0FWu1Y:APA91bGf1c3t9BGXv0WoYc1-ycpjl29_g7AKjiyoT4mZyJpYpvvKYDzcj7fqjAYz7nr0s56nQvUPLkdWfqmwyRqszwGCeJ93pO2--evn00sDYb1l5YoIdhPyBH6m5iT0cbaabXBa3ubr',
                            'Content-Type: application/json',
                        ];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                        curl_exec($ch);
                    }
                }

                return response()->json([
                    "msg" => trans('api.activated'),
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                $user->orders_notify = 0;
                $user->save();
                return response()->json([
                    "msg" => trans('api.unactivated'),
                    'status' => true,
                    'code' => 200,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }
    public function products_notify(Request $request)
    {
        try {
            $user = User::where('api_token' , $request->bearerToken())->first();
            if($user->products_notify == 0){
                $user->products_notify = 1;
                $user->save();

                $firebaseTokens = DB::table('token_users')->where('user_id' , $user->id)->get();
                if($firebaseTokens->count() > 0){
                    foreach ($firebaseTokens as $firebaseToken){
                        if($firebaseToken->lang == 'en'){
                            $title = 'Activate Notifications';
                            $body = 'Activate Orders Notifications Successfully.';
                        }else{
                            $title = 'تفعيل الاشعارات';
                            $body = 'تم تفعيل اشعارات طلبات الشراء بنجاح.';
                        }
                        $data = [
                            "to" => $firebaseToken->device_token,
                            "notification" =>
                                [
                                    "title" => $title,
                                    "body" => $body,
                                    "icon" => url('/logo.png'),
                                    "sound" => 'default',
                                ],
                        ];
                        $dataString = json_encode($data);

                        $headers = [
                            'Authorization: key=AAAAH0FWu1Y:APA91bGf1c3t9BGXv0WoYc1-ycpjl29_g7AKjiyoT4mZyJpYpvvKYDzcj7fqjAYz7nr0s56nQvUPLkdWfqmwyRqszwGCeJ93pO2--evn00sDYb1l5YoIdhPyBH6m5iT0cbaabXBa3ubr',
                            'Content-Type: application/json',
                        ];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                        curl_exec($ch);
                    }
                }
                return response()->json([
                    "msg" => trans('api.activated'),
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                $user->products_notify = 0;
                $user->save();
                return response()->json([
                    "msg" => trans('api.unactivated'),
                    'status' => true,
                    'code' => 200,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "msg" => trans('validation.error'),
                'status' => false,
                'code' => 400,
            ]);
        }
    }
}
