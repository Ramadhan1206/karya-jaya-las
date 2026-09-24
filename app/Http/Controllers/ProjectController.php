<?php
// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Menampilkan daftar proyek dengan filter
    public function index(Request $request)
    {
        $query = Project::query();

        // Filter kategori
        if ($request->filled('category') && $request->category !== 'Semua Kategori') {
            $query->where('category', $request->category);
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $query->where('status', $request->status);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%")
                  ->orWhere('client', 'like', "%{$request->search}%");
            });
        }

        $projects = $query->latest()->paginate(10);
        
        // Untuk filter dropdown
        $categories = Project::distinct()->pluck('category');
        $statuses = ['Semua Status', 'dalam_proses', 'selesai', 'ditunda'];

        return view('projects.index', compact('projects', 'categories', 'statuses'));
    }

    // Menampilkan form tambah proyek
    public function create()
    {
        return view('projects.create');
    }

    // Menyimpan proyek baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'status' => 'required|in:dalam_proses,selesai,ditunda',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        Project::create($validated);

        return redirect()->route('projects.index')
                         ->with('success', 'Proyek berhasil ditambahkan!');
    }

    // Menampilkan detail proyek
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Menampilkan form edit proyek
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Mengupdate proyek
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'status' => 'required|in:dalam_proses,selesai,ditunda',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        $project->update($validated);

        return redirect()->route('projects.index')
                         ->with('success', 'Proyek berhasil diperbarui!');
    }

    // Menghapus proyek
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();

        return redirect()->route('projects.index')
                         ->with('success', 'Proyek berhasil dihapus!');
    }
}