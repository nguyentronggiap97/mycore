<?php

namespace App\Providers;

use App\Snowflake;

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
        // Register snowflake guid service with random {ServerId:1-1023}
        $this->app->singleton('guid', function ($app) {
            return new Snowflake();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
