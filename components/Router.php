<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath =  '../config/routes.php';
        $this->routes = include($routesPath);

    }
    /**
     * Return get request  string
     * @return string
     */
    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');

        }
    }
    public function run()
    {
        $uri = $this->getUri();
        //take $_GET parametr

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $segments = explode('/', $path);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst((array_shift($segments)));
                //check is this parameter in routes.php
                //if match to determine which controller and action process the request
                //connect file class and controller
                $controllerFile = '../controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null) {
                    break;
                }


            }
            //Create an object to invoke a method
        }


    }
}
//$router = new Router();
//$router->run();















