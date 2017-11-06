<?php

namespace HW4\App\Models;

require_once "DB.php";
require_once "User.php";

use HW4\App\Models\DB;
use HW4\App\Models\User;

class Mapper
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function loadById($id)
    {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $args = [['id', $id]];
        $result = $this->db->run($sql, $args)->fetchAll(\PDO::FETCH_ASSOC);
        return new User($result[0]);
    }

    public function loadByLogin($login)
    {
        $sql = 'SELECT * FROM hw4.user WHERE login = :login';
        $args = [['login', $login]];
        $result = $this->db->run($sql, $args)->fetchAll(\PDO::FETCH_ASSOC);
        if (empty($result)) {
            echo 'Не найден пользователь с таким логином';
            return false;
        }
        return new User($result[0]);
    }

    public function loadAllUsers()
    {
        $sql = 'SELECT * FROM hw4.user';
        $result = $this->db->run($sql)->fetchAll(\PDO::FETCH_ASSOC);
        $arrUsers = [];
        foreach ($result as $item) {
            $user = new User($item);
            $arrUsers[] = $user->getArrayProperties();
        }
        return $arrUsers;
    }

    public function newUser(User $user)
    {
        $sql = 'INSERT INTO hw4.user (login, password)  
                VALUES (:login, :password)';

        $args = [
            ['login', $user->getLogin()],
            ['password', $user->getPassword()]
        ];

        if (!empty($this->db->run($sql, $args, 'Не удалось зарегистрировать нового пользователя')))
        {
            session_start();
            $lastId = $this->db->lastInsId();
            $_SESSION['user'] = $lastId;
            return $lastId;
        }

        return false;
    }

    public function editUser(User $user)
    {
        $sql = 'UPDATE hw4.user u
                SET u.name = :name,
                    u.birthday = :birthday,
                    u.description = :description,
                    u.photo = :photo
                WHERE u.id = :id';

        $args = [
            ['name', $user->getName()],
            ['birthday', $user->getBirthday()],
            ['description', $user->getDescription()],
            ['photo', $user->getPhoto()],
            ['id', $user->getId()]
        ];

        $this->db->run($sql, $args);
    }

    public function deleteUser(User $user)
    {
        $this->deletePhoto($user);
        $sql = 'DELETE FROM hw4.user WHERE login = :login';
        $args = [['login', $user->getLogin()]];
        $this->db->run($sql, $args);
    }

    public function getAllPhoto()
    {
        $sql = 'SELECT u.id, u.photo FROM hw4.user u WHERE u.photo IS NOT NULL';
        $result = $this->db->run($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function deletePhoto(User $user)
    {
        $sql = 'UPDATE hw4.user u SET u.photo = null WHERE u.id = :id';
        $args = [
            ['id', $user->getId()]
        ];
        $user->deletePhotoFromDisk();
        $this->db->run($sql, $args);
        return true;
    }
}