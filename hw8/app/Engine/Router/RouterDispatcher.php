<?php

namespace HW8\App\Engine\Router;

use HW8\App\ConfigStore;

/**
 * Class RouterDispatcher
 * @package HW8\App\Engine\Router
 */
class RouterDispatcher
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var mixed
     */
    private $controllerBasePath;

    /**
     * RouterDispatcher constructor.
     */
    public function __construct()
    {
        $this->router = new Router();
        $this->controllerBasePath = ConfigStore::getItem('controllerBasePath');
    }

    /**
     * Get Router
     *
     * @return Router
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Dispatch Controller By URI
     *
     * @return mixed
     */
    public function dispatch()
    {
        $uri = URIParser::getURI();
        $method = URIParser::getMethod();

        list($staticRoutes, $variableRoutes) = $this->router->getRoutes();

        if (!empty($staticRoutes[$method][$uri]['action']) && null !== $handler = $staticRoutes[$method][$uri]['action']) {
            return $this->parseBeforeDoDispatch($handler);
        }

        if (null !== $result = $this->dispatchVariableRoute($variableRoutes, $method, $uri)) {
            return $this->parseBeforeDoDispatch($result[0], $result[1]);
        }


        if (null !== $result = $this->dispatchMethodNotAllowedRoute($variableRoutes, $uri)) {
            return $this->parseBeforeDoDispatch($result[0], $result[1]);
        }

        return null;//$this->doDispatch('Page404', 'index', [0]);

    }

    /**
     * Prepare controller before do dispatch
     *
     * @param $handler
     * @param array $parameters
     * @return mixed
     */
    private function parseBeforeDoDispatch($handler, $parameters = [])
    {
        list($controllerName, $action) = explode(':', $handler);
        return $this->doDispatch($controllerName, $action, $parameters);
    }

    /**
     * Prepare controller with parameters before do dispatch
     *
     * @param $variableRoutes
     * @param $method
     * @param $uri
     * @return array|null
     */
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

    /**
     * Check exists URI with method
     *
     * @param $variableRoutes
     * @param $uri
     * @return array|null
     */
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

    /**
     * Helper. Count segments in route or URI
     *
     * @param $path
     * @return int
     */
    private function countSegments($path)
    {
        return substr_count($path, '/');
    }

    /**
     * Do dispatch action in controller
     *
     * @param $controllerName
     * @param $action
     * @param array $parameters
     * @return mixed
     */
    public function doDispatch($controllerName, $action, $parameters = [])
    {
        return call_user_func_array([$this->createController($controllerName), $action], $data = $parameters);
    }

    /**
     * Create object of finding controller
     *
     * @param $controllerName
     * @return mixed
     */
    private function createController($controllerName)
    {
        $controller = $this->controllerBasePath . $controllerName;
        return new $controller();
    }
}