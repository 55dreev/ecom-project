<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Costume;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $costume = Costume::findOrFail($id);

        $cart = Session::get('cart', []);

        $cart[$id] = [
            'name' => $costume->name,
            'price' => $costume->price,
            'quantity' => $request->input('quantity', 1),
            'days' => $request->input('days', 1),
            'total_price' => $costume->price * $request->input('quantity', 1) * $request->input('days', 1),
            'image' => $costume->image
        ];

        Session::put('cart', $cart);
        return response()->json(['success' => true]); // Send JSON response
       
        
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
    }


}
