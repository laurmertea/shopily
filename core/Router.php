<?php

namespace App\Core;

use Exception;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {

        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {

        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType]))
            return $this->call(
                ...explode("@", $this->routes[$requestType][$uri])
            );
        
        if (App::get('env')['mode'] !== "dev") {
            view('404');
            return false;
        }
        
        throw new Exception("No route found for {$uri}");
    }

    protected function call($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (! method_exists($controller, $action)) 
            throw new Exception("Controller {$controller} does not respond to the {$action} action!");

        return $controller->$action();
    }


}
