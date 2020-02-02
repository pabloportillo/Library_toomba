<?php

namespace Resources\Controllers;

use Interop\Container\ContainerInterface;
use Resources\Models\Access;
use Slim\Http\Request;
use Slim\http\Response;
use \RedBeanPHP\R as R;

class AccessController
{
    /**
     * Contenedor de la aplicacion 
     *
     * @var Interop\Container\ContainerInterface
     */
    protected $container;
    /**
     * Instancia de base de datos de redBeanphp
     *
     * @var \RedBeanPHP\
     */
    protected $db;

    /**
     * Crea una instancia de Resources\Models\ReservaController
     *
     * @param Interop\Container\ContainerInterface $container
     * 
     * @internal param $auth
     */
    public function __construct(ContainerInterface $container )
    {
        $this->container = $container;
        $this->db = $container->get('db');
    }

    /**
     * Crea el token
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function token(Request $request, Response $response, array $args)
    {  
       $result = Access::token($request);
       return $response->withJson($result);
    }
}