<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\sendnew;
use App\Models\Subscribe;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:message-list', ['only' => ['message','send_message']]);
    }
    public function message()
    {
        return view('backend.sendmessage.form');
    }

    public function send_message(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'title' => 'required',
            'msg' => 'required',
        ]);
        $email = $request->email;
        \Mail::to($email)->send(new sendnew($request->title, $request->msg));
        if(app()->getLocale() == 'en'){
            return redirect()->back()->with('done' , 'Message Send Successflly');
        }else{
            return redirect()->back()->with('done' , 'تم لارسال بنجاح');
        }

    }

    public function users_message()
    {
        return view('backend.sendmessage.users_form');
    }

    public function send_users_message(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'msg' => 'required',
        ]);
        foreach (User::pluck('email') as $email){
            \Mail::to($email)->send(new sendnew($request->title, $request->msg));
        }
        if(app()->getLocale() == 'en'){
            return redirect()->back()->with('done' , 'Message Send Successflly');
        }else{
            return redirect()->back()->with('done' , 'تم لارسال بنجاح');
        }
    }

    public function subscribers_message()
    {
        return view('backend.sendmessage.subscribers_form');
    }

    public function send_subscribers_message(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'msg' => 'required',
        ]);
        foreach (Subscribe::pluck('email') as $email){
            \Mail::to($email)->send(new sendnew($request->title, $request->msg));
        }
        if(app()->getLocale() == 'en'){
            return redirect()->back()->with('done' , 'Message Send Successflly');
        }else{
            return redirect()->back()->with('done' , 'تم لارسال بنجاح');
        }
    }
}
