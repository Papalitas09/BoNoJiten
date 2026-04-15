<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan locale id_ID agar alamat menggunakan format Indonesia
        $faker = Faker::create('id_ID');

        $orders = [];

        // Kita akan men-generate 20 data dummy
        for ($i = 0; $i < 20; $i++) {
            $orders[] = [
                // Menggunakan rentang harga yang masuk akal (misal: 50.000 s/d 5.000.000)
                'total_price'    => $faker->randomFloat(2, 50000, 5000000),
                
                // Mengambil status secara acak sesuai enum di skema
                'status'         => $faker->randomElement(['pending', 'completed', 'cancelled']),
                
                // Men-generate alamat acak
                'address'        => $faker->address(),
                
                // Quantity barang antara 1 sampai 5
                'quantity'       => $faker->numberBetween(1, 5),
                
                // Membuat Order Number unik (Contoh hasil: BNJ-A1B2-8901)
                'order_number'   => 'ORD-' . strtoupper($faker->unique()->bothify('????-####')),
                
                // Asumsi ID dari tabel users (1-10) dan products (1-20) sudah ada datanya
                'user_id'        => $faker->numberBetween(2, 4),
                'product_id'     => $faker->numberBetween(1, 20),
                
                // Timestamps
                'created_at'     => Carbon::now()->subDays(rand(1, 30)), // Dibuat acak dalam 30 hari terakhir
                'updated_at'     => Carbon::now(),
            ];
        }

        // Insert all generated orders into the database
        DB::table('orders')->insert($orders);

    }
}
