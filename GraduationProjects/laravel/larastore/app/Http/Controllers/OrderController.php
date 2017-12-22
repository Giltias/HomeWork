<?php

namespace App\Http\Controllers;

use App\Mail\OrderNotification;
use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     *
     */
    public function create()
    {
        $order = new Orders();
        $_POST = json_decode(file_get_contents('php://input'), true);
        $order->goods_id = $_POST['order-goods-id'];
        $order->email    = $_POST['order-email'];
        $order->person   = $_POST['order-person'];
        $order->save();
        $tos = User::where('is_admin', 1)->whereNotNull('notif_email')->get();
        if ($tos) {
            foreach ($tos as $to) {
                Mail::to($to->notif_email)->queue(new OrderNotification($order));
            }
        }
        echo json_encode([
            'person' => $_POST['order-person'],
            'email'  => $_POST['order-email']
        ]);
    }
}
