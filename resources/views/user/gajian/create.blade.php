@extends('layouts.app')

@section('title', 'Tambah Gajian - Karya Jaya Las Konstruksi')

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
    .hero-header .subtitle i { margin-right: 6px; }
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
       CARD
       ============================================ */
    .form-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 30px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.02);
    }
    .form-card .section-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 16px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
    }
    .form-card .section-title i {
        color: #667eea;
        margin-right: 8px;
    }

    /* ============================================
       REKAP ABSEN
       ============================================ */
    .rekap-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }
    .rekap-box .rekap-title {
        font-weight: 600;
        color: #0f172a;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .rekap-box .rekap-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
    .rekap-box .rekap-item {
        text-align: center;
        padding: 8px;
        background: white;
        border-radius: 8px;
    }
    .rekap-box .rekap-item .number {
        font-size: 18px;
        font-weight: 800;
    }
    .rekap-box .rekap-item .number.text-success { color: #059669; }
    .rekap-box .rekap-item .number.text-warning { color: #d97706; }
    .rekap-box .rekap-item .number.text-danger { color: #dc2626; }
    .rekap-box .rekap-item .number.text-secondary { color: #64748b; }
    .rekap-box .rekap-item .label {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
        display: block;
        margin-top: 2px;
    }
    .rekap-box .rekap-total {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #e2e8f0;
        font-size: 14px;
    }
    .rekap-box .rekap-total .label { color: #475569; }
    .rekap-box .rekap-total .value { font-weight: 700; color: #0f172a; }

    /* ============================================
       FORM
       ============================================ */
    .form-control {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 14px;
        transition: var(--transition);
        font-size: 14px;
        background: white;
        width: 100%;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.08);
        outline: none;
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 4px;
        display: block;
    }
    .form-label i {
        color: #667eea;
        margin-right: 4px;
    }
    .text-danger { color: #dc2626 !important; }

    /* ============================================
       BUTTON
       ============================================ */
    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 600;
        color: white;
        transition: var(--transition);
        box-shadow: 0 4px 20px rgba(102,126,234,0.3);
        font-size: 15px;
        cursor: pointer;
    }
    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 35px rgba(102,126,234,0.5);
        color: white;
    }
    .btn-cancel {
        background: #f1f5f9;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 600;
        color: #475569;
        transition: var(--transition);
        font-size: 15px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* ============================================
       ALERT
       ============================================ */
    .alert-custom {
        border-radius: 12px;
        border-left: 4px solid #dc2626;
        padding: 14px 20px;
        margin-bottom: 20px;
        background: #fef2f2;
        color: #991b1b;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-custom i {
        font-size: 18px;
    }
    .alert-custom .btn-close-custom {
        margin-left: auto;
        background: none;
        border: none;
        font-size: 18px;
        color: #991b1b;
        cursor: pointer;
    }
    .alert-custom .btn-close-custom:hover {
        color: #7f1d1d;
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
        .form-card { padding: 16px; }
        .rekap-box .rekap-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .rekap-box .rekap-total {
            flex-direction: column;
            text-align: center;
            gap: 4px;
        }
        .btn-save, .btn-cancel {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
        .d-flex.gap-3 { flex-direction: column; }
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
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah <span>Gajian</span>
                    </h2>
                    <p class="subtitle">Isi data gajian dengan lengkap</p>
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
    ALERT ERROR
    ============================================ -->
    @if(session('error'))
        <div class="alert-custom">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="btn-close-custom" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-custom">
            <i class="fas fa-exclamation-circle"></i>
            <span>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
            <button class="btn-close-custom" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif

    <!-- ============================================
    FORM
    ============================================ -->
    <div class="form-card">
        <!-- ===== REKAP ABSEN ===== -->
        <div class="rekap-box">
            <div class="rekap-title">
                <i class="fas fa-clipboard-list me-2" style="color: #667eea;"></i>
                Rekap Absen Bulan Ini
                <span style="font-size: 13px; font-weight: 400; color: #94a3b8;">{{ date('F Y') }}</span>
            </div>
            <div class="rekap-grid">
                <div class="rekap-item">
                    <div class="number text-success">{{ $totalHadir ?? 0 }}</div>
                    <span class="label">Hadir</span>
                </div>
                <div class="rekap-item">
                    <div class="number text-warning">{{ $totalIzin ?? 0 }}</div>
                    <span class="label">Izin</span>
                </div>
                <div class="rekap-item">
                    <div class="number text-danger">{{ $totalSakit ?? 0 }}</div>
                    <span class="label">Sakit</span>
                </div>
                <div class="rekap-item">
                    <div class="number text-secondary">{{ $totalAlpha ?? 0 }}</div>
                    <span class="label">Alpha</span>
                </div>
            </div>
            <div class="rekap-total">
                <span class="label">Gaji Per Hari:</span>
                <span class="value">Rp {{ number_format($gajiPerHari ?? 150000, 0, ',', '.') }}</span>
                <span class="label">Total Gaji Pokok:</span>
                <span class="value" style="color: #667eea;">Rp {{ number_format($gajiPokok ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- ===== FORM ===== -->
        <form method="POST" action="{{ route('user.gajian.store') }}">
            @csrf

            <div class="row">
                <!-- ===== NAMA LENGKAP (INPUT TEXT) ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-user"></i> Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                        class="form-control @error('nama_lengkap') is-invalid @enderror" 
                        name="nama_lengkap" 
                        value="{{ old('nama_lengkap', Auth::user()->name) }}" 
                        placeholder="Masukkan nama lengkap karyawan"
                        required>
                    <small class="text-muted">Masukkan nama lengkap karyawan yang akan digaji</small>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TANGGAL GAJI ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-calendar"></i> Tanggal Gaji <span class="text-danger">*</span>
                    </label>
                    <input type="date" 
                           class="form-control @error('tanggal_gaji') is-invalid @enderror" 
                           name="tanggal_gaji" 
                           value="{{ old('tanggal_gaji', $today ?? date('Y-m-d')) }}" 
                           required>
                    @error('tanggal_gaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== JENIS GAJI ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-tag"></i> Jenis Gaji <span class="text-danger">*</span>
                    </label>
                    <select class="form-control @error('jenis_gaji') is-invalid @enderror" name="jenis_gaji" required>
                        <option value="harian" {{ old('jenis_gaji') == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="mingguan" {{ old('jenis_gaji') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ old('jenis_gaji') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                    @error('jenis_gaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== STATUS ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-info-circle"></i> Status <span class="text-danger">*</span>
                    </label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="dibayar" {{ old('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                        <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== GAJI POKOK ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-money-bill"></i> Gaji Pokok <span class="text-danger">*</span>
                    </label>
                    <input type="number" 
                           class="form-control @error('gaji_pokok') is-invalid @enderror" 
                           name="gaji_pokok" 
                           value="{{ old('gaji_pokok', $gajiPokok ?? 0) }}" 
                           step="1000" 
                           required>
                    @error('gaji_pokok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TUNJANGAN ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-plus-circle text-success"></i> Tunjangan
                    </label>
                    <input type="number" 
                           class="form-control @error('tunjangan') is-invalid @enderror" 
                           name="tunjangan" 
                           value="{{ old('tunjangan', 0) }}" 
                           step="1000">
                    @error('tunjangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== BONUS ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-star text-warning"></i> Bonus
                    </label>
                    <input type="number" 
                           class="form-control @error('bonus') is-invalid @enderror" 
                           name="bonus" 
                           value="{{ old('bonus', 0) }}" 
                           step="1000">
                    @error('bonus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== POTONGAN ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-minus-circle text-danger"></i> Potongan
                    </label>
                    <input type="number" 
                           class="form-control @error('potongan') is-invalid @enderror" 
                           name="potongan" 
                           value="{{ old('potongan', 0) }}" 
                           step="1000">
                    @error('potongan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TOTAL HADIR ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-user-check text-success"></i> Total Hadir
                    </label>
                    <input type="number" 
                           class="form-control @error('total_hadir') is-invalid @enderror" 
                           name="total_hadir" 
                           value="{{ old('total_hadir', $totalHadir ?? 0) }}">
                    @error('total_hadir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TOTAL IZIN ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-user-clock text-warning"></i> Total Izin
                    </label>
                    <input type="number" 
                           class="form-control @error('total_izin') is-invalid @enderror" 
                           name="total_izin" 
                           value="{{ old('total_izin', $totalIzin ?? 0) }}">
                    @error('total_izin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TOTAL SAKIT ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-user-injured text-danger"></i> Total Sakit
                    </label>
                    <input type="number" 
                           class="form-control @error('total_sakit') is-invalid @enderror" 
                           name="total_sakit" 
                           value="{{ old('total_sakit', $totalSakit ?? 0) }}">
                    @error('total_sakit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TOTAL ALPHA ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-user-slash text-secondary"></i> Total Alpha
                    </label>
                    <input type="number" 
                           class="form-control @error('total_alpha') is-invalid @enderror" 
                           name="total_alpha" 
                           value="{{ old('total_alpha', $totalAlpha ?? 0) }}">
                    @error('total_alpha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== TOTAL LEMBUR ===== -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-clock text-info"></i> Total Lembur
                    </label>
                    <input type="number" 
                           class="form-control @error('total_lembur') is-invalid @enderror" 
                           name="total_lembur" 
                           value="{{ old('total_lembur', 0) }}">
                    @error('total_lembur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== KETERANGAN ===== -->
                <div class="col-12 mb-3">
                    <label class="form-label">
                        <i class="fas fa-sticky-note"></i> Keterangan
                    </label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              name="keterangan" 
                              rows="2">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== RINCIAN PEKERJAAN ===== -->
                <div class="col-12 mb-3">
                    <label class="form-label">
                        <i class="fas fa-tasks"></i> Rincian Pekerjaan
                    </label>
                    <textarea class="form-control @error('rincian_pekerjaan') is-invalid @enderror" 
                              name="rincian_pekerjaan" 
                              rows="2">{{ old('rincian_pekerjaan') }}</textarea>
                    @error('rincian_pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- ===== BUTTONS ===== -->
            <div class="d-flex gap-3 mt-3 flex-wrap">
                <a href="{{ route('user.gajian.index') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-2"></i> Simpan Gajian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
