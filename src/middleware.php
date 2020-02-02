<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Resources\Middleware;


$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) == '/') {

        // permanently redirect paths with a trailing slash
        // to their non-trailing counterpart
        $uri = $uri->withPath(substr($path, 0, -1));
        if($request->getMethod() == 'GET') {
            return $response->withRedirect((string)$uri, 301);
        }
        else {
            return $next($request->withUri($uri), $response);
        }
    }
    return $next($request, $response);
});


/**
 *   Introduce los header de cors suficientes para el control de acceso y autorizacion
 */
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    foreach ($this->get('settings')['Header'] as $key =>  $header)
    {
        $response = $response->withHeader($key, $header);
    } 
    return 
       $response;
});
