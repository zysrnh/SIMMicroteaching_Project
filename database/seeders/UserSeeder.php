<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 0. Akun Super Admin
        \App\Models\User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@iaipersis.ac.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
        ]);

        // 1. Akun Admin Koordinator
        \App\Models\User::create([
            'name' => 'Admin Microteaching',
            'email' => 'admin@iaipersis.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Akun Dosen (Guru Pamong)
        \App\Models\User::create([
            'name' => 'Dr. Budi Santoso, M.Pd.',
            'email' => 'dosen1@iaipersis.ac.id',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        \App\Models\User::create([
            'name' => 'Siti Aminah, M.Ag.',
            'email' => 'dosen2@iaipersis.ac.id',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        // 3. Akun Mahasiswa
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\User::create([
                'name' => 'Mahasiswa Simulasi ' . $i,
                'email' => 'mahasiswa'.$i.'@student.iaipersis.ac.id',
                'password' => bcrypt('password'),
                'role' => 'mahasiswa',
            ]);
        }
    }
}
