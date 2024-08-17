<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MainCategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
    }
}
