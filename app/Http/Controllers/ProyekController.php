<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\FotoProyek;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProyekController extends Controller
{
    // ============ HAPUS CONSTRUCTOR INI ============
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'admin'])->except(['index', 'show']);
    // }

    // ============================================================
    // USER - PUBLIC
    // ============================================================

    public function index(Request $request)
    {
        $query = Proyek::with('cover')->orderBy('created_at', 'desc');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_proyek', 'like', '%' . $request->search . '%')
                  ->orWhere('klien', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        }

        $proyek = $query->paginate(9);
        $kategoris = ['gedung', 'jembatan', 'industri', 'infrastruktur', 'lainnya'];
        $statuses = ['selesai', 'berjalan', 'direncanakan'];

        return view('user.proyek.index', compact('proyek', 'kategoris', 'statuses'));
    }

    public function show($slug)
    {
        $proyek = Proyek::with('foto')->where('slug', $slug)->firstOrFail();
        $proyek->increment('views');

        $related = Proyek::where('kategori', $proyek->kategori)
            ->where('id', '!=', $proyek->id)
            ->where('status', 'selesai')
            ->with('cover')
            ->take(4)
            ->get();

        return view('user.proyek.show', compact('proyek', 'related'));
    }

    // ============================================================
    // ADMIN - MANAGEMENT
    // ============================================================

    public function adminIndex(Request $request)
    {
        $query = Proyek::with('cover')->orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_proyek', 'like', '%' . $request->search . '%')
                  ->orWhere('klien', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $proyek = $query->paginate(10);
        $statuses = ['selesai', 'berjalan', 'direncanakan'];

        // Statistik
        $totalProyek = Proyek::count();
        $totalSelesai = Proyek::where('status', 'selesai')->count();
        $totalBerjalan = Proyek::where('status', 'berjalan')->count();
        $totalDirencanakan = Proyek::where('status', 'direncanakan')->count();

        return view('admin.proyek.index', compact(
            'proyek',
            'statuses',
            'totalProyek',
            'totalSelesai',
            'totalBerjalan',
            'totalDirencanakan'
        ));
    }

    public function create()
    {
        return view('admin.proyek.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_proyek' => 'required|string|max:255',
            'klien' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'kategori' => 'nullable|string|max:100',
            'status' => 'required|in:selesai,berjalan,direncanakan',
            'is_featured' => 'nullable|boolean',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $slug = Str::slug($request->nama_proyek);
        $slugCount = Proyek::where('slug', 'like', $slug . '%')->count();
        if ($slugCount > 0) {
            $slug = $slug . '-' . ($slugCount + 1);
        }

        $proyek = Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'slug' => $slug,
            'klien' => $request->klien,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'is_featured' => $request->is_featured ?? false,
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('proyek', $filename, 'public');

                FotoProyek::create([
                    'proyek_id' => $proyek->id,
                    'foto_url' => $path,
                    'is_cover' => $index === 0,
                    'urutan' => $index,
                ]);
            }
        }

        return redirect()->route('admin.proyek.index')
            ->with('success', 'Proyek "' . $proyek->nama_proyek . '" berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $proyek = Proyek::with('foto')->findOrFail($id);
        return view('admin.proyek.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $proyek = Proyek::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_proyek' => 'required|string|max:255',
            'klien' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'kategori' => 'nullable|string|max:100',
            'status' => 'required|in:selesai,berjalan,direncanakan',
            'is_featured' => 'nullable|boolean',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $slug = Str::slug($request->nama_proyek);
        if ($slug !== $proyek->slug) {
            $slugCount = Proyek::where('slug', 'like', $slug . '%')->where('id', '!=', $id)->count();
            if ($slugCount > 0) {
                $slug = $slug . '-' . ($slugCount + 1);
            }
        }

        $proyek->update([
            'nama_proyek' => $request->nama_proyek,
            'slug' => $slug,
            'klien' => $request->klien,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'is_featured' => $request->is_featured ?? false,
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('proyek', $filename, 'public');

                FotoProyek::create([
                    'proyek_id' => $proyek->id,
                    'foto_url' => $path,
                    'is_cover' => $index === 0 && $proyek->foto->count() === 0,
                    'urutan' => $proyek->foto->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.proyek.index')
            ->with('success', 'Proyek "' . $proyek->nama_proyek . '" berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);

        foreach ($proyek->foto as $foto) {
            if (Storage::disk('public')->exists($foto->foto_url)) {
                Storage::disk('public')->delete($foto->foto_url);
            }
            $foto->delete();
        }

        $proyek->delete();

        return redirect()->route('admin.proyek.index')
            ->with('success', 'Proyek "' . $proyek->nama_proyek . '" berhasil dihapus!');
    }

    public function deleteFoto($id)
    {
        $foto = FotoProyek::findOrFail($id);
        $proyekId = $foto->proyek_id;

        if (Storage::disk('public')->exists($foto->foto_url)) {
            Storage::disk('public')->delete($foto->foto_url);
        }

        $foto->delete();

        return redirect()->route('admin.proyek.edit', $proyekId)
            ->with('success', 'Foto berhasil dihapus!');
    }

    public function setCover($id)
    {
        $foto = FotoProyek::findOrFail($id);
        $proyekId = $foto->proyek_id;

        FotoProyek::where('proyek_id', $proyekId)->update(['is_cover' => false]);
        $foto->update(['is_cover' => true]);

        return redirect()->route('admin.proyek.edit', $proyekId)
            ->with('success', 'Foto cover berhasil diubah!');
    }

    public function adminShow($id)
    {
        $proyek = Proyek::with('foto')->findOrFail($id);
        return view('admin.proyek.show', compact('proyek'));
    }
}