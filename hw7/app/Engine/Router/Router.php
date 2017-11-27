<?php

namespace HW7\App\Engine\Router;


class Router
{
    private $staticRoutes = [];
    private $variableRoutes = [];

    private $parser;

    public function __construct()
    {
        $this->parser = new RouteParser();
    }

    public function getRoutes()
    {
        return [$this->staticRoutes, $this->variableRoutes];
    }

    public function addRoute($httpMethod, $route, $action)
    {
        $routeArrays = $this->parser->parser($route);

        if (isset($routeArrays['variables'])) {
            $regex = $routeArrays['route'];
            foreach ($routeArrays['variables'] as $variable) {
                $regex .= '/(' . $variable[1] . ')';
            }
            $this->variableRoutes[$httpMethod][] = ['variables' => $routeArrays['variables'], 'action' => $action, 'regex' => $regex];

        } else {
            $this->staticRoutes[$httpMethod][$routeArrays['route']] = ['action' => $action];
        }
        return true;
    }

    public function get($route, $action)
    {
        $this->addRoute('GET', $route, $action);
        return true;
    }

    public function post($route, $action)
    {
        $this->addRoute('POST', $route, $action);
        return true;
    }
}