<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Manager',
            'email' => 'manager@test.com',
            'password' => Hash::make('password123'),
            'role' => 'manager',
        ]);

        User::factory()->create([
            'name' => 'Kevin',
            'email' => 'employee@test.com',
            'password' => Hash::make('password123'),
            'role' => 'employee',
        ]);
    }
}
