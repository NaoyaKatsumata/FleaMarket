<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '働いたら負けTシャツ',
            'brand' => 'ユニクロ',
            'img_path' => 'img/HrhPeYbEzktR.jpg',
            'comment' => 'ユニクロの働いたら負けTシャツです',
            'price' => '3000',
            'category_id' => '2',
            'status_id' => '1',
            'sell_flg' => '0',
            'shipping_user_id'=>'1',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'iPhone',
            'brand' => 'Apple',
            'img_path' => 'img/01_l.jpg',
            'comment' => '13mini',
            'price' => '80000',
            'category_id' => '12',
            'status_id' => '3',
            'sell_flg' => '1',
            'shipping_user_id'=>'1',
            'buy_user_id'=>'1',
        ];
        DB::table('items')->insert($param);
    }
}
