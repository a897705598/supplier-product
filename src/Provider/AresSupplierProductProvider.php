<?php

namespace Ares\Provider;

use Illuminate\Support\ServiceProvider;

class AresSupplierProductProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Migration');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->publishes([
            __DIR__.'/../Controller' => app_path('Http/Controllers/Ares')
        ]);
        $this->publishes([
            __DIR__.'/../Model' => app_path('Model/Ares')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
