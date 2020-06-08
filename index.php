<?php


use brain\Router;

require_once 'vendor/autoload.php';


spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    require_once $path . '.php';
});

//return phpinfo();
$router = new Router();
$router->start();
