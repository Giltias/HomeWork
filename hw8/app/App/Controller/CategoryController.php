<?php

namespace HW8\App\App\Controller;


use HW8\App\App\Model\Categories;
use HW8\App\App\Model\Goods;
use HW8\App\Engine\MainController;

/**
 * Class CategoryController
 * @package HW8\App\App\Controller
 */
class CategoryController extends MainController
{
    /**
     * @return bool
     */
    public function index()
    {
        $categories = Categories::all();

        echo $categories->toJson();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function select($id)
    {
        $category = Categories::find($id);
        echo $category->toJson();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function goods($id)
    {
        $category = Categories::find($id);
        $goods = Goods::whereIn('category_id', $category->lists)->get();
        echo $goods->toJson();
        return true;
    }

    /**
     * @return bool
     */
    public function lists()
    {
        $categories = $this->capsule::table('categories')
            ->whereNotIn('id', function ($query) {
                $query->select('subcategory_id')->from('categories');
            })
            ->get();
        echo $categories->toJson();
        return true;
    }

    /**
     *
     */
    public function list()
    {
        $categories = Categories::where('active', 1)->get();
        echo $categories->toJson();
    }

    /**
     *
     */
    public function post()
    {
        switch ($_REQUEST['_method']) {
            case 'create':
                $this->create();
                break;
            case 'edit':
                $this->edit($_REQUEST['category']);
                break;
        }
    }

    /**
     *
     */
    public function create()
    {
        $cat = new Categories();
        $cat->name = $_REQUEST['add-category-name'];
        $cat->subcategory_id = $_REQUEST['add-parent-category'];
        $cat->discount = $_REQUEST['add-category-discount'];
        $cat->save();
        $this->index();
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $cat = Categories::find($id);
        $cat->subcategory_id = $_REQUEST['parent-category'];
        $cat->discount = $_REQUEST['category-discount'];
        $cat->save();
        $this->index();
    }

    /**
     *
     */
    public function activeChange()
    {
        $id = $_REQUEST['id'];
        $category = Categories::find($id);
        $category->active = !$category->active;
        $category->save();
        $this->index();
    }
}