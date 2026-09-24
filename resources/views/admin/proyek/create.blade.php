@extends('layouts.app')

@section('title', 'Tambah Proyek - Admin')

@section('styles')
<style>
    /* ===== HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .page-header .content {
        position: relative;
        z-index: 1;
    }
    .page-header h4 {
        font-weight: 700;
        margin-bottom: 2px;
    }
    .page-header p {
        opacity: 0.8;
        margin-bottom: 0;
        font-size: 14px;
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
    }
    .form-card .form-section {
        margin-bottom: 30px;
    }
    .form-card .form-section .section-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 16px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f2f5;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-card .form-section .section-title i {
        color: #667eea;
    }

    /* ===== FORM CONTROL ===== */
    .form-control, .form-select {
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        padding: 12px 16px;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
        height: 48px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
    }
    .form-control::placeholder {
        color: #a0aec0;
        font-size: 13px;
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 5px;
    }
    .form-label .required {
        color: #e53e3e;
        margin-left: 2px;
    }
    .form-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    /* ===== TEXTAREA ===== */
    textarea.form-control {
        height: auto;
        resize: vertical;
        min-height: 100px;
    }

    /* ===== FILE UPLOAD ===== */
    .file-upload-wrapper {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background: #fafbfc;
    }
    .file-upload-wrapper:hover {
        border-color: #667eea;
        background: #f8faff;
    }
    .file-upload-wrapper .upload-icon {
        font-size: 40px;
        color: #667eea;
        margin-bottom: 10px;
    }
    .file-upload-wrapper .upload-text {
        color: #64748b;
        font-size: 14px;
    }
    .file-upload-wrapper .upload-text strong {
        color: #667eea;
    }
    .file-upload-wrapper .upload-hint {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 5px;
    }

    /* ===== PREVIEW IMAGES ===== */
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 15px;
    }
    .preview-item {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        position: relative;
        background: #f8fafc;
    }
    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .preview-item .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #e53e3e;
        color: white;
        border: none;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .preview-item .remove-btn:hover {
        transform: scale(1.1);
        background: #c53030;
    }

    /* ===== CHECKBOX ===== */
    .form-check-input {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    .form-check-label {
        font-weight: 500;
        color: #334155;
        font-size: 14px;
        cursor: pointer;
    }
    .form-check .helper-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 2px;
        padding-left: 28px;
    }

    /* ===== BUTTON ===== */
    .btn-back {
        border-radius: 12px;
        padding: 10px 28px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f1f5f9;
        color: #475569;
        border: none;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateX(-3px);
    }
    .btn-submit {
        border-radius: 12px;
        padding: 10px 36px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(102,126,234,0.3);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(102,126,234,0.4);
        color: white;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
            text-align: center;
        }
        .form-card {
            padding: 20px;
        }
        .form-control, .form-select {
            height: 44px;
            font-size: 13px;
        }
        .file-upload-wrapper {
            padding: 20px;
        }
        .file-upload-wrapper .upload-icon {
            font-size: 30px;
        }
        .preview-item {
            width: 80px;
            height: 80px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="content">
                    <h4>
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Proyek
                    </h4>
                    <p>Tambahkan data proyek baru dengan lengkap</p>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-project-diagram me-1"></i>
                    Proyek Baru
                </span>
            </div>
        </div>
    </div>

    <!-- ===== ALERT ===== -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
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
    <div class="form-card">
        <form method="POST" action="{{ route('admin.proyek.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- ===== INFORMASI PROYEK ===== -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Proyek
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nama Proyek <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_proyek') is-invalid @enderror" 
                               name="nama_proyek" 
                               value="{{ old('nama_proyek') }}" 
                               placeholder="Masukkan nama proyek" 
                               required>
                        @error('nama_proyek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Klien
                        </label>
                        <input type="text" 
                               class="form-control @error('klien') is-invalid @enderror" 
                               name="klien" 
                               value="{{ old('klien') }}" 
                               placeholder="Masukkan nama klien">
                        @error('klien')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Lokasi
                        </label>
                        <input type="text" 
                               class="form-control @error('lokasi') is-invalid @enderror" 
                               name="lokasi" 
                               value="{{ old('lokasi') }}" 
                               placeholder="Masukkan lokasi proyek">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Kategori
                        </label>
                        <select class="form-select @error('kategori') is-invalid @enderror" name="kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="gedung" {{ old('kategori') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                            <option value="jembatan" {{ old('kategori') == 'jembatan' ? 'selected' : '' }}>Jembatan</option>
                            <option value="industri" {{ old('kategori') == 'industri' ? 'selected' : '' }}>Industri</option>
                            <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Tanggal Mulai
                        </label>
                        <input type="date" 
                               class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                               name="tanggal_mulai" 
                               value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Tanggal Selesai
                        </label>
                        <input type="date" 
                               class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                               name="tanggal_selesai" 
                               value="{{ old('tanggal_selesai') }}">
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Status <span class="required">*</span>
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="berjalan" {{ old('status') == 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                            <option value="direncanakan" {{ old('status') == 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ===== DESKRIPSI ===== -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-align-left"></i>
                    Deskripsi Proyek
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  name="deskripsi" 
                                  rows="4" 
                                  placeholder="Masukkan deskripsi proyek secara lengkap">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ===== FOTO PROYEK ===== -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-images"></i>
                    Foto Proyek
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Upload Foto</label>
                        <div class="file-upload-wrapper" onclick="document.getElementById('fileInput').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                <strong>Klik untuk upload</strong> atau drag & drop
                            </div>
                            <div class="upload-hint">
                                Format: JPG, PNG, GIF | Maks: 5MB per file
                            </div>
                            <input type="file" 
                                   id="fileInput" 
                                   class="d-none" 
                                   name="foto[]" 
                                   multiple 
                                   accept="image/*"
                                   onchange="previewImages(event)">
                        </div>
                        @error('foto.*')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="preview-container" id="previewContainer"></div>
                    </div>
                </div>
            </div>

            <!-- ===== FEATURED ===== -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-star"></i>
                    Pengaturan Featured
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input @error('is_featured') is-invalid @enderror" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1" 
                                   {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                <i class="fas fa-star text-warning me-1"></i>
                                Jadikan Proyek Unggulan
                            </label>
                            <div class="helper-text">
                                Proyek akan ditampilkan di halaman utama sebagai proyek unggulan
                            </div>
                        </div>
                        @error('is_featured')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ===== BUTTON ===== -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('admin.proyek.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i>Simpan Proyek
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImages(event) {
        const container = document.getElementById('previewContainer');
        const files = event.target.files;
        
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'preview-item';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview ' + i;
                
                const btn = document.createElement('button');
                btn.className = 'remove-btn';
                btn.innerHTML = '×';
                btn.onclick = function() {
                    wrapper.remove();
                };
                
                wrapper.appendChild(img);
                wrapper.appendChild(btn);
                container.appendChild(wrapper);
            }
            reader.readAsDataURL(files[i]);
        }
    }
</script>
@endsection
