<?php

namespace MVC\App\Engine;

use Illuminate\Database\Schema\Blueprint;

class MainController
{
    protected $view;
    protected $capsule;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->view = new MainView();
        $this->capsule = MainEloquent::run();

        if (!$this->capsule::schema()->hasTable('users')) {
            $this->capsule::schema()->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('login');
                $table->string('password');
                $table->string('lastname')->nullable();
                $table->string('firstname')->nullable();
                $table->string('midname')->nullable();
                $table->string('birthdate')->nullable();
                $table->integer('description')->nullable();
                $table->integer('role')->default(0);
                $table->timestamps();
            });

            $this->capsule->table('users')->insert(
                [
                    'login' => 'admin',
                    'password' => 'admin',
                    'role' => '1'
                ]
            );

            $this->capsule::schema()->create('photos', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('user');
                $table->string('path');
                $table->boolean('current')->default(0);
                $table->timestamps();
            });
        }
    }
}