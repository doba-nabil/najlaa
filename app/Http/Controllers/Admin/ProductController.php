<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\EmptyProductNotification;
use App\Models\Image;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-list', ['only' => ['index','show','see_empty_not']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update','see_empty_not']]);
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
            return view('backend.products.create', compact('categories', 'materials', 'brands','colors','sizes'));
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
            if($request->percentage_discount){
                $offerprice = $request->price;
                $offerdisc = $request->percentage_discount;
                $offerRate = ($offerprice * $offerdisc) / 100;
                $offerRate = $request->price - $offerRate;
            }

            $product = new Product();
            $product->name_ar = $request->name_ar;
            $product->name_en = $request->name_en;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->material_id = $request->material_id;
//            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            if ($request->percentage_discount || $request->percentage_discount!= 0) {
                $product->discount_price = $offerRate;
                $product->percentage_discount = $request->percentage_discount . ' % ';
            } else {
                $product->percentage_discount = 0;
                $product->discount_price = 0;
            }
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
//            if ($request->sizes) {
//                $this->saveDetails($request->sizes, $product->id, 'size');
//            }
//            if ($request->colors) {
//                $this->saveDetails($request->colors, $product->id, 'color');
//            }
            foreach($request->colors as $color){
                $co = new ProductColor();
                $co->color_id = $color['color_id'];
                $co->size_id = $color['size_id'];
                $co->stock_qty = $color['qty'];
                $co->product_id = $product->id;
                $co->save();
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
             $selected_colors = DB::table('product_colors')->where('product_id' ,$product->id )
                ->select('color_id')
                ->distinct()
                ->pluck('color_id');
            return view('backend.products.show', compact('product','selected_colors'));
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
                $selected_colors = DB::table('product_colors')->where('product_id' ,$product->id )->get();
                $materials = Material::all();
                $brands = Brand::all();
                $colors = Color::all();
                $sizes = Size::all();
                return view('backend.products.edit', compact('product', 'categories',
                    'materials', 'brands', 'subcategories','colors' , 'sizes' ,'selected_colors'));
            } else {
                return redirect()->back()->with('error', 'Error Try Again !!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function see_empty_not($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            $empties = EmptyProductNotification::where('product_id' , $product->id)->where('moderator_id' , Auth::user()->id)->get();
            foreach($empties as $empty){
                $empty->delete();
            }
            if (isset($product)) {
                $categories = Category::whereNull('parent_id')->get();
                $subcategories = Category::whereNotNull('parent_id')->get();
                $selected_colors = DB::table('product_colors')->where('product_id' ,$product->id )->get();
                $materials = Material::all();
                $brands = Brand::all();
                $colors = Color::all();
                $sizes = Size::all();
                return view('backend.products.edit', compact('product', 'categories',
                    'materials', 'brands', 'subcategories','colors' , 'sizes' ,'selected_colors'));
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
            if($request->percentage_discount){
                $offerprice = $request->price;
                $offerdisc = $request->percentage_discount;

                $offerRate = ($offerprice * $offerdisc) / 100;
                $offerRate = $request->price - $offerRate;
            }

            $product = Product::find($id);
            $product->name_ar = $request->name_ar;
            $product->name_en = $request->name_en;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->material_id = $request->material_id;
//            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            if ($request->percentage_discount || $request->percentage_discount!= 0) {
                $product->discount_price = $offerRate;
                $product->percentage_discount = $request->percentage_discount . ' % ';
            } else {
                $product->percentage_discount = 0;
                $product->discount_price = 0;
            }
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
//            if ($request->sizes) {
//                $this->editDetails($request->sizes, $product->id, 'size');
//            }
//            if ($request->colors) {
//                $this->editDetails($request->colors, $product->id, 'color');
//            }
            if($request->colors){
                foreach ($product->colors as $col){
                    $col->delete();
                }
                foreach($request->colors as $color){
                    $found_emps = EmptyProductNotification::where('product_id' ,$product->id)->where('color_id' , $color['color_id'])->where('size_id', $color['size_id'])->get();
                    $co = new ProductColor();
                    $co->color_id = $color['color_id'];
                    $co->size_id = $color['size_id'];
                    $co->stock_qty = $color['qty'];
                    $co->product_id = $product->id;
                    $co->save();
                    if($co->stock_qty > 0){
                        foreach ($found_emps as $found){
                            $found->delete();
                        }
                    }
                }
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


    public function discount()
    {
        try {
            $products = Product::orderBy('id', 'desc')->get();
            return view('backend.products.discount', compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function discount_form(Request $request)
    {
        try {
            $ids = $request->ids;
            $dis = $request->percentage_discount;
            if($request->ids){
                $products = Product::whereIn('id',$ids)->get();
                foreach ($products as $product){
                    if($request->percentage_discount){
                        $offerprice = $product->price;
                        $offerdisc = $dis;

                        $offerRate = ($offerprice * $offerdisc) / 100;
                        $offerRate = $product->price - $offerRate;

                        $product->discount_price = $offerRate;
                        $product->percentage_discount = $dis . ' % ';
                        $product->save();
                    }
                }
                if(app()->getLocale() == 'ar'){
                    return redirect()->back()->with('done','تم تطبيق الخصم بنجاح .....');
                }else{
                    return redirect()->back()->with('done','Discount applied successfully.....');
                }
            }
            if(app()->getLocale() == 'ar'){
                return redirect()->back()->with('error','يرجى تحديد المنتجات .....');
            }else{
                return redirect()->back()->with('error','Please select the products.....');
            }
        } catch (\Exception $e) {
            if(app()->getLocale() == 'ar'){
                return redirect()->back()->with('error','خطأ يرجى المحاولة مرة اخرى.....');
            }else{
                return redirect()->back()->with('error','Error Please Try Again.....');
            }

        }
    }
}
