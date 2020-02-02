<?php

namespace Resources\Controllers;

use Interop\Container\ContainerInterface;
use Resources\Models\Category;
use Slim\Http\Request;
use Slim\http\Response;
use \RedBeanPHP\R as R;

class CategoryController
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
     * Insertar Category
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function insertar(Request $request, Response $response, array $args)
    {  
       $result = Category::insertar($request);
       return $response->withJson($result);
    }

    /**
     * Modifica un Category
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function modificar(Request $request, Response $response, array $args)
    {  
       $result = Category::modificar($request);
       return $response->withJson($result);
    }  

    /**
     * Busqueda de Category por ID
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function Category(Request $request, Response $response, array $args)
    {  
       $result = Category::Category($args['codigo']);
       return $response->withJson($result);
    }

    /**
     * Borra un Category
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function borrar(Request $request, Response $response, array $args)
    {  
       $result = Category::borrar($args['codigo']);
       return $response->withJson($result);
    }
    
    /**
     * Error
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function error(Request $request, Response $response, array $args)
    {  
       $result = [
        'status' => 400,
        'body' => [
                'estado' => '400',
                'error' => 'Solicitud incorrecta.',
                'descripción' => 'Faltan parámetros requeridos o existe otro problema con la solicitud.'
            ]
        ];
       return $response->withJson($result);
    }      

}