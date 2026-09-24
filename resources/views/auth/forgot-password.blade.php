@extends('layouts.app')

@section('title', 'Lupa Password - Karya Jaya Las Konstruksi')

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
       VARIABLES
    ============================================================ */
    :root {
        --primary: #6366f1;
        --primary-light: #818cf8;
        --primary-dark: #4338ca;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        
        --success: #10b981;
        --success-bg: #ecfdf5;
        --warning: #f59e0b;
        --warning-bg: #fffbeb;
        --danger: #ef4444;
        --danger-bg: #fef2f2;
        
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.10);
        --shadow-xl: 0 20px 60px rgba(0,0,0,0.12);
        --shadow-2xl: 0 30px 80px rgba(0,0,0,0.15);
        
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-full: 9999px;
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(2deg); }
    }

    @keyframes floatReverse {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(15px) rotate(-2deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes sparkle {
        0%, 100% { opacity: 0; transform: scale(0); }
        50% { opacity: 1; transform: scale(1); }
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* ============================================================
       AUTH CONTAINER - FULLSCREEN
    ============================================================ */
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: #f0f2f8;
        position: relative;
        overflow: hidden;
    }

    .auth-wrapper::before {
        content: '';
        position: absolute;
        top: -20%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 10s ease-in-out infinite;
        pointer-events: none;
    }

    .auth-wrapper::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(168, 85, 247, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        animation: floatReverse 12s ease-in-out infinite;
        pointer-events: none;
    }

    /* ============================================================
       AUTH CARD - SPLIT LAYOUT
    ============================================================ */
    .auth-card {
        display: flex;
        width: 100%;
        max-width: 1000px;
        min-height: 600px;
        background: white;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-2xl);
        overflow: hidden;
        position: relative;
        z-index: 1;
        animation: slideInUp 0.8s ease forwards;
    }

    /* ============================================================
       LEFT SIDE - BRANDING (WARNING THEME)
    ============================================================ */
    .auth-left {
        flex: 0 0 45%;
        background: linear-gradient(135deg, #1a0a1a 0%, #2d1b1b 40%, #4a1f1f 100%);
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .auth-left .bg-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
    }

    .auth-left .bg-orb-1 {
        width: 350px;
        height: 350px;
        background: #f59e0b;
        top: -100px;
        right: -100px;
        opacity: 0.2;
        animation: float 10s ease-in-out infinite;
    }

    .auth-left .bg-orb-2 {
        width: 300px;
        height: 300px;
        background: #ef4444;
        bottom: -80px;
        left: -80px;
        opacity: 0.15;
        animation: floatReverse 12s ease-in-out infinite;
    }

    .auth-left .bg-orb-3 {
        width: 200px;
        height: 200px;
        background: #ec4899;
        top: 40%;
        right: 20%;
        opacity: 0.08;
        animation: float 14s ease-in-out infinite;
    }

    .auth-left .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    .auth-left .sparkle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: white;
        border-radius: 50%;
        pointer-events: none;
    }

    .auth-left .sparkle:nth-child(1) { top: 15%; left: 20%; animation: sparkle 3s ease-in-out infinite; }
    .auth-left .sparkle:nth-child(2) { top: 25%; right: 25%; animation: sparkle 3s ease-in-out 0.5s infinite; }
    .auth-left .sparkle:nth-child(3) { top: 70%; left: 15%; animation: sparkle 3s ease-in-out 1s infinite; }
    .auth-left .sparkle:nth-child(4) { top: 80%; right: 20%; animation: sparkle 3s ease-in-out 1.5s infinite; }
    .auth-left .sparkle:nth-child(5) { top: 45%; left: 45%; animation: sparkle 3s ease-in-out 2s infinite; }

    .auth-left .content {
        position: relative;
        z-index: 2;
    }

    .auth-left .brand-icon {
        width: 64px;
        height: 64px;
        border-radius: var(--radius-lg);
        background: linear-gradient(135deg, #f59e0b, #ef4444);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 8px 32px rgba(245, 158, 11, 0.4);
        animation: pulse 3s ease-in-out infinite;
    }

    .auth-left h1 {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.8px;
        margin-bottom: 12px;
    }

    .auth-left h1 .gradient-text {
        background: linear-gradient(135deg, #fbbf24, #f59e0b, #ef4444);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 6s ease infinite;
    }

    .auth-left p.subtitle {
        font-size: 15px;
        opacity: 0.6;
        font-weight: 400;
        line-height: 1.7;
        max-width: 340px;
    }

    /* Steps */
    .auth-left .steps {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .auth-left .step-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 16px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-md);
        transition: all 0.3s ease;
        cursor: default;
    }

    .auth-left .step-item:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(245, 158, 11, 0.2);
        transform: translateX(4px);
    }

    .auth-left .step-item .step-number {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f59e0b, #ef4444);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .auth-left .step-item .step-text {
        font-size: 13px;
        font-weight: 500;
        color: rgba(255,255,255,0.85);
        line-height: 1.4;
        padding-top: 3px;
    }

    .auth-left .step-item .step-text small {
        display: block;
        font-size: 11px;
        opacity: 0.5;
        font-weight: 400;
        margin-top: 2px;
    }

    .auth-left .footer-text {
        position: relative;
        z-index: 2;
        font-size: 12px;
        opacity: 0.4;
        letter-spacing: 0.3px;
    }

    /* ============================================================
       RIGHT SIDE - FORM
    ============================================================ */
    .auth-right {
        flex: 1;
        padding: 60px 55px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: white;
        position: relative;
        animation: slideInRight 0.8s ease forwards;
    }

    .auth-right .form-header {
        margin-bottom: 28px;
    }

    .auth-right .form-header .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        color: #d97706;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.3px;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .auth-right .form-header .badge i {
        font-size: 10px;
    }

    .auth-right .form-header h2 {
        font-size: 28px;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.5px;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .auth-right .form-header p {
        font-size: 14px;
        color: var(--gray-500);
        font-weight: 400;
        margin: 0;
        line-height: 1.6;
    }

    /* Alert */
    .auth-right .alert {
        border-radius: var(--radius-md);
        font-size: 13px;
        padding: 12px 16px;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        animation: slideInUp 0.4s ease;
    }

    .auth-right .alert-danger {
        background: var(--danger-bg);
        color: #991b1b;
        border-left: 3px solid var(--danger);
    }

    .auth-right .alert-success {
        background: var(--success-bg);
        color: #065f46;
        border-left: 3px solid var(--success);
    }

    .auth-right .alert i {
        font-size: 16px;
    }

    /* Info Box */
    .auth-right .info-box {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border-radius: var(--radius-md);
        padding: 14px 18px;
        margin-bottom: 24px;
        border-left: 3px solid var(--warning);
        display: flex;
        align-items: flex-start;
        gap: 12px;
        animation: slideInUp 0.5s ease;
    }

    .auth-right .info-box i {
        color: #d97706;
        font-size: 18px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .auth-right .info-box p {
        color: #92400e;
        font-size: 13px;
        margin: 0;
        line-height: 1.5;
        font-weight: 400;
    }

    /* Form */
    .auth-right .form-group {
        margin-bottom: 20px;
    }

    .auth-right .form-label {
        display: block;
        font-weight: 600;
        color: var(--gray-700);
        font-size: 13px;
        margin-bottom: 6px;
        letter-spacing: 0.1px;
    }

    .auth-right .form-label i {
        color: var(--warning);
        margin-right: 6px;
        font-size: 12px;
    }

    .auth-right .input-wrapper {
        position: relative;
    }

    .auth-right .form-control {
        width: 100%;
        border-radius: var(--radius-md);
        padding: 13px 16px;
        border: 1.5px solid var(--gray-200);
        transition: all 0.3s ease;
        font-size: 14px;
        background: var(--gray-50);
        color: var(--gray-900);
        font-weight: 500;
    }

    .auth-right .form-control:focus {
        border-color: var(--warning);
        background: white;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.08);
        outline: none;
    }

    .auth-right .form-control::placeholder {
        color: var(--gray-400);
        font-size: 13px;
        font-weight: 400;
    }

    .auth-right .form-control.is-invalid {
        border-color: var(--danger);
        animation: shake 0.4s ease;
    }

    .auth-right .invalid-feedback {
        font-size: 12px;
        color: var(--danger);
        margin-top: 4px;
        display: block;
    }

    /* Button */
    .auth-right .btn-send {
        width: 100%;
        background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        background-size: 200% 200%;
        border: none;
        border-radius: var(--radius-md);
        padding: 14px;
        font-weight: 700;
        color: white;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        letter-spacing: 0.2px;
        box-shadow: 0 4px 20px rgba(245, 158, 11, 0.25);
        margin-bottom: 20px;
    }

    .auth-right .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(245, 158, 11, 0.4);
        background-position: 100% 50%;
    }

    .auth-right .btn-send::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }

    .auth-right .btn-send:hover::before {
        left: 100%;
    }

    .auth-right .btn-send:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }

    /* Back Link */
    .auth-right .back-link-wrap {
        text-align: center;
        padding-top: 16px;
        border-top: 1px solid var(--gray-100);
    }

    .auth-right .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-500);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: var(--radius-md);
    }

    .auth-right .back-link:hover {
        color: var(--primary);
        background: var(--gray-50);
        transform: translateX(-3px);
    }

    .auth-right .back-link i {
        font-size: 14px;
    }

    /* Security note */
    .auth-right .security-note {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
        padding: 10px 14px;
        background: var(--gray-50);
        border-radius: var(--radius-md);
        border: 1px dashed var(--gray-200);
    }

    .auth-right .security-note i {
        color: var(--success);
        font-size: 14px;
    }

    .auth-right .security-note span {
        font-size: 11px;
        color: var(--gray-500);
        font-weight: 400;
        line-height: 1.4;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .auth-card {
            flex-direction: column;
            max-width: 500px;
            min-height: auto;
        }

        .auth-left {
            flex: none;
            padding: 40px 35px;
            min-height: auto;
        }

        .auth-left .steps {
            display: none;
        }

        .auth-left h1 {
            font-size: 28px;
        }

        .auth-left p.subtitle {
            font-size: 14px;
        }

        .auth-left .brand-icon {
            width: 56px;
            height: 56px;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .auth-left .footer-text {
            display: none;
        }

        .auth-right {
            padding: 40px 35px;
        }
    }

    @media (max-width: 576px) {
        .auth-wrapper {
            padding: 12px;
        }

        .auth-card {
            border-radius: var(--radius-xl);
        }

        .auth-left {
            padding: 30px 24px;
        }

        .auth-left h1 {
            font-size: 22px;
        }

        .auth-left p.subtitle {
            font-size: 13px;
        }

        .auth-left .brand-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
            margin-bottom: 14px;
        }

        .auth-right {
            padding: 30px 24px;
        }

        .auth-right .form-header h2 {
            font-size: 22px;
        }

        .auth-right .form-header p {
            font-size: 13px;
        }

        .auth-right .form-control {
            padding: 11px 14px;
            font-size: 13px;
        }

        .auth-right .btn-send {
            padding: 12px;
            font-size: 14px;
        }

        .auth-right .info-box {
            padding: 12px 14px;
        }

        .auth-right .info-box p {
            font-size: 12px;
        }

        .auth-right .security-note {
            padding: 8px 12px;
        }

        .auth-right .security-note span {
            font-size: 10px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        
        <!-- ============================================================
             LEFT SIDE - BRANDING (WARNING THEME)
        ============================================================ -->
        <div class="auth-left">
            <!-- Background Effects -->
            <div class="bg-orb bg-orb-1"></div>
            <div class="bg-orb bg-orb-2"></div>
            <div class="bg-orb bg-orb-3"></div>
            <div class="grid-pattern"></div>
            
            <!-- Sparkles -->
            <div class="sparkle"></div>
            <div class="sparkle"></div>
            <div class="sparkle"></div>
            <div class="sparkle"></div>
            <div class="sparkle"></div>

            <div class="content">
                <!-- Brand -->
                <div class="brand-icon">
                    <i class="fas fa-key"></i>
                </div>

                <h1>
                    Lupa<br>
                    <span class="gradient-text">Password?</span>
                </h1>

                <p class="subtitle">
                    Jangan khawatir! Kami akan membantu Anda mengembalikan akses ke akun Anda dengan aman.
                </p>

                <!-- Steps -->
                <div class="steps">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-text">
                            Masukkan Email
                            <small>Email yang terdaftar di akun Anda</small>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-text">
                            Cek Inbox Email
                            <small>Kami akan mengirim link reset password</small>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-text">
                            Reset Password
                            <small>Buat password baru yang kuat</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-text">
                © {{ date('Y') }} Karya Jaya Las Konstruksi. All rights reserved.
            </div>
        </div>

        <!-- ============================================================
             RIGHT SIDE - FORM
        ============================================================ -->
        <div class="auth-right">
            <div class="form-header">
                <div class="badge">
                    <i class="fas fa-shield-alt"></i>
                    Secure Recovery
                </div>
                <h2>Reset Password Anda</h2>
                <p>Masukkan alamat email yang terdaftar untuk menerima link reset password</p>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <p>Link reset password akan dikirim ke email Anda dan berlaku selama 60 menit.</p>
            </div>

            <!-- Alert -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i> Alamat Email
                    </label>
                    <div class="input-wrapper">
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               id="email"
                               value="{{ old('email') }}" 
                               placeholder="nama@email.com" 
                               required 
                               autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-send" id="sendBtn">
                    <i class="fas fa-paper-plane"></i>
                    Kirim Link Reset Password
                </button>
            </form>

            <!-- Security Note -->
            <div class="security-note">
                <i class="fas fa-lock"></i>
                <span>Kami tidak akan pernah meminta password Anda melalui email. Jaga kerahasiaan data Anda.</span>
            </div>

            <!-- Back Link -->
            <div class="back-link-wrap">
                <a href="{{ route('login') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Login
                </a>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    // ===== FORM SUBMIT LOADING =====
    document.getElementById('forgotForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('sendBtn');
        const originalContent = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Mengirim...';
        btn.disabled = true;
        
        // Fallback jika ada error
        setTimeout(() => {
            if (btn.disabled) {
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }
        }, 10000);
    });

    // ===== AUTO FOCUS EMAIL =====
    document.getElementById('email').focus();

    // ===== ENTER KEY SUBMIT =====
    document.getElementById('email').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('forgotForm').submit();
        }
    });

    // ===== KEYBOARD SHORTCUT =====
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter untuk submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            document.getElementById('forgotForm').submit();
        }
        
        // Escape untuk kembali ke login
        if (e.key === 'Escape') {
            window.location.href = '{{ route("login") }}';
        }
    });

    // ===== ALERT AUTO DISMISS =====
    document.querySelectorAll('.alert').forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 500);
        }, 8000);
    });
</script>
@endsection