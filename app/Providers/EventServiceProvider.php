<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Authenticated::class => [
            'App\Listeners\UpdateCartCount',
        ],
        Logout::class => [
            'App\Listeners\ClearCartCount',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
