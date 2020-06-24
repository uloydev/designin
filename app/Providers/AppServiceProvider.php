<?php

namespace App\Providers;

use App\BlogCategory;
use App\Service;
use App\TokenConversion;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        $blogCategory = BlogCategory::all();
        $tokenConversion = TokenConversion::first();
        $services = Service::all();
        View::share([
            'blogCategory' => $blogCategory,
            'tokenConversion' => $tokenConversion,
            'services' => $services
        ]);
    }
}
