<?php

namespace Modules\Account;

use Modules\Account\Policy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * This is module name
     * 
     * @var string
     */
    protected $module = 'account';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Account\Controllers';

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
        // Load module policies
        $this->loadPolicies();

        // Load module routes
        $this->loadRoutes();

        // Load module views
        $this->loadViewsFrom(__DIR__ . '/Views', $this->module);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function loadRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(__DIR__ . '/Routes.php');
    }

    /**
     * Define the policies for the module.
     *
     * @return void
     */
    public function loadPolicies()
    {
        Gate::resource('accountant', Policy::class);
        Gate::resource('chart', Policy::class);
        Gate::resource('report', Policy::class);
        Gate::resource('payment', Policy::class);
    }
}
