<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use LaravelLocalization;

class PageController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('auth:api')->except('index' , 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $pages = Page::select(
                'id',
                'name_'.app()->getLocale().' as name',
                'body_'.app()->getLocale().' as body',
                'active'
            )->get();
            return response()->json([
                'status' => true,
                'data' => $pages,
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
    public function show($id)
    {
        $page = Page::where('id',$id)->select(
            'id',
            'name_'.app()->getLocale().' as name',
            'body_'.app()->getLocale().' as body',
            'active'
            )->first();
        if(isset($page)) {
            return response()->json([
                'status' => true,
                'data' => $page,
                'code' => 200,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'صفحة غير موجودة',
                'code' => 400,
            ]);
        }
    }

}
