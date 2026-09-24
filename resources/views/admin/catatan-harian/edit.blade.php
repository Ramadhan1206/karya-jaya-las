@extends('layouts.app')

@section('title', 'Edit Catatan Harian - Admin')

@section('styles')
<style>
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.08);
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 4px;
    }
    .card-edit {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .card-edit .card-header {
        border-radius: 16px 16px 0 0;
        padding: 18px 24px;
        background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
        color: white;
        border: none;
    }
    .card-edit .card-header h5 {
        font-weight: 700;
    }
    .card-edit .card-body {
        padding: 25px;
    }
    .btn-back {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        transform: translateX(-3px);
    }
    .btn-update {
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: 600;
        background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245,158,11,0.35);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-edit">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Catatan Harian
                    </h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" style="border-radius:12px;border-left:4px solid #e53e3e;">
                            <i class="fas fa-exclamation-circle me-2"></i> Terjadi kesalahan:
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.catatan-harian.update', $catatan->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user me-1 text-primary"></i>Karyawan</label>
                            <input type="text" class="form-control" value="{{ $catatan->user->name }} ({{ $catatan->user->email }})" disabled style="background:#f8fafc;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-calendar me-1 text-primary"></i>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $catatan->tanggal) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fas fa-clock me-1 text-primary"></i>Jam Masuk</label>
                                <input type="time" class="form-control" name="jam_masuk" 
                                       value="{{ old('jam_masuk', $catatan->jam_masuk ? \Carbon\Carbon::parse($catatan->jam_masuk)->format('H:i') : '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fas fa-clock me-1 text-primary"></i>Jam Pulang</label>
                                <input type="time" class="form-control" name="jam_pulang" 
                                       value="{{ old('jam_pulang', $catatan->jam_pulang ? \Carbon\Carbon::parse($catatan->jam_pulang)->format('H:i') : '') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-project-diagram me-1 text-primary"></i>Proyek</label>
                            <input type="text" class="form-control" name="proyek" value="{{ old('proyek', $catatan->proyek) }}" placeholder="Nama proyek">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-tasks me-1 text-primary"></i>Pekerjaan</label>
                            <textarea class="form-control" name="pekerjaan" rows="2" placeholder="Deskripsi pekerjaan">{{ old('pekerjaan', $catatan->pekerjaan) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-sticky-note me-1 text-primary"></i>Catatan</label>
                            <textarea class="form-control" name="catatan" rows="2" placeholder="Catatan tambahan">{{ old('catatan', $catatan->catatan) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-tag me-1 text-primary"></i>Status</label>
                            <select class="form-select" name="status" required>
                                <option value="hadir" {{ old('status', $catatan->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ old('status', $catatan->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ old('status', $catatan->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ old('status', $catatan->status) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.catatan-harian') }}" class="btn btn-secondary btn-back">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn-update">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
