<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatatanHarian;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CatatanHarianSeeder extends Seeder
{
    public function run()
    {
        // Buat beberapa user jika belum ada
        $users = [
            ['name' => 'Kahlina Gunawan', 'email' => 'kahlina@karyajayalas.com'],
            ['name' => 'Radiatul Ramadhan', 'email' => 'radiatul@karyajayalas.com'],
            ['name' => 'Bambang Gunawan', 'email' => 'bambang@karyajayalas.com'],
        ];

        foreach ($users as $data) {
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'user',
                ]);
            }

            // Buat catatan harian untuk user tersebut
            CatatanHarian::create([
                'user_id' => $user->id,
                'nama_lengkap' => $data['name'],
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '17:00:00',
                'proyek' => 'Proyek ' . chr(rand(65, 67)),
                'pekerjaan' => 'Mengerjakan tugas las',
                'catatan' => 'Catatan harian ' . $data['name'],
                'status' => 'hadir',
            ]);
        }
    }
}