<?php
require_once "../classes/User.php";
require_once "../classes/Order.php";

use Burgers\App\Classes\User;
use Burgers\App\Classes\Order;

$user = new User();
$order = new Order();

/*================== ФАЗА 1 ====================*/
if (!$user->existsUser($_POST['email'])) {
    $user->addUser($_POST);
}
$userId = $user->getUserByEmail($_POST['email']);
setcookie('User', $userId);
/*================== КОНЕЦ ФАЗЫ 1 ====================*/

/*================== ФАЗА 2 ====================*/
$order->addOrder($userId, $_POST);
/*================== КОНЕЦ ФАЗЫ 2 ====================*/
/*================== ФАЗА 3 ====================*/
/* ФАЗА 3 осуществляется в фазе 2 */
/*================== КОНЕЦ ФАЗЫ 3 ====================*/
