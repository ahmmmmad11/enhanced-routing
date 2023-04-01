<?php

namespace Ahmmmmad11\Routing;

use Ahmmmmad11\Routing\Router;

class RoutingServiceProvider extends \Illuminate\Routing\RoutingServiceProvider
{

    /**
     * Register the router instance.
     *
     * @return void
     */
    protected function registerRouter()
    {
        $this->app->singleton('router', function ($app) {
            return new Router($app['events'], $app);
        });

        $this->app->alias('router', Router::class);
    }
}
