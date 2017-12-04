<?php
namespace MVC\MVC\Controller;

use MVC\App\Engine\MainController;
use MVC\MVC\Model\User;

class HomeController extends MainController
{
    public function index()
    {
        if (!empty($_SESSION['user'])) {
            $users = User::all();
            $this->view->render('user.html.twig', ['users' => $users]);
        } else {
            $this->view->render('auth.html.twig', ['error' => $_SESSION['error']]);
            if ($_SESSION['error'] !== null) {
                unset($_SESSION['error']);
            }
        }
    }

    public function login()
    {
        if (empty($_POST['login'])) {
            $_SESSION['error'] = 'Заполните поле логина';
            header('Location: /');
            return false;
        }

        if (empty($_POST['password'])) {
            $_SESSION['error'] = 'Заполните поле пароля';
            header('Location: /');
            return false;
        }

        $user = User::where('login', $_POST['login'])->first();

        if (!$user) {
            $_SESSION['error'] = 'Пользователь с таким логином не найден';
            header('Location: /');
            return false;
        }

        if (password_verify($_POST['password'], $user->password)) {
            if ($user->role === 1) {
                echo 'admin';
            } else {
                $_SESSION['user'] = $user->id;
                header('Location: /');
            }
        } else {
            $_SESSION['error'] = 'Неверная пара Логин/Пароль';
            header('Location: /');
            return false;
        }
    }

    public function formRegister()
    {
        $this->view->render('register.html.twig', ['error' => $_SESSION['error']]);
        if ($_SESSION['error'] !== null) {
            unset($_SESSION['error']);
        }
    }

    public function registerConfirm()
    {
        if (empty($_POST['login'])) {
            $_SESSION['error'] = 'Заполните поле логина';
            header('Location: /user/register/form');
            return false;
        }

        if (empty($_POST['password'])) {
            $_SESSION['error'] = 'Заполните поле пароля';
            header('Location: /user/register/form');
            return false;
        }

        if (empty($_POST['passwordConfirm'])) {
            $_SESSION['error'] = 'Заполните поле проверки пароля';
            header('Location: /user/register/form');
            return false;
        }

        $user = User::where('login', $_POST['login'])->first();

        if ($user) {
            $_SESSION['error'] = 'Пользователь с таким логином уже существует';
            header('Location: /user/register/form');
            return false;
        }

        if ($_POST['passwordConfirm'] !== $_POST['password'] ) {
            $_SESSION['error'] = 'Введенные пароли не совпадают';
            header('Location: /user/register/form');
            return false;
        }

        $newUser = new User();
        $newUser->login = $_POST['login'];
        $newUser->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $newUser->save();

        header('Location: /');
        return true;
    }

    public function user()
    {

    }
}