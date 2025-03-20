<?php

namespace App\Providers;

use App\Services\PayMongoService;
use Illuminate\Support\ServiceProvider;
use App\Models\Costume;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->singleton(PayMongoService::class, function ($app) {
        return new PayMongoService();
    });
}

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    View::share('costumes', Costume::all());
}
}
