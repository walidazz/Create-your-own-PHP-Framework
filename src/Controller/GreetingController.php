<?php

namespace  App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GreetingController
{
    public function hello(Request $request)
    {
        $name = $request->attributes->get('name');

        //integrer du HTML
        ob_start();
        include __DIR__ . '/../pages/hello.php';

        // Envoyer la réponse
        return new Response(ob_get_clean());
    }

    public function bye()
    {
        //integrer du HTML
        ob_start();
        include __DIR__ . '/../pages/bye.php';

        // Envoyer la réponse
        return new Response(ob_get_clean());
    }
}
