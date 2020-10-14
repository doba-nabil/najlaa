<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function selected($id)
    {
        try {
            $address = Address::find($id);
            $address->active = 1;
            $address->save();
            $addresses = Address::where('user_id' , $address->user_id)->where('id' , '!=' ,$id)->get();
            foreach ($addresses as $ad){
                $ad->active = 0;
                $ad->save();
            }
            return redirect()->back()->with('done', 'Selected A Main Address Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
