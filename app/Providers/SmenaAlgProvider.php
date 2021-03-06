<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SmenaAlg;

class SmenaAlgProvider extends ServiceProvider
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
        $this->app->bind('App\Contracts\SmenaAlgInterface', function($app) {
            return new SmenaAlg;
        });
    }
}
