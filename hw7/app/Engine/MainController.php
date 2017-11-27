<?php

namespace HW7\App\Engine;

use HW7\App\Classes\View;

class MainController
{
    protected $view;

    /**
     * MainController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }
}