<?php
/**
 * Список всех возможных роутов
 */
$this->router->get('/', 'HomeController:index');
$this->router->get('/goods', 'GoodsController:index');
$this->router->post('/goods', 'GoodsController:post');
$this->router->get('/goods/{id:int}', 'GoodsController:select');
$this->router->delete('/goods/{id:int}', 'GoodsController:delete');
$this->router->get('/category/lists', 'CategoryController:lists');





