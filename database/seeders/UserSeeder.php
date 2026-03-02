<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "username" => "Admin",
                "email" => "admin@example.com",
                "password" => bcrypt("password123"),
                "role" => "admin"
            ],
             [
                "username" => "user",
                "email" => "user@example.com",
                "password" => bcrypt("password123"),
                "role" => "user"
            ],
             [
                "username" => "bgst2",
                "email" => "bgst2@example.com",
                "password" => bcrypt("password123"),
                "role" => "user"
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
