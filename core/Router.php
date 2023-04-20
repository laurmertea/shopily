<?php

namespace App\Core;

use Exception;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    protected $routeId = null;

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
        $this->resetRouteId();

        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->call(
                ...explode("@", $this->routes[$requestType][$uri])
            );
        }

        foreach (array_keys($this->routes[$requestType]) as $route) {
            $pattern = str_replace(':id', '([\d]+)', $route);
            preg_match('~' . $pattern . '~', $uri, $matches);
            if (isset($matches[1])) {
                $this->setRouteId($matches[1]);
                return $this->call(
                    ...explode("@", $this->routes[$requestType][$route])
                );
            }
        }

        if (App::get('env')['mode'] !== "dev") {
            view('404');
            return false;
        }

        throw new Exception("No route found for {$uri}");
    }

    protected function call($controller, $action, $id = null)
    {
        $controllerName = "App\\Controllers\\{$controller}";
        $controller = new $controllerName;

        if (! method_exists($controller, $action)) 
            throw new Exception("Controller {$controllerName} does not respond to the {$action} action!");

        return ($this->routeId)
            ? $controller->$action($this->routeId)
            : $controller->$action();
    }

    public function getRouteId()
    {
        return $this->routeId;
    }

    protected function setRouteId($routeId)
    {
        $this->routeId = $routeId;
    }

    protected function resetRouteId()
    {
        $this->routeId = null;
    }
}
