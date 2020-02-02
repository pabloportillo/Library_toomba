<?php

namespace Resources\Middleware;
use Interop\Container\ContainerInterface;
use Resources\Models\Access;

use \RedBeanPHP\R as R;
class isLoggedMiddleware
{
  
    private $container;
    private $db;
    
    /**
     * Comprueba las credenciales del usuario si son correctas crea sesion y devuelve el usuario 
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $container->get('db');
    }
    
    public function __invoke($request, $response, $next)
    {

        $authorization = substr($request->getHeaderLine('Authorization'), 7); // quitamos "Bearer " de la cabecera: 'Authorization: Bearer 76858675876...'
        $token = Access::getToken($authorization);

        if($token){
            return $next($request, $response);
        } else {
            return $response->withJson([
                'estado' => 401,
                'error' => "No authorized."
            ], 401);
        }
    }
}
