<?php

namespace HW8\App\App\Controller;

use HW8\App\App\Model\Goods;
use HW8\App\Engine\MainController;
use Intervention\Image\ImageManagerStatic as Image;

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

    private function checkPhoto($index)
    {
        $photo = $_FILES[$index];
        if (!empty($photo['name'])) {
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detectedType = exif_imagetype($photo['tmp_name']);

            $allowedExt = array('gif', 'png', 'jpg');
            $filename = $photo['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($detectedType, $allowedTypes) && in_array($ext, $allowedExt)) {
                return $photo;
            }
        }
        return false;
    }

    public function edit($id)
    {
        $goods = Goods::find($id);
        $goods->price       = $_REQUEST['goods-price'];
        $goods->discount    = $_REQUEST['goods-discount'];
        $goods->description = $_REQUEST['goods-description'];

        if ($photo = $this->checkPhoto('goods-photo')) {
            $path = __DIR__ . '/../../../web/uploads/goods/';
            $goods->photo = $goods->id . '.gif';
            $image = Image::make($photo['tmp_name'])->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $goods->id . '.gif');
        }
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
        $goods->description = $_REQUEST['add-goods-description'];
        if ($photo = $this->checkPhoto('add-goods-photo')) {
            $path = __DIR__ . '/../../../web/uploads/goods/';
            $goods->save();
            $goods->photo = $goods->id . '.gif';
            $image = Image::make($photo['tmp_name'])->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $goods->id . '.gif');
        }

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