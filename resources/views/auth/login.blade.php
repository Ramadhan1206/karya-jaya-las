@extends('layouts.app')

@section('title', 'Login - Karya Jaya Las Konstruksi')

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

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
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

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes rippleAnim {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-reverse { animation: floatReverse 7s ease-in-out infinite; }
    .animate-pulse { animation: pulse 2s ease-in-out infinite; }

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

    /* Background decorative elements */
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
        max-width: 1100px;
        min-height: 640px;
        background: white;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-2xl);
        overflow: hidden;
        position: relative;
        z-index: 1;
        animation: slideInUp 0.8s ease forwards;
    }

    /* ============================================================
       LEFT SIDE - BRANDING
    ============================================================ */
    .auth-left {
        flex: 0 0 45%;
        background: linear-gradient(135deg, #0a0a1a 0%, #1a1a3e 40%, #2d1b4e 100%);
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        color: white;
    }

    /* Background effects */
    .auth-left .bg-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
    }

    .auth-left .bg-orb-1 {
        width: 350px;
        height: 350px;
        background: #6366f1;
        top: -100px;
        right: -100px;
        opacity: 0.25;
        animation: float 10s ease-in-out infinite;
    }

    .auth-left .bg-orb-2 {
        width: 300px;
        height: 300px;
        background: #a855f7;
        bottom: -80px;
        left: -80px;
        opacity: 0.2;
        animation: floatReverse 12s ease-in-out infinite;
    }

    .auth-left .bg-orb-3 {
        width: 200px;
        height: 200px;
        background: #f59e0b;
        top: 40%;
        right: 20%;
        opacity: 0.08;
        animation: float 14s ease-in-out infinite;
    }

    /* Grid pattern */
    .auth-left .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    /* Sparkles */
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

    /* Brand */
    .auth-left .brand-icon {
        width: 64px;
        height: 64px;
        border-radius: var(--radius-lg);
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 8px 32px rgba(99, 102, 241, 0.4);
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
        background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc, #fbbf24);
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

    /* Features */
    .auth-left .features {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .auth-left .feature-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-md);
        transition: all 0.3s ease;
        cursor: default;
    }

    .auth-left .feature-item:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(99, 102, 241, 0.2);
        transform: translateX(4px);
    }

    .auth-left .feature-item .feature-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        background: rgba(99, 102, 241, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a5b4fc;
        font-size: 14px;
        flex-shrink: 0;
    }

    .auth-left .feature-item .feature-text {
        font-size: 13px;
        font-weight: 500;
        color: rgba(255,255,255,0.85);
        line-height: 1.4;
    }

    .auth-left .feature-item .feature-text small {
        display: block;
        font-size: 11px;
        opacity: 0.5;
        font-weight: 400;
        margin-top: 1px;
    }

    /* Footer */
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
        margin-bottom: 32px;
    }

    .auth-right .form-header .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: var(--primary);
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

    /* Form */
    .auth-right .form-group {
        margin-bottom: 18px;
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
        color: var(--primary);
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
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        outline: none;
    }

    .auth-right .form-control::placeholder {
        color: var(--gray-400);
        font-size: 13px;
        font-weight: 400;
    }

    .auth-right .form-control.is-invalid {
        border-color: var(--danger);
    }

    .auth-right .invalid-feedback {
        font-size: 12px;
        color: var(--danger);
        margin-top: 4px;
        display: block;
    }

    /* Password toggle */
    .auth-right .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        padding: 6px;
        transition: all 0.2s ease;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-right .password-toggle:hover {
        color: var(--primary);
        background: var(--gray-100);
    }

    /* Remember & Forgot */
    .auth-right .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .auth-right .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .auth-right .form-check-input {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 1.5px solid var(--gray-300);
        cursor: pointer;
        transition: all 0.2s ease;
        margin: 0;
    }

    .auth-right .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .auth-right .form-check-label {
        font-size: 13px;
        color: var(--gray-600);
        cursor: pointer;
        font-weight: 500;
    }

    .auth-right .forgot-link {
        font-size: 13px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .auth-right .forgot-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Button */
    .auth-right .btn-login {
        width: 100%;
        background: var(--primary-gradient);
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
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.25);
    }

    .auth-right .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(99, 102, 241, 0.4);
        background-position: 100% 50%;
    }

    .auth-right .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }

    .auth-right .btn-login:hover::before {
        left: 100%;
    }

    .auth-right .btn-login:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }

    /* Divider */
    .auth-right .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 24px 0;
    }

    .auth-right .divider::before,
    .auth-right .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--gray-200);
    }

    .auth-right .divider span {
        padding: 0 16px;
        color: var(--gray-400);
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Register link */
    .auth-right .register-link {
        text-align: center;
        font-size: 14px;
        color: var(--gray-500);
    }

    .auth-right .register-link a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .auth-right .register-link a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Demo box */
    .auth-right .demo-box {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 16px;
        margin-top: 24px;
    }

    .auth-right .demo-box .demo-header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }

    .auth-right .demo-box .demo-header i {
        color: var(--primary);
    }

    .auth-right .demo-box .demo-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .auth-right .demo-box .demo-item {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 10px 12px;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .auth-right .demo-box .demo-item:hover {
        border-color: var(--primary-light);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
        transform: translateY(-2px);
    }

    .auth-right .demo-box .demo-item .demo-role {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .auth-right .demo-box .demo-item .demo-role.admin {
        color: var(--danger);
    }

    .auth-right .demo-box .demo-item .demo-role.user {
        color: var(--success);
    }

    .auth-right .demo-box .demo-item code {
        font-size: 10px;
        background: var(--gray-100);
        padding: 2px 6px;
        border-radius: 4px;
        display: block;
        color: var(--gray-700);
        font-family: 'SF Mono', 'Monaco', 'Courier New', monospace;
        margin-bottom: 2px;
        word-break: break-all;
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

        .auth-left .features {
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

        .auth-right .btn-login {
            padding: 12px;
            font-size: 14px;
        }

        .auth-right .demo-box .demo-grid {
            grid-template-columns: 1fr;
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
             LEFT SIDE - BRANDING
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
                    <i class="fas fa-bolt"></i>
                </div>

                <h1>
                    Karya Jaya<br>
                    <span class="gradient-text">Las Konstruksi</span>
                </h1>

                <p class="subtitle">
                    Solusi las dan fabrikasi logam profesional untuk kebutuhan industri dan konstruksi Anda.
                </p>

                <!-- Features -->
                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-text">
                            Keamanan Terjamin
                            <small>Data terenkripsi dengan aman</small>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="feature-text">
                            Akses Cepat
                            <small>Login dalam hitungan detik</small>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-text">
                            Multi User
                            <small>Admin & User dalam satu platform</small>
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
                    <i class="fas fa-lock"></i>
                    Secure Login
                </div>
                <h2>Selamat Datang Kembali</h2>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
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
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
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

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-wrapper">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               id="password" 
                               placeholder="Masukkan password" 
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               id="remember" 
                               name="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Lupa password?
                    </a>
                </div>

                <!-- Button -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>atau</span>
            </div>

            <!-- Register Link -->
            <div class="register-link">
                Belum punya akun? 
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i>
                    Daftar Sekarang
                </a>
            </div>

            <!-- Demo Credentials -->
            <div class="demo-box">
                <div class="demo-header">
                    <i class="fas fa-info-circle"></i>
                    Akun Demo - Klik untuk mengisi otomatis
                </div>
                <div class="demo-grid">
                    <div class="demo-item" onclick="fillDemo('admin@karyajayalas.com', 'password123')">
                        <div class="demo-role admin">
                            <i class="fas fa-user-shield"></i> Admin
                        </div>
                        <code>admin@karyajayalas.com</code>
                        <code>password123</code>
                    </div>
                    <div class="demo-item" onclick="fillDemo('karyajayalas@gmail.com', 'password123')">
                        <div class="demo-role user">
                            <i class="fas fa-user"></i> User
                        </div>
                        <code>karyajayalas@gmail.com</code>
                        <code>password123</code>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    // ===== TOGGLE PASSWORD VISIBILITY =====
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    // ===== FILL DEMO CREDENTIALS =====
    function fillDemo(email, password) {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        emailInput.value = email;
        passwordInput.value = password;
        
        // Visual feedback
        emailInput.style.borderColor = '#6366f1';
        passwordInput.style.borderColor = '#6366f1';
        
        setTimeout(() => {
            emailInput.style.borderColor = '';
            passwordInput.style.borderColor = '';
        }, 1000);
        
        // Focus ke button login
        document.getElementById('loginBtn').focus();
    }

    // ===== FORM SUBMIT LOADING =====
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('loginBtn');
        const originalContent = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Sedang masuk...';
        btn.disabled = true;
        
        // Fallback jika ada error
        setTimeout(() => {
            if (btn.disabled) {
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }
        }, 10000);
    });

    // ===== KEYBOARD SHORTCUT =====
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter untuk submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            document.getElementById('loginForm').submit();
        }
    });

    // ===== ENTER KEY NAVIGATION =====
    document.getElementById('email').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('password').focus();
        }
    });
</script>
@endsection