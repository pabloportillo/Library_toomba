<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => 'bloomstore.clientesbiz.com',
            'database' => 'clien_bloomstore',
            'username' => 'clien_bloomstore',
            'password' => 'fy9mL8QD',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''

            // 'driver' => 'mysql',
            // 'host' => '192.168.0.247',
            // 'database' => 'apibloomstore_copy',
            // 'username' => 'root',
            // 'password' => 'm1sql',
            // 'charset'   => 'utf8',
            // 'collation' => 'utf8_unicode_ci',
            // 'prefix'    => ''            
        ],
        'Header' => 
        [
         'Content-Type' => 'application/json',
         'Access-Control-Allow-Origin' =>'http://localhost:8000', 
         'Access-Control-Allow-Origin' =>'*', 
         'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, Accept, Origin, Authorization',
         'Access-Control-Allow-Credentials' => 'true',
         'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS'
        ],
        'autorizationGuest' => 'Bearer 1234567890'
    ],
];


