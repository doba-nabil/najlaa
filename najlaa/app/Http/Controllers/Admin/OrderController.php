<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Pay;
use App\Notifications\OrderSatusNot;
use App\Notifications\OrderStatus;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index','show']]);
        $this->middleware('permission:order-list', ['only' => ['index','show']]);
        $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy' , 'delete_orders']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $orders = Order::orderBy('id', 'desc')->get();
            return view('backend.orders.index' , compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function new()
    {
        try {
            $orders = Order::where('new' , 1)->orderBy('id' , 'desc')->get();
            return view('backend.orders.new' , compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function old()
    {
        try {
            $orders = Order::where('new' , 0)->orderBy('id' , 'desc')->get();
            return view('backend.orders.old' , compact('orders'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function send_message(Request $request,$id)
    {
        $order = Order::find($id);
        $order->new = 0;
        $order->save();

        $pays = Pay::where('order_id' , $id)->get();

        $dels = Delivery::active()->orderBy('id','desc')->get();

        $phone = $request->phone;
        return view('backend.orders.show' , compact('order','pays','dels','phone'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $order = Order::find($id);
            $order->new = 0;
            $order->save();

            $pays = Pay::where('order_id' , $id)->get();

            $dels = Delivery::active()->orderBy('id','desc')->get();
            return view('backend.orders.show' , compact('order','pays','dels'));
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $order = Order::find($id);
            $order->status = $request->status;
            if($request->status == 0){
                $order->processed = null;
                $order->shipped = null;
                $order->out_to_delivery = null;
                $order->delivered = null;
            }elseif($request->status == 1){
                $order->processed = Carbon::now();
                $order->shipped = null;
                $order->out_to_delivery = null;
                $order->delivered = null;
            }elseif($request->status == 2){
                $order->shipped = Carbon::now();
                $order->out_to_delivery = null;
                $order->delivered = null;
            }elseif($request->status == 3){
                $order->out_to_delivery = Carbon::now();
                $order->delivered = null;
            }elseif($request->status == 4){
                $order->delivered =  Carbon::now();
            }
            $order->delivery_id = $request->delivery_id;
            $order->save();

           $firebaseToken = DB::table('token_users')->where('user_id' , $order->user_id)->pluck('device_token')->all();

            $SERVER_API_KEY = 'AAAAH0FWu1Y:APA91bGf1c3t9BGXv0WoYc1-ycpjl29_g7AKjiyoT4mZyJpYpvvKYDzcj7fqjAYz7nr0s56nQvUPLkdWfqmwyRqszwGCeJ93pO2--evn00sDYb1l5YoIdhPyBH6m5iT0cbaabXBa3ubr';

            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => 'Najlaa Boutique',
                    "body" => 'Your Order Status Changed' . $order->code,
                ]
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
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

            if($request->status == 0){
                $code =  'signed / تم الاستلام';
            }elseif($request->status == 1){
                $code =  'processed / تحت المعالجة';
            }elseif($request->status == 2){
                $code =  'shipped / تم الشحن';
            }elseif($request->status == 3){
                $code =  'out to delivery / في الطريق اليك';
            }elseif($request->status == 4){
                $code =  'delivered / تم التوصيل';
            }
            $user = User::find($order->user_id);
            $user->notify(new OrderStatus($code));

            $user->notify(new OrderSatusNot($order));
            return redirect()->back()->with('done' , 'Order Updated Successfully');

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
            $order = Order::find($id);
            $order->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function delete_orders()
    {
        try {
            $orders = Order::all();
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    $order->delete();
                }
                return response()->json([
                    'success' => 'Records deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO Records TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function delete_old_orders()
    {
        try {
            $orders = Order::where('new' , 0)->get();
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    $order->delete();
                }
                return response()->json([
                    'success' => 'Records deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO Records TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function delete_new_orders()
    {
        try {
            $orders = Order::where('new' , 1)->get();
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    $order->delete();
                }
                return response()->json([
                    'success' => 'Records deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO Records TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
