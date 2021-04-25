<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Moderator;
use App\Notifications\NewUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Exception;
use App\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {


        $user = Socialite::driver('google')->stateless()->user();
        $finduser = User::where('provider_id', $user->id)->where('provider', 'google')->first();

        if ($finduser) {
            $finduser->generateToken();
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
                'data' => $finduser,
                'code' => 200,
            ]);
        } else {
            $finduserr = User::where('provider_id', $user->id)->where('email', $user->email)->first();
            if (isset($finduserr)) {
                return response()->json([
                    'status' => false,
                    'msg' => 'The given data was invalid.',
                    "errors" => [
                        "email" => [
                            "The email has already been taken."
                        ]
                    ],
                    'code' => 422,
                ]);
            } else {
                $pass = '123456789';
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->id,
                    'email_verified_at' => Carbon::now(),
                    'provider' => 'google',
                    'password' => Hash::make($pass),
                ]);
                $newUser->generateToken();

                $admins = Moderator::where('status', 1)->get();
                foreach ($admins as $admin) {
                    $admin->notify(new NewUser($user));
                }

                $token = \Request::header('token');
                if (isset($token)) {
                    DB::table('token_users')->insert(
                        array(
                            'user_id' => $user->id,
                            'device_token' => $token
                        )
                    );
                }
                return response()->json([
                    'status' => true,
                    'data' => $newUser,
                    'code' => 200,
                ]);
            }
        }

    }
}
