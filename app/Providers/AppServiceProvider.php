<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

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
        UrlGenerator::macro('append', function ($parameters) {
            return sprintf(
                '%s/?%s', 
                url('/'), 
                http_build_query(array_merge(request()->all(), $parameters))
            );
        });
    }
}
