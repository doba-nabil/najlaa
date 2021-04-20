<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-list', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy' , 'delete_users']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::orderBy('id', 'desc')->get();
            return view('backend.users.index',compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function token()
    {
        try {
            $users = User::select('code' , 'email' , 'email_verified_at' , 'api_token')->orderBy('id', 'desc')->get();
            $userss = [];
            foreach ($users as $user){
                $user['codee'] = $user->code;
                array_push($userss , $user);
            }
            return $userss;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function blocked()
    {
        try {
            $users = User::orderBy('id', 'desc')->where('active' , 0)->get();
            return view('backend.users.blocked',compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function block_user($id)
    {
        try {
            $user = User::find($id);
            if($user->active == 1){
                $user->active = 0;
                $user->save();
                return redirect()->back()->with('error', 'Blocked Successfully ....');
            }else{
                $user->active = 1;
                $user->save();
                return redirect()->back()->with('done', 'Unblocked Successfully ....');
            }
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
            return view('backend.users.create');
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
    public function store(UserRequest $request)
    {
        try {
            if($request->active){
                $request->request->add(['active' => 1]);
            }else{
                $request->request->add(['active' => 0]);
            }
            $request->request->add(['email_verified_at' => Carbon::now()]);
            User::create($request->all());
            return redirect()->route('users.index')->with('done', 'Added Successfully ....');
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
        try {
            $user = User::find($id);
            $addresses = Address::where('user_id' , $id)->orderBy('id', 'desc')->get();
            return view('backend.addresses.index',compact('addresses' , 'user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function orders($id)
    {
        try{
            $user = User::find($id);
            if (isset($user)) {
                $orders = Order::where('user_id',$id)->orderBy('id', 'desc')->get();
                return view('backend.users.orders', compact('orders','user'));
            } else {
                return redirect()->back()->with('error', 'Error Try Again !!');
            }
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
    public function edit($id)
    {
        $user = User::find($id);
        if (isset($user)) {
            return view('backend.users.edit', compact('user'));
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
    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->birth = $request->birth;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if($request->password){
                $user->password = Hash::make($request->password);
            }else{
                $user->password = $user->password;
            }
            $user->email_verified_at = Carbon::now();
            $user->save();
            return redirect()->route('users.index')->with('done', 'Edited Successfully');
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
            $user = User::find($id);
            if(count($user->orders) > 0){
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'error' => 'لا يمكن حذ المستخدم بسبب وجود طلبات شراء'
                    ],422);
                }else{
                    return response()->json([
                        'error' => 'Cannot delete,Existing Orders To This User',
                    ],422);
                }

            }else{
                $user->delete();
                if(app()->getLocale() == 'ar'){
                    return response()->json([
                        'success' => 'تم حذف المستخدم بنجاح',
                    ],200);
                }else{
                    return response()->json([
                        'success' => 'User deleted successfully!',
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

    public function delete_users()
    {
        try {
            $users = User::all();
            if (count($users) > 0) {
                foreach ($users as $user) {
                    if(count($user->orders) == 0){
                        $user->delete();
                    }
                }
                return response()->json([
                    'success' => 'Deleted Users has not orders',
                ],200);
            } else {
                return response()->json([
                    'error' => 'NO Users TO DELETE'
                ],422);
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
