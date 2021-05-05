<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:coupon-list|coupon-create|coupon-edit|coupon-delete', ['only' => ['index','show']]);
        $this->middleware('permission:coupon-list', ['only' => ['index','show']]);
        $this->middleware('permission:coupon-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupon-delete', ['only' => ['destroy' , 'delete_coupons']]);
    }
    public function index()
    {
        try{
            $cobones = Coupon::all();
            return view('backend.coupons.index', compact('cobones'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('backend.coupons.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|max:255|unique:cobones',
            'value' => 'required|numeric|min:1',
        ]);
        try{
            $cobone = new Coupon();
            $cobone->code = $request->code;
            $cobone->value = $request->value;
            $cobone->used_count = $request->used_count;
            $cobone->user_used_count = $request->user_used_count;
            $cobone->end_date = $request->end_date;
            $cobone->save();
            return redirect(route('coupons.index'))->with('done', 'Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $coupon = Coupon::find($id);
            return view('backend.coupons.edit', compact('coupon'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|max:255|unique:cobones,id,'.$id,
            'value' => 'required|numeric|min:1',
        ]);
        try{
            $cobone = Coupon::find($id);
            $cobone->code = $request->code;
            $cobone->value = $request->value;
            $cobone->used_count = $request->used_count;
            $cobone->user_used_count = $request->user_used_count;
            $cobone->end_date = $request->end_date;
            if($request->end_date > Carbon::now()){
                $cobone->active = 1;
            }
            $cobone->save();
            return redirect(route('coupons.index'))->with('done', 'Edited Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cobone = Coupon::find($id);
            $cobone->delete();
            return response()->json([
                'success' => 'Record deleted successfully!',
            ], 200);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function delete_coupons()
    {
        try {
            $cobones = Coupon::all();
            if (count($cobones) > 0) {
                foreach ($cobones as $cobone) {
                    $cobone->delete();
                }
                return response()->json([
                    'success' => 'Deleted Successfully',
                ], 200);
            } else {
                return response()->json([
                    'error' => 'NO THING TO DELETE'
                ], 422);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function usesSave(Request $request)
    {
        $user = User::find($request->user_id);
        $cobone = Cobone::find($request->cobone_id);
        $today = Carbon::now();
        if (count($user) > 0) {
            $found = Cobone_user::where([
                'user_id' => $request->user_id,
                'cobone_id' => $request->cobone_id,
            ])->first();
            if (count($found) > 0 && $found->user_uses == $cobone->user_uses) {
                return redirect()->back()->with('done', 'Already used!');
            } elseif (count($found) > 0 && $found->user_uses < $cobone->user_uses) {
                if ($cobone->end_date >= $today && $cobone->coupon_uses != 0) {
                    $found->user_uses = $found->user_uses + 1;
                    $found->save();

                    $cobone->coupon_uses = $cobone->coupon_uses - 1;
                    $cobone->save();
                    return redirect()->back()->with('done', 'Used Successfully!');
                } else {
                    return redirect()->back()->with('done', 'Expired Coupon!');
                }
            } else {
                if ($cobone->end_date >= $today || $cobone->coupon_uses != 0) {
                    $cobonee = new Cobone_user();
                    $cobonee->user_id = $request->user_id;
                    $cobonee->cobone_id = $request->cobone_id;
                    $cobonee->user_uses = 1;
                    $cobonee->save();

                    $cobone->coupon_uses = $cobone->coupon_uses - 1;
                    $cobone->save();
                    return redirect()->back()->with('done', 'Used Successfully!');
                } else {
                    return redirect()->back()->with('done', 'Expired Coupon!');
                }
            }
        } else {
            return redirect()->back()->with('done', 'Coupon not found');
        }
    }
}
