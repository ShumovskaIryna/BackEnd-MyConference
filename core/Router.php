<?php

namespace core;

class Router
{
    private $routes = [];
    private $uri;

    public function __construct(string $query)
    {
        $this->routes = include_once(ROOT . '/config/routes.php');
        $this->uri = empty($query) ? '/' : trim($query, '/');
    }


    public function uploadPage()
    {

        foreach ($this->routes as $uriReg => $path) {

            if (preg_match("~^$uriReg$~", $this->uri)) {

                $route = preg_replace("~$uriReg~", $path, $this->uri);

                $separator = explode('@', $route);

                $controller = array_shift($separator);

                $signature = explode('/', array_shift($separator));

                $action = array_shift($signature);

                $params = $signature;

                $pathToController = ROOT . '/app/Controllers/' . $controller . '.php';

                if (file_exists($pathToController)) {
    
                    include_once $pathToController;
                } else {
                    echo('Method does not exist');
                    die();
                }

                $controllerName = '\app\\Controllers\\' . $controller;

                $obj = new $controllerName;

                if (method_exists($obj, $action)) {
                    $obj->$action(...$params);

                } else {
                    echo('Method does not exist');
                    die();
                }
                die();


            }

        }


        echo('PATH does not exist');
        die();

    }


}