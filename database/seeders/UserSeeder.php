<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com', 
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_premium' => false,
            'premium_expires_at' => null,
            'phone_number' => null,
            'address' => null,
            'resume_path' => null,
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'jobseeker', 
            'is_premium' => false,
            'premium_expires_at' => null,
            'phone_number' => null,
            'address' => null,
            'resume_path' => null,
            'email_verified_at' => now()
        ]);
    }
}
