<?php

namespace Database\Seeders\ProductSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $products = [
            [
                'name' => 'Polygon Siskiu T8',
                'description' => 'A high-performance full suspension trail bike ready for an adventure. Built with ALX alloy frame and durable components.',
                'price' => 28500000,
                'stock' => 15,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Trek Marlin 7 Gen 3',
                'description' => 'Your best friend on the trail and your daily commuter. Upgraded RockShox fork and Shimano Deore drivetrain.',
                'price' => 13500000,
                'stock' => 8,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Specialized Stumpjumper EVO Elite Alloy',
                'description' => 'The ultimate alloy trail bike. Built to go full gas through the roughest terrain, featuring SWAT door integration.',
                'price' => 55000000,
                'stock' => 3,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Santa Cruz Hightower 3',
                'description' => 'The Hightower remains our greatest hits engineering. Lower-link VPP suspension means big hit capabilities.',
                'price' => 80000000,
                'stock' => 1,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Giant Trance X Advanced Pro 29',
                'description' => 'From chunky rock gardens to fast, flowy singletrack. Lightweight carbon frame with adjustable geometry.',
                'price' => 65000000,
                'stock' => 0,
                'categories' => 'unit',
                'status' => 'unavailable',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Polygon Collosus N9',
                'description' => 'An enduro beast built to tackle the most demanding descents of EWS tracks. High-pivot suspension design.',
                'price' => 48000000,
                'stock' => 5,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cannondale Scalpel HT Carbon 3',
                'description' => 'A whole new breed of cross-country hardtail. The purest form of racing speed with a Lefty Ocho fork.',
                'price' => 32000000,
                'stock' => 7,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Scott Spark RC Team Issue AXS',
                'description' => 'World Championship proven full suspension cross-country race bike. Features wireless shifting.',
                'price' => 78000000,
                'stock' => 2,
                'categories' => 'unit',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($products);
        $this->command->info('Data Produk Unit berhasil ditambahkan!');
    }
}
