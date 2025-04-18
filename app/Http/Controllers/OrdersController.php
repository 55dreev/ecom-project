<?php

    namespace App\Http\Controllers;

    use App\Models\Order;
    use Illuminate\Support\Facades\Auth;

    class OrdersController extends Controller
    {
        public function index()
        {
            $userId = Auth::id();
            $orders = Order::where('user_id', $userId)->latest()->get();

            return view('orders.index', compact('orders'));
        }
    }