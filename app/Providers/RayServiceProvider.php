<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('stats', function($view) {
        //     $view->with('stats', app('App\Stats'));
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
