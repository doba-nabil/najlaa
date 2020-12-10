<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactOrder;
use App\User;
use Illuminate\Http\Request;

class ContactOrderController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api')->except('types');
    }

    public function contact(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            if(isset($user)){
                $contact = new ContactOrder();
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->type_id = $request->type_id;
                $contact->order_id = $request->order_id;
                $contact->user_id = $user->id;
                $contact->message = $request->message;
                $contact->save();

                $contactt = ContactOrder::where('id' , $contact->id)->with(array('user' => function ($query) {
                        $query->select(
                            'name',
                            'id'
                        );
                    })
                )->with(array('order' => function ($query) {
                        $query->select(
                            'order_no',
                            'id'
                        );
                    })
                )->first();
                if($contactt->type_id == 1){
                    if(app()->getLocale() == 'ar'){
                        $contactt['type']='شكوى';
                    }else{
                        $contactt['type']='Complaint';
                    }
                }
                if($contactt->type_id == 2){
                    if(app()->getLocale() == 'ar'){
                        $contactt['type']='اقتراح';
                    }else{
                        $contactt['type']='Suggestion';
                    }
                }
                if($contactt->type_id == 3){
                    if(app()->getLocale() == 'ar'){
                        $contactt['type']='تقييم';
                    }else{
                        $contactt['type']='Evaluation';
                    }
                }
                return response()->json([
                    'status' => true,
                    'data' => $contactt,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'تسجيل دخول خاطئ',
                    'code' => 400,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'يوجد خطأ يرجى المحاولة مرة اخرى',
                'code' => 400,
            ]);
        }
    }
    public function types()
    {
        try{
            if(app()->getLocale() == 'ar'){
                $name[1]='شكوى';
                $name[2]='اقتراح';
                $name[3]='تقييم';
            }else{
                $name[1]='Complaint';
                $name[2]='Suggestion';
                $name[3]='Evaluation';
            }
            $types = [];
            for ($i = 1; $i <= 3; $i++) {
                array_push($types, ['id' => $i, 'name' => $name[$i]]);
            }
            return response()->json([
                'status' => true,
                'data' => $types,
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
}
