<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        // Ambil data karyawan (hanya yang satu perusahaan)
        $karyawan = User::where('email', 'like', '%@karyajayalas.com%')
                        ->orWhere('email', 'karyajayalas@gmail.com')
                        ->get();
        
        // Statistik
        $totalKaryawan = $karyawan->count();
        $totalAdmin = $karyawan->where('role', 'admin')->count();
        
        // Data untuk chart (opsional)
        $bulanIni = User::where('email', 'like', '%@karyajayalas.com%')
                        ->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
        
        return view('user.dashboard', compact(
            'user',
            'karyawan',
            'totalKaryawan',
            'totalAdmin',
            'bulanIni'
        ));
    }
}