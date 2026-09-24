<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. DATA KARYAWAN (SUDAH PASTI AMAN)
        // ==========================================
        
        // Hitung total seluruh karyawan di database
        $totalUsers = Karyawan::count();
        
        // Hitung karyawan yang baru dibuat hari ini
        $newToday = Karyawan::whereDate('created_at', Carbon::today())->count();

        // ==========================================
        // 2. DATA ADMIN & USER (DUMMY TAPI BISA DIUBAH)
        // ==========================================
        // Jika Anda memiliki kolom 'role' di tabel karyawan, Anda bisa uncomment kode di bawah:
        // $totalAdmin = Karyawan::where('role', 'admin')->count();
        // $totalUser = Karyawan::where('role', 'user')->count();
        
        // Untuk saat ini kita pakai data statis agar halaman langsung terbuka:
        $totalAdmin = 1; 
        $totalUser = 1;

        // ==========================================
        // 3. DATA ABSENSI HARI INI (TIDAK AKAN ERROR!)
        // ==========================================
        // Kita gunakan Try-Catch. Jika tabel 'absensis' belum dibuat, 
        // maka semua nilai absensi akan otomatis menjadi 0, TIDAK ERROR 500.

        try {
            // Cek apakah Model Absensi benar-benar ada
            if (class_exists('App\Models\Absensi')) {
                $absensiModel = new \App\Models\Absensi();
                $today = Carbon::today();

                $hadirHariIni    = $absensiModel::whereDate('tanggal', $today)->where('status', 'Hadir')->count();
                $izinHariIni     = $absensiModel::whereDate('tanggal', $today)->where('status', 'Izin')->count();
                $sakitHariIni    = $absensiModel::whereDate('tanggal', $today)->where('status', 'Sakit')->count();
                $alphaHariIni    = $absensiModel::whereDate('tanggal', $today)->where('status', 'Alpha')->count();
                $totalAbsensiHariIni = $hadirHariIni + $izinHariIni + $sakitHariIni + $alphaHariIni;
            } else {
                // Jika model Absensi belum dibuat, set semuanya ke 0
                $hadirHariIni = 0;
                $izinHariIni = 0;
                $sakitHariIni = 0;
                $alphaHariIni = 0;
                $totalAbsensiHariIni = 0;
            }
        } catch (\Exception $e) {
            // Jika terjadi error database (misal tabel belum dibuat), set semuanya ke 0
            $hadirHariIni = 0;
            $izinHariIni = 0;
            $sakitHariIni = 0;
            $alphaHariIni = 0;
            $totalAbsensiHariIni = 0;
        }

        // ==========================================
        // 4. KIRIM SEMUA DATA KE VIEW
        // ==========================================
        return view('admin.dashboard', compact(
            'totalUsers',
            'newToday',
            'totalAdmin',
            'totalUser',
            'hadirHariIni',
            'izinHariIni',
            'sakitHariIni',
            'alphaHariIni',
            'totalAbsensiHariIni'
        ));
    }
}