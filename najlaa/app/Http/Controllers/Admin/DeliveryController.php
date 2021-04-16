<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:delivery-list|delivery-create|delivery-edit|delivery-delete', ['only' => ['index','show']]);
        $this->middleware('permission:delivery-list', ['only' => ['index','show']]);
        $this->middleware('permission:delivery-create', ['only' => ['create','store']]);
        $this->middleware('permission:delivery-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:delivery-delete', ['only' => ['destroy' , 'delete_deliveries']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dels = Delivery::orderBy('id', 'desc')->get();
            return view('backend.deliveries.index', compact('dels'));
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
        try {
            return view('backend.deliveries.create');
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
        try{
            $del = new Delivery();
            $del->name = $request->name;
            $del->phone = $request->phone;
            if ($request->active) {
                $del->active = 1;
            } else {
                $del->active = 0;
            }
            $del->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/deliveries', $del->id, Delivery::class, 'main');
            }
            return redirect()->route('deliveries.index')->with('done', 'Added Successfully ....');
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
        try{
            $del = Delivery::find($id);
            if (isset($del)) {
                $orders = Order::where('delivery_id',$id)->orderBy('id', 'desc')->get();
                return view('backend.deliveries.orders', compact('orders','del'));
            } else {
                return redirect()->back()->with('error', 'Error Try Again !!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $del = Delivery::find($id);
        if (isset($del)) {
            return view('backend.deliveries.edit', compact('del'));
        } else {
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
        try {
            $del = Delivery::find($id);
            $del->name = $request->name;
            $del->phone = $request->phone;
            if ($request->active) {
                $del->active = 1;
            } else {
                $del->active = 0;
            }
            $del->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image, 'pictures/deliveries', $del->id, Delivery::class, 'main');
            }
            return redirect()->route('deliveries.index')->with('done', 'Edited Successfully ....');
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
            $del = Delivery::find($id);
            $this->deleteimages($del->id, 'pictures/deliveries/', Delivery::class);
            $del->delete();
            return response()->json([
                'success' => 'Delivery deleted successfully!',
            ], 200);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function delete_deliveries()
    {
        try{
            $dels = Delivery::all();
            if(count($dels) > 0){
                foreach ($dels as $del){
                    if($del->orders->count() > 0){
                        return response()->json([
                            'error' => 'Can\'t Delete this delivery'
                        ]);
                    }else{
                        $this->deleteimages($del->id, 'pictures/deliveries/', Delivery::class);
                        $del->delete();
                        return response()->json([
                            'success' => 'Record deleted successfully!'
                        ]);
                    }
                }

            }else{
                return response()->json([
                    'error' => 'NO Record TO DELETE'
                ]);
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
