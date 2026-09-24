<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryaJayaLasSeeder extends Seeder
{
    public function run()
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

        // User lainnya
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567891',
                'address' => 'Jl. Kemayoran No. 45, Jakarta',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567892',
                'address' => 'Jl. Pasar Baru No. 78, Jakarta',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567893',
                'address' => 'Jl. Sudirman No. 90, Jakarta',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'role' => $data['role'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                ]
            );
        }
    }
}