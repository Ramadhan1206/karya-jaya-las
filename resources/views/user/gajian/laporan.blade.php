@extends('layouts.app')

@section('title', 'Laporan Gajian - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ===== HEADER ===== */
    .laporan-header {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        border-radius: 16px;
        padding: 30px 35px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .laporan-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 50%;
    }
    .laporan-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(118, 75, 162, 0.04);
        border-radius: 50%;
    }
    .laporan-header .content {
        position: relative;
        z-index: 1;
    }
    .laporan-header .badge-header {
        background: rgba(255,255,255,0.12);
        padding: 5px 18px;
        border-radius: 50px;
        font-size: 12px;
        display: inline-block;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 6px;
    }
    .laporan-header h2 {
        font-weight: 800;
        font-size: 28px;
        margin-bottom: 2px;
    }
    .laporan-header h2 span {
        color: #667eea;
    }
    .laporan-header p {
        opacity: 0.7;
        font-size: 14px;
        margin-bottom: 0;
    }
    .laporan-header .btn-back {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    .laporan-header .btn-back:hover {
        background: rgba(255,255,255,0.2);
        color: white;
        transform: translateY(-2px);
    }

    /* ===== STATISTIK CARDS ===== */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 22px 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    }
    .stat-card .stat-icon {
        font-size: 32px;
        margin-bottom: 6px;
        display: block;
    }
    .stat-card .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    .stat-card .stat-label {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
        margin-top: 2px;
    }
    .stat-card.total::after { background: linear-gradient(90deg, #667eea, #764ba2); }
    .stat-card.total .stat-number { color: #667eea; }
    .stat-card.transaksi::after { background: #059669; }
    .stat-card.transaksi .stat-number { color: #059669; }
    .stat-card.tertinggi::after { background: #d97706; }
    .stat-card.tertinggi .stat-number { color: #d97706; }
    .stat-card.rata::after { background: #3b82f6; }
    .stat-card.rata .stat-number { color: #3b82f6; }

    /* ===== CARD SECTION ===== */
    .section-card {
        background: white;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }
    .section-card .section-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 17px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }
    .section-card .section-title i {
        color: #667eea;
        margin-right: 10px;
    }

    /* ===== CHART ===== */
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    /* ===== TABLE ===== */
    .table-wrapper {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.03);
    }
    .table-wrapper .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }
    .table-wrapper .table-header h5 {
        font-weight: 700;
        color: #0f172a;
        font-size: 16px;
        margin-bottom: 0;
    }
    .table-wrapper .table-header h5 i {
        color: #667eea;
        margin-right: 8px;
    }
    .table-wrapper .table-header .badge-total {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .table-wrapper table {
        margin-bottom: 0;
    }
    .table-wrapper table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e8ecf1;
        padding: 10px 14px;
    }
    .table-wrapper table tbody td {
        padding: 10px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
        color: #334155;
    }
    .table-wrapper table tbody tr:last-child td {
        border-bottom: none;
    }
    .table-wrapper table tbody tr:hover {
        background: #fafbff;
    }

    /* ===== BADGE STATUS ===== */
    .badge-status {
        padding: 3px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-dibayar { background: #d1fae5; color: #065f46; }
    .badge-proses { background: #fef3c7; color: #92400e; }
    .badge-draft { background: #f1f5f9; color: #475569; }
    .badge-batal { background: #fecaca; color: #991b1b; }

    /* ===== FILTER ===== */
    .filter-card {
        background: white;
        border-radius: 14px;
        padding: 20px 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }
    .filter-card .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 4px;
    }
    .filter-card .form-select {
        border-radius: 10px;
        border: 2px solid #e8ecf1;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fafbfc;
    }
    .filter-card .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.08);
        background: white;
    }
    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 10px 28px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
        color: white;
    }
    .btn-reset {
        background: #f1f5f9;
        border: none;
        border-radius: 10px;
        padding: 10px 28px;
        font-weight: 600;
        color: #475569;
        transition: all 0.3s ease;
    }
    .btn-reset:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .laporan-header {
            padding: 20px;
            text-align: center;
        }
        .laporan-header .btn-back {
            width: 100%;
            text-align: center;
        }
        .stat-card {
            padding: 16px 14px;
        }
        .stat-card .stat-number {
            font-size: 22px;
        }
        .stat-card .stat-icon {
            font-size: 26px;
        }
        .filter-card {
            padding: 16px;
        }
        .filter-card .row {
            gap: 10px;
        }
        .filter-card .btn-filter,
        .filter-card .btn-reset {
            width: 100%;
        }
        .section-card {
            padding: 16px;
        }
        .chart-container {
            height: 200px;
        }
        .table-wrapper {
            padding: 12px;
        }
        .table-wrapper .table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        .table-wrapper table thead th {
            font-size: 9px;
            padding: 6px 8px;
        }
        .table-wrapper table tbody td {
            font-size: 11px;
            padding: 6px 8px;
        }
    }
    @media (max-width: 480px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .stat-card {
            padding: 12px 10px;
        }
        .stat-card .stat-number {
            font-size: 18px;
        }
        .stat-card .stat-icon {
            font-size: 22px;
        }
        .stat-card .stat-label {
            font-size: 11px;
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
                    <span class="badge-header">
                        <i class="fas fa-file-alt me-1"></i> Laporan Gajian
                    </span>
                    <h2>
                        <i class="fas fa-chart-bar me-2"></i>
                        Laporan <span>Gajian</span>
                    </h2>
                    <p>
                        <i class="fas fa-user me-1"></i>
                        {{ $user->name ?? Auth::user()->name }} 
                        <span class="mx-2">|</span>
                        <i class="fas fa-calendar me-1"></i>
                        Tahun {{ $tahun ?? date('Y') }}
                    </p>
                </div>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <a href="{{ route('user.gajian.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <div class="col-12 d-md-none mt-3">
                <a href="{{ route('user.gajian.index') }}" class="btn-back w-100 text-center">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- ===== FILTER TAHUN ===== -->
    <div class="filter-card">
        <form method="GET" action="{{ route('user.gajian.laporan') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <select name="tahun" class="form-select">
                    @foreach($tahunTersedia ?? [] as $thn)
                        <option value="{{ $thn }}" {{ ($tahun ?? date('Y')) == $thn ? 'selected' : '' }}>
                            {{ $thn }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-filter w-100">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('user.gajian.laporan') }}" class="btn-reset w-100 text-center d-block">
                    <i class="fas fa-undo me-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- ===== STATISTIK ===== -->
    <div class="stat-grid">
        <div class="stat-card total">
            <span class="stat-icon">💰</span>
            <div class="stat-number">Rp {{ number_format($totalGajiTahun ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Total Gaji {{ $tahun ?? date('Y') }}</div>
        </div>
        <div class="stat-card transaksi">
            <span class="stat-icon">📋</span>
            <div class="stat-number">{{ $totalTransaksi ?? 0 }}</div>
            <div class="stat-label">Total Transaksi</div>
        </div>
        <div class="stat-card tertinggi">
            <span class="stat-icon">🏆</span>
            <div class="stat-number">Rp {{ number_format($gajiTertinggi ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Gaji Tertinggi</div>
        </div>
        <div class="stat-card rata">
            <span class="stat-icon">📊</span>
            <div class="stat-number">Rp {{ number_format($gajiRataRata ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Rata-Rata Gaji</div>
        </div>
    </div>

    <!-- ===== CHART ===== -->
    <div class="section-card">
        <div class="section-title">
            <i class="fas fa-chart-line"></i>
            Grafik Gaji Per Bulan - {{ $tahun ?? date('Y') }}
        </div>
        <div class="chart-container">
            <canvas id="gajiChart"></canvas>
        </div>
    </div>

    <!-- ===== RINGKASAN BULANAN ===== -->
    <div class="section-card">
        <div class="section-title">
            <i class="fas fa-calendar-alt"></i>
            Ringkasan Per Bulan
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Total Gaji</th>
                        <th>Transaksi</th>
                        <th>Rata-Rata</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $bulanNama = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    @endphp
                    @foreach($bulanNama as $index => $bulan)
                        @php
                            $bulanData = $gajiPerBulan[$index + 1] ?? ['total' => 0, 'count' => 0];
                        @endphp
                        <tr>
                            <td><strong>{{ $bulan }}</strong></td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($bulanData['total'] ?? 0, 0, ',', '.') }}
                            </td>
                            <td>{{ $bulanData['count'] ?? 0 }}</td>
                            <td>
                                Rp {{ number_format($bulanData['count'] > 0 ? ($bulanData['total'] / $bulanData['count']) : 0, 0, ',', '.') }}
                            </td>
                            <td>
                                @if(($bulanData['count'] ?? 0) > 0)
                                    <span class="badge-status badge-dibayar">
                                        <i class="fas fa-check-circle me-1"></i> Ada Data
                                    </span>
                                @else
                                    <span class="badge-status badge-draft">
                                        <i class="fas fa-minus-circle me-1"></i> Kosong
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="fw-bold" style="background: #f8fafc;">
                        <td>TOTAL</td>
                        <td class="text-primary" style="font-size: 16px;">
                            Rp {{ number_format($totalGajiTahun ?? 0, 0, ',', '.') }}
                        </td>
                        <td>{{ $totalTransaksi ?? 0 }}</td>
                        <td>
                            Rp {{ number_format($gajiRataRata ?? 0, 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- ===== DETAIL GAJIAN ===== -->
    <div class="table-wrapper">
        <div class="table-header">
            <h5>
                <i class="fas fa-list"></i>
                Detail Gajian {{ $tahun ?? date('Y') }}
            </h5>
            <span class="badge-total">{{ $gajian->total() ?? 0 }} Data</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Tanggal</th>
                        <th>Periode</th>
                        <th>Total Gaji</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gajian ?? [] as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->user->name ?? '-' }}</strong>
                                <br>
                                <small class="text-muted" style="font-size: 11px;">{{ $item->user->email ?? '-' }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_gaji)->format('d/m/Y') }}</td>
                            <td>{{ $item->periode ?? '-' }}</td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge-status badge-{{ $item->status ?? 'draft' }}">
                                    {{ ucfirst($item->status ?? 'Draft') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted d-block mb-2"></i>
                                <p class="text-muted">Belum ada data gajian</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $gajian->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- ===== SCRIPT CHART ===== -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('gajiChart').getContext('2d');

        // Data dari PHP
        const labels = {!! json_encode($chartLabels ?? []) !!};
        const data = {!! json_encode($chartData ?? []) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Gaji (Rp)',
                    data: data,
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.6)',
                        'rgba(102, 126, 234, 0.5)',
                        'rgba(102, 126, 234, 0.4)',
                        'rgba(102, 126, 234, 0.3)',
                        'rgba(102, 126, 234, 0.6)',
                        'rgba(102, 126, 234, 0.5)',
                        'rgba(102, 126, 234, 0.4)',
                        'rgba(102, 126, 234, 0.3)',
                        'rgba(102, 126, 234, 0.6)',
                        'rgba(102, 126, 234, 0.5)',
                        'rgba(102, 126, 234, 0.4)',
                        'rgba(102, 126, 234, 0.3)'
                    ],
                    borderColor: '#667eea',
                    borderWidth: 2,
                    borderRadius: 6,
                    barPercentage: 0.6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.raw || 0;
                                return label + ': Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            },
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.04)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection