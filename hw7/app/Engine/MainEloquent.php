<?php

namespace HW7\App\Engine;

use Illuminate\Database\Capsule\Manager as Capsule;


class MainEloquent
{
    protected $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'burgers',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}