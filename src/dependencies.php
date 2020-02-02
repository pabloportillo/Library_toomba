<?php

use Slim\App;
use \RedBeanPHP\R as R;
use Resources\Middleware\isLoggedMiddleware;
use Resources\Middleware\IsLoggedMiddlewareGuest;


    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
    $container['db'] = function ($c) {
    
        $settings = $c->get('settings')['db'];  
        $instance = R::setup($settings['driver'] . ':host=' . $settings['host'] . ';dbname=' . $settings['database'],$settings['username'],$settings['password']);
        R::freeze(true);
        R::ext('xdispense', function( $type ){
            return R::getRedBean()->dispense( $type );
        });

        return $instance->getRedBean();
    };
    $container['isloggedMiddleware'] = function ($c) {
        return new isLoggedMiddleware($c);
    };
    $container['isloggedMiddlewareGuest'] = function ($c) {
        return new isLoggedMiddlewareGuest($c);
    };


