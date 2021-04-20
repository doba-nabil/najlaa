<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;

class ColorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:property-list|property-create|property-edit|property-delete', ['only' => ['index','show']]);
        $this->middleware('permission:property-list', ['only' => ['index','show']]);
        $this->middleware('permission:property-create', ['only' => ['create','store']]);
        $this->middleware('permission:property-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:property-delete', ['only' => ['destroy' , 'delete_colors']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $colors = Color::orderBy('id', 'desc')->get();
            return view('backend.colors.index',compact('colors'));
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
            return view('backend.colors.create');
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
    public function store(ColorRequest $request)
    {
        try {
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            Color::create($request->all());
            return redirect()->route('colors.index')->with('done', 'Added Successfully ....');
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
        $color = Color::find($id);
        if(isset($color)){
            return view('backend.colors.edit' , compact('color'));
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
    public function update(ColorRequest $request, $id)
    {
        try{
            $color = Color::find($id);
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            $color->update($request->all());
            return redirect()->route('colors.index')->with('done' , 'Edited Successfully ....');
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
            $color = Color::find($id);
            if(count($color->productDetails) > 0){
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
                $color->delete();
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف اللون بنجاح',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Color deleted successfully!',
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
    public function delete_colors()
    {
        try{
            $colors = Color::all();
            if(count($colors) > 0){
                foreach ($colors as $color) {
                    if(count($color->productDetails) == 0){
                        $color->delete();
                    }
                }
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف الالوان الفارغة',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Deleted the Empty Colors',
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
