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
        echo json_encode($goods);
        return true;
    }

    public function post()
    {
        switch ($_REQUEST['_method']) {
            case 'edit':
                $this->edit($_REQUEST['goods-id']);
                break;
            case 'create':
                $this->create();
                break;
        }
    }

    public function edit($id)
    {
        $goods = Goods::find($id);
        $goods->price       = $_REQUEST['goods-price'];
        $goods->discount    = $_REQUEST['goods-discount'];
        $goods->photo       = $_REQUEST['goods-photo'];
        $goods->description = $_REQUEST['goods-description'];
        $goods->save();
        $this->index();
        return true;
    }

    public function create()
    {
        $goods = new Goods();
        $goods->name        = $_REQUEST['add-goods-name'];
        $goods->category_id = $_REQUEST['add-goods-category'];
        $goods->price       = $_REQUEST['add-goods-price'];
        $goods->discount    = $_REQUEST['add-goods-discount'];
        $goods->photo       = $_REQUEST['add-goods-photo'];
        $goods->description = $_REQUEST['add-goods-description'];
        $goods->save();
        $this->index();
    }

    public function delete($id)
    {
        $good = Goods::destroy($id);
        $this->index();
        return true;
    }
}