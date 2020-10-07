<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use UploadTrait;
//    function __construct()
//    {
//        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show' , 'tree']]);
//        $this->middleware('permission:category-list', ['only' => ['index','show' , 'tree']]);
//        $this->middleware('permission:category-create', ['only' => ['create','store']]);
//        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:category-delete', ['only' => ['destroy' , 'delete_categories']]);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $brands = Brand::orderBy('id', 'desc')->get();
            return view('backend.brands.index',compact('brands'));
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
            return view('backend.brands.create');
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
    public function store(BrandRequest $request)
    {
        try {
            $brand = new Brand();
            $brand->name_ar = $request->name_ar;
            $brand->name_en = $request->name_en;
            if ($request->active) {
                $brand->active = 1;
            } else {
                $brand->active = 0;
            }
            $brand->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/brands', $brand->id , Brand::class, 'main');
            }
            return redirect()->route('brands.index')->with('done', 'Added Successfully ....');
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
    public function edit($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        if (isset($brand)) {
            return view('backend.brands.edit', compact('brand'));
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
    public function update(BrandRequest $request, $id)
    {
        try {
            $brand = Brand::find($id);
            $brand->name_ar = $request->name_ar;
            $brand->name_en = $request->name_en;
            if ($request->active) {
                $brand->active = 1;
            } else {
                $brand->active = 0;
            }
            $brand->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image , 'pictures/brands' , $brand->id , Brand::class , 'main');
            }
            return redirect()->route('brands.index')->with('done', 'Edited Successfully');
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
            $brand = Brand::find($id);
            $this->deleteimages($brand->id , 'pictures/brand/' , Brand::class);
            $brand->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }

    }

    public function delete_brands()
    {
        try {
            $brands = Brand::all();
            if (count($brands) > 0) {
                foreach ($brands as $brand) {
                    $this->deleteimages($brand->id , 'pictures/brands/' , Brand::class);
                    $brand->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO EVENTS TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
