<?php

namespace HW8\App\App\Controller;


use HW8\App\Engine\MainController;
use HW8\App\VK as VKClass;

class VK extends MainController
{

    public function auth()
    {
        $vk = new VKClass();
        $vk->authUrl();
    }
    
    public function wall()
    {
        $vk = new VKClass();
        $data = $vk->getWall();
        echo json_encode($data);
    }

    public function postWall()
    {
        $vk = new VKClass();
        $data = $vk->postOnWall();
        echo "<pre>";
        print_r($data);
        die();
    }
}