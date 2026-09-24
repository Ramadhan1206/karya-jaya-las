@extends('layouts.app')

@section('title', 'Detail Gajian - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ============================================
       ROOT VARIABLES
       ============================================ */
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --bg-dark: #0f0c29;
        --bg-mid: #302b63;
        --bg-light: #24243e;
        --card-radius: 20px;
        --shadow: 0 8px 32px rgba(0,0,0,0.06);
        --shadow-hover: 0 16px 48px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ============================================
       HERO HEADER
       ============================================ */
    .hero-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-mid) 50%, var(--bg-light) 100%);
        border-radius: var(--card-radius);
        padding: 35px 40px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .hero-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(102,126,234,0.06);
        border-radius: 50%;
        pointer-events: none;
    }
    .hero-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(118,75,162,0.04);
        border-radius: 50%;
        pointer-events: none;
    }
    .hero-header .content { position: relative; z-index: 1; }
    .hero-header .date-badge {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(12px);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 12px;
        display: inline-block;
        border: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 6px;
    }
    .hero-header .date-badge i { margin-right: 6px; color: #667eea; }
    .hero-header h2 {
        font-weight: 800;
        font-size: 28px;
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
        padding: 8px 20px;
        font-weight: 600;
        color: white;
        transition: var(--transition);
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

    /* ============================================
       DETAIL CARD
       ============================================ */
    .detail-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 35px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.02);
        transition: var(--transition);
    }
    .detail-card:hover {
        box-shadow: var(--shadow-hover);
    }
    .detail-card .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 16px;
        border-bottom: 2px solid #f1f5f9;
        margin-bottom: 24px;
    }
    .detail-card .detail-header h5 {
        font-weight: 700;
        color: #0f172a;
        font-size: 18px;
        margin-bottom: 0;
    }
    .detail-card .detail-header h5 i {
        color: #667eea;
        margin-right: 8px;
    }

    /* ============================================
       USER PROFILE
       ============================================ */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 16px 20px;
        background: #f8fafc;
        border-radius: 14px;
        margin-bottom: 24px;
        transition: var(--transition);
    }
    .user-profile:hover {
        background: #f1f4f9;
    }
    .user-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 22px;
        flex-shrink: 0;
    }
    .user-info h5 {
        font-weight: 700;
        color: #0f172a;
        font-size: 17px;
        margin-bottom: 2px;
    }
    .user-info .user-email {
        color: #94a3b8;
        font-size: 13px;
        display: block;
    }
    .user-info .user-role {
        font-size: 11px;
        font-weight: 600;
        padding: 2px 12px;
        border-radius: 50px;
        background: #eef2ff;
        color: #4f46e5;
        display: inline-block;
        margin-top: 2px;
    }
    .badge-you {
        background: #34d399;
        color: #065f46;
        font-size: 10px;
        padding: 2px 10px;
        border-radius: 50px;
        font-weight: 600;
        margin-left: 8px;
    }

    /* ============================================
       STATUS BADGE
       ============================================ */
    .status-badge {
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }
    .status-draft {
        background: #f1f5f9;
        color: #475569;
    }
    .status-proses {
        background: #fef3c7;
        color: #92400e;
    }
    .status-dibayar {
        background: #d1fae5;
        color: #065f46;
    }
    .status-batal {
        background: #fecaca;
        color: #991b1b;
    }

    /* ============================================
       INFO GRID
       ============================================ */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }
    .info-item {
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 10px;
        transition: var(--transition);
    }
    .info-item:hover {
        background: #f1f4f9;
    }
    .info-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
    }
    .info-item .value {
        font-weight: 700;
        color: #0f172a;
        font-size: 15px;
        margin-top: 2px;
        display: block;
    }
    .info-item .value.text-primary { color: #667eea; }
    .info-item .value.text-success { color: #059669; }
    .info-item .value.text-danger { color: #dc2626; }

    /* ============================================
       GAJI DETAIL
       ============================================ */
    .gaji-section {
        background: #f8fafc;
        border-radius: 14px;
        padding: 20px;
        margin-top: 16px;
    }
    .gaji-section .gaji-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 14px;
        margin-bottom: 12px;
    }
    .gaji-section .gaji-title i {
        color: #667eea;
        margin-right: 6px;
    }
    .gaji-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .gaji-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 14px;
        background: white;
        border-radius: 8px;
        border-left: 3px solid #e2e8f0;
    }
    .gaji-item .label {
        font-size: 13px;
        color: #475569;
    }
    .gaji-item .value {
        font-weight: 700;
        font-size: 14px;
    }
    .gaji-item .value.text-primary { color: #667eea; }
    .gaji-item .value.text-success { color: #059669; }
    .gaji-item .value.text-danger { color: #dc2626; }
    .gaji-item.total {
        border-left-color: #667eea;
        background: #eef2ff;
    }
    .gaji-item.total .value {
        font-size: 18px;
        color: #667eea;
    }

    /* ============================================
       CATATAN
       ============================================ */
    .catatan-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 14px 18px;
        margin-top: 12px;
        border-left: 3px solid #667eea;
    }
    .catatan-box .catatan-label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .catatan-box .catatan-text {
        margin-top: 4px;
        font-size: 14px;
        color: #1e293b;
    }
    .catatan-box .catatan-text.empty {
        color: #94a3b8;
        font-style: italic;
    }

    /* ============================================
       ACTION BUTTONS
       ============================================ */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 2px solid #f1f5f9;
        flex-wrap: wrap;
        gap: 10px;
    }
    .btn-action-custom {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-action-custom:hover {
        transform: translateY(-2px);
    }
    .btn-secondary-custom {
        background: #f1f5f9;
        color: #475569;
    }
    .btn-secondary-custom:hover {
        background: #e2e8f0;
        color: #1e293b;
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
    .action-buttons .btn-group {
        display: flex;
        gap: 10px;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .hero-header {
            padding: 20px;
            text-align: center;
        }
        .hero-header .btn-back {
            display: block;
            text-align: center;
        }
        .detail-card {
            padding: 18px;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .gaji-grid {
            grid-template-columns: 1fr;
        }
        .user-profile {
            flex-direction: column;
            text-align: center;
            padding: 16px;
        }
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .action-buttons .btn-group {
            flex-direction: column;
        }
        .btn-action-custom {
            justify-content: center;
        }
        .detail-card .detail-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .detail-card .detail-header .status-badge {
            align-self: flex-start;
        }
    }
    @media (max-width: 480px) {
        .user-avatar {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }
        .user-info h5 {
            font-size: 15px;
        }
        .gaji-item .value {
            font-size: 13px;
        }
        .gaji-item.total .value {
            font-size: 16px;
        }
        .info-item .value {
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ============================================
    HERO HEADER
    ============================================ -->
    <div class="hero-header">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="content">
                    <span class="date-badge">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </span>
                    <h2>
                        <i class="fas fa-file-invoice me-2"></i>
                        Detail <span>Gajian</span>
                    </h2>
                    <p class="subtitle">
                        <i class="fas fa-info-circle"></i>
                        Informasi lengkap gaji Anda
                    </p>
                </div>
            </div>
            <div class="col-md-5 text-end d-none d-md-block">
                <a href="{{ route('user.gajian.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="col-12 d-md-none mt-3">
                <a href="{{ route('user.gajian.index') }}" class="btn-back w-100 text-center">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- ============================================
    DETAIL CARD
    ============================================ -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="detail-card">
                <!-- ===== HEADER ===== -->
                <div class="detail-header">
                    <h5>
                        <i class="fas fa-file-invoice"></i>
                        Informasi Gajian
                    </h5>
                    <span class="status-badge status-{{ $gajian->status ?? 'draft' }}">
                        <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                        {{ ucfirst($gajian->status ?? 'Draft') }}
                    </span>
                </div>

                <!-- ===== USER PROFILE ===== -->
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr($gajian->user->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="user-info">
                        <h5>
                            {{ $gajian->user->name ?? '-' }}
                            @if(($gajian->user->id ?? 0) == auth()->id())
                                <span class="badge-you">Anda</span>
                            @endif
                        </h5>
                        <span class="user-email">
                            <i class="fas fa-envelope me-1"></i>
                            {{ $gajian->user->email ?? '-' }}
                        </span>
                        <span class="user-role">
                            <i class="fas fa-user me-1"></i>
                            {{ ucfirst($gajian->user->role ?? 'user') }}
                        </span>
                    </div>
                </div>

                <!-- ===== INFO GRID ===== -->
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label"><i class="fas fa-calendar me-1"></i> Tanggal Gaji</span>
                        <span class="value">{{ $gajian->tanggal_formatted ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-calendar-alt me-1"></i> Periode</span>
                        <span class="value">{{ $gajian->periode ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-tag me-1"></i> Jenis Gaji</span>
                        <span class="value">{{ ucfirst($gajian->jenis_gaji ?? '-') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-phone me-1"></i> Telepon</span>
                        <span class="value">{{ $gajian->user->phone ?? '-' }}</span>
                    </div>
                </div>

                <!-- ===== GAJI DETAIL ===== -->
                <div class="gaji-section">
                    <div class="gaji-title">
                        <i class="fas fa-money-bill-wave"></i>
                        Rincian Gaji
                    </div>
                    <div class="gaji-grid">
                        <div class="gaji-item">
                            <span class="label">Gaji Pokok</span>
                            <span class="value">Rp {{ number_format($gajian->gaji_pokok ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="gaji-item">
                            <span class="label">Tunjangan</span>
                            <span class="value text-success">+ Rp {{ number_format($gajian->tunjangan ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="gaji-item">
                            <span class="label">Bonus</span>
                            <span class="value text-success">+ Rp {{ number_format($gajian->bonus ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="gaji-item">
                            <span class="label">Potongan</span>
                            <span class="value text-danger">- Rp {{ number_format($gajian->potongan ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="gaji-item total" style="grid-column: span 2;">
                            <span class="label" style="font-weight: 700; font-size: 15px;">
                                <i class="fas fa-calculator me-2"></i> Total Gaji
                            </span>
                            <span class="value text-primary" style="font-size: 22px; font-weight: 800;">
                                Rp {{ number_format($gajian->total_gaji ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ===== CATATAN ===== -->
                @if($gajian->keterangan || $gajian->rincian_pekerjaan)
                    <div style="margin-top: 16px;">
                        @if($gajian->keterangan)
                            <div class="catatan-box">
                                <div class="catatan-label">
                                    <i class="fas fa-sticky-note me-1"></i> Keterangan
                                </div>
                                <div class="catatan-text">{{ $gajian->keterangan }}</div>
                            </div>
                        @endif
                        @if($gajian->rincian_pekerjaan)
                            <div class="catatan-box" style="margin-top: 10px;">
                                <div class="catatan-label">
                                    <i class="fas fa-tasks me-1"></i> Rincian Pekerjaan
                                </div>
                                <div class="catatan-text">{{ $gajian->rincian_pekerjaan }}</div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- ===== ACTION BUTTONS ===== -->
                <div class="action-buttons">
                    <a href="{{ route('user.gajian.index') }}" class="btn-action-custom btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <div class="btn-group">
                        <a href="{{ route('user.gajian.edit', $gajian->id) }}" class="btn-action-custom btn-warning-custom">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('user.gajian.destroy', $gajian->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data gajian ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-custom btn-danger-custom">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection