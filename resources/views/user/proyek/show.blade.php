@extends('layouts.app')

@section('title', $proyek->nama_proyek . ' - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #4f46e5;
        --primary-light: #818cf8;
        --primary-dark: #3730a3;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        
        --success: #10b981;
        --success-bg: #ecfdf5;
        --warning: #f59e0b;
        --warning-bg: #fffbeb;
        --danger: #ef4444;
        --danger-bg: #fef2f2;
        --info: #3b82f6;
        --info-bg: #eff6ff;
        
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        --shadow-xl: 0 20px 60px rgba(0,0,0,0.10);
        
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-full: 9999px;
        
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    body {
        background: #f0f2f8;
    }

    /* ============================================================
       PAGE HEADER
    ============================================================ */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-header .left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 13px;
        background: white;
        color: var(--gray-700);
        text-decoration: none;
        border: 1px solid var(--gray-200);
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }

    .btn-back:hover {
        background: var(--gray-50);
        color: var(--gray-900);
        transform: translateX(-4px);
        box-shadow: var(--shadow-md);
        border-color: var(--gray-300);
    }

    .btn-back i {
        font-size: 12px;
    }

    .page-header .breadcrumb-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--gray-500);
    }

    .page-header .breadcrumb-info i {
        font-size: 10px;
        color: var(--gray-300);
    }

    .page-header .breadcrumb-info .current {
        color: var(--primary);
        font-weight: 600;
    }

    /* ============================================================
       MAIN CARD - GALLERY
    ============================================================ */
    .main-card {
        background: white;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: var(--transition);
    }

    .main-card:hover {
        box-shadow: var(--shadow-lg);
    }

    /* ============================================================
       GALLERY HERO
    ============================================================ */
    .gallery-hero {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 10;
        background: linear-gradient(135deg, #1e1b4b, #312e81);
        overflow: hidden;
        cursor: pointer;
    }

    .gallery-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-hero:hover img {
        transform: scale(1.03);
    }

    .gallery-hero .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
        opacity: 0;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 28px;
    }

    .gallery-hero:hover .overlay {
        opacity: 1;
    }

    .gallery-hero .overlay .zoom-hint {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        color: white;
        padding: 8px 16px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        width: fit-content;
        border: 1px solid rgba(255,255,255,0.2);
        animation: pulseHint 2s ease-in-out infinite;
    }

    @keyframes pulseHint {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.03); }
    }

    .gallery-hero .overlay .zoom-hint i {
        font-size: 11px;
    }

    .gallery-hero .image-counter {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(10px);
        color: white;
        padding: 6px 14px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .gallery-hero .image-counter i {
        font-size: 10px;
        color: #a5b4fc;
    }

    /* ============================================================
       THUMBNAIL STRIP
    ============================================================ */
    .thumbnail-strip {
        padding: 20px 24px 24px;
        background: white;
        border-top: 1px solid var(--gray-100);
    }

    .thumbnail-strip .strip-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .thumbnail-strip .strip-header h6 {
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .thumbnail-strip .strip-header h6 i {
        color: var(--primary);
        font-size: 12px;
    }

    .thumbnail-strip .strip-header .count {
        font-size: 11px;
        font-weight: 600;
        color: var(--gray-500);
        background: var(--gray-100);
        padding: 3px 10px;
        border-radius: var(--radius-full);
    }

    .thumbnail-list {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 8px;
        scroll-behavior: smooth;
    }

    .thumbnail-list::-webkit-scrollbar {
        height: 4px;
    }

    .thumbnail-list::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .thumbnail-list::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }

    .thumbnail-list::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }

    .thumbnail-item {
        position: relative;
        flex-shrink: 0;
        width: 100px;
        height: 72px;
        border-radius: var(--radius-md);
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition-bounce);
        background: var(--gray-100);
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .thumbnail-item:hover {
        transform: translateY(-4px) scale(1.02);
        border-color: var(--primary-light);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.2);
    }

    .thumbnail-item.active {
        border-color: var(--primary);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
    }

    .thumbnail-item.active::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(99, 102, 241, 0.15);
        border: 2px solid white;
        border-radius: var(--radius-md);
    }

    .thumbnail-item .cover-badge {
        position: absolute;
        top: 4px;
        left: 4px;
        background: linear-gradient(135deg, #f59e0b, #ef4444);
        color: white;
        padding: 2px 8px;
        border-radius: var(--radius-full);
        font-size: 9px;
        font-weight: 700;
        z-index: 2;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
    }

    /* ============================================================
       INFO CARD - SIDEBAR
    ============================================================ */
    .info-card {
        background: white;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: var(--transition);
        position: sticky;
        top: 20px;
    }

    .info-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .info-card .card-header-custom {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        padding: 24px 24px 20px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .info-card .card-header-custom::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .info-card .card-header-custom::after {
        content: '';
        position: absolute;
        bottom: -50%;
        left: -20%;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }

    .info-card .card-header-custom .content {
        position: relative;
        z-index: 1;
    }

    .info-card .card-header-custom .status-badge-wrap {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .status-badge-premium {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .status-badge-premium i {
        font-size: 10px;
    }

    .status-badge-premium.selesai {
        background: rgba(16, 185, 129, 0.25);
        color: #d1fae5;
    }

    .status-badge-premium.proses {
        background: rgba(245, 158, 11, 0.25);
        color: #fef3c7;
    }

    .status-badge-premium.draft {
        background: rgba(107, 114, 128, 0.25);
        color: #e5e7eb;
    }

    .status-badge-premium.batal {
        background: rgba(239, 68, 68, 0.25);
        color: #fecaca;
    }

    .status-badge-premium.featured {
        background: rgba(251, 191, 36, 0.25);
        color: #fef3c7;
    }

    .info-card .card-header-custom h4 {
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .info-card .card-header-custom p {
        font-size: 13px;
        opacity: 0.7;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-card .card-header-custom p i {
        font-size: 11px;
    }

    /* ============================================================
       INFO LIST
    ============================================================ */
    .info-list {
        padding: 8px 0;
    }

    .info-item-premium {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 24px;
        transition: var(--transition);
        border-bottom: 1px solid var(--gray-50);
    }

    .info-item-premium:last-child {
        border-bottom: none;
    }

    .info-item-premium:hover {
        background: var(--gray-50);
    }

    .info-item-premium .icon-box {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
        transition: var(--transition);
    }

    .info-item-premium:hover .icon-box {
        transform: scale(1.05) rotate(-3deg);
    }

    .info-item-premium .icon-box.indigo { background: #eef2ff; color: #4f46e5; }
    .info-item-premium .icon-box.green { background: #ecfdf5; color: #10b981; }
    .info-item-premium .icon-box.orange { background: #fffbeb; color: #f59e0b; }
    .info-item-premium .icon-box.blue { background: #eff6ff; color: #3b82f6; }
    .info-item-premium .icon-box.purple { background: #f5f3ff; color: #8b5cf6; }
    .info-item-premium .icon-box.pink { background: #fdf2f8; color: #ec4899; }

    .info-item-premium .info-content {
        flex: 1;
        min-width: 0;
    }

    .info-item-premium .info-content .label {
        font-size: 11px;
        font-weight: 600;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: block;
        margin-bottom: 2px;
    }

    .info-item-premium .info-content .value {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-900);
        display: block;
        word-break: break-word;
        line-height: 1.3;
    }

    .info-item-premium .info-content .value.muted {
        color: var(--gray-400);
        font-weight: 400;
        font-style: italic;
    }

    /* ============================================================
       DESCRIPTION CARD
    ============================================================ */
    .description-section {
        padding: 20px 24px 24px;
        border-top: 1px solid var(--gray-100);
        background: var(--gray-50);
    }

    .description-section h6 {
        font-size: 12px;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .description-section h6 i {
        color: var(--primary);
        font-size: 12px;
    }

    .description-section p {
        font-size: 13px;
        color: var(--gray-700);
        line-height: 1.7;
        margin: 0;
        font-weight: 400;
    }

    /* ============================================================
       MODAL - ULTRA PREMIUM GALLERY
    ============================================================ */
    .modal-gallery .modal-content {
        background: transparent;
        border: none;
        box-shadow: none;
    }

    .modal-gallery .modal-body {
        padding: 0;
        position: relative;
    }

    .modal-gallery .gallery-container {
        position: relative;
        width: 100%;
        max-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.95);
        border-radius: var(--radius-xl);
        overflow: hidden;
        backdrop-filter: blur(20px);
    }

    .modal-gallery .gallery-container img {
        max-width: 100%;
        max-height: 85vh;
        object-fit: contain;
        border-radius: var(--radius-lg);
        animation: zoomIn 0.4s ease;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .modal-gallery .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-bounce);
        z-index: 10;
    }

    .modal-gallery .close-btn:hover {
        background: rgba(239, 68, 68, 0.8);
        transform: rotate(90deg) scale(1.1);
        border-color: rgba(239, 68, 68, 0.5);
    }

    .modal-gallery .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-bounce);
        z-index: 10;
    }

    .modal-gallery .nav-btn:hover {
        background: rgba(99, 102, 241, 0.8);
        transform: translateY(-50%) scale(1.1);
        border-color: rgba(99, 102, 241, 0.5);
    }

    .modal-gallery .nav-btn.prev {
        left: 20px;
    }

    .modal-gallery .nav-btn.next {
        right: 20px;
    }

    .modal-gallery .image-info {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(10px);
        color: white;
        padding: 8px 20px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        border: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-gallery .image-info i {
        color: #a5b4fc;
        font-size: 11px;
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .animate-in.delay-1 { animation-delay: 0.1s; }
    .animate-in.delay-2 { animation-delay: 0.2s; }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .info-card {
            position: static;
            margin-top: 24px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header .breadcrumb-info {
            font-size: 12px;
        }

        .gallery-hero {
            aspect-ratio: 4 / 3;
        }

        .gallery-hero .overlay {
            padding: 20px;
        }

        .thumbnail-strip {
            padding: 16px;
        }

        .thumbnail-item {
            width: 80px;
            height: 60px;
        }

        .info-card .card-header-custom {
            padding: 20px;
        }

        .info-card .card-header-custom h4 {
            font-size: 18px;
        }

        .info-item-premium {
            padding: 12px 20px;
        }

        .info-item-premium .icon-box {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

        .info-item-premium .info-content .value {
            font-size: 13px;
        }

        .description-section {
            padding: 16px 20px 20px;
        }

        .modal-gallery .nav-btn {
            width: 40px;
            height: 40px;
            font-size: 14px;
        }

        .modal-gallery .nav-btn.prev { left: 10px; }
        .modal-gallery .nav-btn.next { right: 10px; }

        .modal-gallery .close-btn {
            width: 38px;
            height: 38px;
            font-size: 15px;
            top: 12px;
            right: 12px;
        }
    }

    @media (max-width: 480px) {
        .btn-back {
            padding: 8px 16px;
            font-size: 12px;
        }

        .gallery-hero .image-counter {
            top: 12px;
            right: 12px;
            padding: 4px 10px;
            font-size: 11px;
        }

        .thumbnail-strip {
            padding: 12px;
        }

        .thumbnail-strip .strip-header h6 {
            font-size: 12px;
        }

        .thumbnail-item {
            width: 70px;
            height: 52px;
        }

        .info-card .card-header-custom h4 {
            font-size: 16px;
        }

        .info-item-premium {
            padding: 10px 16px;
            gap: 12px;
        }

        .info-item-premium .icon-box {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .info-item-premium .info-content .label {
            font-size: 10px;
        }

        .info-item-premium .info-content .value {
            font-size: 12px;
        }

        .status-badge-premium {
            font-size: 10px;
            padding: 4px 10px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- ============================================================
    PAGE HEADER
    ============================================================ -->
    <div class="page-header animate-in">
        <div class="left">
            <a href="{{ route('proyek.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <div class="breadcrumb-info d-none d-md-flex">
                <span>Proyek</span>
                <i class="fas fa-chevron-right"></i>
                <span class="current">{{ Str::limit($proyek->nama_proyek, 40) }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- ============================================================
        KOLOM KIRI - GALLERY
        ============================================================ -->
        <div class="col-lg-8">
            <div class="main-card animate-in delay-1">
                <!-- Hero Image -->
                <div class="gallery-hero" 
                     data-bs-toggle="modal" 
                     data-bs-target="#imageModal"
                     onclick="openGallery(0)">
                    @if($proyek->cover)
                        <img src="{{ asset('storage/' . $proyek->cover->foto_url) }}" 
                             alt="{{ $proyek->nama_proyek }}"
                             id="heroImage">
                        <div class="image-counter">
                            <i class="fas fa-images"></i>
                            <span id="heroCounter">1 / {{ $proyek->foto->count() }}</span>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="text-center text-white">
                                <i class="fas fa-image fa-4x mb-3" style="opacity: 0.3;"></i>
                                <p style="opacity: 0.5;">Belum ada foto</p>
                            </div>
                        </div>
                    @endif
                    <div class="overlay">
                        <span class="zoom-hint">
                            <i class="fas fa-expand"></i>
                            Klik untuk melihat galeri
                        </span>
                    </div>
                </div>

                <!-- Thumbnail Strip -->
                @if($proyek->foto->count() > 0)
                    <div class="thumbnail-strip">
                        <div class="strip-header">
                            <h6>
                                <i class="fas fa-images"></i>
                                Galeri Foto
                            </h6>
                            <span class="count">{{ $proyek->foto->count() }} Foto</span>
                        </div>
                        <div class="thumbnail-list">
                            @foreach($proyek->foto as $index => $foto)
                                <div class="thumbnail-item {{ $foto->is_cover ? 'active' : '' }}"
                                     onclick="openGallery({{ $index }})"
                                     data-index="{{ $index }}">
                                    <img src="{{ asset('storage/' . $foto->foto_url) }}" 
                                         alt="Thumbnail {{ $index + 1 }}">
                                    @if($foto->is_cover)
                                        <span class="cover-badge">
                                            <i class="fas fa-star"></i> Cover
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- ============================================================
        KOLOM KANAN - INFO
        ============================================================ -->
        <div class="col-lg-4">
            <div class="info-card animate-in delay-2">
                <!-- Header Card -->
                <div class="card-header-custom">
                    <div class="content">
                        <div class="status-badge-wrap">
                            @php
                                $statusClass = match($proyek->status) {
                                    'selesai' => 'selesai',
                                    'proses' => 'proses',
                                    'draft' => 'draft',
                                    'batal' => 'batal',
                                    default => 'draft'
                                };
                            @endphp
                            <span class="status-badge-premium {{ $statusClass }}">
                                <i class="fas fa-circle"></i>
                                {{ $proyek->status_label ?? ucfirst($proyek->status) }}
                            </span>
                            @if($proyek->is_featured)
                                <span class="status-badge-premium featured">
                                    <i class="fas fa-star"></i>
                                    Featured
                                </span>
                            @endif
                        </div>
                        <h4>{{ $proyek->nama_proyek }}</h4>
                        <p>
                            <i class="fas fa-tag"></i>
                            {{ ucfirst($proyek->kategori ?? 'Tanpa Kategori') }}
                        </p>
                    </div>
                </div>

                <!-- Info List -->
                <div class="info-list">
                    <div class="info-item-premium">
                        <div class="icon-box indigo">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="info-content">
                            <span class="label">Klien</span>
                            <span class="value {{ !$proyek->klien ? 'muted' : '' }}">
                                {{ $proyek->klien ?? 'Belum diisi' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-item-premium">
                        <div class="icon-box green">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <span class="label">Lokasi</span>
                            <span class="value {{ !$proyek->lokasi ? 'muted' : '' }}">
                                {{ $proyek->lokasi ?? 'Belum diisi' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-item-premium">
                        <div class="icon-box orange">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-content">
                            <span class="label">Tanggal Mulai</span>
                            <span class="value {{ !$proyek->tanggal_mulai ? 'muted' : '' }}">
                                {{ $proyek->tanggal_mulai ? $proyek->tanggal_mulai->format('d F Y') : 'Belum diisi' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-item-premium">
                        <div class="icon-box blue">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <div class="info-content">
                            <span class="label">Tanggal Selesai</span>
                            <span class="value {{ !$proyek->tanggal_selesai ? 'muted' : '' }}">
                                {{ $proyek->tanggal_selesai ? $proyek->tanggal_selesai->format('d F Y') : 'Belum diisi' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-item-premium">
                        <div class="icon-box purple">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="info-content">
                            <span class="label">Dilihat</span>
                            <span class="value">
                                {{ number_format($proyek->views ?? 0, 0, ',', '.') }} kali
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($proyek->deskripsi)
                    <div class="description-section">
                        <h6>
                            <i class="fas fa-align-left"></i>
                            Deskripsi Proyek
                        </h6>
                        <p>{{ $proyek->deskripsi }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL - ULTRA PREMIUM GALLERY
============================================================ -->
<div class="modal fade modal-gallery" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="gallery-container">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    @if($proyek->foto->count() > 1)
                        <button type="button" class="nav-btn prev" onclick="navigateGallery(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="nav-btn next" onclick="navigateGallery(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif

                    <img src="" id="modalImage" alt="Gallery Image">
                    
                    <div class="image-info">
                        <i class="fas fa-image"></i>
                        <span id="modalCounter">1 / {{ $proyek->foto->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ============================================================
    // GALLERY DATA
    // ============================================================
    const galleryImages = [
        @foreach($proyek->foto as $foto)
        {
            url: '{{ asset('storage/' . $foto->foto_url) }}',
            isCover: {{ $foto->is_cover ? 'true' : 'false' }}
        },
        @endforeach
    ];

    let currentIndex = 0;

    // ============================================================
    // OPEN GALLERY
    // ============================================================
    function openGallery(index) {
        if (galleryImages.length === 0) return;
        
        currentIndex = index;
        updateGalleryImage();
        
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
        
        // Update active thumbnail
        updateActiveThumbnail();
    }

    // ============================================================
    // UPDATE GALLERY IMAGE
    // ============================================================
    function updateGalleryImage() {
        const modalImage = document.getElementById('modalImage');
        const modalCounter = document.getElementById('modalCounter');
        
        modalImage.src = galleryImages[currentIndex].url;
        modalCounter.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
        
        // Update hero image
        const heroImage = document.getElementById('heroImage');
        const heroCounter = document.getElementById('heroCounter');
        if (heroImage) {
            heroImage.src = galleryImages[currentIndex].url;
            if (heroCounter) {
                heroCounter.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
            }
        }
    }

    // ============================================================
    // NAVIGATE GALLERY
    // ============================================================
    function navigateGallery(direction) {
        currentIndex += direction;
        
        if (currentIndex < 0) {
            currentIndex = galleryImages.length - 1;
        } else if (currentIndex >= galleryImages.length) {
            currentIndex = 0;
        }
        
        updateGalleryImage();
        updateActiveThumbnail();
    }

    // ============================================================
    // UPDATE ACTIVE THUMBNAIL
    // ============================================================
    function updateActiveThumbnail() {
        document.querySelectorAll('.thumbnail-item').forEach((el, index) => {
            el.classList.toggle('active', index === currentIndex);
        });
    }

    // ============================================================
    // KEYBOARD NAVIGATION
    // ============================================================
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('imageModal');
        if (!modal.classList.contains('show')) return;
        
        if (e.key === 'ArrowLeft') {
            navigateGallery(-1);
        } else if (e.key === 'ArrowRight') {
            navigateGallery(1);
        } else if (e.key === 'Escape') {
            bootstrap.Modal.getInstance(modal).hide();
        }
    });

    // ============================================================
    // INITIALIZE
    // ============================================================
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial hero image
        if (galleryImages.length > 0) {
            const coverIndex = galleryImages.findIndex(img => img.isCover);
            if (coverIndex !== -1) {
                currentIndex = coverIndex;
                updateGalleryImage();
                updateActiveThumbnail();
            }
        }

        // Add smooth scroll to active thumbnail
        const activeThumb = document.querySelector('.thumbnail-item.active');
        if (activeThumb) {
            activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    });

    // ============================================================
    // TOUCH SWIPE SUPPORT
    // ============================================================
    let touchStartX = 0;
    let touchEndX = 0;
    
    const galleryContainer = document.querySelector('.gallery-container');
    if (galleryContainer) {
        galleryContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        galleryContainer.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                navigateGallery(1); // Swipe left, next image
            } else {
                navigateGallery(-1); // Swipe right, prev image
            }
        }
    }
</script>
@endsection