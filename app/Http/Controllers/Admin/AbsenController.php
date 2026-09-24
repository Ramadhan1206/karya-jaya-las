<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        // ===== DEBUG SEMENTARA — HAPUS BARIS INI SETELAH SELESAI CEK =====
        dd(
            DB::table('absensis')->count(),
            DB::table('absensis')->select('status')->distinct()->get(),
            DB::connection()->getDatabaseName()
        );

        // ===== QUERY UNTUK TABLE =====
        $query = Absensi::with('user');

        // Filter
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Data untuk table (paginate)
        $absensi = $query->orderBy('tanggal', 'desc')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

        // ===== STATISTIK =====
        $statusCounts = DB::table('absensis')
            ->select('status', DB::raw('count(*) as jumlah'))
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        $totalHadir = $statusCounts['hadir'] ?? 0;
        $totalIzin  = $statusCounts['izin'] ?? 0;
        $totalSakit = $statusCounts['sakit'] ?? 0;
        $totalAlpha = $statusCounts['alpha'] ?? 0;

        $totalSemua = $totalHadir + $totalIzin + $totalSakit + $totalAlpha;

        // ===== DATA UNTUK FILTER =====
        $users = User::orderBy('name')->get();
        $statuses = ['hadir', 'izin', 'sakit', 'alpha'];

        // ===== PASSING KE VIEW =====
        return view('admin.absen.index', compact(
            'absensi',
            'users',
            'statuses',
            'totalSemua',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha'
        ));
    }

    public function detail($id)
    {
        $absensi = Absensi::with('user')->findOrFail($id);
        return view('admin.absen-detail', compact('absensi'));
    }
}