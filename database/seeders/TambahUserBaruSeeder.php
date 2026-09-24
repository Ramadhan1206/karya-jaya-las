<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CatatanHarian;
use App\Models\CatatanGajian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TambahUserBaruSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('');
        $this->command->info('🚀 ==========================================');
        $this->command->info('🚀  MENAMBAHKAN USER BARU & GAJI');
        $this->command->info('🚀 ==========================================');
        $this->command->info('');

        // ============================================================
        // DATA USER BARU
        // ============================================================
        $users = [
            [
                'name' => 'Khalina Gunawan',
                'email' => 'khalina@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'position' => 'Welder',
                'phone' => '081234567896',
                'address' => 'Jl. Merdeka No. 10, Jakarta',
            ],
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'position' => 'Finishing',
                'phone' => '081234567897',
                'address' => 'Jl. Sudirman No. 20, Jakarta',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@karyajayalas.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'position' => 'Staff',
                'phone' => '081234567898',
                'address' => 'Jl. Gatot Subroto No. 30, Jakarta',
            ],
        ];

        // ============================================================
        // SIMPAN USER
        // ============================================================
        foreach ($users as $data) {
            $user = User::where('email', $data['email'])->first();
            
            if (!$user) {
                $user = User::create($data);
                $this->command->info("✅ User {$data['name']} berhasil dibuat!");
            } else {
                $this->command->warn("⚠️ User {$data['name']} sudah ada!");
            }

            // ============================================================
            // BUAT CATATAN HARIAN
            // ============================================================
            $this->createCatatanHarian($user);
            
            // ============================================================
            // BUAT GAJI
            // ============================================================
            $this->createGaji($user);
        }

        $this->command->info('');
        $this->command->info('🎉 ==========================================');
        $this->command->info('🎉  SELESAI! User dan gaji baru ditambahkan.');
        $this->command->info('🎉 ==========================================');
        $this->command->info('');
    }

    /**
     * Buat catatan harian untuk user
     */
    private function createCatatanHarian($user)
    {
        $data = [
            ['tanggal' => '2026-09-02', 'jam_masuk' => '08:00', 'jam_pulang' => '17:00', 'status' => 'hadir', 'proyek' => 'Proyek A', 'pekerjaan' => 'Pekerjaan Utama'],
            ['tanggal' => '2026-09-01', 'jam_masuk' => '08:30', 'jam_pulang' => '16:30', 'status' => 'hadir', 'proyek' => 'Proyek B', 'pekerjaan' => 'Pekerjaan Tambahan'],
            ['tanggal' => '2026-08-31', 'jam_masuk' => '09:00', 'jam_pulang' => '15:00', 'status' => 'izin', 'proyek' => 'Proyek C', 'pekerjaan' => 'Koordinasi'],
        ];

        foreach ($data as $item) {
            $exists = CatatanHarian::where('user_id', $user->id)
                ->whereDate('tanggal', $item['tanggal'])
                ->exists();

            if (!$exists) {
                CatatanHarian::create([
                    'user_id' => $user->id,
                    'tanggal' => $item['tanggal'],
                    'jam_masuk' => $item['jam_masuk'],
                    'jam_pulang' => $item['jam_pulang'],
                    'status' => $item['status'],
                    'proyek' => $item['proyek'],
                    'pekerjaan' => $item['pekerjaan'],
                    'catatan' => null,
                ]);
                $this->command->line("   📝 Catatan {$user->name} tgl {$item['tanggal']} dibuat.");
            }
        }
    }

    /**
     * Buat gaji untuk user
     */
    private function createGaji($user)
    {
        // Hitung absen September 2026
        $totalHadir = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', 9)
            ->whereYear('tanggal', 2026)
            ->where('status', 'hadir')
            ->count();

        $totalIzin = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', 9)
            ->whereYear('tanggal', 2026)
            ->where('status', 'izin')
            ->count();

        $totalSakit = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', 9)
            ->whereYear('tanggal', 2026)
            ->where('status', 'sakit')
            ->count();

        $totalAlpha = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', 9)
            ->whereYear('tanggal', 2026)
            ->where('status', 'alpha')
            ->count();

        // Tentukan gaji berdasarkan jabatan
        $jabatan = strtolower($user->position ?? 'staff');
        $gajiPerHari = 130000;
        $tunjangan = 200000;

        if ($jabatan == 'welder' || $jabatan == 'tukang las') {
            $gajiPerHari = 200000;
            $tunjangan = 500000;
        } elseif ($jabatan == 'finishing') {
            $gajiPerHari = 150000;
            $tunjangan = 300000;
        } elseif ($jabatan == 'staff') {
            $gajiPerHari = 130000;
            $tunjangan = 200000;
        } elseif ($jabatan == 'admin') {
            $gajiPerHari = 130000;
            $tunjangan = 200000;
        }

        // Hitung gaji
        $gajiPokok = $totalHadir * $gajiPerHari;
        $bonus = $totalHadir >= 25 ? 500000 : ($totalHadir >= 20 ? 300000 : ($totalHadir >= 15 ? 100000 : 0));
        $potongan = ($totalAlpha * 100000) + ($totalIzin * 50000);
        $totalGaji = $gajiPokok + $tunjangan + $bonus - $potongan;

        // Simpan gaji
        $periode = 'September 2026';
        $exists = CatatanGajian::where('user_id', $user->id)
            ->where('periode', $periode)
            ->exists();

        if (!$exists) {
            CatatanGajian::create([
                'user_id' => $user->id,
                'catatan_harian_id' => null,
                'tanggal_gaji' => '2026-09-03',
                'periode' => $periode,
                'jenis_gaji' => 'bulanan',
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'bonus' => $bonus,
                'potongan' => $potongan,
                'total_gaji' => max($totalGaji, 0),
                'total_hadir' => $totalHadir,
                'total_izin' => $totalIzin,
                'total_sakit' => $totalSakit,
                'total_alpha' => $totalAlpha,
                'total_lembur' => 0,
                'keterangan' => "Gaji September 2026 - {$user->name}",
                'status' => 'proses',
            ]);
            $this->command->line("   💰 Gaji {$user->name} (Rp " . number_format(max($totalGaji, 0), 0, ',', '.') . ") dibuat.");
        } else {
            $this->command->warn("   ⚠️ Gaji {$user->name} sudah ada!");
        }
    }
}