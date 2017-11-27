<?php

namespace HW7\App\Controller;


use HW7\App\Engine\MainController;
use HW7\App\Model\Order;
use HW7\App\Model\User;

class AdminController extends MainController
{
    public function index()
    {
        $users = User::all();
        echo $this->view->render('users.admin.html.twig', ['users' => $users]);
    }

    public function user($id)
    {
        if (!empty($userDetail = Order::where('user_id', $id)->with('user')->get())) {
            echo $this->view->render('detail.admin.html.twig', ['orders' => $userDetail]);
        } else {
            $errorPage = new Page404();
            $errorPage->index(2, $id);
        }
    }

    public function edit($id)
    {
        $order = Order::find($id);
        echo $this->view->render('editOrder.html.twig',
            [
                'order' => $id,
                'street' => $order->street,
                'house' => $order->house,
                'fraction' => $order->fraction,
                'room' => $order->room,
                'floor' => $order->floor,
                'comment' => $order->comment,
            ]
        );
    }

    public function editSuccess($id)
    {
        $order = Order::find($id);
        $order->street   = $_POST['street'];
        $order->house    = $_POST['house'];
        $order->fraction = $_POST['fraction'];
        $order->room     = $_POST['room'];
        $order->floor    = $_POST['floor'];
        $order->comment  = $_POST['comment'];
        $order->save();
        header('Location: /user/' . $order->user_id);
    }

    public function createOrder($user)
    {
        $user = User::find($user);
        echo $this->view->render('createOrder.html.twig', ['id' => $user->id ,'email' => $user->email]);
    }

    public function createOrderSuccess()
    {
        $order = new Order();
        $order->street   = $_POST['street'];
        $order->house    = $_POST['house'];
        $order->fraction = $_POST['fraction'];
        $order->room     = $_POST['room'];
        $order->floor    = $_POST['floor'];
        $order->comment  = $_POST['comment'];
        $order->user_id  = $_POST['user'];
        $order->save();

        header('Location: /user/' . $order->user_id);
    }
}