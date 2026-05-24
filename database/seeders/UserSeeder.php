<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@oriya.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create Kasir User
        User::updateOrCreate(
            ['email' => 'kasir@oriya.com'],
            [
                'name' => 'Kasir',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );
    }
}
