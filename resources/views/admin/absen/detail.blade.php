@extends('layouts.app')

@section('title', 'Detail Absensi - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    /* ===== HEADER ===== */
    .detail-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #ffecd2 100%);
        border-radius: 20px;
        padding: 30px 35px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .detail-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .detail-header .content {
        position: relative;
        z-index: 1;
    }
    .detail-header .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .detail-header h4 {
        font-weight: 700;
        font-size: 22px;
        margin-bottom: 2px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .detail-header p {
        opacity: 0.8;
        margin-bottom: 0;
        font-size: 14px;
    }
    .detail-header .badge-date {
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.1);
        display: inline-block;
    }

    /* ===== CARD ===== */
    .detail-card {
        background: white;
        border-radius: 16px;
        padding: 25px 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        margin-bottom: 25px;
    }
    .detail-card .card-title {
        font-weight: 600;
        color: #1e293b;
        font-size: 15px;
        margin-bottom: 15px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f2f5;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .detail-card .card-title i {
        color: #f5576c;
    }

    /* ===== USER INFO ===== */
    .user-info {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .avatar-detail {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #f093fb, #f5576c);
        border: 3px solid rgba(255,255,255,0.3);
        flex-shrink: 0;
    }
    .user-info .details .name {
        font-weight: 700;
        font-size: 18px;
        color: #1e293b;
    }
    .user-info .details .email {
        color: #94a3b8;
        font-size: 14px;
    }
    .user-info .details .phone {
        color: #64748b;
        font-size: 13px;
        margin-top: 2px;
    }

    /* ===== INFO GRID ===== */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .info-item {
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #f0f2f5;
        transition: all 0.3s ease;
    }
    .info-item:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }
    .info-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: block;
        margin-bottom: 3px;
    }
    .info-item .label i {
        margin-right: 4px;
    }
    .info-item .value {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-item .value i {
        font-size: 14px;
        color: #f5576c;
    }

    /* ===== STATUS BADGE ===== */
    .status-badge-large {
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .status-hadir {
        background: #d1fae5;
        color: #065f46;
    }
    .status-izin {
        background: #fef3c7;
        color: #92400e;
    }
    .status-sakit {
        background: #fce4ec;
        color: #c62828;
    }
    .status-alpha {
        background: #fecaca;
        color: #991b1b;
    }
    .status-badge-large i {
        font-size: 18px;
    }

    /* ===== TEXT INFO ===== */
    .info-text {
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #f0f2f5;
        margin-top: 10px;
    }
    .info-text .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: block;
        margin-bottom: 3px;
    }
    .info-text .label i {
        margin-right: 4px;
    }
    .info-text .value {
        font-size: 14px;
        color: #1e293b;
        line-height: 1.6;
    }
    .info-text .value .empty-text {
        color: #94a3b8;
        font-style: italic;
    }

    /* ===== BUTTON ===== */
    .btn-back {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f1f5f9;
        color: #475569;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateX(-3px);
        text-decoration: none;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .detail-header {
            padding: 20px;
            text-align: center;
        }
        .detail-header .d-flex {
            flex-direction: column;
            text-align: center;
        }
        .detail-header .icon-box {
            margin: 0 auto;
        }
        .user-info {
            flex-direction: column;
            text-align: center;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .detail-card {
            padding: 20px;
        }
        .detail-card .card-title {
            font-size: 14px;
        }
        .info-item .value {
            font-size: 14px;
        }
        .status-badge-large {
            font-size: 14px;
            padding: 6px 18px;
        }
        .btn-back {
            padding: 8px 16px;
            font-size: 13px;
        }
        .detail-header .badge-date {
            font-size: 12px;
            padding: 4px 16px;
        }
        .avatar-detail {
            width: 55px;
            height: 55px;
            font-size: 22px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="detail-container">
        <!-- ===== HEADER ===== -->
        <div class="detail-header">
            <div class="content">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div>
                            <h4>Detail Absensi</h4>
                            <p>Detail lengkap data absensi karyawan</p>
                        </div>
                    </div>
                    <span class="badge-date">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ \Carbon\Carbon::parse($absen->tanggal)->format('d F Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- ===== INFORMASI KARYAWAN ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-user-circle"></i>
                Informasi Karyawan
            </div>
            <div class="user-info">
                <div class="avatar-detail">
                    {{ strtoupper(substr($absen->nama_lengkap ?? $absen->user->name ?? 'N', 0, 2)) }}
                </div>
                <div class="details">
                    <!-- ===== NAMA LENGKAP ===== -->
                    <div class="name">{{ $absen->nama_lengkap ?? $absen->user->name ?? 'Nama Tidak Tersedia' }}</div>
                    <div class="email">
                        <i class="fas fa-envelope me-1"></i>
                        {{ $absen->user->email ?? 'Email Tidak Tersedia' }}
                    </div>
                    <div class="phone">
                        <i class="fas fa-phone me-1"></i>
                        {{ $absen->user->phone ?? 'Belum diisi' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== DETAIL ABSENSI ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-info-circle"></i>
                Detail Absensi
            </div>
            <div class="info-grid">
                <!-- Tanggal -->
                <div class="info-item">
                    <span class="label">
                        <i class="fas fa-calendar-alt"></i> Tanggal
                    </span>
                    <div class="value">
                        <i class="fas fa-calendar-day"></i>
                        {{ \Carbon\Carbon::parse($absen->tanggal)->format('d F Y') }}
                    </div>
                </div>

                <!-- Jam Masuk -->
                <div class="info-item">
                    <span class="label">
                        <i class="fas fa-clock"></i> Jam Masuk
                    </span>
                    <div class="value">
                        <i class="fas fa-sign-in-alt"></i>
                        {{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') : '-' }}
                    </div>
                </div>

                <!-- Jam Pulang -->
                <div class="info-item">
                    <span class="label">
                        <i class="fas fa-clock"></i> Jam Pulang
                    </span>
                    <div class="value">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ $absen->jam_pulang ? \Carbon\Carbon::parse($absen->jam_pulang)->format('H:i') : '-' }}
                    </div>
                </div>

                <!-- Status -->
                <div class="info-item">
                    <span class="label">
                        <i class="fas fa-check-circle"></i> Status
                    </span>
                    <div class="value">
                        <span class="status-badge-large status-{{ $absen->status }}">
                            <i class="fas {{ $absen->status == 'hadir' ? 'fa-check-circle' : ($absen->status == 'izin' ? 'fa-clock' : ($absen->status == 'sakit' ? 'fa-notes-medical' : 'fa-times-circle')) }}"></i>
                            {{ ucfirst($absen->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== DETAIL PEKERJAAN ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-tasks"></i>
                Detail Pekerjaan
            </div>

            <!-- Proyek -->
            <div class="info-text">
                <span class="label">
                    <i class="fas fa-project-diagram"></i> Proyek
                </span>
                <div class="value">
                    @if($absen->proyek)
                        <i class="fas fa-folder-open text-primary me-1"></i>
                        {{ $absen->proyek }}
                    @else
                        <span class="empty-text">Tidak ada proyek</span>
                    @endif
                </div>
            </div>

            <!-- Pekerjaan -->
            <div class="info-text" style="margin-top: 10px;">
                <span class="label">
                    <i class="fas fa-briefcase"></i> Pekerjaan
                </span>
                <div class="value">
                    @if($absen->pekerjaan)
                        {{ $absen->pekerjaan }}
                    @else
                        <span class="empty-text">Tidak ada pekerjaan</span>
                    @endif
                </div>
            </div>

            <!-- Catatan -->
            <div class="info-text" style="margin-top: 10px;">
                <span class="label">
                    <i class="fas fa-sticky-note"></i> Catatan
                </span>
                <div class="value">
                    @if($absen->catatan)
                        {{ $absen->catatan }}
                    @else
                        <span class="empty-text">Tidak ada catatan</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- ===== BUTTON ===== -->
        <div>
            <a href="{{ route('admin.absen') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Data Absensi
            </a>
        </div>
    </div>
</div>
@endsection