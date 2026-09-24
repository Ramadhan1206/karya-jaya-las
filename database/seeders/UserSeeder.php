<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Karya Jaya Las',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567800',
                'address' => 'Jl. Raya Industri No. 1, Jakarta',
            ]
        );

        // User Karya Jaya Las Konstruksi
        User::updateOrCreate(
            ['email' => 'karyajayalas@gmail.com'],
            [
                'name' => 'Karya Jaya Las Konstruksi',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567899',
                'address' => 'Jl. Raya Industri No. 123, Jakarta',
            ]
        );

        // User Lainnya
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@karyajayalas.com',
                'role' => 'user',
                'phone' => '081234567891',
                'address' => 'Jl. Kemayoran No. 45, Jakarta',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@karyajayalas.com',
                'role' => 'user',
                'phone' => '081234567892',
                'address' => 'Jl. Pasar Baru No. 78, Jakarta',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@karyajayalas.com',
                'role' => 'admin',
                'phone' => '081234567893',
                'address' => 'Jl. Sudirman No. 90, Jakarta',
            ],
            [
                'name' => 'Bambang Gunawan',
                'email' => 'bambang@karyajayalas.com',
                'role' => 'user',
                'phone' => '081234567894',
                'address' => 'Jl. Gunung No. 5, Jakarta',
            ],
            [
                'name' => 'Radiatul Ramadhan',
                'email' => 'radiatul@karyajayalas.com',
                'role' => 'user',
                'phone' => '081234567895',
                'address' => 'Jl. Ramadhan No. 10, Jakarta',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'),
                    'role' => $data['role'] ?? 'user',
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                ]
            );
        }
    }
}       