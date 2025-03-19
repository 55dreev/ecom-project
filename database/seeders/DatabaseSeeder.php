<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'Karl@test',
            'password' => Hash::make('password123'), 
        ]);

        // Create Karl
        User::factory()->create([
            'name' => 'Karl',
            'email' => 'Karl@gmail.com',
            'password' => Hash::make('password123'), 
        ]);
    }
}
