<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetMail;
use App\Mail\ResetMailAr;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    public function sendReseteCode(Request $request)
    {
        try{
            $user = User::where('email', $request->email)->first();
            if(isset($user)){
                DB::table('password_resets')->where('email' , $user->email)->delete();
                DB::table('password_resets')->insert(
                    array(
                        'email'     => $user->email,
                        'token'   =>    rand(10000,99999),
                        'created_at'   =>  Carbon::now(),
                    )
                );
                $db = DB::table('password_resets')->where('email' , $request->email)->orderBy('created_at','desc')->first();
                $code = $db->token;

                if (app()->getLocale() == 'ar') {
                    \Mail::to($user->email)->send(new ResetMailAr($user, $code));
                } elseif (app()->getLocale() == 'en') {
                    \Mail::to($user->email)->send(new ResetMail($user, $code));
                }
                return response()->json([
                    "msg" => trans('passwords.sent'),
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    "msg" => trans('passwords.user'),
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
    public function checkReseteCode(Request $request)
    {
        try{
          $db = DB::table('password_resets')->where('email' , $request->email)->where('token' , $request->code)->first();
            if(isset($db)){
                DB::table('password_resets')->where('email' , $request->email)->where('token' , $request->code)->delete();
                return response()->json([
                    "msg" => trans('passwords.good_code'),
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    "msg" => trans('passwords.bad_code'),
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
    public function resetPass(Request $request,$email)
    {
        try{
            $user = User::where('email',$email)->first();
            if(isset($user)){
                if($request->password == $request->password_confirmation){
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json([
                        "msg" => trans('passwords.reset'),
                        'status' => true,
                        'code' => 200,
                    ]);
                }else{
                    return response()->json([
                        "msg" => trans('passwords.failed'),
                        'status' => false,
                        'code' => 400,
                    ]);
                }
            }else{
                return response()->json([
                    "msg" => trans('passwords.failed'),
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
}
