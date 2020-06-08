<?php

namespace brain;

class Router
{
    private $parametrs = [];
    private $routes = [];

    function __construct()
    {
        $arr = require 'config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add_route($key, $value);
        }
    }

    function add_route($route, $values)
    {
        $this->routes[$route] = $values;
    }

    function match_routes($url)
    {
        foreach ($this->routes as $route => $values) {
            if ($route == $url) {
                $this->parametrs = $values;
                return true;
            }
        }
        return false;

    }

    function start()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if ($this->match_routes($url)) {
            $controller_path = 'controllers\\' . $this->parametrs['controller'] . '_controller';
            if (class_exists($controller_path)) {
                $action = $this->parametrs['action'];
                if (method_exists($controller_path, $action)) {

                    $controller = new $controller_path($this->parametrs);

                    $controller->$action();
                } else {
                    echo 'Маршрут не найден';
                }
            }
//             else {
//                //404
//                echo '404' . $controller_path;
//            }


        }
    }
}
