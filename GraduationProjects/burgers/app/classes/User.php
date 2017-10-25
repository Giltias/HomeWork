<?php

namespace Burgers\App\Classes;

require_once "DB.php";

use Burgers\App\Classes\DB;

/**
 * Class User
 * @package Burgers\App\Classes
 */
class User
{
    /**
     * @var \Burgers\App\Classes\DB
     */
    private $db;

    /**
     * @var string
     */
    private $sql;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }

    /**
     *
     */
    public function getUsers()
    {
        $this->sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $email
     * @return array
     */
    public function getUserByEmail($email)
    {
        $this->sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($this->sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $email
     * @return bool
     */
    public function existsUser($email)
    {
        return (bool)count($this->getUserByEmail($email));
    }

    /**
     * @param $email
     * @param $phone
     * @return bool
     */
    public function addUser($email, $phone)
    {
        $this->sql = 'INSERT INTO users(email, phone) VALUES (:email, :phone)';
        $stmt = $this->db->prepare($this->sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);

        try {
            $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Ошибка при добавлении пользователя: ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @param $userId
     * @return bool
     */
    public function deleteUser($userId)
    {
        $this->sql = 'DELETE from users WHERE id = :userId';
        $stmt = $this->db->prepare($this->sql);

        $stmt->bindParam(':userId', $userId);

        try {
            $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Ошибка при попытке удалить пользователя: ' . $e->getMessage();
            return false;
        }
        return true;
    }
}