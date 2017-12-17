<?php
/**
 * Список всех возможных роутов
 */
$this->router->get('/', 'HomeController:site');
$this->router->get('/admin', 'HomeController:admin');
$this->router->get('/admin/goods', 'HomeController:index');
$this->router->get('/admin/categories', 'HomeController:categories');
$this->router->get('/admin/vk', 'HomeController:vk');
$this->router->post('/upload', 'HomeController:upload');
$this->router->get('/admin/vk/auth', 'VK:auth');
$this->router->get('/admin/vk/wall', 'VK:wall');
$this->router->get('/admin/vk/postWall', 'VK:postWall');

$this->router->get('/goods', 'GoodsController:index');
$this->router->post('/goods', 'GoodsController:post');
$this->router->get('/goods/{id:int}', 'GoodsController:select');
$this->router->delete('/goods/{id:int}', 'GoodsController:delete');

$this->router->get('/category/lists', 'CategoryController:lists');
$this->router->get('/category/list', 'CategoryController:list');
$this->router->get('/category', 'CategoryController:index');
$this->router->get('/category/{id:int}', 'CategoryController:select');
$this->router->get('/category/goods/{id:int}', 'CategoryController:goods');
$this->router->post('/category', 'CategoryController:post');
$this->router->post('/category/active/change', 'CategoryController:activeChange');





