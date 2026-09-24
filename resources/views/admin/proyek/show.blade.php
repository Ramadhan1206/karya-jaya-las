@extends('layouts.app')

@section('title', 'Detail Proyek - ' . $proyek->nama_proyek)

@section('styles')
<style>
    /* ===== PROJECT HEADER ===== */
    .project-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 30px 35px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .project-header::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .project-header h2 {
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 2px;
        position: relative;
        z-index: 1;
    }
    .project-header .subtitle {
        opacity: 0.85;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }
    .project-header .badge-status {
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
        position: relative;
        z-index: 1;
    }
    .badge-selesai { background: #38a169; color: white; }
    .badge-berjalan { background: #ed8936; color: white; }
    .badge-direncanakan { background: #4299e1; color: white; }
    .badge-featured {
        background: #f6c23e;
        color: #1e293b;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
        position: relative;
        z-index: 1;
    }

    /* ===== GALLERY ===== */
    .gallery-container {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .gallery-container .main-image {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .gallery-container .main-image:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .gallery-container .thumbnail {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .gallery-container .thumbnail:hover {
        border-color: #667eea;
        transform: scale(1.05);
    }
    .gallery-container .thumbnail.active {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
    }
    .gallery-container .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 350px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px dashed #e2e8f0;
        flex-direction: column;
    }
    .gallery-container .no-image i {
        font-size: 60px;
        color: #cbd5e1;
        margin-bottom: 10px;
    }
    .gallery-container .no-image p {
        color: #94a3b8;
        font-size: 16px;
        margin-bottom: 0;
    }

    /* ===== INFO CARD ===== */
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .info-card .info-item {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .info-card .info-item:last-child {
        border-bottom: none;
    }
    .info-card .info-item .label {
        color: #64748b;
        font-weight: 500;
        font-size: 14px;
    }
    .info-card .info-item .value {
        color: #1e293b;
        font-weight: 600;
        font-size: 14px;
        text-align: right;
    }
    .info-card .info-item .value i {
        margin-right: 6px;
    }
    .info-card .description {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    .info-card .description h6 {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .info-card .description p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* ===== BUTTON ===== */
    .btn-action {
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* ===== MODAL IMAGE ===== */
    .modal-image {
        width: 100%;
        max-height: 80vh;
        object-fit: contain;
        border-radius: 8px;
    }
    .modal-content-transparent {
        background: transparent;
        border: none;
    }
    .btn-close-white {
        filter: invert(1);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .project-header {
            padding: 20px;
            text-align: center;
        }
        .project-header h2 {
            font-size: 22px;
        }
        .project-header .badge-status {
            font-size: 11px;
            padding: 4px 14px;
        }
        .gallery-container {
            padding: 15px;
        }
        .gallery-container .main-image {
            max-height: 250px;
        }
        .gallery-container .thumbnail {
            height: 60px;
        }
        .info-card {
            padding: 15px;
        }
        .info-card .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        .info-card .info-item .value {
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="project-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3 mb-2 flex-wrap">
                    <h2 class="mb-0">{{ $proyek->nama_proyek }}</h2>
                    @if($proyek->is_featured)
                        <span class="badge-featured">
                            <i class="fas fa-star me-1"></i>Featured
                        </span>
                    @endif
                </div>
                <p class="subtitle mb-2">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Dibuat: {{ $proyek->created_at->format('d F Y') }}
                    @if($proyek->updated_at)
                        | Terakhir update: {{ $proyek->updated_at->format('d F Y') }}
                    @endif
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge-status badge-{{ $proyek->status }}">
                        <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                        {{ $proyek->status_label }}
                    </span>
                    <span class="badge-status" style="background: #718096; color: white;">
                        <i class="fas fa-eye me-1"></i>
                        {{ $proyek->views }} kali dilihat
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-end mt-3 mt-md-0">
                <div class="d-flex gap-2 justify-content-end flex-wrap">
                    <a href="{{ route('admin.proyek.edit', $proyek->id) }}" class="btn btn-light btn-action">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.proyek.destroy', $proyek->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Yakin ingin menghapus proyek ini?')">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== CONTENT ===== -->
    <div class="row g-4">
        <!-- ===== GALLERY ===== -->
        <div class="col-lg-8">
            <div class="gallery-container">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-images me-2 text-primary"></i>Galeri Foto Proyek
                    <span class="text-muted fw-normal ms-2">({{ $proyek->foto->count() }} foto)</span>
                </h6>

                @if($proyek->foto->count() > 0)
                    <!-- Main Image -->
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $proyek->cover->foto_url ?? $proyek->foto->first()->foto_url) }}" 
                             class="main-image" 
                             alt="{{ $proyek->nama_proyek }}"
                             id="mainImage"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal"
                             onclick="showImageModal('{{ asset('storage/' . ($proyek->cover->foto_url ?? $proyek->foto->first()->foto_url)) }}')">
                    </div>

                    <!-- Thumbnails -->
                    @if($proyek->foto->count() > 1)
                        <div class="row g-2">
                            @foreach($proyek->foto as $foto)
                                <div class="col-2">
                                    <img src="{{ asset('storage/' . $foto->foto_url) }}" 
                                         class="thumbnail {{ $foto->is_cover ? 'active' : '' }}"
                                         alt="Thumbnail"
                                         onclick="changeImage('{{ asset('storage/' . $foto->foto_url) }}', this)">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="no-image">
                        <i class="fas fa-image"></i>
                        <p>Belum ada foto untuk proyek ini</p>
                        <small class="text-muted">Tambahkan foto saat mengedit proyek</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- ===== INFO ===== -->
        <div class="col-lg-4">
            <div class="info-card">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-info-circle me-2 text-primary"></i>Informasi Proyek
                </h6>

                <div class="info-item">
                    <span class="label"><i class="fas fa-tag me-1"></i>Kategori</span>
                    <span class="value">{{ ucfirst($proyek->kategori ?? '-') }}</span>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-user me-1"></i>Klien</span>
                    <span class="value">{{ $proyek->klien ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-map-marker-alt me-1"></i>Lokasi</span>
                    <span class="value">{{ $proyek->lokasi ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-calendar-plus me-1"></i>Tanggal Mulai</span>
                    <span class="value">{{ $proyek->tanggal_mulai ? $proyek->tanggal_mulai->format('d/m/Y') : '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-calendar-check me-1"></i>Tanggal Selesai</span>
                    <span class="value">{{ $proyek->tanggal_selesai ? $proyek->tanggal_selesai->format('d/m/Y') : '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-eye me-1"></i>Dilihat</span>
                    <span class="value">{{ $proyek->views }} kali</span>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-clock me-1"></i>Status</span>
                    <span class="value">
                        <span class="badge-status badge-{{ $proyek->status }}" style="font-size: 12px; padding: 4px 14px;">
                            {{ $proyek->status_label }}
                        </span>
                    </span>
                </div>

                @if($proyek->deskripsi)
                    <div class="description">
                        <h6><i class="fas fa-align-left me-2 text-primary"></i>Deskripsi</h6>
                        <p>{{ $proyek->deskripsi }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== BACK BUTTON ===== -->
    <div class="mt-4">
        <a href="{{ route('admin.proyek.index') }}" class="btn btn-secondary btn-action">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Proyek
        </a>
    </div>
</div>

<!-- ===== MODAL IMAGE ===== -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-transparent">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                        data-bs-dismiss="modal" style="z-index: 10;"></button>
                <img src="" class="modal-image w-100" id="modalImage">
            </div>
        </div>
    </div>
</div>

<script>
    // Change main image
    function changeImage(src, element) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(el => {
            el.classList.remove('active');
        });
        element.classList.add('active');
    }

    // Show image modal
    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
    }

    // Set initial modal image
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            document.getElementById('modalImage').src = mainImage.src;
        }
    });
</script>
@endsection