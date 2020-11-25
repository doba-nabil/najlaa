<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Darryldecode\Cart\Validators\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function edit_info(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->birth = $request->birth;
            $user->save();
            return response()->json([
                'status' => true,
                'data' => $user,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    public function change_pass(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("code" => 400, "msg" => $validator->errors()->first(), "status" => false);
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("code" => 400, "msg" => "Check your old password.", "status" => false);
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("code" => 400, "msg" => "Please enter a password which is not similar then current password.", "status" => false);
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("code" => 200, "status" => "true", "data" => User::where('id', $userid)->first());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("code" => 400, "message" => $msg, "status" => false);
            }
        }
        return \Response::json($arr);
    }
}
