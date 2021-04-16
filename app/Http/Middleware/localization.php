<?php
namespace App\Http\Middleware;
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
        $token = \Request::header('token');
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
        // continue request
        return $next($request);
    }
}