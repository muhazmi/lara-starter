<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NavigationHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path('Helpers\NavigationHelper.php');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
