@extends('layouts.app')

@section('title', 'Tambah Karyawan - Admin')

@section('styles')
<style>
    .card-shadow {
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }
    .card-shadow .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 20px 30px;
    }
    .card-shadow .card-header h5 {
        color: white;
        font-weight: 700;
    }
    .card-shadow .card-body {
        padding: 30px;
    }
    .form-control {
        border-radius: 10px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.08);
        background: white;
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 6px;
    }
    .form-label .required {
        color: #e53e3e;
        margin-left: 2px;
    }
    .form-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }
    .form-text i {
        margin-right: 4px;
    }
    .btn-action {
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 14px;
        border: none;
        cursor: pointer;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .btn-primary-action {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .btn-primary-action:hover {
        box-shadow: 0 4px 25px rgba(102,126,234,0.35);
        color: white;
    }
    .btn-secondary-action {
        background: #f1f5f9;
        color: #475569;
    }
    .btn-secondary-action:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    .invalid-feedback {
        font-size: 13px;
        color: #e53e3e;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .invalid-feedback i {
        font-size: 14px;
    }
    @media (max-width: 768px) {
        .card-shadow .card-body {
            padding: 20px;
        }
        .btn-action {
            padding: 10px 20px;
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card card-shadow">
                <!-- Header -->
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Tambah Karyawan
                    </h5>
                    <p class="mb-0 text-white-50 small">
                        <i class="fas fa-info-circle me-1"></i>Isi data karyawan dengan lengkap dan benar
                    </p>
                </div>

                <div class="card-body">
                    <!-- Alert Error -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                                <div>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-1 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.karyawan.store') }}">
                        @csrf

                        <div class="row g-3">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap
                                    <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-envelope me-1 text-primary"></i>Email
                                    <span class="required">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="nama@karyajayalas.com" 
                                       required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Harus menggunakan domain <strong>@karyajayalas.com</strong>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-lock me-1 text-primary"></i>Password
                                    <span class="required">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" 
                                       placeholder="Minimal 8 karakter" 
                                       required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Password minimal <strong>8 karakter</strong>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-check-circle me-1 text-primary"></i>Konfirmasi Password
                                    <span class="required">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       name="password_confirmation" 
                                       placeholder="Ulangi password" 
                                       required>
                            </div>

                            <!-- Telepon -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-phone me-1 text-primary"></i>Telepon
                                </label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="081234567890">
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Contoh: 081234567890
                                </div>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Jabatan -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-briefcase me-1 text-primary"></i>Jabatan
                                </label>
                                <input type="text" 
                                       class="form-control @error('position') is-invalid @enderror" 
                                       name="position" 
                                       value="{{ old('position') }}" 
                                       placeholder="Welder, Supervisor, Manager">
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Contoh: Welder, Supervisor, Manager
                                </div>
                                @error('position')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-user-tag me-1 text-primary"></i>Role
                                    <span class="required">*</span>
                                </label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-home me-1 text-primary"></i>Alamat
                                </label>
                                <input type="text" 
                                       class="form-control @error('address') is-invalid @enderror" 
                                       name="address" 
                                       value="{{ old('address') }}" 
                                       placeholder="Jl. Raya Industri No. 123">
                                @error('address')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary-action btn-action">
                                <i class="fas fa-arrow-left"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary-action btn-action">
                                <i class="fas fa-save"></i>Simpan Karyawan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto format phone number (hanya angka)
    document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
@endsection