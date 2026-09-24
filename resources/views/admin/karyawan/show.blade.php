@extends('layouts.app')

@section('title', 'Detail Karyawan - Admin')

@section('styles')
<style>
    /* ===== ROOT VARIABLES ===== */
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --bg-dark: #0f0c29;
        --bg-mid: #302b63;
        --bg-light: #24243e;
        --card-radius: 20px;
        --shadow: 0 8px 32px rgba(0,0,0,0.06);
    }

    /* ===== HERO HEADER ===== */
    .hero-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-mid) 50%, var(--bg-light) 100%);
        border-radius: var(--card-radius);
        padding: 30px 40px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(15, 12, 41, 0.15);
    }
    .hero-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 50%;
    }
    .hero-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(118, 75, 162, 0.04);
        border-radius: 50%;
    }
    .hero-header .content {
        position: relative;
        z-index: 1;
    }
    .hero-header .date-badge {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        padding: 5px 18px;
        border-radius: 50px;
        font-size: 12px;
        display: inline-block;
        border: 1px solid rgba(255,255,255,0.06);
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }
    .hero-header h2 {
        font-weight: 800;
        font-size: 26px;
        margin-bottom: 2px;
    }
    .hero-header h2 span {
        background: linear-gradient(90deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-header .subtitle {
        font-size: 14px;
        opacity: 0.6;
        margin-bottom: 0;
    }
    .hero-header .btn-back {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 8px 24px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        font-size: 13px;
        text-decoration: none;
        display: inline-block;
        position: relative;
        z-index: 1;
    }
    .hero-header .btn-back:hover {
        background: rgba(255,255,255,0.15);
        color: white;
        transform: translateY(-2px);
    }
    .hero-header .btn-back i {
        margin-right: 8px;
    }

    /* ===== PROFILE CARD ===== */
    .profile-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 30px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }
    .profile-card .section-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 16px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
    }
    .profile-card .section-title i {
        color: #667eea;
        margin-right: 8px;
    }

    /* ===== USER PROFILE ===== */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 14px;
        margin-bottom: 24px;
        border: 1px solid #f1f5f9;
    }
    .user-profile .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 32px;
        flex-shrink: 0;
        border: 3px solid rgba(102,126,234,0.2);
    }
    .user-profile .info h4 {
        font-weight: 700;
        color: #0f172a;
        font-size: 20px;
        margin-bottom: 2px;
    }
    .user-profile .info .role-badge {
        font-size: 12px;
        font-weight: 600;
        padding: 3px 14px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 4px;
    }
    .role-badge-admin { background: #fef2f2; color: #dc2626; }
    .role-badge-user { background: #eef2ff; color: #4f46e5; }
    .user-profile .info .email {
        font-size: 14px;
        color: #94a3b8;
        display: block;
        margin-top: 2px;
    }
    .user-profile .info .email i {
        color: #667eea;
        margin-right: 4px;
    }
    .badge-you {
        background: #d1fae5;
        color: #065f46;
        font-size: 11px;
        padding: 2px 12px;
        border-radius: 50px;
        font-weight: 600;
        margin-left: 8px;
    }

    /* ===== INFO GRID ===== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 8px;
    }
    .info-item {
        padding: 14px 18px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    .info-item:hover {
        border-color: #667eea;
        background: #fafbff;
    }
    .info-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
    }
    .info-item .value {
        font-weight: 700;
        color: #0f172a;
        font-size: 15px;
        display: block;
    }
    .info-item .value .badge-role {
        font-size: 12px;
        font-weight: 600;
        padding: 3px 14px;
        border-radius: 50px;
    }
    .badge-role-admin { background: #fef2f2; color: #dc2626; }
    .badge-role-user { background: #eef2ff; color: #4f46e5; }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 16px;
        padding-top: 20px;
        border-top: 2px solid #f1f5f9;
    }
    .btn-action-custom {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-action-custom:hover {
        transform: translateY(-2px);
    }
    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102,126,234,0.3);
    }
    .btn-primary-custom:hover {
        box-shadow: 0 8px 30px rgba(102,126,234,0.5);
        color: white;
    }
    .btn-warning-custom {
        background: #fef3c7;
        color: #92400e;
    }
    .btn-warning-custom:hover {
        background: #fde68a;
        color: #78350f;
    }
    .btn-danger-custom {
        background: #fef2f2;
        color: #dc2626;
    }
    .btn-danger-custom:hover {
        background: #fecaca;
        color: #991b1b;
    }
    .btn-secondary-custom {
        background: #f1f5f9;
        color: #475569;
    }
    .btn-secondary-custom:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .hero-header {
            padding: 20px;
            text-align: center;
        }
        .hero-header .btn-back {
            display: block;
            text-align: center;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .user-profile {
            flex-direction: column;
            text-align: center;
        }
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons .btn-action-custom {
            width: 100%;
            justify-content: center;
        }
        .profile-card {
            padding: 16px;
        }
        .user-profile .avatar {
            width: 70px;
            height: 70px;
            font-size: 28px;
        }
        .user-profile .info h4 {
            font-size: 18px;
        }
        .info-item .value {
            font-size: 14px;
        }
    }
    @media (max-width: 480px) {
        .user-profile .avatar {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        .info-item {
            padding: 10px 14px;
        }
        .info-item .value {
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HERO HEADER ===== -->
    <div class="hero-header">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="content">
                    <span class="date-badge">
                        <i class="fas fa-calendar-alt me-2"></i>
                        {{ now()->format('l, d F Y') }}
                    </span>
                    <h2>
                        <i class="fas fa-user-circle me-2"></i>
                        Detail <span>Karyawan</span>
                    </h2>
                    <p class="subtitle">Informasi lengkap data karyawan</p>
                </div>
            </div>
            <div class="col-md-5 text-end d-none d-md-block">
                <a href="{{ route('admin.karyawan.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="col-12 d-md-none mt-3">
                <a href="{{ route('admin.karyawan.index') }}" class="btn-back w-100 text-center">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- ===== PROFILE CARD ===== -->
    <div class="profile-card">
        <!-- ===== USER PROFILE ===== -->
        <div class="user-profile">
            <div class="avatar">
                {{ strtoupper(substr($karyawan->name, 0, 2)) }}
            </div>
            <div class="info">
                <div>
                    <span class="role-badge {{ $karyawan->role === 'admin' ? 'role-badge-admin' : 'role-badge-user' }}">
                        <i class="fas {{ $karyawan->role === 'admin' ? 'fa-shield-alt' : 'fa-user' }} me-1"></i>
                        {{ ucfirst($karyawan->role) }}
                    </span>
                    @if($karyawan->id == auth()->id())
                        <span class="badge-you"><i class="fas fa-check-circle me-1"></i>Anda</span>
                    @endif
                </div>
                <h4>{{ $karyawan->name }}</h4>
                <span class="email">
                    <i class="fas fa-envelope"></i>
                    {{ $karyawan->email }}
                </span>
            </div>
        </div>

        <!-- ===== INFO GRID ===== -->
        <div class="section-title">
            <i class="fas fa-info-circle"></i>
            Informasi Karyawan
        </div>

        <div class="info-grid">
            <div class="info-item">
                <span class="label"><i class="fas fa-user me-1"></i> Nama Lengkap</span>
                <span class="value">{{ $karyawan->name }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-envelope me-1"></i> Email</span>
                <span class="value">{{ $karyawan->email }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-user-tag me-1"></i> Role</span>
                <span class="value">
                    <span class="badge-role {{ $karyawan->role === 'admin' ? 'badge-role-admin' : 'badge-role-user' }}">
                        <i class="fas {{ $karyawan->role === 'admin' ? 'fa-shield-alt' : 'fa-user' }} me-1"></i>
                        {{ ucfirst($karyawan->role) }}
                    </span>
                </span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-briefcase me-1"></i> Jabatan</span>
                <span class="value">{{ $karyawan->position ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-phone me-1"></i> Telepon</span>
                <span class="value">{{ $karyawan->phone ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-home me-1"></i> Alamat</span>
                <span class="value">{{ $karyawan->address ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-calendar-plus me-1"></i> Bergabung</span>
                <span class="value">{{ $karyawan->created_at->format('d F Y') }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-clock me-1"></i> Terakhir Login</span>
                <span class="value">
                    {{ $karyawan->last_login_at ? $karyawan->last_login_at->diffForHumans() : 'Pertama kali' }}
                </span>
            </div>
        </div>

        <!-- ===== ACTION BUTTONS ===== -->
        <div class="action-buttons">
            <a href="{{ route('admin.karyawan.index') }}" class="btn-action-custom btn-secondary-custom">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn-action-custom btn-warning-custom">
                <i class="fas fa-edit"></i> Edit Karyawan
            </a>
            @if($karyawan->id != auth()->id())
                <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" 
                      method="POST" 
                      class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action-custom btn-danger-custom">
                        <i class="fas fa-trash"></i> Hapus Karyawan
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection