<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'method' => 'コンビニ'
        ];
        DB::table('pay_methods')->insert($param);

        $param = [
            'method' => 'クレジットカード'
        ];
        DB::table('pay_methods')->insert($param);

        $param = [
            'method' => '銀行'
        ];
        DB::table('pay_methods')->insert($param);
    }
}
