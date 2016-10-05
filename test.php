<?php
require __DIR__.'/vendor/autoload.php';

$res = [];
$router = new Oceanis\Route\Router\StdRouter();
$router->addRoute('GET', '/api/{version}/{controller}' , 'Api.index');
$router->addRoute('GET', '/api/{version}/{controller}/{entity}' , 'Api.view');
$router->addRoute('POST', '/api/{version}/{controller}' , 'Api.create');
$router->addRoute('PUT', '/api/{version}/{controller}/{entity}' , 'Api.replace');
$router->addRoute('PATCH', '/api/{version}/{controller}/{entity}/{field}' , 'Api.update');
$router->addRoute('DELETE', '/api/{version}/{controller}/{entity}' , 'Api.delete');

$res[] = $router->dispatch('GET', '/api/1/test');
$res[] = $router->dispatch('GET', '/api/1/test/1000');
$res[] = $router->dispatch('POST', '/api/1/test');
$res[] = $router->dispatch('PUT', '/api/1/test/1000');
$res[] = $router->dispatch('PATCH', '/api/1/test/1000/test');
$res[] = $router->dispatch('DELETE', '/api/1/test/1000');
$res[] = $router->dispatch('POST', '/api/1/test/1000');
$res[] = $router->dispatch('GET', '/a/b/c/d/f/g/h/i/j/k/l/m/n/o/p/q/r/s/t/u');
var_dump($res);
exit;
