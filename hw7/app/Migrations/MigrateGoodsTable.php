<?php

namespace HW7\App\Migrations;


use HW7\App\Engine\MainEloquent;
use Illuminate\Database\Schema\Blueprint;

class MigrateGoodsTable extends MainEloquent
{
    public function migrate()
    {
        $this->capsule::schema()->dropIfExists('goods');
        $this->capsule::schema()->dropIfExists('categories');
        $this->capsule::schema()->create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('subcategory_id');
            $table->integer('discount');
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
            $table->integer('discount');
            $table->string('photo');
            $table->timestamps();
        });
    }
}