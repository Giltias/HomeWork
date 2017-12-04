<?php

namespace MVC\MVC;

use MVC\App\Engine\Router\RouterDispatcher;

/**
 * Класс запуска приложения
 *
 * Class App
 * @package MVC\MVC
 */
class App
{
    /**
     * @var RouterDispatcher
     */
    private $routerDispatcher;
    /**
     * @var \MVC\App\Engine\Router\Router
     */
    private $router;

    /**
     * App constructor.
     */
    public function __construct()
    {
        require_once __DIR__ . '/../Config/parameters.php';
        $this->routerDispatcher = new RouterDispatcher();
        $this->router = $this->routerDispatcher->getRouter();
    }

    /**
     *
     */
    public function run()
    {
        session_start();
        require_once __DIR__ . '/../Config/routes.php';
        $this->routerDispatcher->dispatch();
    }
}