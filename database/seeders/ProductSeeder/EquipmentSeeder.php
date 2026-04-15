<?php

namespace Database\Seeders\ProductSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $products = [
            [
                'name' => 'Muc-Off Nano Tech Bike Cleaner 1L',
                'description' => 'Advanced nano-technology cleaning fluid that cuts through dirt, oil and grime leaving your bike shining.',
                'price' => 250000,
                'stock' => 100,
                'categories' => 'equipment',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Giro Fixture MIPS Helmet',
                'description' => 'Confident mountain bike style and breezy ventilation combine in a compact design that complements nearly any ride.',
                'price' => 1200000,
                'stock' => 25,
                'categories' => 'equipment',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Fox Racing Defend Gloves',
                'description' => 'A perfect mix of lightweight top hand material and a minimal, yet extremely durable palm.',
                'price' => 550000,
                'stock' => 30,
                'categories' => 'equipment',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Park Tool PCS-10.3 Repair Stand',
                'description' => "Professional quality mechanic's repair stand perfectly equipped for home maintenance and tuning.",
                'price' => 3500000,
                'stock' => 12,
                'categories' => 'equipment',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($products);
        $this->command->info('Data Produk Equipment berhasil ditambahkan!');
    }
}
