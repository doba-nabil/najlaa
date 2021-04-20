<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:property-list|property-create|property-edit|property-delete', ['only' => ['index','show']]);
        $this->middleware('permission:property-list', ['only' => ['index','show']]);
        $this->middleware('permission:property-create', ['only' => ['create','store']]);
        $this->middleware('permission:property-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:property-delete', ['only' => ['destroy' , 'delete_materials']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $materials = Material::orderBy('id', 'desc')->get();
            return view('backend.materials.index',compact('materials'));
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
            return view('backend.materials.create');
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
    public function store(MaterialRequest $request)
    {
        try {
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            Material::create($request->all());
            return redirect()->route('materials.index')->with('done', 'Added Successfully ....');
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
        $material = Material::find($id);
        if(isset($material)){
            return view('backend.materials.edit' , compact('material'));
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
    public function update(MaterialRequest $request, $id)
    {
        try{
            $material = Material::find($id);
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            $material->update($request->all());
            return redirect()->route('materials.index')->with('done' , 'تم التعديل بنجاح');
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
            $material = Material::find($id);
            if(count($material->products) > 0){
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
                $material->delete();
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف الخامة بنجاح',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Material deleted successfully!',
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
    public function delete_materials()
    {
        try{
            $materials = Material::all();
            if(count($materials) > 0){
                foreach ($materials as $material) {
                    if(count($material->products) == 0){
                        $material->delete();
                    }
                }
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف الخامات الفارغة',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Deleted the Empty Materials',
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
