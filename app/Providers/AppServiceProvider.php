<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('months', __('months'));
        });

        try {
            // Check if the companies table exists
            if (Schema::hasTable('companies')) {
                $companyInfo = Cache::remember('companyInfo', 60, function () {
                    return Company::find(1);
                });
                view()->share('companyInfo', $companyInfo);
            } else {
                view()->share('companyInfo', null);
            }
        } catch (QueryException $e) {
            // If there's a database connection error, set companyInfo to null
            view()->share('companyInfo', null);
        }
    }
}
