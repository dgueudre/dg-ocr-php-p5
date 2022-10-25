<?php

namespace Prout;

class Router
{
    public static function find($uri, $routes)
    {
        foreach ($routes as $route) {
            $route->analyse($uri);
            if ($route->hit()) {
                return $route;
            }
        }
    }
}
