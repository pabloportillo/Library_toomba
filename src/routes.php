<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Resources\Controllers\AccessController;
use Resources\Controllers\BookController;
use Resources\Controllers\CategoryController;

   /**
     *  logout
     */
// $app->delete('/usuarios', UsuarioController::class. ':logout');
  
  $app->get('/', function($request, $response, $args) {
    // no hacemos nada para no dar pistas.
  });
    
  $app->group('/v1', function (App $app) {

    /**
     * ---------------------------------------- AUTENTICACIÓN ----------------------------------------
     */
    // Access Token -> Generar Token de acceso
    $app->post('/access-token',AccessController::class. ':token')->add($app->getContainer()->get('isloggedMiddlewareGuest'));


    /**
     * ---------------------------------------- BOOKS ----------------------------------------
     */
    $app->post('/books',BookController::class. ':insertar')->add($app->getContainer()->get('isloggedMiddleware'));
    $app->put('/books',BookController::class. ':modificar')->add($app->getContainer()->get('isloggedMiddleware'));  
    $app->get('/books/{codigo}',BookController::class. ':book')->add($app->getContainer()->get('isloggedMiddleware'));
    $app->delete('/books/{codigo}',BookController::class. ':borrar')->add($app->getContainer()->get('isloggedMiddleware'));
    $app->get('/books',BookController::class. ':error')->add($app->getContainer()->get('isloggedMiddleware'));  

    /**
     * ---------------------------------------- CATEGORIES ----------------------------------------
     */
    $app->post('/categories',CategoryController::class. ':insertar')->add($app->getContainer()->get('isloggedMiddleware'));
    $app->put('/categories',CategoryController::class. ':modificar')->add($app->getContainer()->get('isloggedMiddleware'));  
    $app->get('/categories/{codigo}',CategoryController::class. ':category')->add($app->getContainer()->get('isloggedMiddleware'));
    $app->delete('/categories/{codigo}',CategoryController::class. ':borrar')->add($app->getContainer()->get('isloggedMiddleware'));
    $app->get('/categories',CategoryController::class. ':error')->add($app->getContainer()->get('isloggedMiddleware')); 

  });