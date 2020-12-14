<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Mail\VerifyMailAr;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifiedController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api');
    }
    public function check_verified(Request $request){
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            if(!empty($user->email_verified_at)){
                return response()->json([
                    'status' => true,
                    'data' => $user,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'يرجى تفعيل العضوية',
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
    public function verified(Request $request){
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            if($user->code == $request->code){
                $user->email_verified_at = Carbon::now();
                $user->save();
                return response()->json([
                    'status' => true,
                    'data' => $user,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'كود خاطئ',
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
    public function verified_code(Request $request){
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            if(empty($user->email_verified_at)){
                $user->code = rand(10000,99999);
                $user->save();
                if(app()->getLocale() == 'ar'){
                    \Mail::to($user->email)->send(new VerifyMailAr($user , $user->code));
                }elseif(app()->getLocale() == 'en'){
                    \Mail::to($user->email)->send(new VerifyMail($user , $user->code));
                }
                return response()->json([
                    'status' => true,
                    'msg' => 'تم ارسال الكود بنجاح',
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'msg' => 'عضوية مفعلة من قبل',
                    'code' => 200,
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
