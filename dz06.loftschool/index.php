<?php

use DZ06\App\Classes\User;
use DZ06\App\Classes\View;

require 'vendor/autoload.php';
require_once 'app/config/parameters.php';


$view = new View();


echo $view->render('index.html.twig');