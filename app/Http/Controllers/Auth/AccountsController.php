<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
   function reset_without_token(){
       $user = DB::table('users')->where('email', '=', $request->email)
           ->first();
       if (count($user) < 1) {
           return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
       }
       DB::table('password_resets')->insert([
           'email' => $request->email,
           'token' => str_random(60),
           'created_at' => Carbon::now()
       ]);
       $tokenData = DB::table('password_resets')
           ->where('email', $request->email)->first();

       if ($this->sendResetEmail($request->email, $tokenData->token)) {
           return response()->json([
               'status' => false,
               'msg' => 'تم ارسال رابط التفعيل عبر البريد',
               'code' => 400,
           ]);
       } else {
           return response()->json([
               'status' => false,
               'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
               'code' => 400,
           ]);
       }
   }
}
