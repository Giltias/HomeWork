<?php

use HW7\App\Engine\MainEloquent;
use HW7\App\Engine\Router\RouterDispatcher;

require 'vendor/autoload.php';
require_once 'app/config/parameters.php';

$capsule = new MainEloquent();

$routerDispatcher = new RouterDispatcher();

$routerDispatcher->getRouter()->get('/', 'BurgersController:index');
$routerDispatcher->getRouter()->get('/admin', 'AdminController:index');
$routerDispatcher->getRouter()->get('/user/{id:int}', 'AdminController:user');
$routerDispatcher->getRouter()->post('/order', 'BurgersController:order');
$routerDispatcher->getRouter()->get('/migrate/users', 'MigrateController:users');
$routerDispatcher->getRouter()->get('/order/edit/{id:int}', 'AdminController:edit');
$routerDispatcher->getRouter()->post('/order/edit/success/{id:int}', 'AdminController:editSuccess');
$routerDispatcher->getRouter()->post('/order/create/success', 'AdminController:createOrderSuccess');
$routerDispatcher->getRouter()->get('/order/create/{user:int}', 'AdminController:createOrder');
$routerDispatcher->getRouter()->get('/migrate/goods', 'MigrateController:goods');

$routerDispatcher->dispatch();

