<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Support\Facades\Validator;
=======
use Illuminate\Pagination\Paginator;
>>>>>>> Cristian

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        Validator::extend('greater_than_zero', function ($attribute, $value, $parameters, $validator) {
            return $value > 0;
        });
=======
        Paginator::useBootstrap();
>>>>>>> Cristian
    }
}
