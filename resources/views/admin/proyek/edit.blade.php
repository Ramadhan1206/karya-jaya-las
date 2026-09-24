@extends('layouts.app')

@section('title', 'Edit Proyek - Admin')

@section('styles')
<style>
    /* ===== ANIMASI ===== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes shimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }

    .animate-fade-up { animation: fadeInUp 0.6s ease forwards; }
    .animate-scale { animation: scaleIn 0.5s ease forwards; }
    .delay-1 { animation-delay: 0.1s; opacity: 0; }
    .delay-2 { animation-delay: 0.2s; opacity: 0; }
    .delay-3 { animation-delay: 0.3s; opacity: 0; }
    .delay-4 { animation-delay: 0.4s; opacity: 0; }

    /* ===== HEADER ===== */
    .edit-header {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        border-radius: 24px;
        padding: 40px 45px;
        color: white;
        margin-bottom: 35px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
    }
    .edit-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(102,126,234,0.06);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }
    .edit-header .content {
        position: relative;
        z-index: 1;
    }
    .edit-header .header-icon {
        font-size: 44px;
        color: #667eea;
        display: inline-block;
        background: rgba(102,126,234,0.12);
        padding: 14px 18px;
        border-radius: 16px;
        margin-bottom: 10px;
        border: 1px solid rgba(102,126,234,0.15);
    }
    .edit-header h4 {
        font-weight: 800;
        font-size: 28px;
        margin-bottom: 2px;
        letter-spacing: -0.5px;
    }
    .edit-header h4 span {
        background: linear-gradient(90deg, #667eea, #a78bfa, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% auto;
        animation: shimmer 4s linear infinite;
    }
    .edit-header p {
        opacity: 0.65;
        font-size: 15px;
        margin-bottom: 0;
        font-weight: 300;
    }
    .edit-header .proyek-name {
        display: inline-block;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 13px;
        margin-top: 8px;
        backdrop-filter: blur(10px);
    }
    .edit-header .proyek-name i {
        color: #667eea;
        margin-right: 8px;
    }

    /* ===== FORM ===== */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 35px 40px;
        box-shadow: 0 4px 30px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.3s ease;
    }
    .form-card:hover {
        box-shadow: 0 12px 50px rgba(0,0,0,0.06);
    }
    .form-card .section-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 17px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }
    .form-card .section-title i {
        color: #667eea;
        font-size: 20px;
    }
    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
    }
    .form-control:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .form-label i {
        color: #667eea;
        font-size: 14px;
    }
    .form-label .required {
        color: #e53e3e;
        font-size: 14px;
    }
    .form-select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        background: #fafbfc;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
    }
    .form-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    /* ===== TOGGLE ===== */
    .toggle-switch {
        position: relative;
        width: 50px;
        height: 28px;
        background: #e2e8f0;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .toggle-switch.active {
        background: #667eea;
        box-shadow: 0 0 20px rgba(102,126,234,0.25);
    }
    .toggle-switch .toggle-circle {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 22px;
        height: 22px;
        background: white;
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .toggle-switch.active .toggle-circle {
        left: 25px;
    }
    .toggle-switch input {
        display: none;
    }

    /* ===== FOTO EXISTING ===== */
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }
    .foto-item {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        background: #f8fafc;
        aspect-ratio: 1/1;
    }
    .foto-item:hover {
        border-color: #667eea;
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .foto-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .foto-item .foto-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(0deg, rgba(0,0,0,0.5) 0%, transparent 50%);
        opacity: 0;
        transition: all 0.3s ease;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        padding: 12px;
    }
    .foto-item:hover .foto-overlay {
        opacity: 1;
    }
    .foto-item .foto-overlay .cover-badge {
        background: #f6c23e;
        color: #1e293b;
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .foto-item .foto-overlay .delete-btn {
        background: rgba(229,62,62,0.9);
        color: white;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    .foto-item .foto-overlay .delete-btn:hover {
        background: #e53e3e;
        transform: scale(1.1);
    }
    .foto-item .foto-overlay .delete-btn.active {
        background: #e53e3e;
        box-shadow: 0 0 0 3px rgba(229,62,62,0.3);
    }
    .foto-item .foto-overlay .delete-btn input {
        display: none;
    }
    .foto-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px 20px;
        background: #f8fafc;
        border-radius: 14px;
        border: 2px dashed #e2e8f0;
        color: #94a3b8;
    }
    .foto-empty i {
        font-size: 40px;
        display: block;
        margin-bottom: 10px;
    }

    /* ===== PREVIEW ===== */
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 12px;
    }
    .preview-container .preview-item {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        position: relative;
        animation: scaleIn 0.3s ease;
    }
    .preview-container .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .preview-container .preview-item .remove-preview {
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(229,62,62,0.9);
        color: white;
        border: none;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .preview-container .preview-item .remove-preview:hover {
        background: #e53e3e;
        transform: scale(1.1);
    }

    /* ===== BUTTONS ===== */
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.4s ease;
        box-shadow: 0 4px 25px rgba(102,126,234,0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-submit:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 50px rgba(102,126,234,0.5);
        color: white;
    }
    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 14px 32px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateY(-2px);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .edit-header {
            padding: 25px 20px;
            text-align: center;
        }
        .edit-header h4 {
            font-size: 22px;
        }
        .form-card {
            padding: 20px;
        }
        .foto-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }
        .preview-container .preview-item {
            width: 80px;
            height: 80px;
        }
        .btn-submit {
            padding: 12px 24px;
            font-size: 14px;
            width: 100%;
            justify-content: center;
        }
        .btn-cancel {
            padding: 12px 24px;
            font-size: 14px;
            width: 100%;
            justify-content: center;
        }
        .edit-header .proyek-name {
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="edit-header animate-fade-up">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="content">
                    <div class="header-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h4>Edit <span>Proyek</span></h4>
                    <p>Perbarui data proyek dan kelola foto</p>
                    <div class="proyek-name">
                        <i class="fas fa-project-diagram"></i>
                        {{ $proyek->nama_proyek }}
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-light text-dark" style="padding: 6px 20px; border-radius: 50px;">
                    <i class="fas fa-clock me-1"></i>
                    Dibuat: {{ $proyek->created_at->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- ===== ALERT ===== -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate-fade-up delay-1" style="border-radius: 14px; border-left: 4px solid #38a169; box-shadow: 0 4px 20px rgba(56,161,105,0.12);">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show animate-fade-up delay-1" style="border-radius: 14px; border-left: 4px solid #e53e3e; box-shadow: 0 4px 20px rgba(229,62,62,0.12);">
            <i class="fas fa-exclamation-circle me-2"></i>
            Terjadi kesalahan:
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ===== FORM ===== -->
    <div class="form-card animate-fade-up delay-1">
        <form method="POST" action="{{ route('admin.proyek.update', $proyek->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ===== SECTION: INFORMASI DASAR ===== -->
            <div class="section-title">
                <i class="fas fa-info-circle"></i>
                Informasi Dasar
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>
                        Nama Proyek <span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('nama_proyek') is-invalid @enderror" 
                           name="nama_proyek" 
                           value="{{ old('nama_proyek', $proyek->nama_proyek) }}" 
                           placeholder="Masukkan nama proyek"
                           required>
                    @error('nama_proyek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Klien
                    </label>
                    <input type="text" 
                           class="form-control @error('klien') is-invalid @enderror" 
                           name="klien" 
                           value="{{ old('klien', $proyek->klien) }}" 
                           placeholder="Masukkan nama klien">
                    @error('klien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Lokasi
                    </label>
                    <input type="text" 
                           class="form-control @error('lokasi') is-invalid @enderror" 
                           name="lokasi" 
                           value="{{ old('lokasi', $proyek->lokasi) }}" 
                           placeholder="Masukkan lokasi proyek">
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-folder"></i>
                        Kategori
                    </label>
                    <select class="form-select @error('kategori') is-invalid @enderror" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="gedung" {{ old('kategori', $proyek->kategori) == 'gedung' ? 'selected' : '' }}>Gedung</option>
                        <option value="jembatan" {{ old('kategori', $proyek->kategori) == 'jembatan' ? 'selected' : '' }}>Jembatan</option>
                        <option value="industri" {{ old('kategori', $proyek->kategori) == 'industri' ? 'selected' : '' }}>Industri</option>
                        <option value="infrastruktur" {{ old('kategori', $proyek->kategori) == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                        <option value="lainnya" {{ old('kategori', $proyek->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-calendar-plus"></i>
                        Tanggal Mulai
                    </label>
                    <input type="date" 
                           class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                           name="tanggal_mulai" 
                           value="{{ old('tanggal_mulai', $proyek->tanggal_mulai ? $proyek->tanggal_mulai->format('Y-m-d') : '') }}">
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-calendar-check"></i>
                        Tanggal Selesai
                    </label>
                    <input type="date" 
                           class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                           name="tanggal_selesai" 
                           value="{{ old('tanggal_selesai', $proyek->tanggal_selesai ? $proyek->tanggal_selesai->format('Y-m-d') : '') }}">
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <!-- ===== SECTION: STATUS & FEATURED ===== -->
            <div class="section-title">
                <i class="fas fa-cog"></i>
                Status & Pengaturan
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-info-circle"></i>
                        Status <span class="required">*</span>
                    </label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="selesai" {{ old('status', $proyek->status) == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                        <option value="berjalan" {{ old('status', $proyek->status) == 'berjalan' ? 'selected' : '' }}>🔄 Sedang Berjalan</option>
                        <option value="direncanakan" {{ old('status', $proyek->status) == 'direncanakan' ? 'selected' : '' }}>📋 Direncanakan</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-star"></i>
                        Featured
                    </label>
                    <div class="d-flex align-items-center gap-3 mt-2">
                        <div class="toggle-switch {{ old('is_featured', $proyek->is_featured) ? 'active' : '' }}" 
                             onclick="toggleSwitch(this)">
                            <input type="checkbox" name="is_featured" value="1" 
                                   {{ old('is_featured', $proyek->is_featured) ? 'checked' : '' }}>
                            <div class="toggle-circle"></div>
                        </div>
                        <span class="text-muted small">
                            {{ old('is_featured', $proyek->is_featured) ? '✅ Proyek Unggulan' : 'Jadikan proyek unggulan' }}
                        </span>
                    </div>
                    <small class="text-muted d-block mt-1">Proyek unggulan akan ditampilkan di bagian utama</small>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              name="deskripsi" 
                              rows="4" 
                              placeholder="Masukkan deskripsi proyek">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <!-- ===== SECTION: FOTO PROYEK ===== -->
            <div class="section-title">
                <i class="fas fa-images"></i>
                Foto Proyek
            </div>

            <!-- Foto Existing -->
            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-image"></i>
                    Foto Saat Ini
                    <span class="text-muted fw-normal">({{ $proyek->foto->count() }} foto)</span>
                </label>
                
                @if($proyek->foto->count() > 0)
                    <div class="foto-grid">
                        @foreach($proyek->foto as $foto)
                            <div class="foto-item">
                                <img src="{{ asset('storage/' . $foto->foto_url) }}" alt="Foto Proyek">
                                <div class="foto-overlay">
                                    <span class="cover-badge">
                                        <i class="fas {{ $foto->is_cover ? 'fa-star' : 'fa-star-o' }}"></i>
                                        {{ $foto->is_cover ? 'COVER' : '' }}
                                    </span>
                                    <button type="button" class="delete-btn" onclick="toggleDelete(this)">
                                        <i class="fas fa-times"></i>
                                        <input type="checkbox" name="hapus_foto[]" value="{{ $foto->id }}">
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Klik tombol <i class="fas fa-times text-danger"></i> pada foto untuk menandai dihapus, lalu klik Update Proyek
                    </small>
                @else
                    <div class="foto-empty">
                        <i class="fas fa-image"></i>
                        Belum ada foto untuk proyek ini
                    </div>
                @endif
            </div>

            <!-- Upload Foto Baru -->
            <div>
                <label class="form-label">
                    <i class="fas fa-upload"></i>
                    Tambah Foto Baru
                </label>
                <input type="file" 
                       class="form-control @error('foto.*') is-invalid @enderror" 
                       name="foto[]" 
                       multiple 
                       accept="image/*"
                       onchange="previewImages(event)"
                       style="padding: 10px; border-radius: 12px; border: 2px dashed #e2e8f0;">
                <small class="form-text">Format: JPG, PNG, GIF. Maks: 5MB per file</small>
                
                <div class="preview-container" id="previewContainer"></div>
                
                @error('foto.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- ===== BUTTONS ===== -->
            <div class="d-flex flex-wrap justify-content-between gap-3 mt-4 pt-3 border-top">
                <button type="button" class="btn-cancel" onclick="window.location.href='{{ route('admin.proyek.index') }}'">
                    <i class="fas fa-arrow-left"></i> Batal
                </button>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Update Proyek
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // ===== PREVIEW IMAGES =====
    function previewImages(event) {
        const container = document.getElementById('previewContainer');
        container.innerHTML = '';
        
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${i}">
                    <button type="button" class="remove-preview" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(div);
            }
            reader.readAsDataURL(files[i]);
        }
    }

    // ===== TOGGLE SWITCH =====
    function toggleSwitch(element) {
        const checkbox = element.querySelector('input[type="checkbox"]');
        const label = element.parentElement.querySelector('span:last-child');
        
        checkbox.checked = !checkbox.checked;
        element.classList.toggle('active');
        
        if (checkbox.checked) {
            label.textContent = '✅ Proyek Unggulan';
        } else {
            label.textContent = 'Jadikan proyek unggulan';
        }
    }

    // ===== TOGGLE DELETE =====
    function toggleDelete(button) {
        const checkbox = button.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
        button.classList.toggle('active');
        
        const icon = button.querySelector('i');
        if (checkbox.checked) {
            icon.className = 'fas fa-check';
            button.style.background = '#e53e3e';
            button.style.boxShadow = '0 0 0 3px rgba(229,62,62,0.3)';
        } else {
            icon.className = 'fas fa-times';
            button.style.background = 'rgba(229,62,62,0.9)';
            button.style.boxShadow = 'none';
        }
    }

    // ===== INITIALIZE TOGGLE SWITCH =====
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-switch').forEach(function(el) {
            const checkbox = el.querySelector('input[type="checkbox"]');
            if (checkbox.checked) {
                el.classList.add('active');
            }
        });
    });
</script>
@endsection