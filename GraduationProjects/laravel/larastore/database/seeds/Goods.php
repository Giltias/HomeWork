<?php

use Illuminate\Database\Seeder;

class Goods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            [
                'id' => 1,
                'name' => 'Гарри Поттер',
                'price' => 5.99,
                'description' => 'Первый роман в серии книг про юного волшебника Гарри Поттера, написанный Дж. К. Роулинг.',
                'photo' => '1.gif',
                'category_id' => 3
            ],
            [
                'id' => 2,
                'name' => 'Select',
                'price' => 3.99,
                'description' => 'Мяч для игры в футбол',
                'photo' => '2.gif',
                'category_id' => 5
            ]
        ]);
    }
}
