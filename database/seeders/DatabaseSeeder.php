<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Superadmin
        User::create([
            'name' => 'admin_jdih',
            'nama_lengkap' => 'Superadmin JDIH MBD',
            'email' => 'admin@jdih.malukubaratdayakab.go.id',
            'no_hp' => '081234567890',
            'password' => Hash::make('password123'), // Silakan ganti passwordnya
            'role' => 'superadmin',
            'is_aktif' => true,
        ]);

        // 2. Akun Kabag Hukum
        User::create([
            'name' => 'kabag_hukum',
            'nama_lengkap' => 'Kepala Bagian Hukum MBD',
            'email' => 'kabag@jdih.malukubaratdayakab.go.id',
            'no_hp' => '081234567891',  
            'password' => Hash::make('password123'),
            'role' => 'kabag_hukum',
            'is_aktif' => true,
        ]);

        // 3. Akun Operator
        User::create([
            'name' => 'operator_jdih',
            'nama_lengkap' => 'Operator JDIH MBD',
            'email' => 'operator@jdih.malukubaratdayakab.go.id',
            'no_hp' => '081234567892',
            'password' => Hash::make('password123'),
            'role' => 'operator',
            'is_aktif' => true,
        ]);
    }
}
