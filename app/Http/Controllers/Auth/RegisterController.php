<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Mail\VerifyMailAr;
use App\Models\ChoseCountry;
use App\Models\Country;
use App\Models\Moderator;
use App\Notifications\NewUser;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'birth' => $data['birth'],
            'code' => rand(10000,99999),
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        event(new Registered($user));
        $this->guard()->login($user);
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();
        response()->json(['data' => $user->toArray()], 201);
    }

    public function registerapi(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        /** start chose country */
        $chose_country = new ChoseCountry();
        $chose_country->user_id = $user->id;
        $chose_country->country_id = $request->country_id;
        $chose_country->save();
        /** end chose country */
        event(new Registered($user));
        $this->guard()->login($user);
        if(empty($user->email_verified_at)){
            if(app()->getLocale() == 'ar'){
                \Mail::to($user->email)->send(new VerifyMailAr($user , $user->code));
            }elseif(app()->getLocale() == 'en'){
                \Mail::to($user->email)->send(new VerifyMail($user , $user->code));
            }
        }
        $token = \Request::header('token');
        if(isset($token)){
            $found = DB::table('token_users')->where('device_token',$token)->first();
            if(!isset($found)){
                DB::table('token_users')->insert(
                    array(
                        'user_id'     =>   $user->id,
                        'device_token'   =>  $token,
                        'lang'   =>  app()->getLocale()
                    )
                );
            }
        }
        $admins = Moderator::where('status' , 1)->get();
        foreach ($admins as $admin){
            $admin->notify(new NewUser($user));
        }
        $this->registered($request, $user) ?: redirect($this->redirectPath());
        $user['country'] = Country::where('id' , $chose_country->country_id)->select(
            'id',
            'code',
            'call_code as calling_code',
            'name_' . app()->getLocale() . ' as name'
        )->with(array('mainImage' => function ($query) {
                $query->select(
                    'image',
                    'imageable_id'
                );
            })
        )->first();
        return response()->json([
            'status' =>true,
            'data' => $user,
            'code' =>200,
        ]);
    }
}
