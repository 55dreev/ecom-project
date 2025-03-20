<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Costume;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Add item to cart
     */
    public function addToCart(Request $request, $id)
    {
        $costume = Costume::findOrFail($id);
        $userId = auth()->id();

        // Use session token for guests
        if (!$userId && !Session::has('cart_token')) {
            Session::put('cart_token', \Illuminate\Support\Str::uuid()->toString());
        }
        
        $cartToken = Session::get('cart_token');

        // Check if the item already exists for the logged-in user or guest
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
            return response()->json(['success' => false, 'message' => 'Item already in cart!'], 409);
        }

        // Add the new item to the cart
        DB::table('carts')->insert([
            'cart_token'   => $cartToken,
            'user_id'      => $userId,
            'costume_id'   => $id,
            'unit_price'   => $costume->price,
            'quantity'     => $request->input('quantity', 1),
            'days'         => $request->input('days', 1),
            'total_price'  => $costume->price * $request->input('quantity', 1) * $request->input('days', 1),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // ✅ Recalculate cart count based on the user
        $cartCount = $this->getCartCount($userId, $cartToken);

        // Store the cart count in the session
        session(['cart_count' => $cartCount]);

        return response()->json([
            'success'    => true,
            'message'    => 'Item added to cart!',
            'cart_count' => $cartCount
        ]);
    }

    /**
     * View Cart
     */
    public function viewCart()
    {
        $userId = auth()->id();
        $cartToken = Session::get('cart_token');

        $cartItems = DB::table('carts')
            ->join('costumes', 'carts.costume_id', '=', 'costumes.id')
            ->where(function ($query) use ($userId, $cartToken) {
                if ($userId) {
                    $query->where('carts.user_id', $userId);
                } else {
                    $query->where('carts.cart_token', $cartToken);
                }
            })
            ->select('carts.id', 'carts.quantity', 'carts.days', 'carts.total_price', 
                     'costumes.name', 'costumes.price', 'costumes.image')
            ->get();

        // ✅ Recalculate the cart count
        $cartCount = $this->getCartCount($userId, $cartToken);
        session(['cart_count' => $cartCount]);

        return view('cart', compact('cartItems', 'cartCount'));
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart($id)
    {
        $userId = auth()->id();
        $cartToken = Session::get('cart_token');

        // Find the item
        $item = DB::table('carts')
            ->where('id', $id)
            ->where(function ($query) use ($userId, $cartToken) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('cart_token', $cartToken);
                }
            })
            ->first();

        if ($item) {
            // Delete the item
            DB::table('carts')->where('id', $id)->delete();

            // ✅ Recalculate the cart count
            $cartCount = $this->getCartCount($userId, $cartToken);
            session(['cart_count' => $cartCount]);
        }

        return redirect()->route('cart.view')
            ->with('success', 'Item removed successfully!')
            ->with('cart_count', $cartCount);
    }

    /**
     * Get cart count based on user or guest session
     */
    private function getCartCount($userId, $cartToken)
    {
        return DB::table('carts')
            ->where(function ($query) use ($userId, $cartToken) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('cart_token', $cartToken);
                }
            })
            ->sum('quantity');
    }
}
