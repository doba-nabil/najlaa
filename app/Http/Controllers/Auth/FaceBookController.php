<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Moderator;
use App\Notifications\NewUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;

class FaceBookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleFacebookCallback()
    {
        try{
            $getInfo = Socialite::driver('facebook')->stateless()->user();
            $user = $this->createUser($getInfo);
            $user->generateToken();
            $token = \Request::header('token');
            if(isset($token)){
                $user_token = DB::table('token_users')->where('user_id' , $user->id)->where('device_token' , $token)->first();
                if(!isset($user_token)){
                    DB::table('token_users')->insert(
                        array(
                            'user_id'     =>   $user->id,
                            'device_token'   =>  $token
                        )
                    );
                }
            }
            return response()->json([
                'status' => true,
                'data' => $user,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    function createUser($getInfo){
        $user = User::where('provider_id', $getInfo->id)->where('provider' , 'facebook')->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => 'facebook',
                'email_verified_at'=> Carbon::now(),
                'password' => Hash::make('123456789'),
                'provider_id' => $getInfo->id
            ]);
            $admins = Moderator::where('status' , 1)->get();
            foreach ($admins as $admin){
                $admin->notify(new NewUser($user));
            }
        }
        return $user;
    }
}
