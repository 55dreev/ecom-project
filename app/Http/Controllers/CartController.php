<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Costume;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
{
    $costume = Costume::findOrFail($id);
    $userId = auth()->id();
    
    if (!Session::has('cart_token')) {
        Session::put('cart_token', Str::uuid()->toString());
    }
    $cartToken = Session::get('cart_token');

    // Check if item exists in the cart for this user or session
    $existingItem = DB::table('carts')
        ->where(function ($query) use ($userId, $cartToken, $id) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('cart_token', $cartToken);
            }
            $query->where('costume_id', $id);
        })
        ->first();

    if ($existingItem) {
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Item already in cart!']);
        }
        return redirect()->route('cart.view')->with('error', 'Item already in cart!');
    }

    // Insert new item into cart
    DB::table('carts')->insert([
        'cart_token' => $cartToken,
        'user_id' => $userId, // Associate cart with logged-in user
        'costume_id' => $id,
        'unit_price' => $costume->price,
        'quantity' => $request->input('quantity', 1),
        'days' => $request->input('days', 1),
        'total_price' => $costume->price * $request->input('quantity', 1) * $request->input('days', 1),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Item added to cart!']);
    }

    return redirect()->route('cart.view')->with('success', 'Item added to cart!');
}

    public function viewCart()
{
    $userId = auth()->id(); // Get logged-in user ID
    $cartToken = Session::get('cart_token');

    // If no user is logged in, fallback to session-based cart
    $cartItems = DB::table('carts')
        ->join('costumes', 'carts.costume_id', '=', 'costumes.id')
        ->where(function ($query) use ($cartToken, $userId) {
            if ($userId) {
                $query->where('carts.user_id', $userId);
            } else {
                $query->where('carts.cart_token', $cartToken);
            }
        })
        ->select('carts.id', 'carts.quantity', 'carts.days', 'carts.total_price', 
                 'costumes.name', 'costumes.price', 'costumes.image')
        ->get();

    return view('cart', compact('cartItems'));
}


    public function removeFromCart($id)
    {
        DB::table('carts')->where('id', $id)->delete();
        return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
    }
}
