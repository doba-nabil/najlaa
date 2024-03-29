<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChoseCountry;
use App\Models\Country;
use App\Models\Notification;
use App\Models\WishList;
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
    public function get_info(Request $request)
    {
        try{

            $user = User::where('api_token', $request->bearerToken())->withCount('orders')->first();
            $notifications = Notification::where('notifiable_id' , $user->id)->whereNull('read_at')->orderBy('created_at' , 'desc')->get();
            $wishLists = WishList::where('user_id' , $user->id)->orderBy('id' , 'desc')->get();
            $old_chose = ChoseCountry::where('user_id' , $user->id)->first();
            if(isset($old_chose)){
                $user['country'] = Country::where('id' , $old_chose->country_id)->select(
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
            }else{
                $user['country'] = Country::where('id' , 1)->select(
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
            }
            $user['notifications_count'] = $notifications->count();
            $user['wish_lists_count'] = $wishLists->count();
            return response()->json([
                'status' =>true,
                'data' => $user,
                'code' =>200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }

    public function edit_info(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->birth = $request->birth;
            $old_chose = ChoseCountry::where('user_id' , $user->id)->first();
            if(isset($old_chose)){
                $old_chose->country_id = $request->country_id;
                $old_chose->save();
                $chose_country = $old_chose;
            }else{
                $chose_country = new ChoseCountry();
                $chose_country->user_id = $user->id;
                $chose_country->country_id = $request->country_id;
                $chose_country->save();
            }
            $user->save();
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
                'status' => true,
                'data' => $user,
                'code' => 200,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
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
