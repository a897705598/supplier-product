<?php

namespace Jxc\Provider;

use Illuminate\Support\ServiceProvider;

class JxcSupplierProductProvider extends ServiceProvider
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
