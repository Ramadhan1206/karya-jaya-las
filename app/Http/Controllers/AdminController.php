<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CatatanHarian;
use App\Models\CatatanGajian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalUsersToday = User::whereDate('created_at', today())->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalUsersOnly = User::where('role', 'user')->count();
        
        $latestUsers = User::latest()->take(5)->get();
        
        $monthlyUsers = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        
        $months = [];
        $totals = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $found = $monthlyUsers->where('month', $i)->first();
            $totals[] = $found ? $found->total : 0;
        }

        // Statistik absen hari ini
        $absenHariIni = CatatanHarian::whereDate('tanggal', today())->count();
        $hadirHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'hadir')->count();
        $izinHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'izin')->count();
        $sakitHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'sakit')->count();
        $alphaHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'alpha')->count();

        // Ambil 5 absensi terakhir
        $absensiTerakhir = CatatanHarian::with('user')
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalUsersToday',
            'totalAdmins',
            'totalUsersOnly',
            'latestUsers',
            'months',
            'totals',
            'absenHariIni',
            'hadirHariIni',
            'izinHariIni',
            'sakitHariIni',
            'alphaHariIni',
            'absensiTerakhir'
        ));
    }

    // ============================================================
    // USER MANAGEMENT
    // ============================================================

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil dihapus!');
    }

    // ============================================================
    // DATA ABSENSI
    // ============================================================

    /**
     * Data Absensi
     */
    public function absen(Request $request)
    {
        $query = CatatanHarian::with('user')->orderBy('tanggal', 'desc');

        // Filter by user
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $absensi = $query->paginate(15);
        $users = User::all();
        $statuses = ['hadir', 'izin', 'sakit', 'alpha'];

        // Statistik dengan filter yang sama
        $baseQuery = CatatanHarian::query();

        if ($request->has('user_id') && $request->user_id != '') {
            $baseQuery->where('user_id', $request->user_id);
        }
        if ($request->has('status') && $request->status != '') {
            $baseQuery->where('status', $request->status);
        }
        if ($request->has('tanggal') && $request->tanggal != '') {
            $baseQuery->whereDate('tanggal', $request->tanggal);
        }

        $totalHadir = (clone $baseQuery)->where('status', 'hadir')->count();
        $totalIzin  = (clone $baseQuery)->where('status', 'izin')->count();
        $totalSakit = (clone $baseQuery)->where('status', 'sakit')->count();
        $totalAlpha = (clone $baseQuery)->where('status', 'alpha')->count();
        $totalSemua = $totalHadir + $totalIzin + $totalSakit + $totalAlpha;

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

    /**
     * Detail Absensi
     */
    public function absenDetail($id)
    {
        $absen = CatatanHarian::with('user')->findOrFail($id);
        return view('admin.absen.detail', compact('absen'));
    }

    // ============================================================
    // CATATAN HARIAN - ADMIN
    // ============================================================

    public function catatanHarian(Request $request)
    {
        $query = CatatanHarian::with('user')->orderBy('tanggal', 'desc');

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $catatan = $query->paginate(15);
        $users = User::all();
        $statuses = ['hadir', 'izin', 'sakit', 'alpha'];

        $totalHadir = CatatanHarian::where('status', 'hadir')->count();
        $totalIzin = CatatanHarian::where('status', 'izin')->count();
        $totalSakit = CatatanHarian::where('status', 'sakit')->count();
        $totalAlpha = CatatanHarian::where('status', 'alpha')->count();
        $totalCatatan = CatatanHarian::count();

        $catatanHariIni = CatatanHarian::whereDate('tanggal', today())->count();
        $hadirHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'hadir')->count();
        $izinHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'izin')->count();
        $sakitHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'sakit')->count();
        $alphaHariIni = CatatanHarian::whereDate('tanggal', today())->where('status', 'alpha')->count();

        return view('admin.catatan-harian.index', compact(
            'catatan',
            'users',
            'statuses',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha',
            'totalCatatan',
            'catatanHariIni',
            'hadirHariIni',
            'izinHariIni',
            'sakitHariIni',
            'alphaHariIni'
        ));
    }

    public function catatanHarianDetail($id)
    {
        $catatan = CatatanHarian::with('user')->findOrFail($id);
        return view('admin.catatan-harian.detail', compact('catatan'));
    }

    public function catatanHarianDelete($id)
    {
        $catatan = CatatanHarian::findOrFail($id);
        $catatan->delete();

        return redirect()->route('admin.catatan-harian')
            ->with('success', 'Catatan harian berhasil dihapus!');
    }

    // ============================================================
    // GAJIAN - ADMIN
    // ============================================================

    /**
     * Gajian Admin - Index
     */
    public function gajianIndex(Request $request)
    {
        $query = CatatanGajian::with('user')->orderBy('tanggal_gaji', 'desc');

        // Filter by user
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal_gaji', $request->tanggal);
        }

        $gajian = $query->paginate(15);
        $users = User::all();
        $statuses = ['draft', 'proses', 'dibayar', 'batal'];

        // Statistik Gaji
        $totalGaji = CatatanGajian::sum('total_gaji');
        $totalDraft = CatatanGajian::where('status', 'draft')->count();
        $totalProses = CatatanGajian::where('status', 'proses')->count();
        $totalDibayar = CatatanGajian::where('status', 'dibayar')->count();
        $totalBatal = CatatanGajian::where('status', 'batal')->count();

        // Statistik Absen
        $totalHadir = CatatanHarian::where('status', 'hadir')->count();
        $totalIzin = CatatanHarian::where('status', 'izin')->count();
        $totalSakit = CatatanHarian::where('status', 'sakit')->count();
        $totalAlpha = CatatanHarian::where('status', 'alpha')->count();

        return view('admin.gajian.index', compact(
            'gajian',
            'users',
            'statuses',
            'totalGaji',
            'totalDraft',
            'totalProses',
            'totalDibayar',
            'totalBatal',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha'
        ));
    }

    /**
     * Gajian Admin - Detail
     */
    public function gajianDetail($id)
    {
        $gajian = CatatanGajian::with('user')->findOrFail($id);
        return view('admin.gajian.detail', compact('gajian'));
    }

    /**
     * Gajian Admin - Update Status
     */
    public function gajianUpdateStatus(Request $request, $id)
    {
        $gajian = CatatanGajian::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:draft,proses,dibayar,batal',
        ]);

        $gajian->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? $gajian->keterangan,
        ]);

        return redirect()->route('admin.gajian')
            ->with('success', 'Status gajian berhasil diperbarui!');
    }

    /**
     * Gajian Admin - Delete
     */
    public function gajianDelete($id)
    {
        $gajian = CatatanGajian::findOrFail($id);
        $gajian->delete();

        return redirect()->route('admin.gajian')
            ->with('success', 'Data gajian berhasil dihapus!');
    }

    // ============================================================
    // KARYAWAN - ADMIN
    // ============================================================

    public function karyawanIndex(Request $request)
    {
        $query = User::where(function ($q) {
            $q->where('email', 'like', '%@karyajayalas.com%')
              ->orWhere('email', 'karyajayalas@gmail.com')
              ->orWhere('role', 'admin');
        });

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $karyawan = $query->orderBy('name')->paginate(10);
        
        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function karyawanCreate()
    {
        return view('admin.karyawan.create');
    }

    public function karyawanStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|ends_with:karyajayalas.com',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'position' => 'nullable|string|max:100',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function karyawanEdit($id)
    {
        $karyawan = User::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function karyawanUpdate(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|ends_with:karyajayalas.com',
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'position' => 'nullable|string|max:100',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'position' => $request->position,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan berhasil diperbarui!');
    }

    public function karyawanDestroy($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $karyawan = User::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus!');
    }

    // ============================================================
    // SETTINGS
    // ============================================================

    public function settings()
    {
        return view('admin.settings');
    }
}