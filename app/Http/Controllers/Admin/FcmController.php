<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\DB;

class FcmController extends Controller
{
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = config('app.firebase_server_key');
    }

    public function fcm ()
    {
        return view('backend.sendfirbase.create');
    }

    public function sendPushAll(Request $request)
    {
        $firebaseTokens = DB::table('token_users')->get();
        foreach ($firebaseTokens as $firebaseToken){
            $data = [
                "to" => $firebaseToken->device_token,
                "notification" =>
                    [
                        "title" => $request['title_'.$firebaseToken->lang],
                        "body" => $request['desc_'.$firebaseToken->lang],
                        "icon" => url('/logo.png'),
                        "sound" => 'default',
                    ],
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=AAAA46z3lxk:APA91bGF7acxyBgWfhXkHiUUYDasurOeVt1j88IuTfDkHPk_t27DjF0I_Yhfn-VMYEVyOQxiQBuLZyp4Y-hrMUq2iKi9G8QK1_xoDvHx9tRmEnxM76Y3V50_sQ3bVf-qU9a8ZiykdvDJ',
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_exec($ch);
        }

         return redirect()->back()->with('done' ,'Successfully');
    }

    public function fcm_users ()
    {
        return view('backend.sendfirbase.users');
    }

    public function sendPushUsers(Request $request)
    {
        if($request->all){
            $users = User::pluck('id');
        }else{
            $users = User::whereIn('id' , $request->user_ids)->pluck('id');
        }
        $users;
        if($users->count() > 0){
            $firebaseTokens = DB::table('token_users')->whereIn('user_id' , $users)->get();
            foreach ($firebaseTokens as $firebaseToken){
                $data = [
                    "to" => $firebaseToken->device_token,
                    "notification" =>
                        [
                            "title" => $request['title_'.$firebaseToken->lang],
                            "body" => $request['desc_'.$firebaseToken->lang],
                            "icon" => url('/logo.png'),
                            "sound" => 'default',
                        ],
                ];
                $dataString = json_encode($data);

                $headers = [
                    'Authorization: key=AAAA46z3lxk:APA91bGF7acxyBgWfhXkHiUUYDasurOeVt1j88IuTfDkHPk_t27DjF0I_Yhfn-VMYEVyOQxiQBuLZyp4Y-hrMUq2iKi9G8QK1_xoDvHx9tRmEnxM76Y3V50_sQ3bVf-qU9a8ZiykdvDJ',
                    'Content-Type: application/json',
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                curl_exec($ch);
            }

            return redirect()->back()->with('done' ,'Successfully');
        }else{
            return redirect()->back()->with('error' ,'No Users or Devices');
        }

    }

    public function fcm_not_users ()
    {
        return view('backend.sendfirbase.not_users');
    }

    public function sendPushNotUsers(Request $request)
    {
        $firebaseTokens = DB::table('token_users')->whereNull('user_id')->get();
        foreach ($firebaseTokens as $firebaseToken){
            $data = [
                "to" => $firebaseToken->device_token,
                "notification" =>
                    [
                        "title" => $request['title_'.$firebaseToken->lang],
                        "body" => $request['desc_'.$firebaseToken->lang],
                        "icon" => url('/logo.png'),
                        "sound" => 'default',
                    ],
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=AAAA46z3lxk:APA91bGF7acxyBgWfhXkHiUUYDasurOeVt1j88IuTfDkHPk_t27DjF0I_Yhfn-VMYEVyOQxiQBuLZyp4Y-hrMUq2iKi9G8QK1_xoDvHx9tRmEnxM76Y3V50_sQ3bVf-qU9a8ZiykdvDJ',
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_exec($ch);
        }
        return redirect()->back()->with('done' ,'Successfully');

    }
}
