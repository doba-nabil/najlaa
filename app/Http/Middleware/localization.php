<?php
namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Support\Facades\DB;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check header request and determine localizaton
        $local = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        // set laravel localization
        app()->setLocale($local);
        if(\Request::is('api/login' , 'api/register')){}else{
            $token = \Request::header('token');
            if($request->bearerToken()){
                $user = User::where('api_token', $request->bearerToken())->first();
                $user_token = DB::table('token_users')->where('user_id' , $user->id)->where('device_token' , $token)->first();
                if(!isset($user_token)){
                    DB::table('token_users')->insert(
                        array(
                            'user_id'     =>   $user->id,
                            'device_token'   =>  $token
                        )
                    );
                }
            }else{
                if(isset($token)){
                    $user_token = DB::table('token_users')->where('device_token' , $token)->first();
                    if(!isset($user_token)){
                        DB::table('token_users')->insert(
                            array(
                                'device_token'   =>  $token,
                                'lang'   =>  $local
                            )
                        );
                    }elseif(isset($user_token)){
                        DB::table('token_users')->where('device_token' , $token)->update(array(
                            'lang'=>$local,
                        ));
                    }
                }
            }
        }


        // continue request
        return $next($request);
    }
}