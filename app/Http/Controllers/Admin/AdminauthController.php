<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Moderator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AdminauthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginFrom()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    }

    protected function authenticated(Request $request, $user)
    {
        if(\Schema::hasTable('options')){
            $option = Option::find(1);
            $order_dates = Order::where('status' , '!=' , '4')->whereDate('updated_at',Carbon::now()->subDay()->toDateString())->get();
            foreach ($order_dates as $order_date){
                $to_name = 'Admin';
                $order_no = $order_date->order_no;
                $to_email = $option->sys_email;
                $data = array('name'=>"Najlaa App", "body" => $order_no);
                Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('No action on order');
                });
            }
        }
//        $user->generateToken();
//        response()->json(['data' => $user->toArray()], 201);
        $moderator = Moderator::find($user->id);
        /*$permissions = $moderator->permissions;
        foreach ($permissions as $permission) {
            Session::put($permission->permissions, $permission->permissions);
        }*/
        return Redirect::intended('/admin');
    }

    public function __construct()
    {
        $this->middleware('guest:moderator')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('moderator');
    }
}
