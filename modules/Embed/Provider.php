<?php

namespace Modules\Embed;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * This is module name
     * 
     * @var string
     */
    protected $module = 'embed';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Embed\Controllers';

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
        $this->mapRoutes();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function mapRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(__DIR__ . '/Routes.php');
    }
}
