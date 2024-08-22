<?php

namespace App\Providers;

use App\Facebook\CachePersistentDataHandler;
use Facebook\PersistentData\PersistentDataInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Facebook
        $this->app->singleton(PersistentDataInterface::class, fn ($app) => $app[CachePersistentDataHandler::class]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
