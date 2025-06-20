<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\Breadcrumbs\Breadcrumbs;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        Schema::defaultStringLength(191);
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Paginator::useBootstrapFive();

        Request::macro('breadcrumbs', function (){
            return new Breadcrumbs($this);
        });
    }
}
