<?php

namespace DZ06\App\Classes;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class View
 * @package DZ06\App\Classes
 */
class View
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
     * View constructor.
     */
    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/../view');
        $this->twig = new Twig_Environment($this->loader, array(
            __DIR__ . '/../cache',
        ));
    }

    /**
     * @param $filename
     * @param array $data
     * @return string
     */
    public function render($filename, $data = [])
    {
        return $this->twig->render($filename, $data);
    }
}