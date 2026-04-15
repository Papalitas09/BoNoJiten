<?php

namespace Database\Seeders\ProductSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $products = [
            [
                'name' => 'Shimano Deore XT M8100 Rear Derailleur',
                'description' => '12-speed rear derailleur offering fast and precise shifting performance. Perfect for aggressive mountain biking.',
                'price' => 1500000,
                'stock' => 20,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Maxxis Minion DHF Tire 29x2.5',
                'description' => 'The standard for aggressive all-mountain and enduro riding. Featuring EXO protection and 3C MaxxTerra compound.',
                'price' => 850000,
                'stock' => 42,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'RockShox Recon Silver RL Fork',
                'description' => 'Air spring suspension fork with Motion Control damping offering reliable performance and plush feel.',
                'price' => 4200000,
                'stock' => 12,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'SRAM GX Eagle 12-Speed Cassette',
                'description' => '10-52T wide range cassette providing a 520% gear range. Perfect for steep climbs and high-speed descents.',
                'price' => 2800000,
                'stock' => 18,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Fox 36 Factory GRIP2 Fork',
                'description' => 'The undisputed all-mountain champion fork. Featuring Kashima coating and highly tunable GRIP2 damper.',
                'price' => 15500000,
                'stock' => 4,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Shimano XTR M9120 4-Piston Brakeset',
                'description' => 'Top-tier hydraulic disc brakes delivering uncompromised stopping power for enduro and downhill riders.',
                'price' => 8200000,
                'stock' => 6,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Crankbrothers Stamp 7 Flat Pedals',
                'description' => 'Premium flat pedals with optimal size interface. Forged aluminum body with 10 adjustable pins per side.',
                'price' => 1850000,
                'stock' => 25,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ergon GA2 Grips',
                'description' => 'Excellent tactile feel. Super-soft, UV stable rubber compound exclusively manufactured in Germany.',
                'price' => 450000,
                'stock' => 55,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Race Face Chester Handlebar',
                'description' => 'Tough, 35mm aluminum handlebar built to withstand severe abuse on the roughest gravity trails.',
                'price' => 650000,
                'stock' => 14,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'RockShox Reverb Stealth Dropper Post',
                'description' => 'Internally routed dropper seatpost featuring completely redesigned internals for a smoother drop.',
                'price' => 5500000,
                'stock' => 8,
                'categories' => 'sparepart',
                'status' => 'available',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($products);
        $this->command->info('Data Produk Sparepart berhasil ditambahkan!');
    }
}
