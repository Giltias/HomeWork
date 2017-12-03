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
            $this->view->render('index.html.twig', ['users' => $users]);
        } else {
            $this->view->render('auth.html.twig');
        }
    }
}