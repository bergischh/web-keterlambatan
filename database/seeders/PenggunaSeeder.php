<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'PS Rayon',
            'email' => 'pembimbing@gmail.com',
            'password' => Hash::make('ps'),
            'role' => 'pembimbingsiswa',
        ]);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminweb'),
            'role' => 'administrator',
        ]);
    }
}
