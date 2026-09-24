@extends('layouts.app')

@section('title', 'Detail Catatan Harian')

@section('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #f1f3f5;
    }
    .detail-card .header {
        border-bottom: 2px solid #f1f3f5;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .detail-card .header h5 {
        font-weight: 700;
        color: #1e293b;
    }
    .detail-item {
        display: flex;
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
    }
    .detail-item .label {
        width: 140px;
        font-weight: 600;
        color: #475569;
        font-size: 14px;
        flex-shrink: 0;
    }
    .detail-item .value {
        color: #1e293b;
        font-size: 14px;
    }
    .detail-item .value .status-badge {
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-hadir { background: #d1fae5; color: #065f46; }
    .status-izin { background: #fef3c7; color: #92400e; }
    .status-sakit { background: #fce4ec; color: #c62828; }
    .status-alpha { background: #fecaca; color: #991b1b; }
    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-hadir .dot { background: #38a169; }
    .status-izin .dot { background: #ed8936; }
    .status-sakit .dot { background: #e53e3e; }
    .status-alpha .dot { background: #718096; }
    .durasi-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
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
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateX(-3px);
    }
    .catatan-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 15px 20px;
        border-left: 3px solid #667eea;
        margin-top: 5px;
    }
    .catatan-box .catatan-label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .catatan-box .catatan-text {
        font-size: 14px;
        color: #334155;
        margin-bottom: 0;
    }
    @media (max-width: 768px) {
        .detail-item {
            flex-direction: column;
            gap: 4px;
        }
        .detail-item .label {
            width: 100%;
            font-size: 12px;
        }
        .detail-item .value {
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Back Button -->
            <a href="{{ route('user.catatan-harian') }}" class="btn-back mb-4">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <!-- Detail Card -->
            <div class="detail-card">
                <div class="header">
                    <h5>
                        <i class="fas fa-file-alt text-primary me-2"></i>
                        Detail Catatan Harian
                    </h5>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-calendar me-1 text-primary"></i>Tanggal</div>
                    <div class="value">{{ \Carbon\Carbon::parse($catatan->tanggal)->format('d F Y') }}</div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-user me-1 text-primary"></i>Karyawan</div>
                    <div class="value">
                        <strong>{{ $catatan->user->name ?? '-' }}</strong>
                        <span class="text-muted" style="font-size:12px;">{{ $catatan->user->email ?? '' }}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-clock me-1 text-primary"></i>Jam Masuk</div>
                    <div class="value">{{ $catatan->jam_masuk ? \Carbon\Carbon::parse($catatan->jam_masuk)->format('H:i') : '-' }}</div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-clock me-1 text-primary"></i>Jam Pulang</div>
                    <div class="value">{{ $catatan->jam_pulang ? \Carbon\Carbon::parse($catatan->jam_pulang)->format('H:i') : '-' }}</div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-hourglass-half me-1 text-primary"></i>Durasi</div>
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
                        <span class="durasi-badge">{{ $durasi }}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-project-diagram me-1 text-primary"></i>Proyek</div>
                    <div class="value">{{ $catatan->proyek ?? '-' }}</div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-tasks me-1 text-primary"></i>Pekerjaan</div>
                    <div class="value">{{ $catatan->pekerjaan ?? '-' }}</div>
                </div>

                <div class="detail-item">
                    <div class="label"><i class="fas fa-tag me-1 text-primary"></i>Status</div>
                    <div class="value">
                        <span class="status-badge status-{{ $catatan->status }}">
                            <span class="dot"></span>
                            {{ ucfirst($catatan->status) }}
                        </span>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="detail-item" style="border-bottom: none; padding-bottom: 0;">
                    <div class="label"><i class="fas fa-sticky-note me-1 text-primary"></i>Catatan</div>
                    <div class="value" style="flex:1;">
                        @if($catatan->catatan)
                            <div class="catatan-box">
                                <div class="catatan-label"><i class="fas fa-pencil-alt me-1"></i>Catatan</div>
                                <p class="catatan-text">{{ $catatan->catatan }}</p>
                            </div>
                        @else
                            <span class="text-muted" style="font-style:italic;">Tidak ada catatan</span>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-4 d-flex gap-2 flex-wrap">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $catatan->id }}">
                        <i class="fas fa-edit me-2"></i>Edit
                    </button>
                    <form action="{{ route('user.catatan-harian.destroy', $catatan->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </form>
                    <a href="{{ route('user.catatan-harian') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
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
            <form method="POST" action="{{ route('user.catatan-harian.update', $catatan->id) }}">
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
                        <label class="form-label"><i class="fas fa-tag me-1 text-warning"></i>Status <span class="required">*</span></label>
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