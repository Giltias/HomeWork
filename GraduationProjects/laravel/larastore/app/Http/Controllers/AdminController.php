<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Goods;
use App\Orders;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goods()
    {
        $goods = Goods::all();
        $data = ['goods' => $goods];
        return view('admin.goods.main', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        $cats = Categories::all();
        $data = ['categories' => $cats];
        return view('admin.categories.main', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();
        $data = ['orders' => $orders];
        return view('admin.orders.main', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        $data = ['user' => $user];
        return view('admin.user', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        $user = Auth::user();
        $user->notif_email = $request->notifEmail;
        $user->save();
        return redirect()->intended('/admin');
    }
}
