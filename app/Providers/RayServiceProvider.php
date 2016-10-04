<?php

namespace App\Providers;

use Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class RayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        });

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
