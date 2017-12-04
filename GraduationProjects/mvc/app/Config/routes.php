<?php
$this->router->get('/', 'HomeController:index');
$this->router->post('/user/login', 'HomeController:login');
$this->router->get('/user/register/form', 'HomeController:formRegister');
$this->router->post('/user/register/confirm', 'HomeController:registerConfirm');
$this->router->get('/user', 'HomeController:user');
