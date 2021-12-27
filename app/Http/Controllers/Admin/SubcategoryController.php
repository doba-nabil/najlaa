<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    use UploadTrait ;
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show','discount','discount_form']]);
        $this->middleware('permission:category-list', ['only' => ['index','show','discount','discount_form']]);
        $this->middleware('permission:category-create', ['only' => ['create','store','discount','discount_form']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update','discount','discount_form']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy' , 'delete_categories']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->orWhere('parent_id' , '!=' , 0)->orderBy('id' , 'desc')->get();
            return view('backend.subcategories.index' , compact('categories'));
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'Error Try Again....');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $parents = Category::whereNull('parent_id')->orWhere('parent_id' , '==' , 0)->get();
            return view('backend.subcategories.create' , compact('parents'));
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'Error Try Again....');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
        try{
            $category = new Category();
            $category->name_ar = $request->name_ar;
            $category->name_en = $request->name_en;
            $category->parent_id = $request->parent_id;
            if($request->active){$category->active = 1;}else{$category->active = 0;}
            $category->save();
            return redirect()->route('subcategories.index')->with('done' , 'Added Successfully....');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'Error Try Again....');
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
    public function edit($slug)
    {
        $category = Category::where('slug' , $slug)->first();
        if(isset($category)){
            $parents = Category::whereNull('parent_id')->orWhere('parent_id' , '==' , 0)->get();
            return view('backend.subcategories.edit' , compact('category' , 'parents'));
        }else{
            return redirect()->back()->with('error' , 'Error Try Again....');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, $id)
    {
        try{
            $category = Category::find($id);
            $category->name_ar = $request->name_ar;
            $category->name_en = $request->name_en;
            if($request->active){$category->active = 1;}else{$category->active = 0;}
            $category->save();
            return redirect()->route('subcategories.index')->with('done' , 'Edited Successfully....');
        }catch (\Exception $e){
            return redirect()->back()->with('error' , 'Error Try Again....');
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
            $category = Category::find($id);
            if(count($category->subcategory_products) > 0){
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يمكن حذف التصنيف بسبب وجود منتجات',
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'Cannot delete,Existing products in this category',
                    ],422);
                }
            }else{
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

    public function delete_categories()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->get();
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    if(count($category->subcategory_products) == 0){
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

    public function discount($slug)
    {
        try {
            $category = Category::where('slug' , $slug)->first();
            if($category){
                if(empty($category->parent_id)){
                    $products = Product::where('category_id' , $category->id)->orderBy('id', 'desc')->get();
                }else{
                    $products = Product::where('subcategory_id' , $category->id)->orderBy('id', 'desc')->get();
                }
                return view('backend.categories.discount', compact('products' , 'category'));
            }
            return redirect()->back()->with('error', 'Category Not found !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function discount_form($slug , Request $request)
    {
        try {
            $category = Category::where('slug' , $slug)->first();
            if($category){
                $ids = $request->ids;
                $dis = $request->percentage_discount;
                if ($request->ids) {
                    if(empty($category->parent_id)){
                        $products = Product::where('category_id' , $category->id)->whereIn('id', $ids)->get();
                    }else{
                        $products = Product::where('subcategory_id' , $category->id)->whereIn('id', $ids)->get();
                    }
                    foreach ($products as $product) {
                        if ($request->percentage_discount) {
                            $offerprice = $product->price;
                            $offerdisc = $dis;

                            $offerRate = ($offerprice * $offerdisc) / 100;
                            $offerRate = $product->price - $offerRate;

                            $product->discount_price = $offerRate;
                            $product->percentage_discount = $dis . ' % ';
                            $product->save();
                        }
                    }

                    $users = User::where('products_notify', 1)->pluck('id');
                    if ($users->count() > 0) {
                        $firebaseTokens = DB::table('token_users')->whereIn('user_id', $users)->get();
                        foreach ($firebaseTokens as $firebaseToken) {
                            if ($firebaseToken->lang == 'en') {
                                $title = 'New discounts on some products';
                                $body = 'Many discounts have been applied. Visit the application to browse the latest discounts';
                            } else {
                                $title = 'تخفيضات جديدة على بعض المنتجات';
                                $body = 'تم تطبيق العديد من التخفيضات قم بزيارة التطبيق لتصفح اخر التخفيضات';
                            }
                            $data = [
                                "to" => $firebaseToken->device_token,
                                "notification" =>
                                    [
                                        "title" => $title,
                                        "body" => $body,
                                        "icon" => url('/logo.png'),
                                        "sound" => 'default',
                                    ],
                            ];
                            $dataString = json_encode($data);

                            $headers = [
                                'Authorization: key=AAAAH0FWu1Y:APA91bGf1c3t9BGXv0WoYc1-ycpjl29_g7AKjiyoT4mZyJpYpvvKYDzcj7fqjAYz7nr0s56nQvUPLkdWfqmwyRqszwGCeJ93pO2--evn00sDYb1l5YoIdhPyBH6m5iT0cbaabXBa3ubr',
                                'Content-Type: application/json',
                            ];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                            curl_exec($ch);
                        }
                    }

                    if (app()->getLocale() == 'ar') {
                        return redirect()->back()->with('done', 'تم تطبيق الخصم بنجاح .....');
                    } else {
                        return redirect()->back()->with('done', 'Discount applied successfully.....');
                    }
                }
                if (app()->getLocale() == 'ar') {
                    return redirect()->back()->with('error', 'يرجى تحديد المنتجات .....');
                } else {
                    return redirect()->back()->with('error', 'Please select the products.....');
                }
            }
            return redirect()->back()->with('error', 'Category Not found !!');
        } catch (\Exception $e) {
            if (app()->getLocale() == 'ar') {
                return redirect()->back()->with('error', 'خطأ يرجى المحاولة مرة اخرى.....');
            } else {
                return redirect()->back()->with('error', 'Error Please Try Again.....');
            }

        }
    }
}
