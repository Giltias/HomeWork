<?php
namespace HW8\App\App\Controller;

use HW8\App\Engine\MainController;

/**
 * Class HomeController
 * @package HW8\App\App\Controller
 */
class HomeController extends MainController
{
    /**
     *
     */
    public function site()
    {
        $this->view->render('site.html.twig');
    }

    /**
     *
     */
    public function admin()
    {
        header('Location: /admin/goods');
    }

    /**
     *
     */
    public function vk()
    {
        $vk = new \HW8\App\VK();
        $data = ['auth' => $vk->checkToken()];
        $this->view->render('vk.html.twig', $data);
    }

    /**
     *
     */
    public function upload()
    {
       if (isset($_REQUEST["url"])) {

            $upload_url = $_REQUEST["url"];
            $params = [
               'photo' =>   new \CURLFile($_FILES['postPhoto']['tmp_name'], 'image/jpg', 'filename.png')
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $upload_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result;

        }
    }

    /**
     *
     */
    public function index()
    {
        $this->view->render('index.html.twig');
    }

    /**
     *
     */
    public function categories()
    {
        $this->view->render('categories.html.twig');
    }
}