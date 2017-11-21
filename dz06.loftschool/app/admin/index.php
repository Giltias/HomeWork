<?php

use DZ06\App\Classes\User;
use DZ06\App\Classes\View;

require '../../vendor/autoload.php';
require_once '../config/parameters.php';


$view = new View();

$user = new User();
$users = $user->getUsers();

echo $view->render('users.admin.html.twig', ['users' => $users]);