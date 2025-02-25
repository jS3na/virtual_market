<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product Type 1',
                'price' => '12.22',
                'stock' => '13',
                'category_id' => 1
            ],
            [
                'name' => 'Product Type 2',
                'price' => '90.13',
                'stock' => '55',
                'category_id' => 2
            ]
        ];

        DB::table('products')->insert($products);
    }
}
