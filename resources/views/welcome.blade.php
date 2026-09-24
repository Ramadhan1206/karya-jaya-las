@extends('layouts.app')

@section('title', 'Karya Jaya Las Konstruksi - Solusi Las Profesional')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: #fafbfc;
        overflow-x: hidden;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #6366f1;
        --primary-light: #818cf8;
        --primary-dark: #4338ca;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        
        --dark: #0f172a;
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
        
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.05);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.06);
        --shadow-xl: 0 20px 60px rgba(0,0,0,0.08);
        --shadow-2xl: 0 30px 80px rgba(0,0,0,0.10);
        --shadow-3xl: 0 40px 100px rgba(0,0,0,0.12);
        
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-3xl: 32px;
        --radius-full: 9999px;
        
        --transition-fast: all 0.2s ease;
        --transition-base: all 0.3s ease;
        --transition-slow: all 0.5s ease;
        --transition-bounce: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        --transition-spring: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes floatSlow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(2deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes sparkle {
        0%, 100% { opacity: 0; transform: scale(0) rotate(0deg); }
        50% { opacity: 1; transform: scale(1) rotate(180deg); }
    }

    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-slow { animation: floatSlow 8s ease-in-out infinite; }
    .animate-pulse { animation: pulse 2s ease-in-out infinite; }

    .slide-in-up {
        opacity: 0;
        animation: slideInUp 0.8s ease forwards;
    }

    .slide-in-left {
        opacity: 0;
        animation: slideInLeft 0.8s ease forwards;
    }

    .slide-in-right {
        opacity: 0;
        animation: slideInRight 0.8s ease forwards;
    }

    .scale-in {
        opacity: 0;
        animation: scaleIn 0.6s ease forwards;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }
    .delay-6 { animation-delay: 0.6s; }
    .delay-7 { animation-delay: 0.7s; }
    .delay-8 { animation-delay: 0.8s; }

    /* ============================================================
       HERO SECTION - ULTRA PREMIUM
    ============================================================ */
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #0a0a1a 0%, #1a1a3e 30%, #2d1b4e 60%, #1a1a3e 100%);
        border-radius: var(--radius-3xl);
        padding: 80px 60px;
        color: white;
        margin-bottom: 50px;
        overflow: hidden;
        isolation: isolate;
        min-height: 600px;
        display: flex;
        align-items: center;
        box-shadow: 0 40px 100px rgba(10, 10, 26, 0.4);
    }

    /* Background Orbs */
    .hero-section .bg-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.15;
        pointer-events: none;
        z-index: 0;
    }

    .hero-section .bg-orb-1 {
        width: 500px;
        height: 500px;
        background: #6366f1;
        top: -200px;
        right: -150px;
        animation: float 12s ease-in-out infinite;
    }

    .hero-section .bg-orb-2 {
        width: 400px;
        height: 400px;
        background: #a855f7;
        bottom: -180px;
        left: -120px;
        animation: float 10s ease-in-out infinite reverse;
    }

    .hero-section .bg-orb-3 {
        width: 300px;
        height: 300px;
        background: #f59e0b;
        top: 40%;
        right: 20%;
        opacity: 0.08;
        animation: float 14s ease-in-out infinite;
    }

    /* Grid Overlay */
    .hero-section .grid-overlay {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none;
        z-index: 0;
        mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
        -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
    }

    /* Sparkles */
    .hero-section .sparkle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: white;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        animation: sparkle 3s ease-in-out infinite;
    }

    .hero-section .sparkle:nth-child(1) { top: 15%; left: 20%; animation-delay: 0s; }
    .hero-section .sparkle:nth-child(2) { top: 25%; right: 30%; animation-delay: 0.5s; }
    .hero-section .sparkle:nth-child(3) { top: 70%; left: 15%; animation-delay: 1s; }
    .hero-section .sparkle:nth-child(4) { top: 80%; right: 25%; animation-delay: 1.5s; }
    .hero-section .sparkle:nth-child(5) { top: 45%; left: 50%; animation-delay: 2s; }
    .hero-section .sparkle:nth-child(6) { top: 10%; right: 15%; animation-delay: 2.5s; }

    .hero-section .content {
        position: relative;
        z-index: 2;
    }

    /* Badge */
    .hero-section .badge-icon {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(99, 102, 241, 0.15);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(99, 102, 241, 0.2);
        padding: 8px 24px;
        border-radius: var(--radius-full);
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
        color: #a5b4fc;
        letter-spacing: 0.3px;
    }

    .hero-section .badge-icon i {
        color: #fbbf24;
        font-size: 16px;
        animation: pulse 2s ease-in-out infinite;
    }

    /* Title */
    .hero-section h1 {
        font-size: 56px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -1px;
        line-height: 1.1;
        position: relative;
    }

    .hero-section h1 .gradient-text {
        background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc, #fbbf24);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 6s ease infinite;
        position: relative;
    }

    .hero-section .subtitle {
        font-size: 20px;
        opacity: 0.7;
        margin-bottom: 28px;
        font-weight: 300;
        letter-spacing: 0.3px;
        line-height: 1.6;
        max-width: 500px;
    }

    /* Tags */
    .hero-section .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 36px;
    }

    .hero-section .tags .tag {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.06);
        padding: 8px 22px;
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,0.75);
        transition: var(--transition-bounce);
        cursor: default;
    }

    .hero-section .tags .tag:hover {
        background: rgba(255,255,255,0.1);
        transform: translateY(-3px);
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.1);
    }

    .hero-section .tags .tag i {
        color: #10b981;
        font-size: 12px;
    }

    /* Buttons */
    .hero-section .buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .hero-section .btn-hero {
        padding: 16px 42px;
        border-radius: var(--radius-full);
        font-weight: 600;
        transition: var(--transition-bounce);
        font-size: 15px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        position: relative;
        overflow: hidden;
        letter-spacing: 0.2px;
    }

    .hero-section .btn-hero-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 8px 32px rgba(99, 102, 241, 0.35);
    }

    .hero-section .btn-hero-primary:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 16px 56px rgba(99, 102, 241, 0.5);
        color: white;
    }

    .hero-section .btn-hero-primary::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.6s ease;
        pointer-events: none;
    }

    .hero-section .btn-hero-primary:hover::before {
        opacity: 1;
    }

    .hero-section .btn-hero-outline {
        background: rgba(255,255,255,0.04);
        border: 1.5px solid rgba(255,255,255,0.15);
        color: white;
    }

    .hero-section .btn-hero-outline:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.3);
        color: white;
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    }

    /* Hero Image / Illustration */
    .hero-section .hero-visual {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
    }

    .hero-section .hero-visual .main-icon {
        font-size: 180px;
        opacity: 0.06;
        color: white;
        user-select: none;
        pointer-events: none;
        position: relative;
        z-index: 1;
    }

    .hero-section .hero-visual .floating-icon {
        position: absolute;
        font-size: 32px;
        color: rgba(255,255,255,0.12);
        animation: floatSlow 6s ease-in-out infinite;
    }

    .hero-section .hero-visual .floating-icon:nth-child(2) {
        top: 10%;
        left: 15%;
        animation-delay: 0s;
        font-size: 28px;
        color: rgba(99, 102, 241, 0.2);
    }

    .hero-section .hero-visual .floating-icon:nth-child(3) {
        top: 20%;
        right: 20%;
        animation-delay: 1s;
        font-size: 24px;
        color: rgba(168, 85, 247, 0.2);
    }

    .hero-section .hero-visual .floating-icon:nth-child(4) {
        bottom: 25%;
        left: 10%;
        animation-delay: 2s;
        font-size: 36px;
        color: rgba(245, 158, 11, 0.15);
    }

    .hero-section .hero-visual .floating-icon:nth-child(5) {
        bottom: 15%;
        right: 15%;
        animation-delay: 3s;
        font-size: 22px;
        color: rgba(16, 185, 129, 0.2);
    }

    /* Stats Mini di Hero */
    .hero-section .hero-stats {
        display: flex;
        gap: 32px;
        margin-top: 32px;
        flex-wrap: wrap;
    }

    .hero-section .hero-stats .stat-item {
        display: flex;
        flex-direction: column;
    }

    .hero-section .hero-stats .stat-item .num {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #818cf8, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-section .hero-stats .stat-item .label {
        font-size: 12px;
        opacity: 0.5;
        font-weight: 400;
        letter-spacing: 0.3px;
    }

    /* ============================================================
       FEATURE CARDS - ULTRA PREMIUM
    ============================================================ */
    .feature-card {
        position: relative;
        background: white;
        border-radius: var(--radius-xl);
        padding: 36px 28px 32px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-bounce);
        height: 100%;
        border: 1px solid var(--gray-100);
        overflow: hidden;
        cursor: default;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.6s ease;
        pointer-events: none;
    }

    .feature-card:hover::after {
        opacity: 1;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-2xl);
        border-color: rgba(99, 102, 241, 0.15);
    }

    .feature-card .icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 30px;
        transition: var(--transition-bounce);
        position: relative;
    }

    .feature-card:hover .icon-wrap {
        transform: scale(1.08) rotate(-4deg);
    }

    .feature-card .icon-wrap::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: var(--radius-lg);
        border: 2px solid transparent;
        transition: var(--transition-base);
    }

    .feature-card:hover .icon-wrap::after {
        border-color: currentColor;
        opacity: 0.1;
    }

    .feature-card .icon-wrap.blue {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: #6366f1;
    }

    .feature-card .icon-wrap.green {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: #10b981;
    }

    .feature-card .icon-wrap.orange {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        color: #f59e0b;
    }

    .feature-card .icon-wrap.pink {
        background: linear-gradient(135deg, #fdf2f8, #fce7f3);
        color: #ec4899;
    }

    .feature-card h5 {
        font-weight: 700;
        color: var(--gray-900);
        font-size: 17px;
        margin-bottom: 8px;
        letter-spacing: -0.2px;
        transition: var(--transition-base);
    }

    .feature-card:hover h5 {
        color: var(--primary);
    }

    .feature-card p {
        color: var(--gray-500);
        font-size: 14px;
        margin-bottom: 0;
        line-height: 1.7;
        font-weight: 400;
        transition: var(--transition-base);
    }

    /* ============================================================
       STATS SECTION - ULTRA PREMIUM
    ============================================================ */
    .stats-section {
        position: relative;
        background: white;
        border-radius: var(--radius-2xl);
        padding: 50px 40px;
        margin-top: 50px;
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        background-size: 200% 200%;
        animation: gradientShift 4s ease infinite;
    }

    .stats-section::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .stats-section .stat-item {
        text-align: center;
        padding: 10px;
        position: relative;
        z-index: 1;
    }

    .stats-section .stat-item .number {
        font-size: 42px;
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1.1;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: var(--transition-bounce);
        display: inline-block;
    }

    .stats-section .stat-item:hover .number {
        transform: scale(1.05);
    }

    .stats-section .stat-item .label {
        color: var(--gray-500);
        font-size: 14px;
        font-weight: 500;
        margin-top: 6px;
        letter-spacing: 0.2px;
    }

    .stats-section .stat-item .divider {
        width: 40px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: var(--radius-full);
        margin: 8px auto 0;
        opacity: 0.3;
    }

    /* ============================================================
       SECTION TITLES
    ============================================================ */
    .section-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title .badge {
        display: inline-block;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: var(--primary);
        padding: 6px 20px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .section-title h2 {
        font-size: 34px;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }

    .section-title h2 .gradient-text {
        background: linear-gradient(135deg, #6366f1, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-title p {
        color: var(--gray-500);
        font-size: 16px;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================================
       CTA SECTION
    ============================================================ */
    .cta-section {
        background: linear-gradient(135deg, #0a0a1a 0%, #1a1a3e 50%, #2d1b4e 100%);
        border-radius: var(--radius-2xl);
        padding: 60px 50px;
        margin-top: 50px;
        text-align: center;
        position: relative;
        overflow: hidden;
        isolation: isolate;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .cta-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168, 85, 247, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .cta-section .content {
        position: relative;
        z-index: 1;
    }

    .cta-section h2 {
        color: white;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .cta-section p {
        color: rgba(255,255,255,0.6);
        font-size: 16px;
        margin-bottom: 24px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-section .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary-gradient);
        color: white;
        padding: 14px 40px;
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 15px;
        transition: var(--transition-bounce);
        text-decoration: none;
        box-shadow: 0 8px 32px rgba(99, 102, 241, 0.35);
    }

    .cta-section .btn-cta:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 16px 56px rgba(99, 102, 241, 0.5);
        color: white;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .hero-section h1 {
            font-size: 44px;
        }
        .hero-section {
            padding: 60px 40px;
        }
    }

    @media (max-width: 992px) {
        .hero-section {
            padding: 50px 32px;
            min-height: auto;
        }
        .hero-section h1 {
            font-size: 36px;
        }
        .hero-section .subtitle {
            font-size: 17px;
        }
        .hero-section .hero-visual .main-icon {
            font-size: 120px;
        }
        .stats-section .stat-item .number {
            font-size: 34px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 40px 24px;
            text-align: center;
            border-radius: var(--radius-xl);
            min-height: auto;
        }

        .hero-section h1 {
            font-size: 28px;
        }

        .hero-section .subtitle {
            font-size: 15px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-section .badge-icon {
            font-size: 12px;
            padding: 6px 18px;
        }

        .hero-section .tags {
            justify-content: center;
        }

        .hero-section .tags .tag {
            font-size: 12px;
            padding: 6px 16px;
        }

        .hero-section .buttons {
            justify-content: center;
        }

        .hero-section .btn-hero {
            padding: 12px 28px;
            font-size: 14px;
        }

        .hero-section .hero-stats {
            justify-content: center;
            gap: 24px;
        }

        .hero-section .hero-stats .stat-item .num {
            font-size: 20px;
        }

        .hero-section .hero-visual {
            display: none;
        }

        .hero-section .bg-orb-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -80px;
        }

        .hero-section .bg-orb-2 {
            width: 250px;
            height: 250px;
            bottom: -80px;
            left: -60px;
        }

        .feature-card {
            padding: 24px 18px;
        }

        .feature-card .icon-wrap {
            width: 56px;
            height: 56px;
            font-size: 24px;
        }

        .feature-card h5 {
            font-size: 15px;
        }

        .feature-card p {
            font-size: 13px;
        }

        .stats-section {
            padding: 30px 20px;
            border-radius: var(--radius-lg);
        }

        .stats-section .stat-item .number {
            font-size: 26px;
        }

        .stats-section .stat-item .label {
            font-size: 12px;
        }

        .section-title h2 {
            font-size: 26px;
        }

        .section-title p {
            font-size: 14px;
        }

        .cta-section {
            padding: 40px 24px;
            border-radius: var(--radius-lg);
        }

        .cta-section h2 {
            font-size: 24px;
        }

        .cta-section p {
            font-size: 14px;
        }

        .cta-section .btn-cta {
            padding: 12px 28px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            padding: 32px 18px;
            border-radius: var(--radius-lg);
        }

        .hero-section h1 {
            font-size: 22px;
        }

        .hero-section .badge-icon {
            font-size: 11px;
            padding: 5px 14px;
        }

        .hero-section .tags .tag {
            font-size: 11px;
            padding: 5px 12px;
        }

        .hero-section .btn-hero {
            padding: 10px 22px;
            font-size: 13px;
            width: 100%;
            justify-content: center;
        }

        .hero-section .buttons {
            flex-direction: column;
        }

        .hero-section .hero-stats {
            gap: 16px;
            margin-top: 20px;
        }

        .hero-section .hero-stats .stat-item .num {
            font-size: 18px;
        }

        .hero-section .hero-stats .stat-item .label {
            font-size: 10px;
        }

        .feature-card {
            padding: 18px 14px;
        }

        .feature-card .icon-wrap {
            width: 48px;
            height: 48px;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .feature-card h5 {
            font-size: 14px;
        }

        .feature-card p {
            font-size: 12px;
        }

        .stats-section {
            padding: 24px 16px;
        }

        .stats-section .stat-item .number {
            font-size: 22px;
        }

        .stats-section .stat-item .label {
            font-size: 11px;
        }

        .section-title h2 {
            font-size: 22px;
        }

        .cta-section {
            padding: 32px 18px;
        }

        .cta-section h2 {
            font-size: 20px;
        }

        .cta-section .btn-cta {
            padding: 10px 22px;
            font-size: 13px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-gradient);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }
</style>
@endsection

@section('content')
<!-- ============================================================
HERO SECTION - ULTRA PREMIUM
============================================================ -->
<div class="hero-section">
    <!-- Background Effects -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
    <div class="grid-overlay"></div>
    
    <!-- Sparkles -->
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>

    <div class="row align-items-center w-100">
        <div class="col-lg-7">
            <div class="content">
                <div class="badge-icon slide-in-left">
                    <i class="fas fa-bolt"></i>
                    <span>Solusi Las Terpercaya Sejak 2008</span>
                </div>

                <h1 class="slide-in-left delay-1">
                    Karya <span class="gradient-text">Jaya Las</span><br>
                    Konstruksi
                </h1>

                <p class="subtitle slide-in-left delay-2">
                    Solusi Las dan Fabrikasi Logam Profesional dengan Teknologi Modern dan Tenaga Ahli Berpengalaman
                </p>

                <div class="tags slide-in-left delay-3">
                    <span class="tag"><i class="fas fa-check-circle"></i> Berpengalaman</span>
                    <span class="tag"><i class="fas fa-check-circle"></i> Berkualitas</span>
                    <span class="tag"><i class="fas fa-check-circle"></i> Terpercaya</span>
                    <span class="tag"><i class="fas fa-check-circle"></i> Profesional</span>
                </div>

                <!-- Buttons -->
                <div class="buttons slide-in-left delay-4">
                    @guest
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-hero btn-hero-outline">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <a href="{{ route('profile') }}" class="btn-hero btn-hero-outline">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    @endguest
                </div>

                <!-- Mini Stats -->
                <div class="hero-stats slide-in-left delay-5">
                    <div class="stat-item">
                        <span class="num">10+</span>
                        <span class="label">Tahun Pengalaman</span>
                    </div>
                    <div class="stat-item">
                        <span class="num">500+</span>
                        <span class="label">Proyek Selesai</span>
                    </div>
                    <div class="stat-item">
                        <span class="num">100%</span>
                        <span class="label">Kepuasan Pelanggan</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-flex">
            <div class="hero-visual">
                <i class="fas fa-industry main-icon animate-float-slow"></i>
                <i class="fas fa-bolt floating-icon"></i>
                <i class="fas fa-tools floating-icon"></i>
                <i class="fas fa-hard-hat floating-icon"></i>
                <i class="fas fa-star floating-icon"></i>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
SECTION TITLE - FEATURES
============================================================ -->
<div class="section-title slide-in-up">
    <div class="badge">Layanan Kami</div>
    <h2>Kenapa Memilih <span class="gradient-text">Kami</span>?</h2>
    <p>Kami memberikan layanan terbaik dengan standar kualitas tinggi untuk setiap proyek</p>
</div>

<!-- ============================================================
FEATURE CARDS - ULTRA PREMIUM
============================================================ -->
<div class="row g-4">
    <div class="col-md-3 col-6">
        <div class="feature-card scale-in delay-1">
            <div class="icon-wrap blue">
                <i class="fas fa-tools"></i>
            </div>
            <h5>Las Profesional</h5>
            <p>Layanan las berkualitas tinggi dengan tenaga ahli berpengalaman di bidangnya</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="feature-card scale-in delay-2">
            <div class="icon-wrap green">
                <i class="fas fa-industry"></i>
            </div>
            <h5>Fabrikasi Logam</h5>
            <p>Pengerjaan logam presisi untuk berbagai kebutuhan industri dan konstruksi</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="feature-card scale-in delay-3">
            <div class="icon-wrap orange">
                <i class="fas fa-hard-hat"></i>
            </div>
            <h5>Tenaga Ahli</h5>
            <p>Tim profesional berpengalaman lebih dari 10 tahun di bidang las dan konstruksi</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="feature-card scale-in delay-4">
            <div class="icon-wrap pink">
                <i class="fas fa-star"></i>
            </div>
            <h5>Kualitas Terjamin</h5>
            <p>Hasil kerja berkualitas dengan standar terbaik dan garansi kepuasan</p>
        </div>
    </div>
</div>

<!-- ============================================================
STATS SECTION - ULTRA PREMIUM
============================================================ -->
<div class="stats-section slide-in-up">
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number" data-count="10">10+</div>
                <div class="label">Tahun Pengalaman</div>
                <div class="divider"></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number" data-count="500">500+</div>
                <div class="label">Proyek Selesai</div>
                <div class="divider"></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number" data-count="50">50+</div>
                <div class="label">Klien Puas</div>
                <div class="divider"></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-item">
                <div class="number" data-count="100">100%</div>
                <div class="label">Kepuasan Pelanggan</div>
                <div class="divider"></div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
CTA SECTION
============================================================ -->
<div class="cta-section slide-in-up">
    <div class="content">
        <h2>Siap Memulai Proyek Anda?</h2>
        <p>Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik</p>
        @guest
            <a href="{{ route('register') }}" class="btn-cta">
                <i class="fas fa-rocket"></i> Mulai Sekarang
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn-cta">
                <i class="fas fa-arrow-right"></i> Ke Dashboard
            </a>
        @endguest
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== COUNTER ANIMATION =====
        const counters = document.querySelectorAll('.stats-section .number');
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-count'));
            const suffix = counter.textContent.includes('+') ? '+' : 
                          counter.textContent.includes('%') ? '%' : '';
            let current = 0;
            const increment = target / 60;
            const duration = 2000;
            const stepTime = duration / 60;
            
            const updateCounter = () => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + suffix;
                    return;
                }
                counter.textContent = Math.floor(current) + suffix;
                setTimeout(updateCounter, stepTime);
            };
            
            updateCounter();
        };

        // ===== INTERSECTION OBSERVER =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));

        // ===== PARALLAX EFFECT =====
        const hero = document.querySelector('.hero-section');
        if (hero) {
            hero.addEventListener('mousemove', (e) => {
                const { left, top, width, height } = hero.getBoundingClientRect();
                const x = (e.clientX - left) / width;
                const y = (e.clientY - top) / height;
                
                const orbs = hero.querySelectorAll('.bg-orb');
                orbs.forEach((orb, index) => {
                    const speed = (index + 1) * 10;
                    orb.style.transform = `translate(${(x - 0.5) * speed}px, ${(y - 0.5) * speed}px)`;
                });
            });
        }

        // ===== RIPPLE EFFECT PADA BUTTON =====
        document.querySelectorAll('.btn-hero, .btn-cta').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.width = '20px';
                ripple.style.height = '20px';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255,255,255,0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'rippleAnim 0.8s ease-out forwards';
                ripple.style.pointerEvents = 'none';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 800);
            });
        });

        // ===== KEYBOARD SHORTCUT =====
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                // Focus ke button utama
                const btn = document.querySelector('.btn-hero-primary');
                if (btn) btn.focus();
            }
        });
    });

    // ===== RIPPLE ANIMATION KEYFRAME =====
    const style = document.createElement('style');
    style.textContent = `
        @keyframes rippleAnim {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection