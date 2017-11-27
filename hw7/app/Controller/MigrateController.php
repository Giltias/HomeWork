<?php
/**
 * Created by PhpStorm.
 * User: Giltias
 * Date: 27.11.2017
 * Time: 20:37
 */

namespace HW7\App\Controller;


use HW7\App\Engine\MainController;
use HW7\App\Migrations\MigrateGoodsTable;
use HW7\App\Migrations\MigrateUserTable;

class MigrateController extends MainController
{
    public function users()
    {
        $migrate = new MigrateUserTable();
        $migrate->migrate();
    }

    public function goods()
    {
        $migrate = new MigrateGoodsTable();
        $migrate->migrate();
    }
}