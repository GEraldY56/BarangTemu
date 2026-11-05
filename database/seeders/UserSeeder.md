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
        User::create([
            'name' => 'Admin BarangTemu',
            'email' => 'admin@barangtemu.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'class' => null,
        ]);

        // Create Regular Users
        User::create([
            'name' => 'Rian Pratama',
            'email' => 'rian@student.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'class' => 'XI MIPA 2',
        ]);

        User::create([
            'name' => 'Bima Arya',
            'email' => 'bima@student.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'class' => 'XII IPS 1',
        ]);

        User::create([
            'name' => 'Nadia Zahra',
            'email' => 'nadia@student.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'class' => 'X-4',
        ]);

        User::create([
            'name' => 'Dinda Kirana',
            'email' => 'dinda@student.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'class' => 'XI IPA 2',
        ]);

        User::create([
            'name' => 'Ilham Ramadhan',
            'email' => 'ilham@student.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'class' => 'XII MIPA 1',
        ]);
    }
}
