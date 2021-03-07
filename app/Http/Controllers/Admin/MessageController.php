<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\sendnew;
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
        return redirect()->back()->with('done' , 'Message Send Successflly');
    }
}
