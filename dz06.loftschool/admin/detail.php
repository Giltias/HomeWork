<?php
require_once '../vendor/autoload.php';
require_once '../app/config/parameters.php';

use DZ06\App\Classes\Order;
use DZ06\App\Classes\User;
use DZ06\App\Classes\View;

$users = new User();
$user = $users->getUserById($_GET['user']);

$ord = new Order();
$orders = $ord->getOrdersByUser($_GET['user']);

$view = new View();
echo $view->render('detail.admin.html.twig', ['orders' => $orders]);
