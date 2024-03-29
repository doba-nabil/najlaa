<?php

namespace App\Http\Controllers\Api;

use App\Models\ChooseConuntry;
use App\Http\Controllers\Controller;
use App\Models\ChoseCountry;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\User;
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
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }

    public function index()
    {
        try{
            $country_ids = [];
            $currencies = Currency::all();
            foreach ($currencies as $currency){
                array_push($country_ids , $currency->country_id);
            }
            $countries = Country::whereIn('id' , $country_ids)->active()->select(
                'id',
                'name_' . app()->getLocale() . ' as name',
                'call_code as calling_code'
            )->with(array('mainImage' => function ($query) {
                    $query->select(
                        'image',
                        'imageable_id'
                    );
                })
            )->orderBy('id' , 'desc')->get();
            return response()->json([
                'status' => true,
                'data' => $countries,
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
    public function check_country(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $old_chose = ChoseCountry::where('user_id' , $user->id)->first();
            if(isset($old_chose)){
                $country = Country::select(
                    'id',
                    'code',
                    'call_code as calling_code',
                    'name_' . app()->getLocale() . ' as name'
                )->where('id' , $old_chose->country_id)->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->first();
            }else{
                $country = Country::select(
                    'id',
                    'code',
                    'call_code as calling_code',
                    'name_' . app()->getLocale() . ' as name'
                )->where('id' , 1)->with(array('mainImage' => function ($query) {
                        $query->select(
                            'image',
                            'imageable_id'
                        );
                    })
                )->first();
            }
            $country['currency'] = Currency::select(
                'id',
                'name_' . app()->getLocale() . ' as name',
                'code'
            )->where('country_id' , $country->id)->first();
            return response()->json([
                'status' => true,
                'data' => $country,
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
    public function choose_country(Request $request)
    {
        try{
            $user = User::where('api_token', $request->bearerToken())->first();
            $old_chose = ChoseCountry::where('user_id' , $user->id)->first();
            if(isset($old_chose)){
                $old_chose->country_id = $request->country_id;
                $old_chose->save();
                return response()->json([
                    'status' => true,
                    'msg' => trans('api.country_changed'),
                    'code' => 200,
                ]);
            }else{
                $chose_country = new ChoseCountry();
                $chose_country->user_id = $user->id;
                $chose_country->country_id = $request->country_id;
                $chose_country->save();
                return response()->json([
                    'status' => true,
                    'msg' => trans('api.country_selected'),
                    'code' => 200,
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => trans('api.err'),
                'code' => 400,
            ]);
        }
    }
    public function currencies_api()
    {
        try{
            $currencies = Currency::all();
            return response()->json([
                'status' => true,
                'data' => $currencies,
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
