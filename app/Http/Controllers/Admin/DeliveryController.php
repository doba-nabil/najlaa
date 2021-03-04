<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    use UploadTrait;
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
}
