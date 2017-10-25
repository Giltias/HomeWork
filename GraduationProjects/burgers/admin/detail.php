<?php
    require_once "../app/classes/Order.php";
    require_once "../app/classes/User.php";

    use Burgers\App\Classes\Order;
    use Burgers\App\Classes\User;

    $users = new User();
    $user = $users->getUserById($_GET['user']);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Список заказов</title>
</head>
<body>

<h1>Список всех заказов пользователя <strong><?php echo $user['name'] ?></strong></h1>
<table>
    <thead>
    <tr>
        <th>№ заказа</th>
        <th>Улица</th>
        <th>Дом</th>
        <th>Корпус</th>
        <th>Квартира</th>
        <th>Этаж</th>
        <th>Комментарий</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $ord = new Order();
    $orders = $ord->getOrdersByUser($_GET['user']);

    foreach ($orders as $order) {
        echo "<tr>
                <td>{$order['id']}</td>
                <td>{$order['street']}</td>
                <td>{$order['house']}</td>
                <td>{$order['fraction']}</td>
                <td>{$order['room']}</td>
                <td>{$order['floor']}</td>
                <td>{$order['comment']}</td>
              </tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>
