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
        $this->app->bind(
            'App\Repositry\CategoryInterface',
            'App\Repositry\CategoryRepositry'
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
