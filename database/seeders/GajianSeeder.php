<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatatanGajian;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GajianSeeder extends Seeder
{
    public function run()
    {
        // =============================================
        // BUAT USER BARU (Jika belum ada)
        // =============================================
        $users = [
            [
                'name' => 'Bambang Gunawan',
                'email' => 'bambang@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Radiatul Ramadhan',
                'email' => 'radiatul@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }

        // =============================================
        // AMBIL SEMUA USER
        // =============================================
        $allUsers = User::all();

        // =============================================
        // BUAT DATA GAJIAN UNTUK SEMUA USER
        // =============================================
        $gajianData = [];

        // Data untuk bulan Agustus 2026
        $dates = ['2026-08-28', '2026-08-27', '2026-08-26', '2026-08-25', '2026-08-24'];
        $statuses = ['draft', 'proses', 'dibayar', 'draft'];
        $jenis = ['harian', 'harian', 'mingguan', 'bulanan'];

        foreach ($allUsers as $user) {
            foreach ($dates as $index => $date) {
                $gajiPokok = rand(300000, 500000);
                $tunjangan = rand(50000, 100000);
                $bonus = rand(0, 200000);
                $potongan = rand(0, 50000);
                
                $gajianData[] = [
                    'user_id' => $user->id,
                    'catatan_harian_id' => null,
                    'tanggal_gaji' => $date,
                    'periode' => 'August 2026',
                    'jenis_gaji' => $jenis[$index % count($jenis)],
                    'gaji_pokok' => $gajiPokok,
                    'tunjangan' => $tunjangan,
                    'bonus' => $bonus,
                    'potongan' => $potongan,
                    'total_gaji' => $gajiPokok + $tunjangan + $bonus - $potongan,
                    'total_hadir' => rand(20, 25),
                    'total_izin' => rand(0, 3),
                    'total_sakit' => rand(0, 2),
                    'total_alpha' => rand(0, 1),
                    'total_lembur' => rand(0, 5),
                    'keterangan' => 'Seeder data untuk ' . $user->name,
                    'rincian_pekerjaan' => 'Pekerjaan rutin bulan Agustus',
                    'status' => $statuses[$index % count($statuses)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert data
        foreach ($gajianData as $data) {
            CatatanGajian::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                    'tanggal_gaji' => $data['tanggal_gaji'],
                ],
                $data
            );
        }

        $this->command->info('✅ ' . count($gajianData) . ' data gajian berhasil dibuat!');
    }
}