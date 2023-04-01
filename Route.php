<?php

namespace Ahmmmmad11;


use Ahmmmmad11\Routing\Router;
use Ahmmmmad11\Routing\RouteUri;
use Illuminate\Routing\Route as BaseRoute;

class Route extends BaseRoute
{
    /**
     * Parse the route URI and normalize / store any implicit binding fields.
     *
     * @param  string  $uri
     * @return string
     */
    protected function parseUri($uri)
    {
        $this->bindingFields = [];

        return tap(RouteUri::parse($uri), function ($uri) {
            $this->bindingFields = $uri->bindingFields;
        })->uri;
    }

    /**
     * Get all middleware, including the ones from the controller.
     *
     * @return array
     */
    public function gatherMiddleware()
    {
        if (! is_null($this->computedMiddleware)) {
            return $this->computedMiddleware;
        }

        $this->computedMiddleware = [];

        return $this->computedMiddleware = Router::uniqueMiddleware(array_merge(
            $this->middleware(), $this->controllerMiddleware()
        ));
    }

    /**
     * Get or set the domain for the route.
     *
     * @param  string|null  $domain
     * @return $this|string|null
     */
    public function domain($domain = null)
    {
        if (is_null($domain)) {
            return $this->getDomain();
        }

        $parsed = RouteUri::parse($domain);

        $this->action['domain'] = $parsed->uri;

        $this->bindingFields = array_merge(
            $this->bindingFields, $parsed->bindingFields
        );

        return $this;
    }
}
