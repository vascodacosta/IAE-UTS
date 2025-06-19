<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop',
                'price' => 15000000,
            ],
            [
                'name' => 'Smartphone',
                'price' => 7000000,
            ],
        ]);
    }
}
