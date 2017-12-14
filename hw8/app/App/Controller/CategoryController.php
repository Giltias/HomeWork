<?php

namespace HW8\App\App\Controller;


use HW8\App\App\Model\Categories;
use HW8\App\Engine\MainController;

class CategoryController extends MainController
{
    public function lists()
    {
        $categories = $this->capsule::table('categories')
            ->whereNotIn('id', function ($query) {
                $query->select('subcategory_id')->from('categories');
            })
            ->get();
        echo json_encode($categories);
        return true;
    }
}