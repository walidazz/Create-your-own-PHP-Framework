<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$routes = require __DIR__ . '/../src/routes.php';



$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);



try {

    extract($urlMatcher->match($request->getPathInfo()));
    ob_start();

    include __DIR__ . '/../src/pages/' . $_route  . '.php';
    $response = new Response(ob_get_clean());
} catch (ResourceNotFoundException $e) {
    $response = new Response("Le contenu n'existe pas", 404);
} catch (Exception $e) {
    $response = new Response("Une erreur est survenue sur le serveur", 500);
}

$response->send();
