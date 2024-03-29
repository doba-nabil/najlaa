<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\Size;

class SizeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:property-list|property-create|property-edit|property-delete', ['only' => ['index','show']]);
        $this->middleware('permission:property-list', ['only' => ['index','show']]);
        $this->middleware('permission:property-create', ['only' => ['create','store']]);
        $this->middleware('permission:property-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:property-delete', ['only' => ['destroy' , 'delete_sizes']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $sizes = Size::orderBy('id', 'desc')->get();
            return view('backend.sizes.index',compact('sizes'));
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
            return view('backend.sizes.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        try {
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            Size::create($request->all());
            return redirect()->route('sizes.index')->with('done', 'Added Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
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
        $size = Size::find($id);
        if(isset($size)){
            return view('backend.sizes.edit' , compact('size'));
        }else{
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, $id)
    {
        try{
            $size = Size::find($id);
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            $size->update($request->all());
            return redirect()->route('sizes.index')->with('done' , 'Edited Successfully ....');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $size = Size::find($id);
            if(count($size->productDetails) > 0){
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يمكن الحذف بسبب وجود منتجات',
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'Cannot delete,Existing products in It',
                    ],422);
                }

            }else{
                $size->delete();
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف المقاس بنجاح',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Size deleted successfully!',
                    ],200);
                }
            }
        }catch(\Exception $e){
            if(app()->getLocale() == 'ar'){
                return response()->json([
                    'error' => 'يوجد خطأ يرجى المحاولة في وقت لاحق!!'
                ],422);
            }else{
                return response()->json([
                    'error' => 'Error Try Again !!'
                ],422);
            }
        }
    }
    public function delete_sizes()
    {
        try{
            $sizes = Size::all();
            if(count($sizes) > 0){
                foreach ($sizes as $size) {
                    if(count($size->productDetails) == 0){
                        $size->delete();
                    }
                }
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف المقاسات الفارغة',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Deleted the Empty Sizes',
                    ],200);
                }

            }else{
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يوجد ما يتم حذفة!!'
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'No Records To delete'
                    ],422);
                }
            }
        }catch(\Exception $e){
            if(app()->getLocale() == 'ar'){
                return response()->json([
                    'error' => 'يوجد خطأ يرجى المحاولة في وقت لاحق!!'
                ],422);
            }else{
                return response()->json([
                    'error' => 'Error Try Again !!'
                ],422);
            }
        }
    }
}
