@extends('layouts.app')

@section('title', 'Karya Jaya Las Konstruksi - Solusi Las Profesional')

@section('styles')
<style>
    /* ===== HERO SECTION ===== */
    .hero-section {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        border-radius: 24px;
        padding: 70px 50px;
        color: white;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(102, 126, 234, 0.06);
        border-radius: 50%;
    }
    .hero-section .content {
        position: relative;
        z-index: 1;
    }
    .hero-section .badge-icon {
        display: inline-block;
        background: rgba(102, 126, 234, 0.15);
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 14px;
        font-size: 36px;
        color: #667eea;
    }
    .hero-section h1 {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
    }
    .hero-section h1 span {
        color: #667eea;
    }
    .hero-section .subtitle {
        font-size: 18px;
        opacity: 0.7;
        margin-bottom: 20px;
        font-weight: 300;
    }
    .hero-section .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 28px;
    }
    .hero-section .tags .tag {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 5px 18px;
        border-radius: 50px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.8);
    }
    .hero-section .tags .tag i {
        color: #667eea;
        font-size: 11px;
    }
    .hero-section .buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }
    .hero-section .btn-hero {
        padding: 12px 32px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 14px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .hero-section .btn-hero-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .hero-section .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .hero-section .btn-hero-outline {
        background: transparent;
        border: 2px solid rgba(255,255,255,0.2);
        color: white;
    }
    .hero-section .btn-hero-outline:hover {
        background: rgba(255,255,255,0.06);
        border-color: rgba(255,255,255,0.4);
        color: white;
        transform: translateY(-3px);
    }
    .hero-section .hero-image {
        position: relative;
        z-index: 1;
        text-align: center;
        font-size: 120px;
        opacity: 0.06;
        user-select: none;
    }

    /* ===== FEATURE CARDS ===== */
    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 28px 20px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #edf2f7;
    }
    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
        border-color: #667eea;
    }
    .feature-card .icon {
        font-size: 36px;
        margin-bottom: 10px;
        display: inline-block;
    }
    .feature-card .icon.blue { color: #667eea; }
    .feature-card .icon.green { color: #38a169; }
    .feature-card .icon.orange { color: #ed8936; }
    .feature-card .icon.pink { color: #d53f8c; }
    .feature-card h5 {
        font-weight: 700;
        color: #1a202c;
        font-size: 15px;
        margin-bottom: 4px;
    }
    .feature-card p {
        color: #718096;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* ===== STATS ===== */
    .stats-section {
        background: #f7fafc;
        border-radius: 16px;
        padding: 35px 20px;
        margin-top: 35px;
        border: 1px solid #edf2f7;
    }
    .stats-section .stat-item {
        text-align: center;
    }
    .stats-section .stat-item .number {
        font-size: 28px;
        font-weight: 800;
        color: #667eea;
    }
    .stats-section .stat-item .label {
        color: #718096;
        font-size: 13px;
        font-weight: 500;
        margin-top: 2px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .hero-section {
            padding: 35px 24px;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 28px;
        }
        .hero-section .subtitle {
            font-size: 15px;
        }
        .hero-section .tags {
            justify-content: center;
        }
        .hero-section .buttons {
            justify-content: center;
        }
        .hero-section .btn-hero {
            padding: 10px 24px;
            font-size: 13px;
        }
        .hero-section .hero-image {
            display: none;
        }
        .stats-section .stat-item .number {
            font-size: 20px;
        }
        .feature-card {
            padding: 20px 15px;
        }
        .feature-card .icon {
            font-size: 28px;
        }
    }
</style>
@endsection

@section('content')
<!-- ===== HERO SECTION ===== -->
<div class="hero-section">
    <div class="row align-items-center">
        <div class="col-lg-7">
            <div class="content">
                <div class="badge-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h1>Karya <span>Jaya Las</span> Konstruksi</h1>
                <p class="subtitle">Solusi Las dan Fabrikasi Logam Profesional</p>
                
                <div class="tags">
                    <span class="tag"><i class="fas fa-check-circle"></i> Berpengalaman</span>
                    <span class="tag"><i class="fas fa-check-circle"></i> Berkualitas</span>
                    <span class="tag"><i class="fas fa-check-circle"></i> Terpercaya</span>
                    <span class="tag"><i class="fas fa-check-circle"></i> Profesional</span>
                </div>

                <!-- ===== BUTTONS ===== -->
                <div class="buttons">
                    @guest
                        <!-- Tampilan untuk user yang BELUM login -->
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-hero btn-hero-outline">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @else
                        <!-- Tampilan untuk user yang SUDAH login -->
                        <a href="{{ route('dashboard') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <a href="{{ route('projects.index') }}" class="btn-hero btn-hero-outline">
                            <i class="fas fa-project-diagram"></i> Lihat Proyek
                        </a>
                    @endguest
                </div>
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
            <div class="hero-image">
                <i class="fas fa-industry"></i>
            </div>
        </div>
    </div>
</div>

<!-- ===== FEATURE CARDS ===== -->
<div class="row g-4 mt-4">
    <div class="col-md-3 col-6">
        <div class="feature-card">
            <div class="icon blue"><i class="fas fa-tools"></i></div>
            <h5>Las Profesional</h5>
            <p>Layanan las berkualitas</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="feature-card">
            <div class="icon green"><i class="fas fa-industry"></i></div>
            <h5>Fabrikasi Logam</h5>
            <p>Pengerjaan presisi</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="feature-card">
            <div class="icon orange"><i class="fas fa-hard-hat"></i></div>
            <h5>Tenaga Ahli</h5>
            <p>Tim berpengalaman</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="feature-card">
            <div class="icon pink"><i class="fas fa-star"></i></div>
            <h5>Kualitas Terjamin</h5>
            <p>Standar terbaik</p>
        </div>
    </div>
</div>

<!-- ===== STATS ===== -->
<div class="stats-section">
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number">10+</div>
                <div class="label">Tahun Pengalaman</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number">500+</div>
                <div class="label">Proyek Selesai</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number">50+</div>
                <div class="label">Klien Puas</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number">100%</div>
                <div class="label">Kepuasan Pelanggan</div>
            </div>
        </div>
    </div>
</div>
@endsection