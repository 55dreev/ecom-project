<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Session;

class ClearCartCount
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event)
    {
        // Clear the cart count session on logout
        Session::forget('cart_count');
    }
}