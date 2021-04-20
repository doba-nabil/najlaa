<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-list', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy' , 'delete_categories']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::whereNull('parent_id')->orWhere('parent_id', '=', 0)->orderBy('id', 'desc')->get();
            return view('backend.categories.index',compact('categories'));
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
            return view('backend.categories.create');
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
    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category();
            $category->name_ar = $request->name_ar;
            $category->name_en = $request->name_en;
            if ($request->active) {
                $category->active = 1;
            } else {
                $category->active = 0;
            }
            if ($request->home_page) {
                $category->home_page = 1;
            } else {
                $category->home_page = 0;
            }
            $category->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/categories', $category->id , Category::class, 'main');
            }
            return redirect()->route('categories.index')->with('done', 'Added Successfully ....');
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
        $category = Category::where('slug', $slug)->first();
        if (isset($category)) {
            return view('backend.categories.edit', compact('category'));
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
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->name_ar = $request->name_ar;
            $category->name_en = $request->name_en;
            if ($request->active) {
                $category->active = 1;
            } else {
                $category->active = 0;
            }
            if ($request->home_page) {
                $category->home_page = 1;
            } else {
                $category->home_page = 0;
            }
            $category->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image , 'pictures/categories' , $category->id , Category::class , 'main');
            }
            return redirect()->route('categories.index')->with('done', 'Edited Successfully');
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
            $category = Category::find($id);
            if(count($category->category_products) > 0 || count($category->subCategories) > 0 ){
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يمكن حذف التصنيف بسبب وجود منتجات او تصميفات فرعية',
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'Cannot delete,Existing products in this category or Subcategories',
                    ],422);
                }

            }else{
                $this->deleteimages($category->id , 'pictures/categories/' , Category::class);
                $category->delete();
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف التصنيف بنجاح',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Category deleted successfully!',
                    ],200);
                }

            }
        } catch (\Exception $e) {
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

    public function delete_categories()
    {
        try {
            $categories = Category::whereNull('parent_id')->get();
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                   if(count($category->category_products) == 0 || count($category->subCategories) > 0 ){
                        $this->deleteimages($category->id , 'pictures/categories/' , Category::class);
                        $category->delete();
                    }
                }
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف التصنيفات الفارغة',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Deleted the Empty Categories',
                    ],200);
                }

            } else {
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يوجد تصنيفات لحذفها'
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'NO Categories TO DELETE'
                    ],422);
                }

            }
        } catch (\Exception $e) {
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
