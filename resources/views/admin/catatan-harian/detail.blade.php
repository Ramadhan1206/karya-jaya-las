@extends('layouts.app')

@section('title', 'Detail Catatan Harian - Admin')

@section('styles')
<style>
    .detail-header {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
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
        top: -30%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 50%;
    }
    .detail-header .content {
        position: relative;
        z-index: 1;
    }
    .detail-header h2 {
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 2px;
    }
    .detail-header h2 span {
        color: #667eea;
    }
    .detail-header .subtitle {
        font-size: 14px;
        opacity: 0.7;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .detail-header .subtitle .badge-date {
        background: rgba(255,255,255,0.1);
        padding: 4px 16px;
        border-radius: 50px;
        font-size: 13px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.06);
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        margin-bottom: 24px;
    }
    .info-card .card-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 16px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }
    .info-card .card-title i {
        color: #667eea;
        margin-right: 8px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .info-item {
        display: flex;
        flex-direction: column;
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #f1f5f9;
    }
    .info-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-item .value {
        font-size: 15px;
        font-weight: 600;
        color: #0f172a;
        margin-top: 2px;
    }
    .info-item .value .badge-role {
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-role-admin { background: #fecaca; color: #991b1b; }
    .badge-role-user { background: #dbeafe; color: #1e40af; }

    .status-badge-large {
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .status-badge-large .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-hadir { background: #ecfdf5; color: #059669; }
    .status-hadir .dot { background: #059669; }
    .status-izin { background: #fffbeb; color: #d97706; }
    .status-izin .dot { background: #d97706; }
    .status-sakit { background: #fef2f2; color: #dc2626; }
    .status-sakit .dot { background: #dc2626; }
    .status-alpha { background: #f1f5f9; color: #64748b; }
    .status-alpha .dot { background: #64748b; }

    .btn-back {
        padding: 10px 28px;
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
        color: #0f172a;
        transform: translateX(-3px);
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .detail-header {
            padding: 20px;
            text-align: center;
        }
        .detail-header .subtitle {
            justify-content: center;
        }
        .info-card {
            padding: 16px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="detail-header">
        <div class="content">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2>
                        <i class="fas fa-file-alt me-2"></i>
                        Detail <span>Catatan Harian</span>
                    </h2>
                    <div class="subtitle">
                        <span>
                            <i class="fas fa-user me-1"></i>
                            {{ $catatan->nama_lengkap ?? $catatan->user->name ?? '-' }}
                        </span>
                        <span class="badge-date">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($catatan->tanggal)->format('l, d F Y') }}
                        </span>
                    </div>
                </div>
                <div>
                    <span class="status-badge-large status-{{ $catatan->status }}">
                        <span class="dot"></span>
                        {{ ucfirst($catatan->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== INFORMASI KARYAWAN ===== -->
    <div class="info-card">
        <div class="card-title">
            <i class="fas fa-user-circle"></i>
            Informasi Karyawan
        </div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Nama Lengkap</span>
                <span class="value">{{ $catatan->nama_lengkap ?? $catatan->user->name ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Email</span>
                <span class="value">{{ $catatan->user->email ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Role</span>
                <span class="value">
                    <span class="badge-role {{ $catatan->user->role == 'admin' ? 'badge-role-admin' : 'badge-role-user' }}">
                        {{ ucfirst($catatan->user->role ?? 'User') }}
                    </span>
                </span>
            </div>
            <div class="info-item">
                <span class="label">Telepon</span>
                <span class="value">{{ $catatan->user->phone ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- ===== INFORMASI CATATAN ===== -->
    <div class="info-card">
        <div class="card-title">
            <i class="fas fa-clipboard-list"></i>
            Informasi Catatan
        </div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Tanggal</span>
                <span class="value">{{ \Carbon\Carbon::parse($catatan->tanggal)->format('d F Y') }}</span>
            </div>
            <div class="info-item">
                <span class="label">Jam Masuk</span>
                <span class="value">{{ $catatan->jam_masuk ? \Carbon\Carbon::parse($catatan->jam_masuk)->format('H:i') : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Jam Pulang</span>
                <span class="value">{{ $catatan->jam_pulang ? \Carbon\Carbon::parse($catatan->jam_pulang)->format('H:i') : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Durasi Kerja</span>
                <span class="value">
                    @if($catatan->jam_masuk && $catatan->jam_pulang)
                        @php
                            $masuk = \Carbon\Carbon::parse($catatan->jam_masuk);
                            $pulang = \Carbon\Carbon::parse($catatan->jam_pulang);
                            $durasi = $pulang->diff($masuk);
                        @endphp
                        <span class="badge bg-primary bg-opacity-10 text-primary" style="padding: 4px 14px; font-weight: 600;">
                            <i class="fas fa-clock me-1"></i>
                            {{ $durasi->format('%h jam %i menit') }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </span>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <span class="label">Status</span>
                <span class="value">
                    <span class="status-badge-large status-{{ $catatan->status }}" style="font-size: 13px; padding: 4px 16px;">
                        <span class="dot"></span>
                        {{ ucfirst($catatan->status) }}
                    </span>
                </span>
            </div>
        </div>
    </div>

    <!-- ===== PROYEK & PEKERJAAN ===== -->
    @if($catatan->proyek || $catatan->pekerjaan || $catatan->catatan)
        <div class="info-card">
            <div class="card-title">
                <i class="fas fa-tasks"></i>
                Detail Pekerjaan
            </div>
            <div class="info-grid">
                @if($catatan->proyek)
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="label">Proyek</span>
                        <span class="value">{{ $catatan->proyek }}</span>
                    </div>
                @endif
                @if($catatan->pekerjaan)
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="label">Pekerjaan</span>
                        <span class="value">{{ $catatan->pekerjaan }}</span>
                    </div>
                @endif
                @if($catatan->catatan)
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="label">Catatan</span>
                        <span class="value">{{ $catatan->catatan }}</span>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- ===== TOMBOL KEMBALI ===== -->
    <a href="{{ route('admin.catatan-harian') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Catatan
    </a>
</div>
@endsection