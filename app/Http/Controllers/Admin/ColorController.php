<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;

class ColorController extends Controller
{
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
            $color->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function delete_colors()
    {
        try{
            $colors = Color::all();
            if(count($colors) > 0){
                foreach ($colors as $color){
                    $color->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            }else{
                return response()->json([
                    'error' => 'NO THING TO DELETE'
                ]);
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
