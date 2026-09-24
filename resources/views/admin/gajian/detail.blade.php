@extends('layouts.app')

@section('title', 'Detail Gajian - Admin')

@section('styles')
<style>
    /* ===== ROOT ===== */
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --success: #38a169;
        --warning: #d97706;
        --danger: #dc2626;
        --gray: #64748b;
        --bg-light: #f8fafc;
        --shadow: 0 4px 20px rgba(0,0,0,0.04);
        --radius: 16px;
    }

    .detail-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* ===== HEADER ===== */
    .detail-header {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        border-radius: var(--radius);
        padding: 30px 35px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .detail-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(102,126,234,0.05);
        border-radius: 50%;
    }
    .detail-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(118,75,162,0.04);
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
        background: rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.06);
    }
    .detail-header h4 {
        font-weight: 700;
        font-size: 22px;
        margin-bottom: 2px;
    }
    .detail-header p {
        opacity: 0.7;
        font-size: 14px;
        margin-bottom: 0;
    }
    .detail-header .badge-status {
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-draft { background: #e2e8f0; color: #4a5568; }
    .badge-proses { background: #fef3c7; color: #92400e; }
    .badge-dibayar { background: #d1fae5; color: #065f46; }
    .badge-batal { background: #fecaca; color: #991b1b; }

    /* ===== CARD ===== */
    .detail-card {
        background: white;
        border-radius: var(--radius);
        padding: 25px 30px;
        box-shadow: var(--shadow);
        border: 1px solid #f0f2f5;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .detail-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }
    .detail-card .card-title {
        font-weight: 600;
        color: #1e293b;
        font-size: 15px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f2f5;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .detail-card .card-title i {
        color: var(--primary);
    }

    /* ===== INFO GRID ===== */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .info-item {
        padding: 14px 18px;
        background: var(--bg-light);
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
        margin-bottom: 4px;
    }
    .info-item .label i {
        margin-right: 4px;
        color: var(--primary);
    }
    .info-item .value {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-item .value .text-muted {
        font-weight: 400;
        font-size: 13px;
    }
    .info-item .value i {
        font-size: 14px;
        color: var(--primary);
    }

    /* ===== RINCIAN GAJI ===== */
    .salary-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 12px;
    }
    .salary-item {
        padding: 14px 18px;
        background: var(--bg-light);
        border-radius: 12px;
        border: 1px solid #f0f2f5;
        text-align: center;
        transition: all 0.3s ease;
    }
    .salary-item:hover {
        background: #f1f5f9;
        transform: translateY(-3px);
    }
    .salary-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: block;
        margin-bottom: 4px;
    }
    .salary-item .label i {
        margin-right: 4px;
    }
    .salary-item .value {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }
    .salary-item .value.positive { color: var(--success); }
    .salary-item .value.negative { color: var(--danger); }
    .salary-item .value.total { color: var(--primary); font-size: 20px; }

    /* ===== REKAP ABSEN ===== */
    .absen-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
    .absen-item {
        padding: 16px;
        background: var(--bg-light);
        border-radius: 12px;
        border: 1px solid #f0f2f5;
        text-align: center;
        transition: all 0.3s ease;
    }
    .absen-item:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }
    .absen-item .number {
        font-size: 24px;
        font-weight: 800;
    }
    .absen-item .label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 500;
        display: block;
        margin-top: 2px;
    }
    .absen-item .number.hadir { color: var(--success); }
    .absen-item .number.izin { color: var(--warning); }
    .absen-item .number.sakit { color: var(--danger); }
    .absen-item .number.alpha { color: var(--gray); }

    /* ===== BUTTONS ===== */
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
    .btn-action {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* ===== MODAL ===== */
    .modal-content {
        border-radius: 16px !important;
        border: none !important;
        overflow: hidden !important;
    }
    .modal-header {
        padding: 18px 24px !important;
        border: none !important;
    }
    .modal-body {
        padding: 24px !important;
    }
    .modal-footer {
        padding: 16px 24px !important;
        border-top: 1px solid #f0f2f5 !important;
    }
    .modal .form-control {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 14px;
        transition: all 0.3s ease;
    }
    .modal .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
    }
    .modal .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 4px;
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
        .info-grid {
            grid-template-columns: 1fr;
        }
        .salary-grid {
            grid-template-columns: 1fr 1fr;
        }
        .absen-grid {
            grid-template-columns: 1fr 1fr;
        }
        .detail-card {
            padding: 18px;
        }
        .detail-card .card-title {
            font-size: 14px;
        }
        .info-item .value {
            font-size: 14px;
        }
        .salary-item .value {
            font-size: 14px;
        }
        .salary-item .value.total {
            font-size: 17px;
        }
        .absen-item .number {
            font-size: 20px;
        }
    }
    @media (max-width: 480px) {
        .salary-grid {
            grid-template-columns: 1fr;
        }
        .absen-grid {
            grid-template-columns: 1fr 1fr;
        }
        .detail-header h4 {
            font-size: 18px;
        }
        .btn-action {
            padding: 8px 16px;
            font-size: 13px;
        }
        .btn-back {
            padding: 8px 16px;
            font-size: 13px;
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
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div>
                            <h4>Detail Gajian</h4>
                            <p>Detail lengkap data gajian karyawan</p>
                        </div>
                    </div>
                    <span class="badge-status badge-{{ $gajian->status ?? 'draft' }}">
                        <i class="fas 
                            {{ $gajian->status == 'dibayar' ? 'fa-check-circle' : 
                               ($gajian->status == 'proses' ? 'fa-spinner' : 
                                ($gajian->status == 'batal' ? 'fa-times-circle' : 'fa-file-alt')) }} 
                            me-1">
                        </i>
                        {{ ucfirst($gajian->status ?? 'Draft') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- ===== INFORMASI KARYAWAN ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-user-circle"></i> Informasi Karyawan
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label"><i class="fas fa-user"></i> Nama Karyawan</span>
                    <div class="value">
                        <i class="fas fa-user text-primary"></i>
                        {{ $gajian->user->name ?? '-' }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-envelope"></i> Email</span>
                    <div class="value">
                        <i class="fas fa-envelope text-primary"></i>
                        {{ $gajian->user->email ?? '-' }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-phone"></i> Telepon</span>
                    <div class="value">
                        <i class="fas fa-phone text-primary"></i>
                        {{ $gajian->user->phone ?? '-' }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-calendar-plus"></i> Bergabung</span>
                    <div class="value">
                        <i class="fas fa-calendar text-primary"></i>
                        {{ $gajian->user->created_at ? \Carbon\Carbon::parse($gajian->user->created_at)->isoFormat('D MMMM YYYY') : '-' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== INFORMASI GAJIAN ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-info-circle"></i> Informasi Gajian
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label"><i class="fas fa-calendar-alt"></i> Tanggal Gaji</span>
                    <div class="value">
                        <i class="fas fa-calendar-day text-primary"></i>
                        {{ $gajian->tanggal_gaji ? \Carbon\Carbon::parse($gajian->tanggal_gaji)->isoFormat('dddd, D MMMM YYYY') : '-' }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-calendar-week"></i> Periode</span>
                    <div class="value">
                        <i class="fas fa-calendar-alt text-primary"></i>
                        {{ $gajian->periode ?? '-' }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-tag"></i> Jenis Gaji</span>
                    <div class="value">
                        <i class="fas fa-tag text-primary"></i>
                        {{ ucfirst($gajian->jenis_gaji ?? '-') }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label"><i class="fas fa-clock"></i> Dibuat</span>
                    <div class="value">
                        <i class="fas fa-clock text-primary"></i>
                        {{ $gajian->created_at ? \Carbon\Carbon::parse($gajian->created_at)->isoFormat('D MMMM YYYY, HH:mm') : '-' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== RINCIAN GAJI ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-calculator"></i> Rincian Gaji
            </div>
            <div class="salary-grid">
                <div class="salary-item">
                    <span class="label"><i class="fas fa-money-bill"></i> Gaji Pokok</span>
                    <div class="value positive">
                        Rp {{ number_format($gajian->gaji_pokok ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="salary-item">
                    <span class="label"><i class="fas fa-plus-circle"></i> Tunjangan</span>
                    <div class="value positive">
                        Rp {{ number_format($gajian->tunjangan ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="salary-item">
                    <span class="label"><i class="fas fa-star"></i> Bonus</span>
                    <div class="value positive">
                        Rp {{ number_format($gajian->bonus ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="salary-item">
                    <span class="label"><i class="fas fa-minus-circle"></i> Potongan</span>
                    <div class="value negative">
                        - Rp {{ number_format($gajian->potongan ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="salary-item" style="grid-column: span 3; background: linear-gradient(135deg, #eef2ff, #e0e7ff); border-color: #667eea;">
                    <span class="label"><i class="fas fa-receipt"></i> Total Gaji</span>
                    <div class="value total">
                        Rp {{ number_format($gajian->total_gaji ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== REKAP ABSEN ===== -->
        <div class="detail-card">
            <div class="card-title">
                <i class="fas fa-clipboard-list"></i> Rekap Absen
            </div>
            <div class="absen-grid">
                <div class="absen-item">
                    <div class="number hadir">{{ $gajian->total_hadir ?? 0 }}</div>
                    <span class="label"><i class="fas fa-check-circle text-success"></i> Hadir</span>
                </div>
                <div class="absen-item">
                    <div class="number izin">{{ $gajian->total_izin ?? 0 }}</div>
                    <span class="label"><i class="fas fa-clock text-warning"></i> Izin</span>
                </div>
                <div class="absen-item">
                    <div class="number sakit">{{ $gajian->total_sakit ?? 0 }}</div>
                    <span class="label"><i class="fas fa-notes-medical text-danger"></i> Sakit</span>
                </div>
                <div class="absen-item">
                    <div class="number alpha">{{ $gajian->total_alpha ?? 0 }}</div>
                    <span class="label"><i class="fas fa-times-circle text-secondary"></i> Alpha</span>
                </div>
            </div>
            @if(($gajian->total_lembur ?? 0) > 0)
                <div class="text-center mt-3">
                    <span class="badge bg-info">
                        <i class="fas fa-clock me-1"></i>
                        Total Lembur: {{ $gajian->total_lembur }} jam
                    </span>
                </div>
            @endif
        </div>

        <!-- ===== CATATAN ===== -->
        @if($gajian->keterangan || $gajian->rincian_pekerjaan)
            <div class="detail-card">
                <div class="card-title">
                    <i class="fas fa-sticky-note"></i> Catatan
                </div>
                @if($gajian->keterangan)
                    <div class="info-text" style="margin-bottom: 10px;">
                        <span class="label" style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 4px;">
                            <i class="fas fa-sticky-note"></i> Keterangan
                        </span>
                        <div style="font-size: 14px; color: #1e293b; padding: 10px 14px; background: #f8fafc; border-radius: 8px; border: 1px solid #f0f2f5;">
                            {{ $gajian->keterangan }}
                        </div>
                    </div>
                @endif
                @if($gajian->rincian_pekerjaan)
                    <div class="info-text">
                        <span class="label" style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 4px;">
                            <i class="fas fa-tasks"></i> Rincian Pekerjaan
                        </span>
                        <div style="font-size: 14px; color: #1e293b; padding: 10px 14px; background: #f8fafc; border-radius: 8px; border: 1px solid #f0f2f5;">
                            {{ $gajian->rincian_pekerjaan }}
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- ===== BUTTONS ===== -->
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.gajian') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button class="btn btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#modalStatus">
                <i class="fas fa-edit"></i> Ubah Status
            </button>
            <form action="{{ route('admin.gajian.delete', $gajian->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Yakin ingin menghapus data gajian ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ===== MODAL UBAH STATUS ===== -->
<div class="modal fade" id="modalStatus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Ubah Status Gajian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.gajian.update-status', $gajian->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="draft" {{ ($gajian->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="proses" {{ ($gajian->status ?? '') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="dibayar" {{ ($gajian->status ?? '') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="batal" {{ ($gajian->status ?? '') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Tambahkan keterangan">{{ $gajian->keterangan ?? '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection