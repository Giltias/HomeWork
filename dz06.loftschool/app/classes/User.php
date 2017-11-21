<?php

namespace DZ06\App\Classes;

/**
 * Класс пользователей
 *
 * Class User
 * @package DZ06\App\Classes
 */
class User
{
    /**
     * Соединение с базой
     *
     * @var \DZ06\App\Classes\DB
     */
    private $db;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }

    /**
     * Получение списка пользователей
     */
    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->run($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Получение ИД пользователя по email
     *
     * @param $email
     * @return array
     */
    public function getUserByEmail($email)
    {
        $sql = "SELECT id FROM users WHERE email = :email";
        $args = [['email', $email]];
        $result = $this->db->run($sql, $args)->fetch(\PDO::FETCH_ASSOC);
        return $result['id'];
    }

    /**
     * Получение данных о пользователе по ID
     *
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $args = [['id', $id]];
        $result = $this->db->run($sql, $args)->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Определение существования пользователя
     *
     * @param $email
     * @return bool
     */
    public function existsUser($email)
    {
        return (bool)count($this->getUserByEmail($email));
    }

    /**
     * Добавление нового пользователя
     *
     * @param $email
     * @param $phone
     * @return bool
     */
    public function addUser($data = [])
    {
        $sql = 'INSERT INTO users(email, phone, name) VALUES (:email, :phone, :name)';
        $args = [['email', $data['email']],['phone', $data['phone']], ['name', $data['name']]];
        $this->db->run($sql, $args, 'Ошибка при добавлении пользователя: ');
        return true;
    }

    /**
     * Удаление пользователя
     *
     * @param $userId
     * @return bool
     */
    public function deleteUser($userId)
    {
        $sql = 'DELETE from users WHERE id = :userId';
        $args = [['userId', $userId]];
        $this->db->run($sql, $args, 'Ошибка при попытке удалить пользователя: ');
        return true;
    }
}