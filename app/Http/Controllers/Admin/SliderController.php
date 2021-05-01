<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\OfferProduct;
use App\Models\Product;
use App\Models\Slider;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','show']]);
        $this->middleware('permission:slider-list', ['only' => ['index','show']]);
        $this->middleware('permission:slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slider-delete', ['only' => ['destroy' , 'delete_sliders']]);
    }
    public function index()
    {
        try {
            $sliders = Slider::orderBy('id', 'desc')->get();
            return view('backend.sliders.index', compact('sliders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function show($id)
    {
        try {
            $slider = Slider::find($id);
            return view('backend.sliders.show', compact('slider'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function create()
    {
        try {
            $products = Product::orderBy('id','desc')->active()->get();
            return view('backend.sliders.create',compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function store(SliderRequest $request)
    {
        try {
            $slider = new Slider();
            $slider->title_ar = $request->title_ar;
            $slider->title_en = $request->title_en;
            $slider->subtitle_ar = $request->subtitle_ar;
            $slider->subtitle_en = $request->subtitle_en;
            if ($request->active) {
                $slider->active = 1;
            } else {
                $slider->active = 0;
            }
            $slider->save();
            if($request->product_ids){
                foreach ($request->product_ids as $pro_id){
                    $offer_pro = new OfferProduct();
                    $offer_pro->product_id = $pro_id;
                    $offer_pro->slider_id = $slider->id;
                    $offer_pro->save();
                }
            }
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/sliders', $slider->id , Slider::class, 'main');
            }
            return redirect()->route('sliders.index')->with('done', 'Added Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        if (isset($slider)) {
            $usedProducts = OfferProduct::where('slider_id' , $id)->get();
            $products = Product::orderBy('id','desc')->active()->get();
            return view('backend.sliders.edit', compact('slider','products','usedProducts'));
        } else {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function update(SliderRequest $request, $id)
    {
        try {
            $slider = Slider::find($id);
            $slider->title_ar = $request->title_ar;
            $slider->title_en = $request->title_en;
            $slider->subtitle_ar = $request->subtitle_ar;
            $slider->subtitle_en = $request->subtitle_en;
            if ($request->active) {
                $slider->active = 1;
            } else {
                $slider->active = 0;
            }
            $slider->save();
            if($request->product_ids){
                if($slider->offer_products->count() > 0){
                    foreach ($slider->offer_products as $pr){
                        $pr->delete();
                    }
                }
                foreach ($request->product_ids as $pro_id){
                    $offer_pro = new OfferProduct();
                    $offer_pro->product_id = $pro_id;
                    $offer_pro->slider_id = $slider->id;
                    $offer_pro->save();
                }
            }

            if ($request->hasFile('image')) {
                $this->editimage($request->image, 'pictures/sliders', $slider->id , Slider::class, 'main');
            }
            return redirect()->route('sliders.index')->with('done', 'Added Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            $this->deleteimages($slider->id , 'pictures/sliders/' , Slider::class);
            $slider->delete();
            if(app()->getLocale() == 'ar'){
                return response()->json([
                    'success' => 'تم بنجاح',
                ],200);
            }else{
                return response()->json([
                    'success' => 'Deleted Successfully',
                ],200);
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

    public function delete_sliders()
    {
        try {
            $sliders = Slider::all();
            if (count($sliders) > 0) {
                foreach ($sliders as $slider) {
                    $this->deleteimages($slider->id , 'pictures/sliders/' , Slider::class);
                    $slider->delete();
                }
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم الحذف بنجاح',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'Deleted Successfully',
                    ],200);
                }
            } else {
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يوجد ما يتم حذفة'
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'No Records To Delete'
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
    public function delete_slider_product($id)
    {
        try {
            OfferProduct::find($id)->delete();
            if(app()->getLocale() == 'ar'){
                return response()->json([
                    'success' => 'تم الحذف من العرض بنجاح',
                ],200);
            }else{
                return response()->json([
                    'success' => 'Deleted From Offer Successfully',
                ],200);
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
