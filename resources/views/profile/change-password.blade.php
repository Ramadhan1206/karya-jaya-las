@extends('layouts.app')

@section('title', 'Ubah Password - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .password-header {
        background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
    }
    .password-header h4 {
        font-weight: 700;
        margin-bottom: 2px;
    }
    .password-header p {
        opacity: 0.9;
        margin-bottom: 0;
        font-size: 14px;
    }
    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: none;
        overflow: hidden;
    }
    .form-card .card-header {
        background: #f8fafc;
        border-bottom: 2px solid #f0f0f0;
        padding: 18px 25px;
    }
    .form-card .card-header h6 {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0;
    }
    .form-card .card-body {
        padding: 30px;
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 4px;
    }
    .form-label i {
        color: #f59e0b;
        width: 18px;
    }
    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
    }
    .form-control:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245,158,11,0.08);
        background: white;
    }
    .btn-submit {
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
        color: white;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(245,158,11,0.3);
    }
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(245,158,11,0.4);
        color: white;
    }
    .btn-back {
        border-radius: 10px;
        padding: 10px 25px;
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
    }
    @media (max-width: 768px) {
        .btn-submit, .btn-back {
            width: 100%;
            justify-content: center;
        }
        .d-flex.gap-3 {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="password-header">
        <h4>
            <i class="fas fa-key me-2"></i>
            Ubah Password
        </h4>
        <p>Ganti password akun Anda untuk keamanan</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="form-card">
        <div class="card-header">
            <h6>
                <i class="fas fa-lock me-2"></i>
                Form Ubah Password
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update-password') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-lock"></i> Password Saat Ini
                    </label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                           name="current_password" placeholder="Masukkan password saat ini" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-key"></i> Password Baru
                    </label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                           name="new_password" placeholder="Minimal 8 karakter" required>
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Password minimal 8 karakter.
                    </div>
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-check-circle"></i> Konfirmasi Password Baru
                    </label>
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                           name="new_password_confirmation" placeholder="Ulangi password baru" required>
                    @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-3 mt-3">
                    <a href="{{ route('profile') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection