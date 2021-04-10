<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class TryController extends Controller
{
    public function users()
    {
        try{
            $users = User::all();
            return response()->json([
                'status' => true,
                'data' => $users,
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
}
