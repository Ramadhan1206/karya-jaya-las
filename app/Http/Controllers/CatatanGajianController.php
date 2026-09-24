<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatanGajian;
use App\Models\CatatanHarian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CatatanGajianController extends Controller
{
    /**
     * Dashboard Gajian User
     */
    public function index()
    {
        $user = Auth::user();
        
        // ===== AMBIL SEMUA DATA GAJIAN (BUKAN HANYA USER LOGIN) =====
        $gajian = CatatanGajian::with('user')
            ->orderBy('tanggal_gaji', 'desc')
            ->paginate(10);
        
        // ===== TOTAL GAJI SEMUA USER =====
        $totalGaji = CatatanGajian::where('status', 'dibayar')->sum('total_gaji');
        
        // ===== TOTAL GAJI BULAN INI SEMUA USER =====
        $totalGajiBulanIni = CatatanGajian::whereMonth('tanggal_gaji', date('m'))
            ->whereYear('tanggal_gaji', date('Y'))
            ->where('status', 'dibayar')
            ->sum('total_gaji');
        
        // ===== TOTAL GAJI DRAFT =====
        $totalGajiDraft = CatatanGajian::where('status', 'draft')->count();
        
        // ===== TOTAL GAJI PROSES =====
        $totalGajiProses = CatatanGajian::where('status', 'proses')->count();
        
        // ===== TOTAL CATATAN =====
        $totalCatatan = CatatanGajian::count();
        
        // ===== REKAP ABSEN BULAN INI (SEMUA USER) =====
        $bulanIni = date('m');
        $tahunIni = date('Y');
        
        $totalHadir = CatatanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'hadir')
            ->count();
        
        $totalIzin = CatatanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'izin')
            ->count();
        
        $totalSakit = CatatanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'sakit')
            ->count();
        
        $totalAlpha = CatatanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'alpha')
            ->count();
        
        return view('user.gajian.index', compact(
            'user',
            'gajian',
            'totalGaji',
            'totalGajiBulanIni',
            'totalGajiDraft',
            'totalGajiProses',
            'totalCatatan',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha'
        ));
    }

    /**
     * Form tambah gajian
     */
    public function create()
    {
        $user = Auth::user();
        $today = date('Y-m-d');
        $periode = date('F Y');
        
        // Hitung otomatis dari catatan harian user yang login
        $bulanIni = date('m');
        $tahunIni = date('Y');
        
        $totalHadir = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'hadir')
            ->count();
        
        $totalIzin = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'izin')
            ->count();
        
        $totalSakit = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'sakit')
            ->count();
        
        $totalAlpha = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'alpha')
            ->count();
        
        // Gaji per hari
        $gajiPerHari = 150000;
        $gajiPokok = $totalHadir * $gajiPerHari;
        
        // ===== SEMUA USER UNTUK DROPDOWN =====
        $users = User::all();
        
        return view('user.gajian.create', compact(
            'user',
            'today',
            'periode',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha',
            'gajiPokok',
            'gajiPerHari',
            'users'  // <- TAMBAHKAN INI
        ));
    }

    /**
     * Simpan gajian
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama_lengkap' => 'required|string|max:255',
        'tanggal_gaji' => 'required|date',
        'jenis_gaji' => 'required|in:harian,mingguan,bulanan',
        'gaji_pokok' => 'required|numeric|min:0',
        'tunjangan' => 'nullable|numeric|min:0',
        'bonus' => 'nullable|numeric|min:0',
        'potongan' => 'nullable|numeric|min:0',
        'total_hadir' => 'nullable|integer|min:0',
        'total_izin' => 'nullable|integer|min:0',
        'total_sakit' => 'nullable|integer|min:0',
        'total_alpha' => 'nullable|integer|min:0',
        'total_lembur' => 'nullable|integer|min:0',
        'keterangan' => 'nullable|string',
        'rincian_pekerjaan' => 'nullable|string',
        'status' => 'required|in:draft,proses,dibayar,batal',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Hitung total
    $totalGaji = ($request->gaji_pokok ?? 0) 
        + ($request->tunjangan ?? 0) 
        + ($request->bonus ?? 0) 
        - ($request->potongan ?? 0);
    
    $periode = date('F Y', strtotime($request->tanggal_gaji));
    
    // ===== CARI ATAU BUAT USER BARU (CASE-SENSITIVE) =====
    $user = User::where('name', $request->nama_lengkap)->first();
    
    if (!$user) {
        // Buat user baru jika tidak ditemukan
        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => strtolower(str_replace(' ', '.', $request->nama_lengkap)) . '@karyajayalas.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);
    }

    // ===== LANGSUNG SIMPAN TANPA CEK DUPLIKAT =====
    $gajian = CatatanGajian::create([
        'user_id' => $user->id,
        'catatan_harian_id' => null,
        'tanggal_gaji' => $request->tanggal_gaji,
        'periode' => $periode,
        'jenis_gaji' => $request->jenis_gaji,
        'gaji_pokok' => $request->gaji_pokok ?? 0,
        'tunjangan' => $request->tunjangan ?? 0,
        'bonus' => $request->bonus ?? 0,
        'potongan' => $request->potongan ?? 0,
        'total_gaji' => $totalGaji,
        'total_hadir' => $request->total_hadir ?? 0,
        'total_izin' => $request->total_izin ?? 0,
        'total_sakit' => $request->total_sakit ?? 0,
        'total_alpha' => $request->total_alpha ?? 0,
        'total_lembur' => $request->total_lembur ?? 0,
        'keterangan' => $request->keterangan,
        'rincian_pekerjaan' => $request->rincian_pekerjaan,
        'status' => $request->status,
    ]);

    return redirect()->route('user.gajian.index')
        ->with('success', 'Data gajian untuk ' . $user->name . ' berhasil ditambahkan!');
}

    /**
     * Detail gajian
     */
    public function show($id)
    {
        $gajian = CatatanGajian::with('user')->findOrFail($id);
        return view('user.gajian.show', compact('gajian'));
    }

    /**
     * Edit gajian
     */
    public function edit($id)
    {
        $gajian = CatatanGajian::with('user')->findOrFail($id);
        return view('user.gajian.edit', compact('gajian'));
    }

    /**
 * Update gajian
 */
public function update(Request $request, $id)
{
    $gajian = CatatanGajian::with('user')->findOrFail($id);

    $validator = Validator::make($request->all(), [
        'nama_lengkap' => 'required|string|max:255',
        'tanggal_gaji' => 'required|date',
        'jenis_gaji' => 'required|in:harian,mingguan,bulanan',
        'gaji_pokok' => 'required|numeric|min:0',
        'tunjangan' => 'nullable|numeric|min:0',
        'bonus' => 'nullable|numeric|min:0',
        'potongan' => 'nullable|numeric|min:0',
        'total_hadir' => 'nullable|integer|min:0',
        'total_izin' => 'nullable|integer|min:0',
        'total_sakit' => 'nullable|integer|min:0',
        'total_alpha' => 'nullable|integer|min:0',
        'total_lembur' => 'nullable|integer|min:0',
        'keterangan' => 'nullable|string',
        'rincian_pekerjaan' => 'nullable|string',
        'status' => 'required|in:draft,proses,dibayar,batal',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $totalGaji = ($request->gaji_pokok ?? 0) 
        + ($request->tunjangan ?? 0) 
        + ($request->bonus ?? 0) 
        - ($request->potongan ?? 0);

    // ===== UPDATE DATA GAJIAN =====
    $gajian->update([
        'tanggal_gaji' => $request->tanggal_gaji,
        'jenis_gaji' => $request->jenis_gaji,
        'gaji_pokok' => $request->gaji_pokok ?? 0,
        'tunjangan' => $request->tunjangan ?? 0,
        'bonus' => $request->bonus ?? 0,
        'potongan' => $request->potongan ?? 0,
        'total_gaji' => $totalGaji,
        'total_hadir' => $request->total_hadir ?? 0,
        'total_izin' => $request->total_izin ?? 0,
        'total_sakit' => $request->total_sakit ?? 0,
        'total_alpha' => $request->total_alpha ?? 0,
        'total_lembur' => $request->total_lembur ?? 0,
        'keterangan' => $request->keterangan,
        'rincian_pekerjaan' => $request->rincian_pekerjaan,
        'status' => $request->status,
    ]);

    // ===== UPDATE NAMA USER =====
    // Cari user berdasarkan nama lama
    $user = $gajian->user;
    
    // Jika nama berubah, update nama user
    if ($request->nama_lengkap && $request->nama_lengkap !== $user->name) {
        // Cek apakah nama baru sudah digunakan user lain
        $existingUser = User::where('name', $request->nama_lengkap)
            ->where('id', '!=', $user->id)
            ->first();
        
        if ($existingUser) {
            // Jika nama sudah digunakan, buat user baru
            $newUser = User::create([
                'name' => $request->nama_lengkap,
                'email' => strtolower(str_replace(' ', '.', $request->nama_lengkap)) . '@karyajayalas.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]);
            
            // Update gajian dengan user baru
            $gajian->user_id = $newUser->id;
            $gajian->save();
        } else {
            // Update nama user yang ada
            $user->name = $request->nama_lengkap;
            $user->save();
        }
    }

    return redirect()->route('user.gajian.index')
        ->with('success', 'Data gajian berhasil diperbarui!');
}

    /**
     * Hapus gajian
     */
    public function destroy($id)
    {
        $gajian = CatatanGajian::with('user')->findOrFail($id);
        $gajian->delete();

        return redirect()->route('user.gajian.index')
            ->with('success', 'Data gajian berhasil dihapus!');
    }

    /**
     * Generate gajian otomatis dari absen
     */
    public function generate(Request $request)
    {
        $user = Auth::user();
        $tanggal = $request->tanggal ?? date('Y-m-d');
        $periode = date('F Y', strtotime($tanggal));
        
        $existing = CatatanGajian::where('user_id', $user->id)
            ->where('tanggal_gaji', $tanggal)
            ->first();
        
        if ($existing) {
            return back()->with('error', 'Gajian untuk tanggal ' . date('d/m/Y', strtotime($tanggal)) . ' sudah ada!');
        }
        
        $bulan = date('m', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
        
        $totalHadir = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'hadir')
            ->count();
        
        $totalIzin = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'izin')
            ->count();
        
        $totalSakit = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'sakit')
            ->count();
        
        $totalAlpha = CatatanHarian::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'alpha')
            ->count();
        
        $gajiPerHari = 150000;
        $gajiPokok = $totalHadir * $gajiPerHari;
        $tunjangan = $totalHadir * 25000;
        $bonus = $totalHadir >= 25 ? 500000 : 0;
        $potongan = $totalAlpha * 100000;
        $totalGaji = $gajiPokok + $tunjangan + $bonus - $potongan;
        
        $gajian = CatatanGajian::create([
            'user_id' => $user->id,
            'catatan_harian_id' => null,
            'tanggal_gaji' => $tanggal,
            'periode' => $periode,
            'jenis_gaji' => 'bulanan',
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $tunjangan,
            'bonus' => $bonus,
            'potongan' => $potongan,
            'total_gaji' => $totalGaji,
            'total_hadir' => $totalHadir,
            'total_izin' => $totalIzin,
            'total_sakit' => $totalSakit,
            'total_alpha' => $totalAlpha,
            'total_lembur' => 0,
            'keterangan' => 'Generate otomatis dari absen',
            'status' => 'proses',
        ]);
        
        return redirect()->route('user.gajian.index')
            ->with('success', 'Gajian periode ' . $periode . ' berhasil digenerate!');
    }
}
