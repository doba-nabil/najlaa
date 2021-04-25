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
        $check_user = User::where([['email', $request->email],['provider', $request->provider]])->first();
        if (User::where([['email', Request()->email], ['provider', null]])->first()) {
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
        }
        if (!isset($check_user)) {
            if(User::where('email', $request->email)->first()){
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
                    if (!isset($user_token)) {
                        DB::table('token_users')->insert(
                            array(
                                'user_id' => $user->id,
                                'device_token' => $token
                            )
                        );
                    }
                }
                $admins = Moderator::where('status' , 1)->get();
                foreach ($admins as $admin){
                    $admin->notify(new NewUser($user));
                }
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
            }
        } else {
            $user = $check_user;
            $user->generateToken();
            $token = \Request::header('token');
            if (isset($token)) {
                $user_token = DB::table('token_users')->where('user_id', $user->id)->where('device_token', $token)->first();
                if (!isset($user_token)) {
                    DB::table('token_users')->insert(
                        array(
                            'user_id' => $user->id,
                            'device_token' => $token
                        )
                    );
                }
            }
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
        }
    }
}
