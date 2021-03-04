<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.home');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function send_email(Request $request)
    {

        try{
            $this->validate($request, [
                'email' => 'required|email',
            ]);
            $emaill = $request->input('email');
            $found = Subscribe::where('email', $emaill)->get();
            if(count($found) > 0){
                return response()->json(['error' => 'Email Already Exists'], 422);
            }else{
                $email = new Subscribe();
                $email->email = $emaill;
                $email->save();
                return response()->json(['status' => 'Subscribed Successfully'], 200);
            }
        }catch (\Exception $e){
            return response()->json(['error' => 'Please enter your email address'], 422);
        }
    }
}
