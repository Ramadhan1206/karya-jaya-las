<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProyekSeeder extends Seeder
{
    public function run()
    {
        $proyek = [
            [
                'nama_proyek' => 'Gedung Perkantoran BCA',
                'klien' => 'PT Bank Central Asia',
                'deskripsi' => 'Pengerjaan rangka baja untuk gedung perkantoran 10 lantai',
                'lokasi' => 'Jakarta Selatan',
                'tanggal_mulai' => '2025-01-15',
                'tanggal_selesai' => '2025-06-30',
                'kategori' => 'gedung',
                'status' => 'selesai',
                'is_featured' => true,
            ],
            [
                'nama_proyek' => 'Jembatan Suramadu Access',
                'klien' => 'PUPR',
                'deskripsi' => 'Pengerjaan struktur baja jembatan akses Suramadu',
                'lokasi' => 'Surabaya-Madura',
                'tanggal_mulai' => '2025-03-01',
                'tanggal_selesai' => '2025-12-20',
                'kategori' => 'jembatan',
                'status' => 'berjalan',
                'is_featured' => true,
            ],
            [
                'nama_proyek' => 'Pabrik Pengolahan Kelapa Sawit',
                'klien' => 'PT Wilmar Group',
                'deskripsi' => 'Konstruksi rangka baja pabrik pengolahan CPO',
                'lokasi' => 'Riau',
                'tanggal_mulai' => '2025-05-10',
                'tanggal_selesai' => '2025-09-15',
                'kategori' => 'industri',
                'status' => 'selesai',
                'is_featured' => false,
            ],
            [
                'nama_proyek' => 'Stadion Sepak Bola Patriot',
                'klien' => 'Pemerintah Kota Bekasi',
                'deskripsi' => 'Pengerjaan rangka baja atap stadion',
                'lokasi' => 'Bekasi',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-11-30',
                'kategori' => 'infrastruktur',
                'status' => 'direncanakan',
                'is_featured' => false,
            ],
            [
                'nama_proyek' => 'Gedung DPRD DKI Jakarta',
                'klien' => 'Pemprov DKI Jakarta',
                'deskripsi' => 'Renovasi struktur baja gedung DPRD',
                'lokasi' => 'Jakarta Pusat',
                'tanggal_mulai' => '2025-02-01',
                'tanggal_selesai' => '2025-05-30',
                'kategori' => 'gedung',
                'status' => 'selesai',
                'is_featured' => true,
            ],
        ];

        foreach ($proyek as $data) {
            $slug = Str::slug($data['nama_proyek']);
            
            // Cek apakah sudah ada
            $exists = DB::table('proyek')->where('slug', $slug)->exists();
            
            if (!$exists) {
                DB::table('proyek')->insert([
                    'nama_proyek' => $data['nama_proyek'],
                    'slug' => $slug,
                    'klien' => $data['klien'],
                    'deskripsi' => $data['deskripsi'],
                    'lokasi' => $data['lokasi'],
                    'tanggal_mulai' => $data['tanggal_mulai'],
                    'tanggal_selesai' => $data['tanggal_selesai'],
                    'kategori' => $data['kategori'],
                    'status' => $data['status'],
                    'is_featured' => $data['is_featured'],
                    'views' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                echo "✅ Proyek {$data['nama_proyek']} created!\n";
            } else {
                echo "⚠️ Proyek {$data['nama_proyek']} already exists!\n";
            }
        }
    }
}