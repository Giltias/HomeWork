<?php

namespace HW7\App\Controller;

use HW7\App\Classes\OrderMail;
use HW7\App\Engine\MainController;
use HW7\App\Model\Order;
use HW7\App\Model\User;
use HW7\App\Service\ImageService;

class BurgersController extends MainController
{
    public function index()
    {
        echo $this->view->render('index.html.twig');
    }

    public function order()
    {
        $user = User::firstOrCreate(
            ['email' => $_POST['email']],
            [
                'phone' => $_POST['phone'],
                'name'  => $_POST['name'],
                'ip'  => $_SERVER['REMOTE_ADDR']
            ]
        );

        $order = new Order();
        $order->street   = empty($_POST['street']) ? null : $_POST['street'];
        $order->house    = empty($_POST['house']) ? null : $_POST['house'];
        $order->fraction = empty($_POST['fraction']) ? null : $_POST['fraction'];
        $order->room     = empty($_POST['room']) ? null : $_POST['room'];
        $order->floor    = empty($_POST['floor']) ? null : $_POST['floor'];
        $order->comment  = empty($_POST['comment']) ? null : $_POST['comment'];
        $order->payment  = empty($_POST['payment']) ? null : $_POST['payment'];
        $order->call     = empty($_POST['call']) ? null : $_POST['call'];
        $order->user_id  = $user->id;
        $order->save();
        $photo = $_FILES['photo'];
        if (!empty($photo['name'])) {
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detectedType = exif_imagetype($photo['tmp_name']);

            $allowedExt = array('gif', 'png', 'jpg');
            $filename = $photo['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($detectedType, $allowedTypes) && in_array($ext, $allowedExt)) {
                $image = new ImageService($photo['tmp_name']);
                $filename = $image->resize()->save($order->id);
                $order->image = $filename;
            }
        }

        $order->save();
        setcookie('User', $user->id);

        $mail = new OrderMail();
        $data = [];
        $address = $order->address;
        $numOrder = Order::where('user_id', $user->id)->count();

        $numOrderText = ($numOrder === 1) ?
            ' - это Ваш первый заказ!' :
            '! Это уже ' . $numOrder . ' заказ!';

        $data['order']     = $order->id;
        $data['emailData'] = [['email' => $user->email, 'name' => $user->name]];
        $data['address']   = $address;
        $data['numOrder']  = $numOrderText;
        $mail->setParams($data);
        $mail->sendMessage();
    }
}