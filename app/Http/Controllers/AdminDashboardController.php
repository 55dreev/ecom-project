<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
    $totalOrders = Order::count();
    $totalDelivered = Order::where('status', 'delivered')->count();
    $totalCanceled = Order::where('status', 'cancelled')->count();
    $totalRevenue = Order::sum('grand_total');

    // For line chart: count orders per day of the week
    $ordersPerDay = Order::select(DB::raw('DAYNAME(created_at) as day'), DB::raw('count(*) as count'))
        ->groupBy('day')
        ->pluck('count', 'day');

    // Reorder to match week layout
    $orderedDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $chartData = [];
    foreach ($orderedDays as $day) {
        $chartData[] = $ordersPerDay[$day] ?? 0;
    }

    return view('admindashboard', compact(
        'totalOrders', 
        'totalDelivered', 
        'totalCanceled', 
        'totalRevenue',
        'totalRevenue',
        'chartData'
    ));
    }
    

}
