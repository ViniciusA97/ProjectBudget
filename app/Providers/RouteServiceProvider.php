<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceApi = 'Api\Controllers';
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapExtractRoutes();
        $this->mapInvestimentoRoutes();
        $this->mapSubtagRoutes();
        $this->mapTagRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapExtractRoutes()
    {
        Route::prefix('extract')
            ->middleware('api')
            ->namespace($this->namespaceApi)
            ->group(base_path('api/routes/extractRoutes.php'));
    }

    protected function mapInvestimentoRoutes()
    {
        Route::prefix('investimento')
            ->namespace($this->namespaceApi)
            ->group(base_path('api/routes/investimentoRoutes.php'));
    }

    protected function mapSubtagRoutes()
    {
        Route::prefix('subtag')
            ->namespace($this->namespaceApi)
            ->group(base_path('api/routes/subtagRoutes.php'));
    }

    protected function mapTagRoutes()
    {
        Route::prefix('tag')
            ->namespace($this->namespaceApi)
            ->group(base_path('api/routes/tagRoutes.php'));
    }

}
