<?php

namespace Resources\Middleware;
use Interop\Container\ContainerInterface;
use Resources\Models\Usuarios;
use Slim\DeferredCallable;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Comprueba si el usuario esta logado , en caso contrario resultado ko;
 */
class IsLoggedMiddlewareGuest
{
    private $container;
    private $db;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $container->get('db');
    }
    
    public function __invoke($request, $response, $next)
    {
        // ... compruebo la autorización
        $authorization = $request->getHeaderLine('Authorization');

        if (empty($authorization)) {
            // ... Error 400: problema con la solicitud
            return $response->withJson([
                'code' => 400,
                'error' => 'Bad request.'
            ], 400);
        } else if($authorization == $this->container->get('settings')['autorizationGuest']) { // Si la autorización es correcta ...
            // ... continuamos con el flujo
            return $next($request, $response);
        } else { // ... sino ...
            // ... Error 401: problema con la autorización
                return $response->withJson([
                    'code' => 401,
                    'error' => 'No authorized.'
                ], 401);
        }
    }
}