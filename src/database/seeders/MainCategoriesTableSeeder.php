<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category_name' => '洋服'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'category_name' => '本'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'category_name' => 'アウトドア'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'category_name' => '家具'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'category_name' => '携帯・パソコン'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'category_name' => '家電'
        ];
        DB::table('main_categories')->insert($param);
    }
}
