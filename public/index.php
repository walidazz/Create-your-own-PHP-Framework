<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$routes = require __DIR__ . '/../src/routes.php';



$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);



// function hello()
// {
//     echo 'Hello le callable';
// }


// function classique(string $prenom)
// {
//     var_dump("classique : $prenom ");
// }

// $anonyme = function (string $prenom) {
//     var_dump("Closure : $prenom");
// };

// class Maclass
// {


//     public function methode(string $prenom)
//     {
//         var_dump("Méthode de l'objet : $prenom");
//     }
// }

// $callable = [new Maclass(), 'methode'];

// //$callable('Walid');


// call_user_func('hello');

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();


try {

    $request->attributes->add($urlMatcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $aguments = $argumentResolver->getArguments($request, $controller);

    // var_dump($request->attributes);
    $response = call_user_func_array($controller, $aguments);
} catch (ResourceNotFoundException $e) {
    $response = new Response("Le contenu n'existe pas", 404);
} catch (Exception $e) {
    $response = new Response("Une erreur est survenue sur le serveur", 500);
}


$response->send();
