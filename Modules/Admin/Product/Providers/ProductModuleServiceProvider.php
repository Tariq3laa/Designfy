<?php

namespace Modules\Admin\Product\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProductModuleServiceProvider extends ServiceProvider
{
    protected $moduleNamespace = 'Modules\Admin\Product\Http\Controllers';
    protected $webRoute = 'Modules/Admin/Product/Routes/web.php';
    protected $apiRoute = 'Modules/Admin/Product/Routes/api.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerRoutes();
        $this->registerApiRoutes();
        $this->registerMigrations();
    }

    protected function registerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->webRoute));
    }

    protected function registerApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->apiRoute));
    }

    /**
     * Register module migrations.
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'websiteUser');
    }

    public function register()
    {}
}
