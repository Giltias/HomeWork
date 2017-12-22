<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Все категории', 'parent' => 0],
            ['id' => 2, 'name' => 'Книги',         'parent' => 1],
            ['id' => 3, 'name' => 'Фэнтези',       'parent' => 2],
            ['id' => 4, 'name' => 'Спорттовары',   'parent' => 1],
            ['id' => 5, 'name' => 'Мячи',          'parent' => 4]
        ]);
    }
}
