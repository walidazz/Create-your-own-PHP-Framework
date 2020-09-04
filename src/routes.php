<?php

use Symfony\Component\Routing\Route;
use App\Controller\GreetingController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;

// https://youtu.be/uRE9RYpbcms?t=1602

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', ['name' => 'World !', '_controller' => 'App\Controller\GreetingController::hello']));
$routes->add('bye', new Route('/bye', ['_controller' => 'App\Controller\GreetingController::bye']));
$routes->add('about', new Route('/about', ['_controller' => 'App\Controller\PageController::about']));

return $routes;
