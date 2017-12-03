<?php

namespace MVC\App\Engine;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class MainView
 * @package MVC\App\Engine
 */
class MainView
{
    /**
     * @var Twig_Loader_Filesystem
     */
    private $loader;
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * MainView constructor.
     */
    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/../MVC/View');
        $this->twig = new Twig_Environment($this->loader, [__DIR__ . '/../cache']);
    }

    /**
     * @param $filename
     * @param array $data
     * @return string
     */
    public function render($filename, $data = [])
    {
        echo $this->twig->render($filename, $data);
    }
}