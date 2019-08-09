<?php

namespace Modules\Media;

use Modules\Media\Policy;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class Provider extends ServiceProvider
{
    /**
     * This is module name
     * 
     * @var string
     */
    protected $module = 'media';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Media\Controllers';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Media', Facade::class);
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

        // Load module languages
        $this->loadTranslationsFrom(__DIR__ . '/Translations', $this->module);

        Blade::directive('upload', function ($data) {
            return "<?php echo Media::widget($data); ?>";
        });
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
        Gate::resource('media', Policy::class);
    }
}
