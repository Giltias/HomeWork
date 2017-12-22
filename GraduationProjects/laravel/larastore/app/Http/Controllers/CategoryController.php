<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Goods;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     *
     */
    public function index()
    {
        $categories = Categories::where('active', 1)->get();
        echo json_encode($categories);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function filter($id)
    {
        if ((int)$id === 1) {
            return redirect()->intended('/');
        }
        $category = Categories::find($id);
        $goods = Goods::whereIn('category_id', $category->lists)->get();
        $data = ['goods' => $goods];
        return view('home', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $categories = Categories::all();
        $data = ['categories' => $categories];
        return view('admin.categories.add', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $cat = new Categories();
        $cat->name = $request->input('add-category-name');
        $cat->parent = $request->input('add-category-parent');
        $cat->discount = $request->input('add-category-discount');
        $cat->save();
        return redirect()->intended('/admin/categories');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Categories::find($id);
        $categories = Categories::all();
        $data = ['cat' => $category, 'categories' => $categories];
        return view('admin.categories.edit', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        $cat = Categories::find($request->category);
        $cat->parent = $request->input('category-parent');
        $cat->discount = $request->input('category-discount');
        $cat->save();
        return redirect()->intended('/admin/categories');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active($id)
    {
        $cat = Categories::find($id);
        $cat->active = !$cat->active;
        $cat->save();
        return redirect()->intended('/admin/categories');
    }
}
