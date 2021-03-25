<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OrderChart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Media;
use App\Models\Moderator;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Question;

use App\User;
use App\Charts\UserChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Request;
use Response;

class AdminController extends Controller
{
    public function index()
    {
        $orderss = Order::orderBy('created_at' , 'desc')->get();
        $dates = [];
        foreach ($orderss as $order){
            $time = $order->created_at;
            $date = new Carbon( $time );
            array_push($dates , $date->year);
        }
        $myCollection = collect($dates);
        $uniqueCollection = $myCollection->unique();

        $uniqueCollection->all();

         $uniqueCollection;

//        $users = User::select(\DB::raw("COUNT(*) as count"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(\DB::raw("Month(created_at)"))
//            ->pluck('count');
//
//        $chart = new UserChart;
//        if(app()->getLocale() == 'en'){
//            $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
//            $chart->dataset('New User Register Chart', 'line', $users)->options([
//                'fill' => 'true',
//                'borderColor' => '#51C1C0'
//            ]);
//        }else{
//            $chart->labels(['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر']);
//            $chart->dataset('المستخدمين الجدد', 'line', $users)->options([
//                'fill' => 'true',
//                'borderColor' => '#51C1C0'
//            ]);
//        }
//
//        $orders = Order::select(\DB::raw("COUNT(*) as count"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(\DB::raw("Month(created_at)"))
//            ->pluck('count');
//        $chartt = new OrderChart;
//        if(app()->getLocale() == 'en'){
//            $chartt->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
//            $chartt->dataset('NEW Orders Chart', 'line', $orders)->options([
//                'fill' => 'true',
//                'borderColor' => '#FFA500'
//            ]);
//        }else{
//            $chartt->labels(['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر']);
//            $chartt->dataset('عمليات الشراء الجديدة', 'line', $orders)->options([
//                'fill' => 'true',
//                'borderColor' => '#FFA500'
//            ]);
//        }
        return view('backend.home',compact('uniqueCollection'));
    }

    public function getsubcategories()
    {
        $category_id = Request::input('category_id');
        $subcategories = Category::where('parent_id', $category_id)->get();
        return Response::json($subcategories);
    }
    public function getcities()
    {
        $country_id = Request::input('country_id');
        $cities = City::where('country_id', $country_id)->get();
        return Response::json($cities);
    }
    /************ delete not *********/
    public function readNotification()
    {
        $notificationID = Request::input('notificationID');
        $notification = Notification::where('id', $notificationID)->first();
        $notification->delete();
        return response()->json(['status' => 'success'], 201);
    }

    public function language($locale)
    {
        if (in_array($locale, \Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
