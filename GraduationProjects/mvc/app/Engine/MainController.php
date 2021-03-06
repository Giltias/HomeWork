<?php

namespace MVC\App\Engine;

use Illuminate\Database\Schema\Blueprint;

/**
 * Class MainController
 * @package MVC\App\Engine
 */
class MainController
{
    /**
     * @var MainView
     */
    protected $view;
    /**
     * @var \Illuminate\Database\Capsule\Manager
     */
    protected $capsule;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->view = new MainView();
        $this->capsule = MainEloquent::run();
        /**
         * If user table not exists in schema then do migration
         * Then create user: admin
         */
        if (!$this->capsule::schema()->hasTable('users')) {
            $this->capsule::schema()->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('login');
                $table->string('password');
                $table->string('lastname')->nullable();
                $table->string('firstname')->nullable();
                $table->string('midname')->nullable();
                $table->string('birthdate')->nullable();
                $table->string('description')->nullable();
                $table->integer('passChanged')->default(0);
                $table->integer('role')->default(0);
                $table->timestamps();
            });

            $this->capsule::schema()->create('photos', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('path');
                $table->boolean('current')->default(0);
                $table->timestamps();
            });

            $this->capsule->table('users')->insert(
                [
                    'login' => 'admin',
                    'password' => password_hash('admin', PASSWORD_BCRYPT),
                    'role' => '1'
                ]
            );
        }
    }
}