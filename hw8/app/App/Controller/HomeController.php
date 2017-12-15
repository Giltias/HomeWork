<?php
namespace HW8\App\App\Controller;

use HW8\App\App\Model\Categories;
use HW8\App\App\Model\Goods;
use HW8\App\Engine\MainController;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class HomeController
 * @package HW8\App\App\Controller
 */
class HomeController extends MainController
{
    public function site()
    {
        $this->view->render('site.html.twig');
    }

    public function admin()
    {
        header('Location: /admin/goods');
    }

    /**
     *
     */
    public function index()
    {
        $this->view->render('index.html.twig');
    }

    public function categories()
    {
        $this->view->render('categories.html.twig');
    }
}