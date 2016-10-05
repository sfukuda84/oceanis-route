<?php
namespace Oceanis\Route;

interface Router
{

    public function getRoutes();

    public function addRoute($method, $pattern, $handler);

    public function addRawRoute($method, $pattern, $handler);

    public function setRoutes($routes);

    public function dispatch($method, $uri);
}
