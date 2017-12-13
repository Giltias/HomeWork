<?php
namespace HW8\App\App\Controller;

use HW8\App\App\Model\Goods;
use HW8\App\Engine\MainController;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class HomeController
 * @package HW8\App\App\Controller
 */
class HomeController extends MainController
{
    /**
     *
     */
    public function index()
    {
        $goods = Goods::all();
        $data = ['goods' => $goods];
        $this->view->render('index.html.twig', $data);
    }
}