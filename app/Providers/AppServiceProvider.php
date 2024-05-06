<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
//        $this->app->bind('path.public', function () {
//            return base_path('public_html');
//        });



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
