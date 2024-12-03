<?php

namespace Database\Seeders;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->isLocal()) {
            UserRepository::create([
                'name' => 'Administrator',
                'phone' => '01000000000',
                'email' => 'admin@example.com',
                'is_active' => true,
                'is_admin' => true,
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'remember_token' => Str::random(10),
            ]);

            User::factory()
                ->count(100)
                ->create();
        }

        if (app()->isProduction()) {
            // Admin User
            UserRepository::create([
                'name' => 'Administrator',
                'phone' => '01000000000',
                'email' => 'admin@readylms.com',
                'is_active' => true,
                'is_admin' => true,
                'email_verified_at' => now(),
                'password' => Hash::make('secret@123'),
                'remember_token' => Str::random(10),
            ]);

            // General User
            UserRepository::create([
                'name' => 'Demo User',
                'phone' => '01000000001',
                'email' => 'user@readylms.com',
                'is_active' => true,
                'is_admin' => false,
                'email_verified_at' => now(),
                'password' => Hash::make('secret@123'),
                'remember_token' => Str::random(10)
            ]);
        }
    }
}
