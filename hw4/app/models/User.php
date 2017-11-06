<?php

namespace HW4\App\Models;


/**
 * Class User
 * @package App\Models
 */
class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $name;
    /**
     * @var mixed
     */
    private $birthday;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $photo;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id           = $data['id'];
            $this->login        = $data['login'];
            $this->password     = $data['password'];
            $this->name         = $data['name'];
            $this->birthday     = $data['birthday'];
            $this->description  = $data['description'];
            $this->photo        = $data['photo'];
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $this->generateHash($password);
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    private function generateHash($string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    public function login($password)
    {
        if (password_verify($password, $this->getPassword())) {
            session_start();
            $_SESSION['user'] = $this->getId();
            return $this->getId();
        } else {
            return false;
        }
    }

    public static function logout()
    {
        session_start();
        unset($_SESSION['user']);
    }

    public function calcAge()
    {
        $dt1 = new \DateTime($this->getBirthday());
        $dt2 = new \DateTime();
        $diff = $dt2->diff($dt1);
        return $diff->y;
    }

    public function getArrayProperties()
    {
        $arr = [
            'id' => $this->getId(),
            'login' => $this->getLogin(),
            'name' => $this->getName(),
            'birthday' => $this->getBirthday(),
            'description' => $this->getDescription(),
            'photo' => $this->getPhoto(),
            'age' => $this->calcAge()
        ];

        return $arr;
//        return get_object_vars($this); пришлось отказаться, так как нельзя отдавать пользователю информацию о паролях
    }

    public function deletePhotoFromDisk()
    {
        $dir = __DIR__ . '/../../web/uploads/';
        if (!empty($this->getPhoto())) {
            unlink($dir . $this->getPhoto());
        }
    }
}