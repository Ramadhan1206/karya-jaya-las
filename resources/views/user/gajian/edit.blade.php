@extends('layouts.app')

@section('title', 'Edit Gajian - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .edit-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 30px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        max-width: 800px;
        margin: 0 auto;
    }
    .edit-card .header-icon {
        font-size: 48px;
        color: #f6c23e;
        display: inline-block;
        background: rgba(246,194,62,0.08);
        padding: 16px 20px;
        border-radius: 16px;
        margin-bottom: 16px;
    }
    .edit-card h4 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }
    .edit-card p {
        color: #94a3b8;
        font-size: 14px;
        margin-bottom: 24px;
    }
    .edit-card .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
    }
    .edit-card .form-control:focus {
        border-color: #f6c23e;
        background: white;
        box-shadow: 0 0 0 4px rgba(246,194,62,0.08);
    }
    .edit-card .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 6px;
    }
    .edit-card .form-label i {
        margin-right: 6px;
    }
    .edit-card .btn-submit {
        background: linear-gradient(135deg, #f6c23e 0%, #f59e0b 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.4s ease;
        box-shadow: 0 4px 25px rgba(246,194,62,0.3);
    }
    .edit-card .btn-submit:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 50px rgba(246,194,62,0.5);
        color: white;
    }
    .edit-card .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 14px 32px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .edit-card .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateY(-2px);
    }
    .edit-card .section-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 16px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .edit-card .section-title i {
        color: #f6c23e;
    }
    .edit-card .rekap-item {
        background: #f8fafc;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    .edit-card .rekap-item:hover {
        border-color: #e2e8f0;
        transform: translateY(-2px);
    }
    .edit-card .rekap-item .rekap-number {
        font-size: 24px;
        font-weight: 800;
    }
    .edit-card .rekap-item .rekap-label {
        font-size: 12px;
        font-weight: 500;
        opacity: 0.7;
    }
    .edit-card .rekap-item.hadir .rekap-number { color: #38a169; }
    .edit-card .rekap-item.izin .rekap-number { color: #ed8936; }
    .edit-card .rekap-item.sakit .rekap-number { color: #e53e3e; }
    .edit-card .rekap-item.alpha .rekap-number { color: #a0aec0; }

    .edit-card .total-gaji-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 16px 24px;
        color: white;
        text-align: center;
    }
    .edit-card .total-gaji-box .label {
        font-size: 14px;
        opacity: 0.8;
    }
    .edit-card .total-gaji-box .number {
        font-size: 28px;
        font-weight: 800;
    }

    @media (max-width: 768px) {
        .edit-card {
            padding: 20px;
        }
        .edit-card .rekap-item .rekap-number {
            font-size: 18px;
        }
        .edit-card .total-gaji-box .number {
            font-size: 22px;
        }
        .d-flex.flex-wrap {
            flex-direction: column;
        }
        .btn-submit, .btn-cancel {
            width: 100%;
            justify-content: center;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="edit-card">
                <!-- Header -->
                <div class="text-center">
                    <div class="header-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h4>Edit Gajian</h4>
                    <p>Perbarui data gajian karyawan</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px; border-left: 4px solid #38a169;">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 12px; border-left: 4px solid #e53e3e;">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Terjadi kesalahan:
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.gajian.update', $gajian->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- ===== NAMA LENGKAP ===== -->
                    <div class="section-title">
                        <i class="fas fa-user"></i>
                        Data Karyawan
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-user text-primary"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_lengkap') is-invalid @enderror" 
                               name="nama_lengkap" 
                               value="{{ old('nama_lengkap', $gajian->user->name ?? Auth::user()->name) }}" 
                               placeholder="Masukkan nama lengkap karyawan">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Masukkan nama lengkap karyawan yang menerima gaji</small>
                    </div>

                    <!-- ===== INFORMASI GAJI ===== -->
                    <div class="section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Informasi Gaji
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar text-primary"></i>Tanggal Gaji <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('tanggal_gaji') is-invalid @enderror" 
                                   name="tanggal_gaji" 
                                   value="{{ old('tanggal_gaji', $gajian->tanggal_gaji ? $gajian->tanggal_gaji->format('Y-m-d') : '') }}" 
                                   required>
                            @error('tanggal_gaji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-tag text-primary"></i>Jenis Gaji <span class="text-danger">*</span>
                            </label>
                            <select class="form-control @error('jenis_gaji') is-invalid @enderror" name="jenis_gaji" required>
                                <option value="harian" {{ old('jenis_gaji', $gajian->jenis_gaji) == 'harian' ? 'selected' : '' }}>Harian</option>
                                <option value="mingguan" {{ old('jenis_gaji', $gajian->jenis_gaji) == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                <option value="bulanan" {{ old('jenis_gaji', $gajian->jenis_gaji) == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            </select>
                            @error('jenis_gaji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- ===== REKAP ABSEN ===== -->
                    <div class="section-title">
                        <i class="fas fa-clipboard-list"></i>
                        Rekap Absen
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-3">
                            <div class="rekap-item hadir">
                                <div class="rekap-number">{{ $gajian->total_hadir ?? 0 }}</div>
                                <div class="rekap-label"><i class="fas fa-check-circle me-1"></i>Hadir</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="rekap-item izin">
                                <div class="rekap-number">{{ $gajian->total_izin ?? 0 }}</div>
                                <div class="rekap-label"><i class="fas fa-clock me-1"></i>Izin</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="rekap-item sakit">
                                <div class="rekap-number">{{ $gajian->total_sakit ?? 0 }}</div>
                                <div class="rekap-label"><i class="fas fa-notes-medical me-1"></i>Sakit</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="rekap-item alpha">
                                <div class="rekap-number">{{ $gajian->total_alpha ?? 0 }}</div>
                                <div class="rekap-label"><i class="fas fa-times-circle me-1"></i>Alpha</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-check text-success"></i>Total Hadir
                            </label>
                            <input type="number" 
                                   class="form-control @error('total_hadir') is-invalid @enderror" 
                                   name="total_hadir" 
                                   value="{{ old('total_hadir', $gajian->total_hadir ?? 0) }}" 
                                   min="0">
                            @error('total_hadir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-clock text-warning"></i>Total Izin
                            </label>
                            <input type="number" 
                                   class="form-control @error('total_izin') is-invalid @enderror" 
                                   name="total_izin" 
                                   value="{{ old('total_izin', $gajian->total_izin ?? 0) }}" 
                                   min="0">
                            @error('total_izin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-injured text-danger"></i>Total Sakit
                            </label>
                            <input type="number" 
                                   class="form-control @error('total_sakit') is-invalid @enderror" 
                                   name="total_sakit" 
                                   value="{{ old('total_sakit', $gajian->total_sakit ?? 0) }}" 
                                   min="0">
                            @error('total_sakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-slash text-secondary"></i>Total Alpha
                            </label>
                            <input type="number" 
                                   class="form-control @error('total_alpha') is-invalid @enderror" 
                                   name="total_alpha" 
                                   value="{{ old('total_alpha', $gajian->total_alpha ?? 0) }}" 
                                   min="0">
                            @error('total_alpha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- ===== KOMPONEN GAJI ===== -->
                    <div class="section-title">
                        <i class="fas fa-coins"></i>
                        Komponen Gaji
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-money-bill text-primary"></i>Gaji Pokok <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('gaji_pokok') is-invalid @enderror" 
                                   name="gaji_pokok" 
                                   value="{{ old('gaji_pokok', $gajian->gaji_pokok ?? 0) }}" 
                                   step="1000" 
                                   required>
                            @error('gaji_pokok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-gift text-primary"></i>Tunjangan
                            </label>
                            <input type="number" 
                                   class="form-control @error('tunjangan') is-invalid @enderror" 
                                   name="tunjangan" 
                                   value="{{ old('tunjangan', $gajian->tunjangan ?? 0) }}" 
                                   step="1000">
                            @error('tunjangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-star text-primary"></i>Bonus
                            </label>
                            <input type="number" 
                                   class="form-control @error('bonus') is-invalid @enderror" 
                                   name="bonus" 
                                   value="{{ old('bonus', $gajian->bonus ?? 0) }}" 
                                   step="1000">
                            @error('bonus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-minus-circle text-primary"></i>Potongan
                            </label>
                            <input type="number" 
                                   class="form-control @error('potongan') is-invalid @enderror" 
                                   name="potongan" 
                                   value="{{ old('potongan', $gajian->potongan ?? 0) }}" 
                                   step="1000">
                            @error('potongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- ===== TOTAL GAJI OTOMATIS ===== -->
                    <div class="total-gaji-box mb-4">
                        <div class="label">Total Gaji</div>
                        <div class="number" id="totalGajiDisplay">
                            Rp {{ number_format(
                                ($gajian->gaji_pokok ?? 0) + 
                                ($gajian->tunjangan ?? 0) + 
                                ($gajian->bonus ?? 0) - 
                                ($gajian->potongan ?? 0), 
                                0, ',', '.'
                            ) }}
                        </div>
                        <small style="opacity:0.7;">(Dihitung otomatis dari komponen di atas)</small>
                    </div>

                    <!-- ===== STATUS ===== -->
                    <div class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Status
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-flag text-primary"></i>Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                            <option value="draft" {{ old('status', $gajian->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="proses" {{ old('status', $gajian->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="dibayar" {{ old('status', $gajian->status) == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="batal" {{ old('status', $gajian->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ===== KETERANGAN ===== -->
                    <div class="section-title">
                        <i class="fas fa-sticky-note"></i>
                        Keterangan
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-pen text-primary"></i>Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  name="keterangan" 
                                  rows="3">{{ old('keterangan', $gajian->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ===== BUTTON ===== -->
                    <div class="d-flex flex-wrap justify-content-between gap-3 mt-4 pt-3 border-top">
                        <a href="{{ route('user.gajian.index') }}" class="btn-cancel">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Update Gajian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ===== HITUNG TOTAL GAJI OTOMATIS =====
    document.addEventListener('DOMContentLoaded', function() {
        const gajiPokok = document.querySelector('input[name="gaji_pokok"]');
        const tunjangan = document.querySelector('input[name="tunjangan"]');
        const bonus = document.querySelector('input[name="bonus"]');
        const potongan = document.querySelector('input[name="potongan"]');
        const totalDisplay = document.getElementById('totalGajiDisplay');

        function hitungTotal() {
            const pokok = parseFloat(gajiPokok.value) || 0;
            const tunj = parseFloat(tunjangan.value) || 0;
            const bon = parseFloat(bonus.value) || 0;
            const pot = parseFloat(potongan.value) || 0;
            
            const total = pokok + tunj + bon - pot;
            
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        gajiPokok.addEventListener('input', hitungTotal);
        tunjangan.addEventListener('input', hitungTotal);
        bonus.addEventListener('input', hitungTotal);
        potongan.addEventListener('input', hitungTotal);
    });
</script>
@endsection