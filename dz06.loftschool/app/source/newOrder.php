<?php
require '../../vendor/autoload.php';
require_once '../config/parameters.php';

use DZ06\App\Classes\User;
use DZ06\App\Classes\Order;


/*
 * Работало с капчей через PHP, но чтобы лишний раз не уходить со страницы заказа
 * сделал через javascript проверку капчи. Теперь тут проверка не работает =)
 */
//$recaptcha = new \ReCaptcha\ReCaptcha('6Lf_oDkUAAAAABVj03B-wKTROewA6SerCTvVKG0D');
//$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
//if ($resp->isSuccess()) {
//    if($resp->getHostName() === $_SERVER['SERVER_NAME']) {
        $user = new User();
        $order = new Order();

        if (!$user->existsUser($_POST['email'])) {
            $user->addUser($_POST);
        }

        $userId = $user->getUserByEmail($_POST['email']);
        setcookie('User', $userId);

        $order->addOrder($userId, $_POST);
/*    }
} else {
    $errors = $resp->getErrorCodes();
}*/



