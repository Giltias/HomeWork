<?php

namespace HW7\App\Migrations;


use HW7\App\Engine\MainEloquent;
use Illuminate\Database\Schema\Blueprint;

class MigrateUserTable extends MainEloquent
{
    public function migrate()
    {
        $this->capsule::schema()->dropIfExists('order');
        $this->capsule::schema()->dropIfExists('user');
        $this->capsule::schema()->create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('phone');
            $table->string('name')->nullable();
            $table->string('ip');
            $table->timestamps();
        });

        $this->capsule::schema()->create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('fraction')->nullable();
            $table->string('room')->nullable();
            $table->string('floor')->nullable();
            $table->string('comment')->nullable();
            $table->string('payment')->nullable();
            $table->integer('call')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }
}