<?php
    require_once "../app/classes/User.php";

    use Burgers\App\Classes\User;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Админка</title>
</head>
<body>

<h1>Список всех пользователей</h1>
<table>
    <thead>
    <tr>
        <th>Email</th>
        <th>Имя пользователя</th>
        <th>Телефон</th>
    </tr>
    </thead>
    <tbody>
<?php

    $user = new User();
    $users = $user->getUsers();

    foreach ($users as $u) {
        echo "<tr>
                <td><a href='detail.php?user={$u['id']}'>{$u['email']}</a></td>
                <td>{$u['name']}</td>
                <td>{$u['phone']}</td>
              </tr>";
    }

?>
    </tbody>
</table>

</body>
</html>
