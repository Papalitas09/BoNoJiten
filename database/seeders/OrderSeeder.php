<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                "total_price" => 50000,
                "status" => "pending",
                "address" => "123 Main St",
                "quantity" => 2,
                "order_number" => 1001,
                "user_id" => 2,
                "product_id" => 1
            ],
            [
                "total_price" => 20000,
                "status" => "completed",
                "address" => "456 Elm St",
                "quantity" => 1,
                "order_number" => 1002,
                "user_id" => 3,
                "product_id" => 2
            ]
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
