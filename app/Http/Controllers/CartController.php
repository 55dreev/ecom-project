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

    if (!Session::has('cart_token')) {
        Session::put('cart_token', Str::uuid()->toString());
    }
    $cartToken = Session::get('cart_token');

    // Check if item already exists in cart
    $existingItem = DB::table('carts')
        ->where('cart_token', $cartToken)
        ->where('costume_id', $id)
        ->first();

    if ($existingItem) {
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Item already in cart!']);
        }
        return redirect()->route('cart.view')->with('error', 'Item already in cart!');
    }

    // Debugging - Check if token is generated
    \Log::info('Cart Token: ' . $cartToken);

    // Insert
    DB::table('carts')->insert([
        'cart_token' => $cartToken,
        'costume_id' => $id,
        'user_id' => auth()->id() ?? null, // if you're not using authentication, set to null
        'unit_price' => $costume->price,
        'quantity' => $request->input('quantity', 1),
        'days' => $request->input('days', 1),
        'total_price' => $costume->price * $request->input('quantity', 1) * $request->input('days', 1),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    \Log::info('Inserted to cart: Costume ID ' . $id);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Item added to cart!']);
    }

    return redirect()->route('cart.view')->with('success', 'Item added to cart!');
}


    public function viewCart()
    {
        $cartToken = Session::get('cart_token');

        $cartItems = DB::table('carts')
            ->join('costumes', 'carts.costume_id', '=', 'costumes.id')
            ->where('cart_token', $cartToken)
            ->select('carts.*', 'costumes.name', 'costumes.price', 'costumes.image')
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function removeFromCart($id)
    {
        DB::table('carts')->where('id', $id)->delete();

        return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
    }
}
