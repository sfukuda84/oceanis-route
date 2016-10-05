<?php
namespace Oceanis\Route;

trait Routable
{
    protected $routes = [];

    public function getRoutes()
    {
        return $this->routes;
    }

    public function addRoute($method, $pattern, $handler)
    {
        $pattern = str_replace('{', '(?P<', str_replace('}', '>\w+)', $pattern));
        $this->addRawRoute($method, $pattern, $handler);
    }

    public function addRawRoute($method, $pattern, $handler)
    {
        $this->routes[substr_count($pattern, '/')][$method]['~^'.$pattern.'$~'] = $handler;
    }

    public function setRoutes($routes) {
        $this->routes = $routes;
    }

    public function dispatch($method, $uri)
    {
        $num = substr_count($uri, '/');
        if (!isset($this->routes[$num])) {
            return [404];
        }
        if (isset($this->routes[$num][$method])) {
            foreach ($this->routes[$num][$method] as $pattern => $handler) {
                if (preg_match($pattern, $uri, $matches)) {
                    is_array($handler) || $handler = [$handler];
                    foreach ($matches as $key => $val) {
                        if (!is_int($key)) {
                            $handler[$key] = $val;
                        }
                    }
                    return [200, $handler]; 
                }
            }
        }
        unset($this->routes[$num][$method]);
        foreach ($this->routes[$num] as $routeMethod => $route) {
            foreach ($route as $pattern => $handler) {
                if (preg_match($pattern, $uri, $matches)) {
                    is_array($handler) || $handler = [$handler];
                    foreach ($matches as $key => $val) {
                        if (!is_int($key)) {
                            $handler[$key] = $val;
                        }
                    }
                    return [403, $handler];
                }
            }
        }
        return [404];
    }
}
