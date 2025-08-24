<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Utama1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('123456789'), // ubah password sesuai kebutuhan
            'role' => 'admin',
            'nomor_whatsapp' => '081234567890',
        ]);

        // Kepala Bagian
        User::create([
            'name' => 'Kepala Bagian Produksi1',
            'email' => 'kepala1@example.com',
            'password' => Hash::make('123456789'),
            'role' => 'kepala_bagian',
            'nomor_whatsapp' => '081234567891',
        ]);

        // Mekanik
        User::create([
            'name' => 'Mekanik 2',
            'email' => 'mekanik2@example.com',
            'password' => Hash::make('123456789'),
            'role' => 'mekanik',
            'nomor_whatsapp' => '081234567892',
        ]);

       
    }
}
