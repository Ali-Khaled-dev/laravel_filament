<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */ public function register()
    {
        $this->app->bind(
            'App\Repositry\PostInterface',
            'App\Repositry\PostRepositry'
        );
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
