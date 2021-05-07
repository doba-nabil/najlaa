<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-list', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy' , 'delete_products']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::orderBy('id', 'desc')->get();
            return view('backend.products.index', compact('products'));
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
            $categories = Category::whereNull('parent_id')->get();
            $materials = Material::all();
            $brands = Brand::all();
            $colors = Color::all();
            $sizes = Size::all();
            return view('backend.products.create', compact('categories', 'materials', 'brands', 'colors', 'sizes'));
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
    public function store(ProductRequest $request)
    {
        try {
            if ($request->discount_price) {
                $offerprice = $request->price;
                $offerdisc = $request->discount_price;
                $offerRate = $offerdisc / $offerprice * 100;
                $offerRate = 100 - $offerRate;
            }

            $product = new Product();
            $product->name_ar = $request->name_ar;
            $product->name_en = $request->name_en;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->material_id = $request->material_id;
//            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            if ($request->discount_price || $request->discount_price!= 0) {
                $product->discount_price = $request->discount_price;
                $product->percentage_discount = round($offerRate) . ' % ';
            } else {
                $product->percentage_discount = 0;
            }
            $product->max_qty = $request->max_qty;
            $product->min_qty = $request->min_qty;
            $product->code = $request->code;
            $product->body_ar = $request->body_ar;
            $product->body_en = $request->body_en;
            if ($request->active == 1) {
                $product->active = 1;
            } else {
                $product->active = 0;
            }
            if ($request->chosen == 1) {
                $product->chosen = 1;
            } else {
                $product->chosen = 0;
            }
            $product->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/products', $product->id, Product::class, 'main');
            }
            if ($request->hasFile('size_image')) {
                $this->saveimage($request->size_image, 'pictures/products', $product->id, Product::class, 'size');
            }
            if ($request->hasFile('images')) {
                $this->saveimages($request->images, 'pictures/products', $product->id, Product::class, 'sub');
            }
            if ($request->sizes) {
                $this->saveDetails($request->sizes, $product->id, 'size');
            }
            if ($request->colors) {
                $this->saveDetails($request->colors, $product->id, 'color');
            }
            return redirect()->route('products.show', $product->slug)->with('done', 'Added Successfully ....');
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
    public function show($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            return view('backend.products.show', compact('product'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function accept($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            if ($product->active == 1) {
                $product->active = 0;
            } else {
                $product->active = 1;
            }
            $product->save();
            return redirect()->route('products.index')->with('done', 'Posted Successfully ....');
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
    public function edit($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            if (isset($product)) {
                $categories = Category::whereNull('parent_id')->get();
                $subcategories = Category::whereNotNull('parent_id')->get();
                $selected_sizes = ProductDetail::where('product_id', $product->id)->where('type', 'size')->get();
                $selected_colors = ProductDetail::where('product_id', $product->id)->where('type', 'color')->get();
                $materials = Material::all();
                $brands = Brand::all();
                $colors = Color::all();
                $sizes = Size::all();
                return view('backend.products.edit', compact('product', 'categories', 'colors',
                    'materials', 'brands', 'sizes', 'subcategories', 'selected_colors', 'selected_sizes'));
            } else {
                return redirect()->back()->with('error', 'Error Try Again !!');
            }
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
    public function update(ProductRequest $request, $id)
    {
        try {
            if ($request->discount_price) {
                $offerprice = $request->price;
                $offerdisc = $request->discount_price;
                $offerRate = $offerdisc / $offerprice * 100;
                $offerRate = 100 - $offerRate;
            }

            $product = Product::find($id);
            $product->name_ar = $request->name_ar;
            $product->name_en = $request->name_en;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->material_id = $request->material_id;
//            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            if ($request->discount_price || $request->discount_price!= 0) {
                $product->discount_price = $request->discount_price;
                $product->percentage_discount = round($offerRate) . ' % ';
            } else {
                $product->percentage_discount = 0;
            }
            $product->max_qty = $request->max_qty;
            $product->min_qty = $request->min_qty;
            $product->code = $request->code;
            $product->body_ar = $request->body_ar;
            $product->body_en = $request->body_en;
            if ($request->active == 1) {
                $product->active = 1;
            } else {
                $product->active = 0;
            }
            if ($request->chosen == 1) {
                $product->chosen = 1;
            } else {
                $product->chosen = 0;
            }
            $product->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image, 'pictures/products', $product->id, Product::class, 'main');
            }
            if ($request->hasFile('size_image')) {
                $this->editimage($request->size_image, 'pictures/products', $product->id, Product::class, 'size');
            }
            if ($request->hasFile('images')) {
                $this->saveimages($request->images, 'pictures/products', $product->id, Product::class, 'sub');
            }
            if ($request->sizes) {
                $this->editDetails($request->sizes, $product->id, 'size');
            }
            if ($request->colors) {
                $this->editDetails($request->colors, $product->id, 'color');
            }
            return redirect()->route('products.show', $product->slug)->with('done', 'Edited Successfully ....');
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
            $product = Product::find($id);
            if (isset($product)) {
                if (count($product->pays) == 0) {
                    $this->deleteimages($product->id, 'pictures/products/', Product::class);
                    foreach ($product->subImages as $image) {
                        @unlink('pictures/products/' . $image->image);
                        $image->delete();
                    }
                    $product->delete();
                    if(app()->getLocale() == 'ar'){
                        return response()->json([
                            'success' => 'تم الحذف بنجاح'
                        ]);
                    }else{
                        return response()->json([
                            'success' => 'Record deleted successfully!'
                        ]);
                    }
                } else {
                    if(app()->getLocale() == 'ar'){
                        return response()->json([
                            'error' => 'لا يمكن حذف المنتج بسبب وجود طلبات شراء'
                        ], 422);
                    }else{
                        return response()->json([
                            'error' => 'Cannot delete Product, In Order'
                        ], 422);
                    }

                }

            } else {
                return redirect()->back()->with('error', 'Error Try Again !!');
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

    public function delete_products(Request $request)
    {
        try {
            $ids = $request->ids;
            $products = Product::whereIn('id',explode(",",$ids))->get();
            foreach ($products as $product){
                if (count($product->pays) == 0) {
                    $this->deleteimages($product->id, 'pictures/products/', Product::class);
                    foreach ($product->subImages as $image) {
                        @unlink('pictures/products/' . $image->image);
                        $image->delete();
                    }
                    $product->delete();
                }
            }
            if(app()->getLocale() == 'ar'){
                return response()->json([
                    'success' => 'تم حذف المنتجات بلا طلبات شراء بنجاح'
                ]);
            }else{
                return response()->json([
                    'success' => 'Products Without Orders deleted successfully!'
                ]);
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

    public function delete_images($imgID)
    {
        try {
            $image = Image::find($imgID);
            @unlink('pictures/products/' . $image->image);
            $image->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
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
