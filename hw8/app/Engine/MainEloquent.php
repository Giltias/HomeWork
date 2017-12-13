<?php

namespace HW8\App\Engine;

use Illuminate\Database\Capsule\Manager as Capsule;
use HW8\App\ConfigStore;


/**
 * Class MainEloquent
 * @package HW8\App\Engine
 */
class MainEloquent
{
    /**
     * @return Capsule
     */
    public static function run()
    {
        $capsule = new Capsule();
        $parametersInString = 'driver,host,database,username,password,charset,collation,prefix';
        $capsule->addConnection(ConfigStore::getArrayByKeys($parametersInString));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }
}