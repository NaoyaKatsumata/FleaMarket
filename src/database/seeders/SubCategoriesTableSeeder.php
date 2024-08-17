<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category_name' => 'レディース',
            'main_category_id' => '1'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => 'メンズ',
            'main_category_id' => '1'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '漫画',
            'main_category_id' => '2'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '小説',
            'main_category_id' => '2'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '雑誌',
            'main_category_id' => '2'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => 'アウトドア',
            'main_category_id' => '3'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '旅行用品',
            'main_category_id' => '3'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '机',
            'main_category_id' => '4'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '椅子',
            'main_category_id' => '4'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '寝具',
            'main_category_id' => '4'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '収納グッズ',
            'main_category_id' => '4'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '携帯',
            'main_category_id' => '5'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => 'パソコン',
            'main_category_id' => '5'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => '生活家電',
            'main_category_id' => '6'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'category_name' => 'エアコン・空調',
            'main_category_id' => '6'
        ];
        DB::table('sub_categories')->insert($param);
    }
}
