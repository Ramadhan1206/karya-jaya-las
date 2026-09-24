<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    /**
     * Daftar semua karyawan
     */
    public function index(Request $request)
    {
        $query = User::where('email', 'like', '%@karyajayalas.com%')
                        ->orWhere('email', 'karyajayalas@gmail.com');

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $karyawan = $query->orderBy('name')->paginate(10);
        
        // ===== GENERATE TELEPON & JABATAN OTOMATIS =====
        $positions = [
            'Direktur Utama',
            'Manajer Produksi',
            'Welder Senior',
            'Admin',
            'Owner',
            'Supervisor',
            'Welder Junior',
            'Staff Administrasi',
            'Teknisi Las',
            'Quality Control',
        ];

        $no = 1;
        foreach ($karyawan as $user) {
            // Jika telepon kosong, generate otomatis
            if (empty($user->phone)) {
                $user->phone = '0812345678' . str_pad($no, 2, '0', STR_PAD_LEFT);
            }
            
            // Jika jabatan kosong, ambil dari daftar
            if (empty($user->position)) {
                $user->position = $positions[$no - 1] ?? 'Karyawan';
            }
            
            $no++;
        }
        
        return view('admin.karyawan.index', compact('karyawan'));
    }

    /**
     * Form tambah karyawan
     */
    public function create()
    {
        return view('admin.karyawan.create');
    }

    /**
     * Simpan karyawan baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|ends_with:karyajayalas.com',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'position' => 'nullable|string|max:100',
        ], [
            'email.ends_with' => 'Email harus menggunakan domain @karyajayalas.com',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan ' . $user->name . ' berhasil ditambahkan!');
    }

    /**
     * Form edit karyawan
     */
    public function edit($id)
    {
        $karyawan = User::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    /**
     * Update karyawan
     */
    public function update(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($karyawan->id),
                'ends_with:karyajayalas.com'
            ],
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'position' => 'nullable|string|max:100',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'email.ends_with' => 'Email harus menggunakan domain @karyajayalas.com',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'position' => $request->position,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan ' . $karyawan->name . ' berhasil diperbarui!');
    }

    /**
     * Hapus karyawan
     */
    public function destroy($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $karyawan = User::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan ' . $karyawan->name . ' berhasil dihapus!');
    }
}