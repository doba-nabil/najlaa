<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TryController extends Controller
{
    public function users()
    {
        try{
            $users = User::all();
            return response()->json([
                'status' => true,
                'data' => $users,
                'tokens' => DB::table('token_users')->get(),
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
    public function delete_tokens()
    {
        try{
            $tokens = DB::table('token_users')->delete();
            return response()->json([
                'status' => true,
                'msg' => 'scc',
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
