<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function cities()
    {
        try{
           $cities = City::active()->select(
               'id',
               'country_id',
               'name_' . app()->getLocale() . ' as name'
           )->with(array('country' => function ($query) {
                $query->select(
                    'id',
                    'code',
                    'name_' . app()->getLocale() . ' as name'
                );
            }))->orderBy('id' , 'desc')->get();
            return response()->json([
                'status' => true,
                'data' => $cities,
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

    public function index()
    {
        try{
            $countries = Country::active()->select(
                'id',
                'name_' . app()->getLocale() . ' as name'
            )->with(array('currency' => function ($query) {
                $query->select(
                    'id',
                    'code',
                    'equal',
                    'country_id',
                    'name_' . app()->getLocale() . ' as name'
                )->active();
            }))->orderBy('id' , 'desc')->get();
            return response()->json([
                'status' => true,
                'data' => $countries,
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
