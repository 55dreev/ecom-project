<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
class CheckoutController extends Controller
{
    // Show the checkout page
    public function showCheckout()
{
    $cartToken = Cookie::get('cart_token');

    $cartItems = [];

    if ($cartToken) {
        $cartItems = Cart::where('cart_token', $cartToken)->get();
    }

    return view('checkout', compact('cartItems'));
}

    // Handle checkout form submission
    public function submitCheckout(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'region' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'payment_method' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $cartToken = Cookie::get('cart_token');
    if (!$cartToken) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    $cartItems = Cart::where('cart_token', $cartToken)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

        // Store order details (create Order model first)
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->user_id = null;
            $order->first_name = $validated['first_name'];
            $order->last_name = $validated['last_name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->region = $validated['region'];
            $order->address = $validated['address'];
            $order->city = $validated['city'];
            $order->zip_code = $validated['zip_code'];
            $order->payment_method = $validated['payment_method'];
            $order->total_amount = $validated['total_amount'];
            $order->status = 'Pending';
            $order->save();

            // Optionally, save cart items to order_items table
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $order->id,
                    'item_name' => $item->item_name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'days' => $item->days,
                ]);
            }

            // Clear cart
            Cart::where('cart_token', $cartToken)->delete();

            DB::commit();

            return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
