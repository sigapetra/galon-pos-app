<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TestDataSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Pastikan tidak duplikat email
        User::firstOrCreate(
            ['email' => 'test@example.com'], // Kondisi unik
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), // Password default
            ]
        );
    }
}
