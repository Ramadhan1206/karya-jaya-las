<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CatatanHarian;
use App\Models\CatatanGajian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Dashboard User
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Data karyawan Karya Jaya Las
        $karyawan = User::where('email', 'like', '%@karyajayalas.com%')
                        ->orWhere('email', 'karyajayalas@gmail.com')
                        ->get();
        
        $totalKaryawan = $karyawan->count();
        $totalAdmin = $karyawan->where('role', 'admin')->count();
        $totalUser = $karyawan->where('role', 'user')->count();
        
        // Statistik Catatan Harian
        $totalCatatanHarian = CatatanHarian::where('user_id', $user->id)->count();
        $totalHadir = CatatanHarian::where('user_id', $user->id)->where('status', 'hadir')->count();
        $totalIzin = CatatanHarian::where('user_id', $user->id)->where('status', 'izin')->count();
        $totalSakit = CatatanHarian::where('user_id', $user->id)->where('status', 'sakit')->count();
        $totalAlpha = CatatanHarian::where('user_id', $user->id)->where('status', 'alpha')->count();
        
        // Catatan hari ini
        $catatanHariIni = CatatanHarian::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();
        
        // Statistik Gajian
        $totalGaji = CatatanGajian::where('user_id', $user->id)
            ->where('status', 'dibayar')
            ->sum('total_gaji');
        
        $totalGajiBulanIni = CatatanGajian::where('user_id', $user->id)
            ->whereMonth('tanggal_gaji', date('m'))
            ->whereYear('tanggal_gaji', date('Y'))
            ->where('status', 'dibayar')
            ->sum('total_gaji');
        
        return view('user.dashboard', compact(
            'user',
            'karyawan',
            'totalKaryawan',
            'totalAdmin',
            'totalUser',
            'totalCatatanHarian',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha',
            'catatanHariIni',
            'totalGaji',
            'totalGajiBulanIni'
        ));
    }

    /**
     * Profile User
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                unlink(storage_path('app/public/' . $user->avatar));
            }
            
            $avatar = $request->file('avatar');
            $filename = time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('avatars', $filename, 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Change Password
     */
    public function changePassword()
    {
        return view('user.change-password');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Lihat karyawan
     */
    public function karyawan()
    {
        $user = Auth::user();
        $karyawan = User::where('email', 'like', '%@karyajayalas.com%')
                        ->orWhere('email', 'karyajayalas@gmail.com')
                        ->orderBy('name')
                        ->paginate(10);
        
        return view('user.karyawan', compact('karyawan', 'user'));
    }

    /**
     * Settings User
     */
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    /**
     * Update Settings
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'notifikasi' => 'boolean',
            'theme' => 'nullable|string|in:light,dark',
            'language' => 'nullable|string|in:id,en',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan settings di session
        session(['user_settings' => $request->only(['notifikasi', 'theme', 'language'])]);

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }

    /**
     * Aktivitas User
     */
    public function aktivitas()
    {
        $user = Auth::user();
        
        // Ambil catatan harian sebagai aktivitas
        $aktivitas = CatatanHarian::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.aktivitas', compact('user', 'aktivitas'));
    }
}