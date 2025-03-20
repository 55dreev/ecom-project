<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UpdateCartCount
{
    /**
     * Handle the event.
     */
    public function handle(Authenticated $event)
    {
        $userId = $event->user->id;

        // Calculate the cart count for the logged-in user
        $cartCount = DB::table('carts')
            ->where('user_id', $userId)
            ->sum('quantity');

        // Store the cart count in session
        Session::put('cart_count', $cartCount);
    }
}
