<?php

namespace HW8\App\App\Controller;

use HW8\App\App\Model\Goods;
use HW8\App\Engine\MainController;

class GoodsController extends MainController
{
    public function index()
    {
        $goods = Goods::with('category')->get();
        if (!$goods) {
            echo json_encode('');
            return false;
        }
        echo json_encode($goods);
        return true;
    }

    public function select($id)
    {
        $goods = Goods::with('category')->find($id);
        if (!$goods) {
            echo json_encode('');
            return false;
        }
        echo json_encode([$goods]);
        return true;
    }
}