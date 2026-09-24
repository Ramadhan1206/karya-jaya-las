<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatanHarian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CatatanHarianController extends Controller
{
    /**
     * Dashboard catatan harian user
     */
    public function index()
    {
        $user = Auth::user();
        $tanggal = date('Y-m-d');
        
        // Cek catatan hari ini
        $catatanHariIni = CatatanHarian::where('user_id', $user->id)
            ->whereDate('tanggal', $tanggal)
            ->first();
        
        // Riwayat catatan dengan relasi user
        $riwayat = CatatanHarian::with('user')
            ->where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        
        // Statistik
        $totalHadir = CatatanHarian::where('user_id', $user->id)
            ->where('status', 'hadir')
            ->count();
        
        $totalIzin = CatatanHarian::where('user_id', $user->id)
            ->where('status', 'izin')
            ->count();
        
        $totalSakit = CatatanHarian::where('user_id', $user->id)
            ->where('status', 'sakit')
            ->count();
        
        $totalAlpha = CatatanHarian::where('user_id', $user->id)
            ->where('status', 'alpha')
            ->count();
        
        return view('user.catatan-harian', compact(
            'user',
            'catatanHariIni',
            'riwayat',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha'
        ));
    }

    /**
     * Store catatan harian
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable',
            'jam_pulang' => 'nullable',
            'proyek' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // ===== HAPUS PENGECEKAN DUPLIKAT TANGGAL =====
        // Langsung simpan tanpa cek duplikat

        $catatan = CatatanHarian::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'proyek' => $request->proyek,
            'pekerjaan' => $request->pekerjaan,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()->route('user.catatan-harian')
            ->with('success', 'Catatan harian berhasil ditambahkan!');
    }

    /**
     * Edit catatan harian
     */
    public function edit($id)
    {
        $catatan = CatatanHarian::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return response()->json($catatan);
    }

    /**
     * Update catatan harian
     */
    public function update(Request $request, $id)
    {
        $catatan = CatatanHarian::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable',
            'jam_pulang' => 'nullable',
            'proyek' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $catatan->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'proyek' => $request->proyek,
            'pekerjaan' => $request->pekerjaan,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()->route('user.catatan-harian')
            ->with('success', 'Catatan harian berhasil diperbarui!');
    }

    /**
     * Hapus catatan harian
     */
    public function destroy($id)
    {
        $catatan = CatatanHarian::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $catatan->delete();

        return redirect()->route('user.catatan-harian')
            ->with('success', 'Catatan harian berhasil dihapus!');
    }
}
