<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialAuth;
use App\Models\Moderator;
use App\Notifications\NewUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function social(SocialAuth $request)
    {

        if(isset($request->provider_id)){
            $check_user = User::where([['provider_id' , $request->provider_id] , ['provider' , $request->provider]])->first();
            if (!isset($check_user)) {
                $checkoo = User::where([['provider_id' , $request->provider_id]])->first();
                if(isset($checkoo)){
                    if(app()->getLocale() == 'en'){
                        return response()->json([
                            "status" => false,
                            "code" => 422,
                            "message" => "The given data was invalid.",
                            "errors" => [
                                "email" => [
                                    "The email has already been taken."
                                ]
                            ],
                        ], 422);
                    }else{
                        return response()->json([
                            "status" => false,
                            "code" => 422,
                            "message" => "البيانات المدخلة غير صالحة.",
                            "errors" => [
                                "email" => [
                                    "عفوا بريد مستخدم سابقا."
                                ]
                            ],
                        ], 422);
                    }
                }
                    $pass = '123456789';
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'provider_id' => $request->provider_id,
                        'email_verified_at' => Carbon::now(),
                        'provider' => $request->provider,
                        'password' => Hash::make($pass),
                    ]);
                    $user->generateToken();
                    $token = \Request::header('token');
                    if (isset($token)) {
                        $user_token = DB::table('token_users')->where('user_id', $user->id)->where('device_token', $token)->first();
                        if(!isset($user_token)){
                            DB::table('token_users')->insert(
                                array(
                                    'user_id'     =>   $user->id,
                                    'device_token'   =>  $token,
                                    'lang'   =>  app()->getLocale()
                                )
                            );
                        }else{
                            DB::table('token_users')->where('device_token' , $token)->update(array(
                                'user_id'     =>   $user->id,
                                'lang'=> app()->getLocale()
                            ));
                        }
                    }
                    $admins = Moderator::where('status' , 1)->get();
                    foreach ($admins as $admin){
                        $admin->notify(new NewUser($user));
                    }
                    if(app()->getLocale() == 'en'){
                        return response()->json([
                            'status' => true,
                            'code' => 200,
                            'message' => 'Registered  Successfully',
                            'data' => [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'api_token'     =>  $user->api_token,
                            ],
                        ], 200);
                    }else{
                        return response()->json([
                            'status' => true,
                            'code' => 200,
                            'message' => 'تسجيل ناجح',
                            'data' => [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'api_token'     =>  $user->api_token,
                            ],
                        ], 200);
                    }
            } else {
                $user = $check_user;
                $user->generateToken();
                $token = \Request::header('token');
                if (isset($token)) {
                    $user_token = DB::table('token_users')->where('user_id', $user->id)->where('device_token', $token)->first();
                    if(!isset($user_token)){
                        DB::table('token_users')->insert(
                            array(
                                'user_id'     =>   $user->id,
                                'device_token'   =>  $token,
                                'lang'   =>  app()->getLocale()
                            )
                        );
                    }else{
                        DB::table('token_users')->where('device_token' , $token)->update(array(
                            'user_id'     =>   $user->id,
                            'lang'=> app()->getLocale()
                        ));
                    }
                }
                if(app()->getLocale() == 'en'){
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'Logined  Successfully',
                        'data' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'api_token'     =>  $user->api_token,
                        ],
                    ], 200);
                }else{
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'تسجيل دخول ناجح',
                        'data' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'api_token'     =>  $user->api_token,
                        ],
                    ], 200);
                }
            }
        }else{
            $check_user = User::where([['email', $request->email],['provider', $request->provider]])->first();

            if (User::where([['email', Request()->email], ['provider', null]])->first()) {
                if(app()->getLocale() == 'en'){
                    return response()->json([
                        "status" => false,
                        "code" => 422,
                        "message" => "The given data was invalid.",
                        "errors" => [
                            "email" => [
                                "The email has already been taken."
                            ]
                        ],
                    ], 422);
                }else{
                    return response()->json([
                        "status" => false,
                        "code" => 422,
                        "message" => "البيانات المدخلة غير صالحة.",
                        "errors" => [
                            "email" => [
                                "عفوا بريد مستخدم سابقا."
                            ]
                        ],
                    ], 422);
                }
            }
            if (!isset($check_user)) {
                if (User::where([['email', Request()->email]])->first()) {
                    if(app()->getLocale() == 'en'){
                        return response()->json([
                            "status" => false,
                            "code" => 422,
                            "message" => "The given data was invalid.",
                            "errors" => [
                                "email" => [
                                    "The email has already been taken."
                                ]
                            ],
                        ], 422);
                    }else{
                        return response()->json([
                            "status" => false,
                            "code" => 422,
                            "message" => "البيانات المدخلة غير صالحة.",
                            "errors" => [
                                "email" => [
                                    "عفوا بريد مستخدم سابقا."
                                ]
                            ],
                        ], 422);
                    }
                }else{
                    $pass = '123456789';
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'provider_id' => $request->provider_id,
                        'email_verified_at' => Carbon::now(),
                        'provider' => $request->provider,
                        'password' => Hash::make($pass),
                    ]);
                    $user->generateToken();
                    $token = \Request::header('token');
                    if (isset($token)) {
                        $user_token = DB::table('token_users')->where('user_id', $user->id)->where('device_token', $token)->first();
                        if(!isset($user_token)){
                            DB::table('token_users')->insert(
                                array(
                                    'user_id'     =>   $user->id,
                                    'device_token'   =>  $token,
                                    'lang'   =>  app()->getLocale()
                                )
                            );
                        }else{
                            DB::table('token_users')->where('device_token' , $token)->update(array(
                                'user_id'     =>   $user->id,
                                'lang'=> app()->getLocale()
                            ));
                        }
                    }
                    $admins = Moderator::where('status' , 1)->get();
                    foreach ($admins as $admin){
                        $admin->notify(new NewUser($user));
                    }
                    if(app()->getLocale() == 'en'){
                        return response()->json([
                            'status' => true,
                            'code' => 200,
                            'message' => 'Registered  Successfully',
                            'data' => [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'api_token'     =>  $user->api_token,
                            ],
                        ], 200);
                    }else{
                        return response()->json([
                            'status' => true,
                            'code' => 200,
                            'message' => 'تسجيل ناجح',
                            'data' => [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'api_token'     =>  $user->api_token,
                            ],
                        ], 200);
                    }

                }
            } else {
                $user = $check_user;
                $user->generateToken();
                $token = \Request::header('token');
                if (isset($token)) {
                    $user_token = DB::table('token_users')->where('user_id', $user->id)->where('device_token', $token)->first();
                    if(!isset($user_token)){
                        DB::table('token_users')->insert(
                            array(
                                'user_id'     =>   $user->id,
                                'device_token'   =>  $token,
                                'lang'   =>  app()->getLocale()
                            )
                        );
                    }else{
                        DB::table('token_users')->where('device_token' , $token)->update(array(
                            'user_id'     =>   $user->id,
                            'lang'=> app()->getLocale()
                        ));
                    }
                }
                if(app()->getLocale() == 'en'){
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'Logined  Successfully',
                        'data' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'api_token'     =>  $user->api_token,
                        ],
                    ], 200);
                }else{
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'تسجيل دخول ناجح',
                        'data' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'api_token'     =>  $user->api_token,
                        ],
                    ], 200);
                }
            }
        }

    }
}
