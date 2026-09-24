@extends('layouts.app')

@section('title', 'Laporan Gajian - Admin')

@section('styles')
<style>
    /* ===== HEADER ===== */
    .laporan-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .laporan-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .laporan-header .content {
        position: relative;
        z-index: 1;
    }
    .laporan-header h4 {
        font-weight: 700;
        margin-bottom: 2px;
    }
    .laporan-header p {
        opacity: 0.8;
        margin-bottom: 0;
        font-size: 14px;
    }

    /* ===== STAT CARD ===== */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 18px 22px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        transition: all 0.3s ease;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .stat-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 8px;
    }
    .stat-card .stat-icon.purple { background: #eef2ff; color: #667eea; }
    .stat-card .stat-icon.green { background: #d1fae5; color: #38a169; }
    .stat-card .stat-icon.orange { background: #fef3c7; color: #ed8936; }
    .stat-card .stat-icon.blue { background: #dbeafe; color: #4299e1; }
    .stat-card .stat-icon.pink { background: #fce4ec; color: #f5576c; }
    .stat-card .stat-number {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
    }
    .stat-card .stat-label {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* ===== FILTER ===== */
    .filter-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        margin-bottom: 25px;
    }
    .filter-card .filter-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .filter-card .form-control,
    .filter-card .form-select {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 14px;
        transition: all 0.3s ease;
        font-size: 13px;
        background: #fafbfc;
        height: 44px;
    }
    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
    }
    .filter-card .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 12px;
        margin-bottom: 4px;
    }
    .btn-filter {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102,126,234,0.3);
        color: white;
    }
    .btn-reset {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f1f5f9;
        color: #475569;
        border: none;
    }
    .btn-reset:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* ===== TABLE ===== */
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
        font-size: 11px;
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
    .table-card .badge-total {
        background: #eef2ff;
        color: #667eea;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ===== BADGE ===== */
    .badge-role {
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-draft { background: #e2e8f0; color: #4a5568; }
    .badge-proses { background: #fef3c7; color: #92400e; }
    .badge-dibayar { background: #d1fae5; color: #065f46; }
    .badge-batal { background: #fecaca; color: #991b1b; }

    /* ===== CHART ===== */
    .chart-container {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
        margin-bottom: 25px;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state i {
        font-size: 50px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }
    .empty-state h5 {
        color: #475569;
    }
    .empty-state p {
        color: #94a3b8;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .laporan-header {
            padding: 20px;
            text-align: center;
        }
        .stat-card {
            padding: 15px;
        }
        .stat-card .stat-number {
            font-size: 20px;
        }
        .filter-card {
            padding: 15px;
        }
        .table-card {
            padding: 15px;
        }
        .table-card .table-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HEADER ===== -->
    <div class="laporan-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="content">
                    <h4>
                        <i class="fas fa-file-invoice me-2"></i>
                        Laporan Gajian
                    </h4>
                    <p>{{ $judulLaporan ?? 'Laporan Gajian' }}</p>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ now()->format('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- ===== STATISTIK ===== -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($totalGaji ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Total Gaji</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $totalDibayar ?? 0 }}</div>
                <div class="stat-label">Dibayar</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-spinner"></i>
                </div>
                <div class="stat-number">{{ $totalProses ?? 0 }}</div>
                <div class="stat-label">Proses</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon pink">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-number">{{ $totalDraft ?? 0 }}</div>
                <div class="stat-label">Draft</div>
            </div>
        </div>
    </div>

    <!-- ===== FILTER ===== -->
    <div class="filter-card">
        <div class="filter-title">
            <i class="fas fa-filter text-primary"></i>
            Filter Laporan
        </div>
        <form method="GET" action="{{ route('admin.laporan-gajian') }}" class="row g-3">
            <div class="col-md-2">
                <label class="form-label">Periode</label>
                <select name="periode" class="form-select" id="periodeSelect" onchange="togglePeriode()">
                    <option value="harian" {{ request('periode') == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="mingguan" {{ request('periode') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="bulanan" {{ request('periode') == 'bulanan' || !request('periode') ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>

            <!-- Periode Harian -->
            <div class="col-md-2 periode-harian" id="periodeHarian">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal', date('Y-m-d')) }}">
            </div>

            <!-- Periode Mingguan -->
            <div class="col-md-3 periode-mingguan" id="periodeMingguan" style="display:none;">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai', date('Y-m-d', strtotime('monday this week'))) }}">
            </div>
            <div class="col-md-3 periode-mingguan" id="periodeMingguan2" style="display:none;">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai', date('Y-m-d', strtotime('sunday this week'))) }}">
            </div>

            <!-- Periode Bulanan -->
            <div class="col-md-2 periode-bulanan" id="periodeBulanan">
                <label class="form-label">Bulan</label>
                <select name="bulan" class="form-select">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan', date('m')) == $i ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2 periode-bulanan" id="periodeBulanan2">
                <label class="form-label">Tahun</label>
                <select name="tahun" class="form-select">
                    @for($i = date('Y'); $i >= date('Y')-5; $i--)
                        <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
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

            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn-filter">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
                <a href="{{ route('admin.laporan-gajian') }}" class="btn-reset">
                    <i class="fas fa-undo me-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- ===== CHART ===== -->
    @if(!empty($chartData['labels']))
    <div class="chart-container">
        <h6 class="fw-bold mb-3">
            <i class="fas fa-chart-bar text-primary me-2"></i>
            Grafik Gajian
        </h6>
        <canvas id="gajiChart" height="200"></canvas>
    </div>
    @endif

    <!-- ===== TABLE ===== -->
    <div class="table-card">
        <div class="table-header">
            <h6>
                <i class="fas fa-list text-primary me-2"></i>
                Daftar Gajian
            </h6>
            <div>
                <span class="badge-total">
                    <i class="fas fa-database me-1"></i>
                    {{ $gajian->total() }} Data
                </span>
                <a href="#" class="btn btn-sm btn-success ms-2" onclick="alert('Fitur Export Coming Soon!')">
                    <i class="fas fa-file-excel me-1"></i>Export
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Periode</th>
                        <th>Gaji Pokok</th>
                        <th>Total Gaji</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gajian as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->user->name ?? '-' }}</strong>
                                <br>
                                <small class="text-muted">{{ $item->user->email ?? '-' }}</small>
                            </td>
                            <td>{{ $item->tanggal_formatted ?? '-' }}</td>
                            <td>{{ $item->periode ?? '-' }}</td>
                            <td>Rp {{ number_format($item->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge-role badge-{{ $item->status ?? 'draft' }}">
                                    {{ ucfirst($item->status ?? 'Draft') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.gajian.detail', $item->id) }}" 
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.gajian.delete', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h5>Belum Ada Data Gajian</h5>
                                    <p>Tidak ada data gajian untuk periode yang dipilih</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $gajian->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<script>
    function togglePeriode() {
        const periode = document.getElementById('periodeSelect').value;
        
        // Sembunyikan semua
        document.getElementById('periodeHarian').style.display = 'none';
        document.getElementById('periodeMingguan').style.display = 'none';
        document.getElementById('periodeMingguan2').style.display = 'none';
        document.getElementById('periodeBulanan').style.display = 'none';
        document.getElementById('periodeBulanan2').style.display = 'none';
        
        // Tampilkan sesuai pilihan
        if (periode === 'harian') {
            document.getElementById('periodeHarian').style.display = 'block';
        } else if (periode === 'mingguan') {
            document.getElementById('periodeMingguan').style.display = 'block';
            document.getElementById('periodeMingguan2').style.display = 'block';
        } else {
            document.getElementById('periodeBulanan').style.display = 'block';
            document.getElementById('periodeBulanan2').style.display = 'block';
        }
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', togglePeriode);
</script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if(!empty($chartData['labels']))
<script>
    const ctx = document.getElementById('gajiChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Total Gaji (Rp)',
                data: {!! json_encode($chartData['values']) !!},
                backgroundColor: 'rgba(102, 126, 234, 0.5)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 2,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endif
@endsection
