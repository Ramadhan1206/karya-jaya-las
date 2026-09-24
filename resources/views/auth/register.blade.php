@extends('layouts.app')

@section('title', 'Register - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* ============================================================
       CONTAINER - SPLIT SCREEN MODERN
    ============================================================ */
    .register-wrapper {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: #ffffff;
        overflow: hidden;
    }

    /* ============================================================
       LEFT SIDE - BRANDING PANEL
    ============================================================ */
    .brand-panel {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #312e81 100%);
        padding: 60px 56px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        color: white;
    }

    /* Background Effects */
    .brand-panel::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -30%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        animation: floatBg 15s ease-in-out infinite;
    }

    .brand-panel::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        animation: floatBg 18s ease-in-out infinite reverse;
    }

    @keyframes floatBg {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(30px, -30px) scale(1.05); }
    }

    .brand-panel .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
        mask-image: radial-gradient(ellipse at center, black 40%, transparent 80%);
        -webkit-mask-image: radial-gradient(ellipse at center, black 40%, transparent 80%);
    }

    .brand-panel .content {
        position: relative;
        z-index: 1;
    }

    /* Logo */
    .brand-panel .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 60px;
    }

    .brand-panel .logo .logo-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
    }

    .brand-panel .logo .logo-text {
        font-size: 16px;
        font-weight: 700;
        letter-spacing: -0.3px;
        color: white;
    }

    .brand-panel .logo .logo-text span {
        color: #a5b4fc;
    }

    /* Main Heading */
    .brand-panel h1 {
        font-size: 40px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -1px;
        margin-bottom: 16px;
    }

    .brand-panel h1 .gradient-text {
        background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .brand-panel .description {
        font-size: 16px;
        color: rgba(255,255,255,0.6);
        line-height: 1.7;
        max-width: 400px;
        margin-bottom: 40px;
    }

    /* Features List */
    .brand-panel .features {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .brand-panel .features .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        color: rgba(255,255,255,0.75);
        font-weight: 400;
    }

    .brand-panel .features .feature-item .check {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a5b4fc;
        font-size: 10px;
        flex-shrink: 0;
    }

    /* Bottom Info */
    .brand-panel .bottom-info {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .brand-panel .bottom-info .avatars {
        display: flex;
        align-items: center;
    }

    .brand-panel .bottom-info .avatars .avatar-mini {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid #1e293b;
        margin-left: -8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: white;
    }

    .brand-panel .bottom-info .avatars .avatar-mini:first-child {
        margin-left: 0;
    }

    .brand-panel .bottom-info .avatars .avatar-mini:nth-child(1) { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
    .brand-panel .bottom-info .avatars .avatar-mini:nth-child(2) { background: linear-gradient(135deg, #10b981, #059669); }
    .brand-panel .bottom-info .avatars .avatar-mini:nth-child(3) { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .brand-panel .bottom-info .avatars .avatar-mini:nth-child(4) { background: linear-gradient(135deg, #ec4899, #db2777); }

    .brand-panel .bottom-info .text {
        font-size: 13px;
        color: rgba(255,255,255,0.5);
    }

    .brand-panel .bottom-info .text strong {
        color: white;
        font-weight: 600;
    }

    /* ============================================================
       RIGHT SIDE - REGISTER FORM
    ============================================================ */
    .form-panel {
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-y: auto;
        background: #ffffff;
    }

    .form-container {
        width: 100%;
        max-width: 440px;
    }

    /* Form Header */
    .form-header {
        margin-bottom: 32px;
    }

    .form-header .step-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eef2ff;
        color: #4f46e5;
        padding: 5px 14px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 16px;
        letter-spacing: 0.2px;
    }

    .form-header .step-badge i {
        font-size: 10px;
    }

    .form-header h2 {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .form-header p {
        font-size: 14px;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }

    .form-header p a {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .form-header p a:hover {
        color: #4338ca;
        text-decoration: underline;
    }

    /* Alert */
    .alert-custom {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 20px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .alert-custom .icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #fee2e2;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc2626;
        font-size: 14px;
        flex-shrink: 0;
    }

    .alert-custom .content {
        flex: 1;
    }

    .alert-custom .content .title {
        font-size: 13px;
        font-weight: 700;
        color: #991b1b;
        margin-bottom: 4px;
    }

    .alert-custom .content ul {
        margin: 0;
        padding-left: 16px;
        font-size: 12px;
        color: #b91c1c;
        line-height: 1.6;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group .form-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-group .form-label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 15px;
        pointer-events: none;
        transition: all 0.2s ease;
        z-index: 1;
    }

    .input-wrapper .form-control {
        width: 100%;
        height: 52px;
        padding: 0 16px 0 48px;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: #0f172a;
        background: #ffffff;
        transition: all 0.2s ease;
        outline: none;
    }

    .input-wrapper .form-control::placeholder {
        color: #cbd5e1;
        font-weight: 400;
    }

    .input-wrapper .form-control:hover {
        border-color: #cbd5e1;
    }

    .input-wrapper .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
    }

    .input-wrapper .form-control.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .input-wrapper .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
    }

    /* Password Toggle */
    .input-wrapper .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        transition: all 0.2s ease;
        font-size: 14px;
        z-index: 2;
    }

    .input-wrapper .password-toggle:hover {
        color: #6366f1;
        background: #f1f5f9;
    }

    /* Password Hints */
    .password-hints {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .password-hints .hint {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 500;
        padding: 3px 10px;
        border-radius: 9999px;
        background: #f1f5f9;
        color: #94a3b8;
        transition: all 0.3s ease;
    }

    .password-hints .hint i {
        font-size: 8px;
    }

    .password-hints .hint.valid {
        background: #ecfdf5;
        color: #10b981;
    }

    .password-hints .hint.invalid {
        background: #fef2f2;
        color: #ef4444;
    }

    /* Terms Checkbox */
    .terms-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 14px 16px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 20px;
        transition: all 0.2s ease;
    }

    .terms-wrapper:hover {
        border-color: #cbd5e1;
    }

    .terms-wrapper .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 1px;
        border: 1.5px solid #cbd5e1;
        border-radius: 5px;
        cursor: pointer;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }

    .terms-wrapper .form-check-input:checked {
        background-color: #6366f1;
        border-color: #6366f1;
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3E%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3E%3c/svg%3E");
    }

    .terms-wrapper .form-check-input:focus {
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        border-color: #6366f1;
    }

    .terms-wrapper .form-check-label {
        font-size: 13px;
        color: #475569;
        line-height: 1.6;
        cursor: pointer;
        user-select: none;
    }

    .terms-wrapper .form-check-label a {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
    }

    .terms-wrapper .form-check-label a:hover {
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.2px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.25);
    }

    .btn-submit:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
    }

    .btn-submit:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .btn-submit:hover::before {
        transform: translateX(100%);
    }

    /* Login Link */
    .login-link {
        text-align: center;
        font-size: 14px;
        color: #64748b;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid #f1f5f9;
    }

    .login-link a {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .login-link a:hover {
        color: #4338ca;
        gap: 8px;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .register-wrapper {
            grid-template-columns: 1fr;
        }

        .brand-panel {
            display: none;
        }

        .form-panel {
            padding: 32px 24px;
            min-height: 100vh;
        }
    }

    @media (max-width: 480px) {
        .form-panel {
            padding: 24px 20px;
        }

        .form-header h2 {
            font-size: 24px;
        }

        .form-header p {
            font-size: 13px;
        }

        .input-wrapper .form-control {
            height: 48px;
            font-size: 13px;
            padding-left: 44px;
        }

        .input-wrapper .input-icon {
            left: 14px;
            font-size: 14px;
        }

        .btn-submit {
            height: 48px;
            font-size: 14px;
        }

        .password-hints {
            gap: 4px;
        }

        .password-hints .hint {
            font-size: 10px;
            padding: 2px 8px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    .form-panel::-webkit-scrollbar {
        width: 6px;
    }

    .form-panel::-webkit-scrollbar-track {
        background: transparent;
    }

    .form-panel::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .form-panel::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@section('content')
<div class="register-wrapper">

    <!-- ============================================================
    LEFT PANEL - BRANDING
    ============================================================ -->
    <div class="brand-panel">
        <div class="grid-pattern"></div>

        <div class="content">
            <!-- Logo -->
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="logo-text">
                    Karya Jaya <span>Las</span>
                </div>
            </div>

            <!-- Heading -->
            <h1>
                Mulai Perjalanan<br>
                <span class="gradient-text">Anda Bersama Kami</span>
            </h1>

            <p class="description">
                Bergabunglah dengan ribuan profesional lainnya dan rasakan kemudahan mengelola proyek las dan konstruksi dalam satu platform.
            </p>

            <!-- Features -->
            <div class="features">
                <div class="feature-item">
                    <div class="check"><i class="fas fa-check"></i></div>
                    <span>Gratis selamanya, tanpa kartu kredit</span>
                </div>
                <div class="feature-item">
                    <div class="check"><i class="fas fa-check"></i></div>
                    <span>Setup dalam 2 menit saja</span>
                </div>
                <div class="feature-item">
                    <div class="check"><i class="fas fa-check"></i></div>
                    <span>Dukungan pelanggan 24/7</span>
                </div>
                <div class="feature-item">
                    <div class="check"><i class="fas fa-check"></i></div>
                    <span>Keamanan data terjamin</span>
                </div>
            </div>
        </div>

        <!-- Bottom Info -->
        <div class="bottom-info">
            <div class="avatars">
                <div class="avatar-mini">A</div>
                <div class="avatar-mini">B</div>
                <div class="avatar-mini">C</div>
                <div class="avatar-mini">+</div>
            </div>
            <div class="text">
                <strong>500+</strong> pengguna sudah bergabung
            </div>
        </div>
    </div>

    <!-- ============================================================
    RIGHT PANEL - FORM
    ============================================================ -->
    <div class="form-panel">
        <div class="form-container">

            <!-- Form Header -->
            <div class="form-header">
                <div class="step-badge">
                    <i class="fas fa-circle"></i>
                    Langkah 1 dari 1
                </div>
                <h2>Buat Akun Baru</h2>
                <p>
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Masuk di sini</a>
                </p>
            </div>

            <!-- Alert Errors -->
            @if($errors->any())
                <div class="alert-custom">
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="content">
                        <div class="title">Terjadi kesalahan</div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label class="form-label">
                        <span>Nama Lengkap <span class="required">*</span></span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap Anda"
                               required
                               autofocus
                               autocomplete="name">
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block" style="font-size: 12px; color: #ef4444; margin-top: 6px;">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">
                        <span>Alamat Email <span class="required">*</span></span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               required
                               autocomplete="email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block" style="font-size: 12px; color: #ef4444; margin-top: 6px;">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">
                        <span>Password <span class="required">*</span></span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               id="password"
                               placeholder="Buat password yang kuat"
                               required
                               autocomplete="new-password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="fas fa-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block" style="font-size: 12px; color: #ef4444; margin-top: 6px;">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror

                    <!-- Password Hints -->
                    <div class="password-hints" id="passwordHints">
                        <span class="hint" id="hintLength">
                            <i class="fas fa-circle"></i> 8+ karakter
                        </span>
                        <span class="hint" id="hintUpper">
                            <i class="fas fa-circle"></i> Huruf besar
                        </span>
                        <span class="hint" id="hintNumber">
                            <i class="fas fa-circle"></i> Angka
                        </span>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label class="form-label">
                        <span>Konfirmasi Password <span class="required">*</span></span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="Ulangi password Anda"
                               required
                               autocomplete="new-password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block" style="font-size: 12px; color: #ef4444; margin-top: 6px;">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Terms -->
                <div class="terms-wrapper">
                    <input type="checkbox"
                           class="form-check-input @error('terms') is-invalid @enderror"
                           id="terms"
                           name="terms"
                           required>
                    <label class="form-check-label" for="terms">
                        Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> yang berlaku
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span id="btnText">
                        <i class="fas fa-user-plus"></i>
                        Buat Akun Sekarang
                    </span>
                    <span id="btnLoading" style="display: none;">
                        <span class="spinner-border spinner-border-sm"></span>
                        Memproses...
                    </span>
                </button>
            </form>

            <!-- Login Link -->
            <div class="login-link">
                Sudah punya akun?
                <a href="{{ route('login') }}">
                    Masuk Sekarang
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // ============================================================
    // TOGGLE PASSWORD VISIBILITY
    // ============================================================
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // ============================================================
    // PASSWORD STRENGTH VALIDATION
    // ============================================================
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const hintLength = document.getElementById('hintLength');
    const hintUpper = document.getElementById('hintUpper');
    const hintNumber = document.getElementById('hintNumber');

    passwordInput.addEventListener('input', function() {
        const value = this.value;

        // Length check
        if (value.length >= 8) {
            hintLength.classList.add('valid');
            hintLength.classList.remove('invalid');
        } else if (value.length > 0) {
            hintLength.classList.add('invalid');
            hintLength.classList.remove('valid');
        } else {
            hintLength.classList.remove('valid', 'invalid');
        }

        // Uppercase check
        if (/[A-Z]/.test(value)) {
            hintUpper.classList.add('valid');
            hintUpper.classList.remove('invalid');
        } else if (value.length > 0) {
            hintUpper.classList.add('invalid');
            hintUpper.classList.remove('valid');
        } else {
            hintUpper.classList.remove('valid', 'invalid');
        }

        // Number check
        if (/\d/.test(value)) {
            hintNumber.classList.add('valid');
            hintNumber.classList.remove('invalid');
        } else if (value.length > 0) {
            hintNumber.classList.add('invalid');
            hintNumber.classList.remove('valid');
        } else {
            hintNumber.classList.remove('valid', 'invalid');
        }

        // Check confirm match
        if (confirmInput.value.length > 0) {
            checkPasswordMatch();
        }
    });

    // ============================================================
    // PASSWORD MATCH CHECK
    // ============================================================
    function checkPasswordMatch() {
        if (confirmInput.value.length > 0) {
            if (passwordInput.value === confirmInput.value) {
                confirmInput.style.borderColor = '#10b981';
                confirmInput.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.08)';
            } else {
                confirmInput.style.borderColor = '#ef4444';
                confirmInput.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.08)';
            }
        } else {
            confirmInput.style.borderColor = '#e2e8f0';
            confirmInput.style.boxShadow = 'none';
        }
    }

    confirmInput.addEventListener('input', checkPasswordMatch);

    // ============================================================
    // FORM SUBMIT LOADING STATE
    // ============================================================
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-flex';
        btnLoading.style.alignItems = 'center';
        btnLoading.style.gap = '8px';
        btn.disabled = true;
    });

    // ============================================================
    // EMAIL VALIDATION VISUAL
    // ============================================================
    const emailInput = document.querySelector('input[name="email"]');
    emailInput.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value.length > 0) {
            if (emailRegex.test(this.value)) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#ef4444';
            }
        }
    });

    emailInput.addEventListener('focus', function() {
        this.style.borderColor = '#6366f1';
        this.style.boxShadow = '0 0 0 4px rgba(99, 102, 241, 0.08)';
    });

    emailInput.addEventListener('input', function() {
        if (this.value.length === 0) {
            this.style.borderColor = '#e2e8f0';
            this.style.boxShadow = 'none';
        }
    });
</script>
@endsection