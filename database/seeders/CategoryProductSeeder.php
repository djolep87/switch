<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryProductSeeder::factory()->times(100)->create();
    }
}
