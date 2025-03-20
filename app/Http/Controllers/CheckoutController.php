<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $grandTotal = $request->input('grand_total');

        // ✅ 1. Create the PayMongo checkout link
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode('sk_test_hVjhiCTews4tHb5BHXikwdiA'), // Replace with your secret key
            'content-type' => 'application/json',
        ])->post('https://api.paymongo.com/v1/links', [
            'data' => [
                'attributes' => [
                    'amount' => (int)($grandTotal * 100), // Convert PHP to cents
                    'description' => 'T Shop Checkout',
                    'remarks' => 'Order Payment',
                    'currency' => 'PHP',
                ],
            ],
        ]);

        if ($response->successful()) {
            $paymongoLink = $response->json()['data']['attributes']['checkout_url'];

            // ✅ 2. Retrieve complete cart items with costume details
            $cartItems = DB::table('carts')
                ->join('costumes', 'carts.costume_id', '=', 'costumes.id')
                ->where('carts.user_id', $userId)
                ->select(
                    'carts.quantity',
                    'carts.days',
                    'carts.total_price',
                    'costumes.name',
                    'costumes.image',
                    'costumes.price'
                )
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Your cart is empty.'], 400);
            }

            // ✅ 3. Store the order in the database with full item details
            $order = new Order();
            $order->user_id = $userId;
            
            $order->items = json_encode($cartItems->map(function ($item) {
                return [
                    'image' => $item->image,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'days' => $item->days,
                    'total_price' => $item->total_price,
                ];
            }));
            
            $order->grand_total = $grandTotal;
            $order->status = 'pending';
            $order->save();

            // ✅ 4. Clear the cart
            DB::table('carts')->where('user_id', $userId)->delete();

            // ✅ 5. Return PayMongo checkout link as JSON response
            return response()->json([
                'success' => true,
                'checkout_url' => $paymongoLink
            ]);

        } else {
            return response()->json(['success' => false, 'message' => 'Failed to create PayMongo link'], 500);
        }
    }
}
