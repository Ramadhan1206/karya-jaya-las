@extends('layouts.app')

@section('title', 'Laporan Gajian - Admin')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .page-header .content {
        position: relative;
        z-index: 1;
    }
    .page-header h4 {
        font-weight: 700;
        margin-bottom: 2px;
    }
    .page-header p {
        opacity: 0.8;
        margin-bottom: 0;
        font-size: 14px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    }
    .stat-card .number {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
    }
    .stat-card .label {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
    }
    .stat-card .icon {
        font-size: 24px;
        margin-bottom: 5px;
    }
    .stat-card.total .icon { color: #667eea; }
    .stat-card.draft .icon { color: #ed8936; }
    .stat-card.proses .icon { color: #4299e1; }
    .stat-card.dibayar .icon { color: #38a169; }
    .stat-card.batal .icon { color: #dc3545; }

    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        margin-bottom: 30px;
    }
    .filter-section .filter-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .filter-section .form-control,
    .filter-section .form-select {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 14px;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
    }
    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
    }
    .filter-section .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .table-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
    }
    .table-card .table-header {
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 15px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .table-card .table-header h6 {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0;
    }
    .table-card thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border-bottom: 2px solid #e2e8f0;
        padding: 10px 12px;
    }
    .table-card tbody td {
        padding: 10px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
        color: #334155;
    }
    .table-card tbody tr:last-child td {
        border-bottom: none;
    }
    .table-card tbody tr:hover {
        background: #f8fafc;
    }

    .status-badge {
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
    .status-draft { background: #e2e8f0; color: #4a5568; }
    .status-proses { background: #fef3c7; color: #92400e; }
    .status-dibayar { background: #d1fae5; color: #065f46; }
    .status-batal { background: #fecaca; color: #991b1b; }

    .btn-export {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #38a169, #2f855a);
        color: white;
        border: none;
    }
    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(56,161,105,0.35);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="content">
                    <h4>
                        <i class="fas fa-file-alt me-2"></i>
                        Laporan Gajian
                    </h4>
                    <p>Lihat dan export data gajian karyawan</p>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ now()->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- ===== STATISTIK ===== -->
    <div class="row g-4 mb-4">
        <div class="col-md-2 col-4">
            <div class="stat-card total">
                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="number">Rp {{ number_format($totalGaji, 0, ',', '.') }}</div>
                <div class="label">Total Gaji</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card draft">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <div class="number">{{ $totalDraft }}</div>
                <div class="label">Draft</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card proses">
                <div class="icon"><i class="fas fa-spinner"></i></div>
                <div class="number">{{ $totalProses }}</div>
                <div class="label">Proses</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card dibayar">
                <div class="icon"><i class="fas fa-check-circle"></i></div>
                <div class="number">{{ $totalDibayar }}</div>
                <div class="label">Dibayar</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card batal">
                <div class="icon"><i class="fas fa-times-circle"></i></div>
                <div class="number">{{ $totalBatal }}</div>
                <div class="label">Batal</div>
            </div>
        </div>
        <div class="col-md-2 col-4">
            <div class="stat-card" style="border: 1px solid #667eea;">
                <div class="icon" style="color: #667eea;"><i class="fas fa-file-excel"></i></div>
                <div class="number" style="font-size: 14px;">
                    <form method="POST" action="{{ route('admin.laporan-gajian.export') }}" id="exportForm">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                        <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                        <button type="submit" class="btn-export" style="font-size: 12px; padding: 8px 16px;">
                            <i class="fas fa-file-excel me-2"></i>Export Excel
                        </button>
                    </form>
                </div>
                <div class="label">Export Data</div>
            </div>
        </div>
    </div>

    <!-- ===== FILTER ===== -->
    <div class="filter-section">
        <div class="filter-title">
            <i class="fas fa-filter text-primary"></i>
            Filter Data
        </div>
        <form method="GET" action="{{ route('admin.laporan-gajian') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Karyawan</label>
                <select name="user_id" class="form-select">
                    <option value="">Semua Karyawan</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-50">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
                <a href="{{ route('admin.laporan-gajian') }}" class="btn btn-secondary w-50">
                    <i class="fas fa-undo me-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- ===== TABLE ===== -->
    <div class="table-card">
        <div class="table-header">
            <h6>
                <i class="fas fa-list me-2 text-primary"></i>
                Data Gajian
            </h6>
            <span class="badge bg-primary">{{ $gajian->total() }} Data</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Periode</th>
                        <th>Jenis</th>
                        <th>Gaji Pokok</th>
                        <th>Total Gaji</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gajian as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->user->name ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->tanggal_gaji ? date('d/m/Y', strtotime($item->tanggal_gaji)) : '-' }}</td>
                            <td>{{ $item->periode ?? '-' }}</td>
                            <td>{{ ucfirst($item->jenis_gaji ?? '-') }}</td>
                            <td>Rp {{ number_format($item->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="status-badge status-{{ $item->status ?? 'draft' }}">
                                    {{ ucfirst($item->status ?? 'Draft') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox d-block mb-2" style="font-size: 30px;"></i>
                                Belum ada data gajian
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $gajian->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection