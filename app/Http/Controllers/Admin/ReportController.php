<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pay;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['yearlyReport','yearlyReport_post','monthlyReport','monthlyReport_post',
            'dailyReport','dailyReport_post','allReport','allReport_post','best_selling','best_selling_post']]);
        $this->middleware('permission:order-list',['only' => ['yearlyReport','yearlyReport_post','monthlyReport','monthlyReport_post',
            'dailyReport','dailyReport_post','allReport','allReport_post','best_selling','best_selling_post']]);
        $this->middleware('permission:order-edit', ['only' => ['yearlyReport','yearlyReport_post','monthlyReport','monthlyReport_post',
            'dailyReport','dailyReport_post','allReport','allReport_post','best_selling','best_selling_post']]);
        $this->middleware('permission:order-delete', ['only' => ['yearlyReport','yearlyReport_post','monthlyReport','monthlyReport_post',
            'dailyReport','dailyReport_post','allReport','allReport_post','best_selling','best_selling_post']]);
    }

    public function yearlyReport()
    {
        try {
            $orders = Order::with('user');
            $orders->yearlyReport()->get();
            return view('backend.reports.yearly', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function yearlyReport_post(Request $request)
    {
        try {
            $orders = Order::with('user');
            if ($request->user_id) {
                $orders = $orders->where('user_id', $request->user_id);
            }
            if ($request->city_id) {
                $orders = $orders->where('city_id', $request->city_id);
            }
            if ($request->year) {
                $orders = $orders->yearlyReport($request->year);
            }

            $orders = $orders->get();
            return view('backend.reports.yearly', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }


    public function monthlyReport()
    {
        try {
            $orders = Order::with('user');
            $orders->monthlyReport()->get();
            return view('backend.reports.monthly', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function monthlyReport_post(Request $request)
    {
        try {
            $orders = Order::with('user');
            if ($request->user_id) {
                $orders = $orders->where('user_id', $request->user_id);
            }
            if ($request->city_id) {
                $orders = $orders->where('city_id', $request->city_id);
            }
            if ($request->year && $request->month) {
                $month = $request->month;
                $year = $request->year;
                $orders = $orders->monthlyReport($month, $year);
            }
            $orders = $orders->get();
            return view('backend.reports.monthly', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }


    public function dailyReport()
    {
        try {
            $orders = Order::with('user');
            $orders->dailyReport()->get();
            return view('backend.reports.daily', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function dailyReport_post(Request $request)
    {
        try {
            $orders = Order::with('user');
            if ($request->user_id) {
                $orders = $orders->where('user_id', $request->user_id);
            }
            if ($request->city_id) {
                $orders = $orders->where('city_id', $request->city_id);
            }
            if ($request->date) {
                $orders = $orders->dailyReport($request->date);
            }
            $orders = $orders->get();
            return view('backend.reports.daily', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function allReport()
    {
        try {
            $orders = Order::with('user');
            $orders->dailyReport()->get();
            return view('backend.reports.all', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function allReport_post(Request $request)
    {
        try {
            $orders = Order::with('user');
            if ($request->user_id) {
                $orders = $orders->where('user_id', $request->user_id);
            }
            if ($request->city_id) {
                $orders = $orders->where('city_id', $request->city_id);
            }
            if ($request->date_from && $request->date_to) {
                $from = $request->date_from;
                $to = $request->date_to;
                $orders = $orders->whereBetween('created_at', [$from, $to]);
            }
            $orders = $orders->get();
            return view('backend.reports.all', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function best_selling()
    {

        $pays = Pay::with('product')->get();
        $product_ids =[];
        foreach ($pays as $pay){
            array_push($product_ids , $pay->product_id);
        }
        $product_ids;
        $products = Product::whereIn('id' , $product_ids)->withCount('pays as cnt')->orderBy('cnt', 'DESC')->get();
        return view('backend.reports.best', compact('products' , 'pays'));
    }
    public function best_selling_post(Request $request)
    {

            $pays = Pay::with('product');
            $orders = Order::with('user');
        if ($request->city_id) {
            $pay_ids = [];
            $orders = $orders->where('city_id' , $request->city_id)->get();
                foreach ($orders as $order){
                    foreach ($order->pays as $pay){
                        array_push($pay_ids , $pay->id);
                    }
                }
                $pays = $pays->whereIn('id' , $pay_ids);
        }
        if ($request->date_from && $request->date_to) {
            $from = $request->date_from;
            $to = $request->date_to;
            $pays = $pays->whereBetween('created_at', [$from, $to]);
        }
        $pays = $pays->get();
            $product_ids =[];
            foreach ($pays as $pay){
                array_push($product_ids , $pay->product_id);
            }
         $product_ids;
        $products = Product::whereIn('id' , $product_ids)->withCount('pays as cnt')->orderBy('cnt', 'DESC')->get();
        return view('backend.reports.best', compact('products' , 'pays'));
    }
}
