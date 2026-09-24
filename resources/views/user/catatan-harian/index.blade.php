@extends('layouts.app')

@section('title', 'Catatan Harian - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ===== STATUS BADGE ===== */
    .status-badge {
        padding: 5px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-hadir { background: #d1fae5; color: #065f46; }
    .status-hadir i { color: #38a169; }
    .status-izin { background: #fef3c7; color: #92400e; }
    .status-izin i { color: #ed8936; }
    .status-sakit { background: #fce4ec; color: #c62828; }
    .status-sakit i { color: #653ee5; }
    .status-alpha { background: #fecaca; color: #991b1b; }
    .status-alpha i { color: #dc3545; }

    /* ===== STAT CARD ===== */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 22px 20px;
        text-align: center;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    }
    .stat-card.hadir::before { background: #38a169; }
    .stat-card.izin::before { background: #ed8936; }
    .stat-card.sakit::before { background: #e53e3e; }
    .stat-card.alpha::before { background: #dc3545; }
    .stat-card.total::before { background: linear-gradient(90deg, #667eea, #764ba2); }
    
    .stat-card .number {
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }
    .stat-card .label {
        font-size: 13px;
        color: #718096;
        font-weight: 500;
        margin-top: 2px;
    }
    .stat-card .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin: 0 auto 10px;
    }
    .stat-card.hadir .icon-circle { background: #d1fae5; color: #38a169; }
    .stat-card.izin .icon-circle { background: #fef3c7; color: #ed8936; }
    .stat-card.sakit .icon-circle { background: #fce4ec; color: #e53e3e; }
    .stat-card.alpha .icon-circle { background: #fecaca; color: #dc3545; }
    .stat-card.total .icon-circle { background: #eef2ff; color: #667eea; }
    .stat-card.hadir .number { color: #38a169; }
    .stat-card.izin .number { color: #ed8936; }
    .stat-card.sakit .number { color: #e53e3e; }
    .stat-card.alpha .number { color: #dc3545; }
    .stat-card.total .number { color: #667eea; }

    /* ===== CARD ===== */
    .card-harian {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .card-harian .card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #f0f0f0;
    }
    .card-harian .card-body {
        padding: 24px;
    }
    .card-harian .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    /* ===== TABLE ===== */
    .table-catatan thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 16px;
    }
    .table-catatan tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-catatan tbody tr:hover {
        background: #f8fafc;
    }

    /* ===== BUTTON ===== */
    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102,126,234,0.35);
        color: white;
    }
    .btn-warning-custom {
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-warning-custom:hover {
        transform: translateY(-2px);
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state .empty-icon {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 16px;
    }
    .empty-state h5 {
        color: #475569;
        margin-bottom: 8px;
    }
    .empty-state p {
        color: #94a3b8;
        margin-bottom: 16px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stat-card .number {
            font-size: 22px;
        }
        .stat-card .icon-circle {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        .table-catatan thead th {
            font-size: 10px;
            padding: 8px 10px;
        }
        .table-catatan tbody td {
            padding: 8px 10px;
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-primary mb-1">
                <i class="fas fa-clipboard-list me-2"></i>Catatan Harian
            </h4>
            <p class="text-muted">Kelola aktivitas harian Anda dengan mudah</p>
        </div>
        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus me-2"></i>Tambah Catatan
        </button>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 12px; border-left: 4px solid #38a169;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2 text-success"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 12px; border-left: 4px solid #dc3545;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2 text-danger"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- ===== STATISTIK ===== -->
    <div class="row g-3 mb-4">
        <div class="col-md-2 col-4">
            <div class="stat-card hadir">
                <div class="icon-circle"><i class="fas fa-check"></i></div>
                <div class="number">{{ $totalHadir }}</div>
                <div class="label">Hadir</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card izin">
                <div class="icon-circle"><i class="fas fa-clock"></i></div>
                <div class="number">{{ $totalIzin }}</div>
                <div class="label">Izin</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card sakit">
                <div class="icon-circle"><i class="fas fa-notes-medical"></i></div>
                <div class="number">{{ $totalSakit }}</div>
                <div class="label">Sakit</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card alpha">
                <div class="icon-circle"><i class="fas fa-times"></i></div>
                <div class="number">{{ $totalAlpha }}</div>
                <div class="label">Alpha</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card total">
                <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                <div class="number">{{ $riwayat->total() }}</div>
                <div class="label">Total</div>
            </div>
        </div>
    </div>

    <!-- ===== CATATAN HARI INI ===== -->
    @if($catatanHariIni)
        <div class="card card-harian mb-4 border-0 shadow-sm">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-calendar-day me-2"></i>Catatan Hari Ini
                    <span class="badge bg-light text-dark ms-2">
                        {{ \Carbon\Carbon::parse($catatanHariIni->tanggal)->format('d F Y') }}
                    </span>
                </h6>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $catatanHariIni->id }}">
                    <i class="fas fa-edit me-1"></i>Edit
                </button>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Karyawan</small>
                                <strong>{{ $user->name }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Jam Masuk</small>
                                <strong>{{ $catatanHariIni->jam_masuk ? \Carbon\Carbon::parse($catatanHariIni->jam_masuk)->format('H:i') : '-' }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Jam Pulang</small>
                                <strong>{{ $catatanHariIni->jam_pulang ? \Carbon\Carbon::parse($catatanHariIni->jam_pulang)->format('H:i') : '-' }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Status</small>
                                <span class="status-badge status-{{ $catatanHariIni->status }}">
                                    <i class="fas fa-circle" style="font-size: 8px;"></i>
                                    {{ ucfirst($catatanHariIni->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-project-diagram text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Proyek</small>
                                <strong>{{ $catatanHariIni->proyek ?? '-' }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-tasks text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Pekerjaan</small>
                                <strong>{{ $catatanHariIni->pekerjaan ?? '-' }}</strong>
                            </div>
                        </div>
                    </div>
                    @if($catatanHariIni->catatan)
                        <div class="col-12">
                            <div class="d-flex align-items-start gap-2">
                                <div class="bg-light rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-sticky-note text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Catatan</small>
                                    <strong>{{ $catatanHariIni->catatan }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info border-0 shadow-sm" style="border-radius: 12px; border-left: 4px solid #4299e1;">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-2 text-info" style="font-size: 20px;"></i>
                <div>
                    <strong>Belum ada catatan untuk hari ini.</strong>
                    <span class="text-muted">Mulai catat aktivitas Anda sekarang.</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambah" class="text-primary fw-bold text-decoration-none ms-1">
                        Tambah catatan
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- ===== RIWAYAT ===== -->
    <div class="card card-harian shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-primary">
                <i class="fas fa-history me-2"></i>Riwayat Catatan
            </h6>
            <span class="badge bg-primary rounded-pill">{{ $riwayat->total() }} Data</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-catatan mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Karyawan</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Proyek</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $item)
                            <tr>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 32px; height: 32px; font-size: 12px; font-weight: 700;">
                                            {{ strtoupper(substr($item->user->name ?? $user->name, 0, 2)) }}
                                        </div>
                                        <strong>{{ $item->user->name ?? $user->name }}</strong>
                                    </div>
                                </td>
                                <td>{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</td>
                                <td>{{ $item->jam_pulang ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') : '-' }}</td>
                                <td>{{ $item->proyek ?? '-' }}</td>
                                <td>
                                    <span class="status-badge status-{{ $item->status }}">
                                        <i class="fas fa-circle" style="font-size: 8px;"></i>
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-warning-custom btn-warning" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEdit{{ $item->id }}"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('user.catatan-harian.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning-custom btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <h5>Belum Ada Catatan</h5>
                                        <p>Mulai catat aktivitas harian Anda sekarang</p>
                                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                            <i class="fas fa-plus me-2"></i>Tambah Catatan
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top">
                {{ $riwayat->links() }}
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL TAMBAH ===== -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px 16px 0 0; padding: 20px 24px;">
                <h5 class="modal-title text-white">
                    <i class="fas fa-plus me-2"></i>Tambah Catatan Harian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('user.catatan-harian.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Pulang</label>
                            <input type="time" class="form-control" name="jam_pulang">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Proyek</label>
                        <input type="text" class="form-control" name="proyek" placeholder="Nama proyek">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pekerjaan</label>
                        <textarea class="form-control" name="pekerjaan" rows="2" placeholder="Deskripsi pekerjaan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="2" placeholder="Catatan tambahan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===== MODAL EDIT ===== -->
@foreach($riwayat as $item)
    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f6c23e 0%, #f59e0b 100%); border-radius: 16px 16px 0 0; padding: 20px 24px;">
                    <h5 class="modal-title text-dark">
                        <i class="fas fa-edit me-2"></i>Edit Catatan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('user.catatan-harian.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jam Masuk</label>
                                <input type="time" class="form-control" name="jam_masuk" 
                                       value="{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jam Pulang</label>
                                <input type="time" class="form-control" name="jam_pulang" 
                                       value="{{ $item->jam_pulang ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') : '' }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Proyek</label>
                            <input type="text" class="form-control" name="proyek" value="{{ $item->proyek }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pekerjaan</label>
                            <textarea class="form-control" name="pekerjaan" rows="2">{{ $item->pekerjaan }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan</label>
                            <textarea class="form-control" name="catatan" rows="2">{{ $item->catatan }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="hadir" {{ $item->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ $item->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ $item->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ $item->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
