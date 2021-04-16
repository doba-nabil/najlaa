<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OrderChart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\User;
use App\Charts\UserChart;

class ChartController extends Controller
{
    public function index()
    {
        $users = User::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');
        $orders= Order::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');

        $chart = new UserChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset('New User Register Chart', 'line', $users)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);
        $chartt = new OrderChart;
        $chartt->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chartt->dataset('New User Register Chart', 'line', $orders)->options([
            'fill' => 'false',
            'borderColor' => '#FFA500'
        ]);

        return view('backend.user', compact('chart','chartt'));
    }
}
