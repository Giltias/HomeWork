<?php

namespace HW7\App\Engine\Router;

use HW7\App\Classes\DBConfig;

class RouterDispatcher
{
    private $router;

    private $controllerBasePath;

    public function __construct()
    {
        $this->router = new Router();
        $this->controllerBasePath = DBConfig::getItem('controllerBasePath');
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function dispatch()
    {
        $uri = URIParser::getURI();
        $method = URIParser::getMethod();

        list($staticRoutes, $variableRoutes) = $this->router->getRoutes();

        if (null !== $handler = $staticRoutes[$method][$uri]['action']) {
            return $this->parseBeforeDoDispatch($handler);
        }

        if (null !== $result = $this->dispatchVariableRoute($variableRoutes, $method, $uri)) {
            return $this->parseBeforeDoDispatch($result[0], $result[1]);
        }


        if (null !== $result = $this->dispatchMethodNotAllowedRoute($variableRoutes, $uri)) {
            return $this->parseBeforeDoDispatch($result[0], $result[1]);
        }

        return $this->doDispatch('Page404', 'index', [0]);

    }

    private function parseBeforeDoDispatch($handler, $parameters = [])
    {
        list($controllerName, $action) = explode(':', $handler);
        return $this->doDispatch($controllerName, $action, $parameters);
    }

    private function dispatchVariableRoute($variableRoutes, $method, $uri)
    {
        $cntURISegments = $this->countSegments($uri);

        if (!isset($variableRoutes[$method])) {
            return null;
        }

        foreach ($variableRoutes[$method] as $variableRoute) {
            if ($cntURISegments !== $this->countSegments($variableRoute['regex'])) {
                continue;
            }

            if (!preg_match('~' . $variableRoute['regex'] . '~x', $uri, $matches)) {
                continue;
            }

            $parameters = [];
            foreach ($matches as $key => $match) {
                if ($key > 0) {
                    $parameters[] = $match;
                }
            }

            return [$variableRoute['action'], $parameters] ;
        }

        return null;
    }

    private function dispatchMethodNotAllowedRoute($variableRoutes, $uri)
    {
        $cntURISegments = $this->countSegments($uri);

        foreach ($variableRoutes as $method => $variableRoute) {
            foreach ($variableRoute as $route) {
                if ($cntURISegments !== $this->countSegments($route['regex'])) {
                    continue;
                }

                if (!preg_match('~' . $route['regex'] . '~x', $uri, $matches)) {
                    continue;
                }

                return ['Page404:index', [1, $method]];
            }
        }

        return null;
    }
    private function countSegments($path)
    {
        return substr_count($path, '/');
    }

    public function doDispatch($controllerName, $action, $parameters = [])
    {
        return call_user_func_array([$this->createController($controllerName), $action], $data = $parameters);
    }

    private function createController($controllerName)
    {
        $controller = $this->controllerBasePath . $controllerName;
        return new $controller();
    }
}