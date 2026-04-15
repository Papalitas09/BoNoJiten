<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder\UnitSeeder;
use Database\Seeders\ProductSeeder\SparepartSeeder;
use Database\Seeders\ProductSeeder\EquipmentSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call(UsersSeeder::class);
        $this->call(
            [
                ProductSeeder::class,
                UserSeeder::class,
                OrderSeeder::class,
                UnitSeeder::class,
                SparepartSeeder::class,
                EquipmentSeeder::class,
            ]);
    }
}
