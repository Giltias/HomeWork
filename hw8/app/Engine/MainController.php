<?php

namespace HW8\App\Engine;

use Illuminate\Database\Schema\Blueprint;

/**
 * Class MainController
 * @package HW8\App\Engine
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

        if (!$this->capsule::schema()->hasTable('goods')) {
            $this->capsule::schema()->create('categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('subcategory_id')->nullable();
                $table->integer('discount')->default(0);
                $table->boolean('active')->default(1);
                $table->timestamps();
            });

            $this->capsule::schema()->create('goods', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id')->unsigned();
                $table->foreign('category_id')->references('id')->on('categories');
                $table->string('name');
                $table->float('price');
                $table->string('description');
                $table->integer('discount')->default(0);
                $table->string('photo');
                $table->timestamps();
            });

            $this->capsule->table('categories')->insert(
                [
                    'name' => 'all googs',
                ]
            );
            $this->capsule->table('categories')->insert(
                [
                    'name' => 'books',
                    'subcategory_id' => 1
                ]);
            $this->capsule->table('categories')->insert(
                [
                    'name' => 'fantasy',
                    'subcategory_id' => 2
                ]);
            $this->capsule->table('categories')->insert(
                [
                    'name' => 'sport',
                    'subcategory_id' => 1
                ]);
            $this->capsule->table('categories')->insert(
                [
                    'name' => 'balls',
                    'subcategory_id' => 4
                ]
            );
            $this->capsule->table('goods')->insert(
                [
                    'category_id' => 2,
                    'name'        => 'Harry Potter',
                    'price'       => '19.99',
                    'description' => 'book about strange boy',
                    'photo'       => '1.png'
                ]
            );
            $this->capsule->table('goods')->insert(
                [
                    'category_id' => 5,
                    'name'        => 'Select',
                    'price'       => '3.99',
                    'description' => 'ball for play football',
                    'photo'       => '2.png'
                ]
            );
        }
    }
}