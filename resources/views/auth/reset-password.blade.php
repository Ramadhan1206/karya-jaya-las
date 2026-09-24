@extends('layouts.app')

@section('title', 'Reset Password - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .reset-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    .reset-card {
        background: white;
        border-radius: 24px;
        padding: 45px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 440px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .reset-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #10b981 0%, #059669 100%);
    }
    .reset-card .brand {
        text-align: center;
        margin-bottom: 28px;
    }
    .reset-card .brand .icon {
        font-size: 48px;
        color: #10b981;
        margin-bottom: 8px;
        display: inline-block;
        background: rgba(16,185,129,0.08);
        padding: 14px;
        border-radius: 16px;
    }
    .reset-card .brand h3 {
        font-weight: 700;
        color: #1a202c;
        font-size: 24px;
        margin-bottom: 2px;
    }
    .reset-card .brand p {
        color: #94a3b8;
        font-size: 14px;
        margin-bottom: 0;
    }
    .reset-card .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        font-size: 14px;
        background: #fafbfc;
        height: 50px;
    }
    .reset-card .form-control:focus {
        border-color: #10b981;
        background: white;
        box-shadow: 0 0 0 4px rgba(16,185,129,0.08);
    }
    .reset-card .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 5px;
    }
    .reset-card .btn-reset {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        border-radius: 12px;
        padding: 14px;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        font-size: 16px;
        cursor: pointer;
        height: 50px;
    }
    .reset-card .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(16,185,129,0.35);
    }
    .reset-card .btn-reset:disabled {
        opacity: 0.7;
        transform: none;
    }
    .reset-card .back-link {
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .reset-card .back-link:hover {
        color: #10b981;
        text-decoration: underline;
    }
    .reset-card .alert {
        border-radius: 12px;
        font-size: 13px;
        padding: 12px 16px;
        border: none;
    }
    .reset-card .alert-danger {
        background: #fef2f2;
        color: #991b1b;
    }
    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 5px;
        z-index: 2;
    }
    .password-toggle:hover {
        color: #10b981;
    }
    .position-relative {
        position: relative;
    }
    .form-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }
    @media (max-width: 768px) {
        .reset-card {
            padding: 30px 24px;
        }
        .reset-card .brand .icon {
            font-size: 36px;
        }
        .reset-card .brand h3 {
            font-size: 20px;
        }
        .reset-card .form-control {
            height: 44px;
        }
        .reset-card .btn-reset {
            height: 44px;
            font-size: 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="reset-container">
    <div class="reset-card">
        <!-- Brand -->
        <div class="brand">
            <div class="icon">
                <i class="fas fa-lock-open"></i>
            </div>
            <h3>Reset Password</h3>
            <p>Buat password baru untuk akun Anda</p>
        </div>

        <!-- Alert -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.update') }}" id="resetForm">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-envelope me-1" style="color:#10b981;"></i>
                    Alamat Email
                </label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="masukkan@email.com" 
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Baru -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-lock me-1" style="color:#10b981;"></i>
                    Password Baru
                </label>
                <div class="position-relative">
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" 
                           id="password" 
                           placeholder="Minimal 8 karakter" 
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                <div class="form-text">
                    <i class="fas fa-info-circle me-1"></i> Password minimal 8 karakter.
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-check-circle me-1" style="color:#10b981;"></i>
                    Konfirmasi Password Baru
                </label>
                <input type="password" 
                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       placeholder="Ulangi password baru" 
                       required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-reset" id="resetBtn">
                <span id="btnText">
                    <i class="fas fa-save me-2"></i>Reset Password
                </span>
                <span id="btnLoading" style="display: none;">
                    <span class="spinner-border spinner-border-sm me-2"></span> Mereset...
                </span>
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Login
            </a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            password.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    document.getElementById('resetForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('resetBtn');
        document.getElementById('btnText').style.display = 'none';
        document.getElementById('btnLoading').style.display = 'inline-block';
        btn.disabled = true;
    });
</script>
@endsection
