<?php

namespace App\Providers;

use App\Services\WatchDog;
use Illuminate\Support\ServiceProvider;

class WatchDogProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\WatchDogInterface', function($app) {
            return new WatchDog;
        });
    }
}
