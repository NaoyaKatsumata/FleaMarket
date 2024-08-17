<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'status' => '新品'
        ];
        DB::table('statuses')->insert($param);

        $param = [
            'status' => '新品に近い中古'
        ];
        DB::table('statuses')->insert($param);

        $param = [
            'status' => '中古'
        ];
        DB::table('statuses')->insert($param);

        $param = [
            'status' => '傷あり'
        ];
        DB::table('statuses')->insert($param);
    }
}
