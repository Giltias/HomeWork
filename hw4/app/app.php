<?php
require_once "./models/Mapper.php";

use HW4\App\Models\Mapper;
use HW4\App\Models\User;

$action = $_POST['action'];
$mapper = new Mapper();

switch ($action) {
    case 'getUserList':
        $user = $mapper->loadAllUsers();
        echo json_encode($user);
        break;
    case 'deleteUser':
        $login = $_POST['user'];
        $user = $mapper->loadByLogin($login);
        $mapper->deleteUser($user);
        break;
    case 'loginUser':
        $login = $_POST['login'];
        $password = $_POST['password'];
        $user = $mapper->loadByLogin($login);
        echo $user->login($password);
        break;
    case 'registrationUser':
        $login = $_POST['login'];
        $password = $_POST['password'];
        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        $mapper->newUser($user);
        break;
    case 'logout':
        User::logout();
        break;
    case 'editUser':
        $user = $mapper->loadById($_POST['user']);
        $user->setName(empty($_POST['name']) ? null : $_POST['name']);
        $user->setBirthday(empty($_POST['date']) ? null : $_POST['date']);
        $user->setDescription(empty($_POST['description']) ? null : $_POST['description']);
        if (!empty($_FILES['photo']['name'])) {
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detectedType = exif_imagetype($_FILES['photo']['tmp_name']);

            $allowedExt = array('gif', 'png', 'jpg');
            $filename = $_FILES['photo']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($detectedType, $allowedTypes) && in_array($ext, $allowedExt)) {
                list($width, $height) = getimagesize($_FILES['photo']['tmp_name']);
                // загрузка
                $thumb = imagecreatetruecolor(100, 100);
                $source = imagecreatefromjpeg($_FILES['photo']['tmp_name']);

                // изменение размера
                imagecopyresized($thumb, $source, 0, 0, 0, 0, 100, 100, $width, $height);
                $newFileName = (string)$user->getId() . '.' . $ext;
                $user->setPhoto($newFileName);
                imagejpeg($thumb, __DIR__ . '/../web/uploads/' . $newFileName);
            }
        }

        $mapper->editUser($user);
        header('Location: ../web/list.html');
        break;
    case 'getUserData':
        $user = $mapper->loadById($_POST['user']);
        echo json_encode($user->getArrayProperties());
        break;
    case 'getPhotoList':
        echo json_encode($mapper->getAllPhoto());
        break;
    case 'deletePhoto':
        $id = $_POST['user'];
        $user = $mapper->loadById($id);
        $mapper->deletePhoto($user);
        break;
}







