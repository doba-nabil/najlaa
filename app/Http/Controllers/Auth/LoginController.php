<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }
        return $request->only($this->username(), 'password');
    }

    public function loginapi(Request $request)
    {
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();
            $userr = $user->select('id' , 'name' , 'email' , 'active','api_token')->first();
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
            $carts = Cart::where('token' , $token)->get();
            if(count($carts) > 0){
                foreach ($carts as $cart){
                    $cart->user_id = $user->id;
                    $cart->token = null;
                    $cart->save();
                }
            }
            return response()->json([
                'status' => true,
                'data' => $user,
                'code' => 200,
            ]);
        }
        $users = User::all();
        foreach ($users as $user){
            if($user->email == $request->email || $user->phone == $request->email){
                return response()->json([
                    'status' => false,
                    'msg' => trans('api.wrong_pass'),
                    'code' => 400,
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'msg' => trans('api.no_user'),
            'code' => 400,
        ]);
    }
    public function logoutapi(Request $request){
        if ($request->bearerToken()) {
            Auth::logout();
            return response()->json([
                'status' => true,
                'msg' => trans('api.succ_logout'),
                'code' => 200,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
}
