<?php
/**
 * Список всех возможных роутов
 */
$this->router->get('/', 'HomeController:index');
$this->router->get('/goods', 'GoodsController:index');
$this->router->get('/goods/{id:int}', 'GoodsController:select');





