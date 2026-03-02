<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [   
            [
                "name" => "Product 1",
                "description" => "Description of Product 1",
                "price" => 10000,
                "stock" => 10
            ],
            [
                "name" => "Product 2",
                "description" => "Description of Product 2",
                "price" => 20000,
                "stock" => 5
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
