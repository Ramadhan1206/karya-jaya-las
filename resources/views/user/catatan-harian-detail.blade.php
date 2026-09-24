@extends('layouts.app')

@section('title', 'Detail Catatan Harian - Admin')

@section('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #f1f3f5;
    }
    .detail-card .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .detail-card .card-header-custom h5 {
        font-weight: 700;
        margin-bottom: 0;
    }
    .detail-card .card-header-custom .badge-date {
        background: rgba(255,255,255,0.2);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 500;
        backdrop-filter: blur(5px);
    }
    .detail-card .card-body {
        padding: 30px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .info-item {
        padding: 15px 18px;
        background: #f8fafc;
        border-radius: 12px;
        border-left: 3px solid #667eea;
        transition: all 0.3s ease;
    }
    .info-item:hover {
        background: #f1f5f9;
        transform: translateX(4px);
    }
    .info-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .info-item .label i {
        color: #667eea;
        font-size: 13px;
    }
    .info-item .value {
        font-size: 15px;
        color: #1e293b;
        font-weight: 600;
    }
    .info-item .value .email-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }
    .info-item .value .email-link:hover {
        text-decoration: underline;
    }
    .info-item.full-width {
        grid-column: 1 / -1;
    }
    .info-item .status-badge {
        padding: 4px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-hadir { background: #d1fae5; color: #065f46; }
    .status-izin { background: #fef3c7; color: #92400e; }
    .status-sakit { background: #fce4ec; color: #c62828; }
    .status-alpha { background: #fecaca; color: #991b1b; }
    .status-badge .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-hadir .dot { background: #38a169; }
    .status-izin .dot { background: #ed8936; }
    .status-sakit .dot { background: #e53e3e; }
    .status-alpha .dot { background: #718096; }
    .durasi-box {
        display: inline-block;
        background: #eef2ff;
        color: #4f46e5;
        padding: 4px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
    }
    .btn-back {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f1f5f9;
        color: #475569;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        font-size: 14px;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateX(-3px);
    }
    .btn-back i {
        font-size: 14px;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-delete {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #fecaca;
        color: #991b1b;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
    }
    .btn-edit {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #fef3c7;
        color: #92400e;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    .btn-edit:hover {
        background: #f6c23e;
        color: #1a1a2e;
        transform: translateY(-2px);
    }
    .catatan-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px 20px;
        border-left: 3px solid #667eea;
        margin-top: 4px;
        min-height: 50px;
    }
    .catatan-box .catatan-label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .catatan-box .catatan-text {
        font-size: 14px;
        color: #334155;
        margin-bottom: 0;
        line-height: 1.6;
    }
    .catatan-box .catatan-text .empty-text {
        color: #94a3b8;
        font-style: italic;
        font-size: 13px;
    }
    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #94a3b8;
        margin-bottom: 20px;
    }
    .breadcrumb-custom a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }
    .breadcrumb-custom a:hover {
        text-decoration: underline;
    }
    .breadcrumb-custom .separator {
        color: #cbd5e1;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .detail-card .card-header-custom {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        .detail-card .card-body {
            padding: 20px;
        }
        .info-item {
            padding: 12px 15px;
        }
        .info-item .value {
            font-size: 14px;
        }
        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
        .action-buttons .btn-back,
        .action-buttons .btn-edit,
        .action-buttons .btn-delete {
            width: 100%;
            justify-content: center;
        }
        .breadcrumb-custom {
            font-size: 13px;
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== BREADCRUMB ===== -->
    <div class="breadcrumb-custom">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <span class="separator">/</span>
        <a href="{{ route('admin.catatan-harian') }}">Catatan Harian</a>
        <span class="separator">/</span>
        <span style="color:#1e293b;font-weight:500;">Detail Catatan</span>
    </div>

    <!-- ===== DETAIL CARD ===== -->
    <div class="detail-card">
        <!-- Header -->
        <div class="card-header-custom">
            <h5>
                <i class="fas fa-file-alt me-2"></i>Detail Catatan Harian
            </h5>
            <span class="badge-date">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ \Carbon\Carbon::parse($catatan->tanggal)->format('d F Y') }}
            </span>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="info-grid">
                <!-- Karyawan -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-user"></i> Karyawan</div>
                    <div class="value">{{ $catatan->user->name }}</div>
                </div>

                <!-- Email -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-envelope"></i> Email</div>
                    <div class="value">
                        <a href="mailto:{{ $catatan->user->email }}" class="email-link">
                            {{ $catatan->user->email }}
                        </a>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-phone"></i> Telepon</div>
                    <div class="value">{{ $catatan->user->phone ?? '-' }}</div>
                </div>

                <!-- Tanggal -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-calendar"></i> Tanggal</div>
                    <div class="value">{{ \Carbon\Carbon::parse($catatan->tanggal)->format('d F Y') }}</div>
                </div>

                <!-- Jam Masuk -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-clock"></i> Jam Masuk</div>
                    <div class="value">
                        {{ $catatan->jam_masuk ? \Carbon\Carbon::parse($catatan->jam_masuk)->format('H:i') : '-' }}
                    </div>
                </div>

                <!-- Jam Pulang -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-clock"></i> Jam Pulang</div>
                    <div class="value">
                        {{ $catatan->jam_pulang ? \Carbon\Carbon::parse($catatan->jam_pulang)->format('H:i') : '-' }}
                    </div>
                </div>

                <!-- Durasi -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-hourglass-half"></i> Durasi</div>
                    <div class="value">
                        @php
                            $durasi = '-';
                            if ($catatan->jam_masuk && $catatan->jam_pulang) {
                                $masuk = \Carbon\Carbon::parse($catatan->jam_masuk);
                                $pulang = \Carbon\Carbon::parse($catatan->jam_pulang);
                                $diff = $pulang->diff($masuk);
                                $durasi = $diff->format('%h jam %i menit');
                            }
                        @endphp
                        <span class="durasi-box">{{ $durasi }}</span>
                    </div>
                </div>

                <!-- Status -->
                <div class="info-item">
                    <div class="label"><i class="fas fa-info-circle"></i> Status</div>
                    <div class="value">
                        <span class="status-badge status-{{ $catatan->status }}">
                            <span class="dot"></span>
                            {{ ucfirst($catatan->status) }}
                        </span>
                    </div>
                </div>

                <!-- Proyek -->
                <div class="info-item full-width">
                    <div class="label"><i class="fas fa-project-diagram"></i> Proyek</div>
                    <div class="value">{{ $catatan->proyek ?? '-' }}</div>
                </div>

                <!-- Pekerjaan -->
                <div class="info-item full-width">
                    <div class="label"><i class="fas fa-tasks"></i> Pekerjaan</div>
                    <div class="value">{{ $catatan->pekerjaan ?? '-' }}</div>
                </div>

                <!-- Catatan -->
                <div class="info-item full-width">
                    <div class="label"><i class="fas fa-sticky-note"></i> Catatan</div>
                    <div class="catatan-box">
                        <div class="catatan-label"><i class="fas fa-pen me-1"></i>Catatan Karyawan</div>
                        @if($catatan->catatan)
                            <p class="catatan-text">{{ $catatan->catatan }}</p>
                        @else
                            <p class="catatan-text"><span class="empty-text">Tidak ada catatan</span></p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 pt-3 border-top">
                <div class="action-buttons">
                    <a href="{{ route('admin.catatan-harian') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali ke Catatan Harian
                    </a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $catatan->id }}">
                        <i class="fas fa-edit"></i> Edit Catatan
                    </button>
                    <form action="{{ route('admin.catatan-harian.delete', $catatan->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fas fa-trash"></i> Hapus Catatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL EDIT ===== -->
<div class="modal fade" id="modalEdit{{ $catatan->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:#f59e0b;color:white;">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Catatan Harian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.catatan-harian.update', $catatan->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-clock me-1 text-warning"></i>Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" 
                                   value="{{ $catatan->jam_masuk ? \Carbon\Carbon::parse($catatan->jam_masuk)->format('H:i') : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-clock me-1 text-warning"></i>Jam Pulang</label>
                            <input type="time" class="form-control" name="jam_pulang" 
                                   value="{{ $catatan->jam_pulang ? \Carbon\Carbon::parse($catatan->jam_pulang)->format('H:i') : '' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-project-diagram me-1 text-warning"></i>Proyek</label>
                        <input type="text" class="form-control" name="proyek" value="{{ $catatan->proyek }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-tasks me-1 text-warning"></i>Pekerjaan</label>
                        <textarea class="form-control" name="pekerjaan" rows="2">{{ $catatan->pekerjaan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-sticky-note me-1 text-warning"></i>Catatan</label>
                        <textarea class="form-control" name="catatan" rows="2">{{ $catatan->catatan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-tag me-1 text-warning"></i>Status</label>
                        <select class="form-select" name="status" required>
                            <option value="hadir" {{ $catatan->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ $catatan->status == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ $catatan->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="alpha" {{ $catatan->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection