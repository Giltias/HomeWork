<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Goods;
use Illuminate\Http\Request;

/**
 * Class GoodsController
 * @package App\Http\Controllers
 */
class GoodsController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select($id)
    {
        $goods = Goods::find($id);
        $data = ['goods' => $goods];
        return view('single', $data);
    }

    /**
     * @param $id
     */
    public function goods($id)
    {
        $goods = Goods::find($id);
        echo $goods->toJson();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $categories = Categories::all();
        $data = ['categories' => $categories];
        return view('admin.goods.add', $data);
    }

    /**
     * @param $index
     * @return bool
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $goods = new Goods();
        $goods->name        = $request->input('add-goods-name');
        $goods->category_id = $request->input('add-goods-category');
        $goods->price       = $this->commaToDot($request->input('add-goods-price'));
        $goods->discount    = $this->commaToDot($request->input('add-goods-discount'));
        $goods->description = $request->input('add-goods-description');
        if ($photo = $this->checkPhoto('add-goods-photo')) {
            $path = public_path('img/');
            $goods->save();
            $goods->photo = $goods->id . '.gif';
            $image = Image::make($photo['tmp_name'])
                ->resize(200, null, function ($constraint) { $constraint->aspectRatio(); })
                ->save($path . $goods->id . '.gif');
        }

        $goods->save();
        return redirect()->intended('/admin');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $good = Goods::destroy($id);
        return redirect()->intended('/admin');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        $categories = Categories::all();
        $data = ['goods' => $goods, 'categories' => $categories];
        return view('admin.goods.edit', $data);
    }

    /**
     * @param $field
     * @return mixed
     */
    private function commaToDot($field)
    {
        return str_replace(',', '.', $field);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        $goods = Goods::find($request->goods);
        $goods->price       = $this->commaToDot($request->input('goods-price'));
        $goods->discount    = $this->commaToDot($request->input('goods-discount'));
        $goods->description = $request->input('goods-description');

        if ($photo = $this->checkPhoto('goods-photo')) {
            $path = public_path('img/');
            $goods->photo = $goods->id . '.gif';
            $image = Image::make($photo['tmp_name'])
                ->resize(200, null, function ($constraint) { $constraint->aspectRatio(); })
                ->save($path . $goods->id . '.gif');
        }
        $goods->save();
        return redirect()->intended('/admin');
    }
}
