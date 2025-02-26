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

        $products = array();

        for ($i = 0; $i < 50; $i++) {
            $products[] = [
                'name' => "Product {$i}",
                'price' => '12',
                'stock' => '13',
                'category_id' => 1
            ];
        }

        DB::table('products')->insert($products);
    }
}
