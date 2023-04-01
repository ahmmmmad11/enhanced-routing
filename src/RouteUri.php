<?php

namespace Ahmmmmad11\Routing;

class RouteUri extends \Illuminate\Routing\RouteUri
{
    /**
     * Parse the given URI.
     *
     * @param  string  $uri
     * @return static
     */
    public static function parse($uri)
    {
        preg_match_all('/\{([\w\:,]+?)\??\}/', $uri, $matches);

        $bindingFields = [];

        foreach ($matches[0] as $match) {
            if (! str_contains($match, ':')) {
                continue;
            }

            $segments = explode(':', trim($match, '{}?'));

            $bindingFields[$segments[0]] = count(explode(',', $segments[1])) > 1
                ? explode(',', $segments[1])
                : $segments[1];

            $uri = str_contains($match, '?')
                ? str_replace($match, '{'.$segments[0].'?}', $uri)
                : str_replace($match, '{'.$segments[0].'}', $uri);
        }

        return new static($uri, $bindingFields);
    }
}
