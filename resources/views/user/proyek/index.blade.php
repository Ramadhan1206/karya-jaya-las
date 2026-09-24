@extends('layouts.app')

@section('title', 'Proyek - Karya Jaya Las Konstruksi')

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
        --warning: #f59e0b;
        --info: #3b82f6;
        --danger: #ef4444;
        
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
        
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        --shadow-xl: 0 20px 60px rgba(0,0,0,0.10);
        
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-full: 9999px;
        
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ============================================================
       HERO HEADER - ULTRA PREMIUM
    ============================================================ */
    .proyek-hero {
        position: relative;
        background: linear-gradient(135deg, #0a0a1a 0%, #1a1a3e 40%, #2d1b4e 70%, #1a1a3e 100%);
        border-radius: var(--radius-2xl);
        padding: 70px 60px;
        color: white;
        margin-bottom: 40px;
        overflow: hidden;
        isolation: isolate;
        box-shadow: 0 30px 80px rgba(10, 10, 26, 0.3);
    }

    .proyek-hero .bg-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.15;
        pointer-events: none;
        z-index: 0;
    }

    .proyek-hero .bg-orb-1 {
        width: 500px;
        height: 500px;
        background: #6366f1;
        top: -200px;
        right: -150px;
        animation: float 12s ease-in-out infinite;
    }

    .proyek-hero .bg-orb-2 {
        width: 400px;
        height: 400px;
        background: #a855f7;
        bottom: -180px;
        left: -120px;
        animation: float 10s ease-in-out infinite reverse;
    }

    .proyek-hero .bg-orb-3 {
        width: 300px;
        height: 300px;
        background: #f59e0b;
        top: 40%;
        right: 25%;
        opacity: 0.08;
        animation: float 14s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(30px, -30px) scale(1.05); }
    }

    .proyek-hero .grid-overlay {
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

    .proyek-hero .content {
        position: relative;
        z-index: 2;
    }

    .proyek-hero .badge-icon {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(99, 102, 241, 0.15);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(99, 102, 241, 0.2);
        padding: 8px 22px;
        border-radius: var(--radius-full);
        margin-bottom: 18px;
        font-size: 13px;
        font-weight: 500;
        color: #a5b4fc;
        letter-spacing: 0.3px;
    }

    .proyek-hero .badge-icon i {
        color: #fbbf24;
        font-size: 14px;
    }

    .proyek-hero h1 {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -1px;
        line-height: 1.1;
    }

    .proyek-hero h1 .gradient-text {
        background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc, #fbbf24);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 6s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .proyek-hero p {
        font-size: 17px;
        opacity: 0.65;
        font-weight: 300;
        letter-spacing: 0.3px;
        max-width: 600px;
        line-height: 1.6;
        margin: 0;
    }

    .proyek-hero .hero-stats {
        display: flex;
        gap: 40px;
        margin-top: 32px;
        flex-wrap: wrap;
    }

    .proyek-hero .hero-stats .stat-item {
        display: flex;
        flex-direction: column;
    }

    .proyek-hero .hero-stats .stat-item .num {
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #818cf8, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    .proyek-hero .hero-stats .stat-item .label {
        font-size: 12px;
        opacity: 0.5;
        font-weight: 400;
        letter-spacing: 0.3px;
        margin-top: 2px;
    }

    /* ============================================================
       FILTER SECTION - MODERN
    ============================================================ */
    .filter-modern {
        background: white;
        border-radius: var(--radius-xl);
        padding: 24px 28px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-100);
        margin-bottom: 32px;
        transition: var(--transition);
    }

    .filter-modern:hover {
        box-shadow: var(--shadow-md);
    }

    .filter-modern .filter-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-100);
    }

    .filter-modern .filter-header .icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 15px;
    }

    .filter-modern .filter-header h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .filter-modern .filter-header p {
        font-size: 12px;
        color: var(--gray-500);
        margin: 0;
    }

    .filter-modern .form-label {
        font-weight: 600;
        color: var(--gray-700);
        font-size: 12px;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .filter-modern .form-label i {
        color: var(--primary);
        font-size: 11px;
    }

    .filter-modern .form-control,
    .filter-modern .form-select {
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-200);
        padding: 10px 16px;
        font-size: 13px;
        transition: var(--transition);
        background: var(--gray-50);
        color: var(--gray-700);
        height: 42px;
    }

    .filter-modern .form-control:focus,
    .filter-modern .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        background: white;
        outline: none;
    }

    .filter-modern .form-control::placeholder {
        color: var(--gray-400);
        font-size: 13px;
    }

    .filter-modern .btn-filter {
        border-radius: var(--radius-md);
        padding: 0 28px;
        font-weight: 600;
        font-size: 13px;
        width: 100%;
        height: 42px;
        background: var(--primary-gradient);
        border: none;
        color: white;
        transition: var(--transition-bounce);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.25);
    }

    .filter-modern .btn-filter:hover {
        transform: translateY(-2px) scale(1.01);
        box-shadow: 0 8px 28px rgba(99, 102, 241, 0.35);
        color: white;
    }

    .filter-modern .btn-reset {
        border-radius: var(--radius-md);
        padding: 0 20px;
        font-weight: 600;
        font-size: 13px;
        height: 42px;
        background: var(--gray-100);
        border: none;
        color: var(--gray-600);
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        width: 100%;
    }

    .filter-modern .btn-reset:hover {
        background: var(--gray-200);
        color: var(--gray-800);
    }

    /* ============================================================
       RESULT INFO
    ============================================================ */
    .result-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding: 0 4px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .result-info .count {
        font-size: 14px;
        color: var(--gray-500);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .result-info .count .badge-count {
        background: var(--primary-gradient);
        color: white;
        padding: 3px 14px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .result-info .view-toggle {
        display: flex;
        gap: 4px;
        background: var(--gray-100);
        padding: 4px;
        border-radius: var(--radius-md);
    }

    .result-info .view-toggle button {
        background: transparent;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        color: var(--gray-500);
        transition: var(--transition);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .result-info .view-toggle button.active {
        background: white;
        color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    /* ============================================================
       PROYEK CARD - ULTRA MODERN
    ============================================================ */
    .proyek-card {
        position: relative;
        background: white;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-bounce);
        height: 100%;
        border: 1px solid var(--gray-100);
        display: flex;
        flex-direction: column;
    }

    .proyek-card::before {
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
        z-index: 3;
    }

    .proyek-card:hover::before {
        transform: scaleX(1);
    }

    .proyek-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
        border-color: rgba(99, 102, 241, 0.15);
    }

    /* Image Container */
    .proyek-card .image-wrap {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: var(--gray-100);
    }

    .proyek-card .image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .proyek-card:hover .image-wrap img {
        transform: scale(1.08);
    }

    .proyek-card .image-wrap .placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
        color: var(--gray-400);
        font-size: 48px;
    }

    .proyek-card .image-wrap .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, transparent 60%);
        opacity: 0;
        transition: var(--transition);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        pointer-events: none;
    }

    .proyek-card:hover .image-wrap .overlay {
        opacity: 1;
    }

    .proyek-card .image-wrap .overlay .quick-view {
        color: white;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .proyek-card .image-wrap .overlay .quick-view i {
        font-size: 11px;
    }

    /* Badges */
    .proyek-card .image-wrap .status-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        font-size: 10px;
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: inline-flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(8px);
    }

    .proyek-card .image-wrap .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: white;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
    }

    .status-selesai { background: linear-gradient(135deg, #10b981, #059669); }
    .status-berjalan { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .status-direncanakan { background: linear-gradient(135deg, #3b82f6, #2563eb); }

    .proyek-card .image-wrap .featured-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: white;
        padding: 5px 12px;
        border-radius: var(--radius-full);
        font-size: 10px;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        letter-spacing: 0.3px;
    }

    /* Body */
    .proyek-card .body {
        padding: 20px 22px 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .proyek-card .body .kategori-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 8px;
    }

    .proyek-card .body .kategori {
        font-size: 10px;
        color: var(--primary);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        background: #eef2ff;
        padding: 3px 10px;
        border-radius: var(--radius-full);
    }

    .proyek-card .body h5 {
        font-weight: 700;
        color: var(--gray-900);
        margin: 0 0 10px;
        font-size: 16px;
        line-height: 1.4;
        letter-spacing: -0.2px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 45px;
        transition: var(--transition);
    }

    .proyek-card:hover .body h5 {
        color: var(--primary);
    }

    .proyek-card .body .meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
        flex: 1;
    }

    .proyek-card .body .meta .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: var(--gray-500);
        font-weight: 400;
    }

    .proyek-card .body .meta .meta-item i {
        width: 16px;
        color: var(--gray-400);
        font-size: 11px;
    }

    .proyek-card .body .meta .meta-item span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Button */
    .proyek-card .body .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 18px;
        background: var(--gray-50);
        color: var(--gray-700);
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        transition: var(--transition-bounce);
        border: 1px solid var(--gray-200);
        margin-top: auto;
    }

    .proyek-card .body .btn-detail .arrow-icon {
        transition: var(--transition);
        font-size: 12px;
    }

    .proyek-card .body .btn-detail:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
        transform: translateY(-2px);
    }

    .proyek-card .body .btn-detail:hover .arrow-icon {
        transform: translateX(4px);
    }

    /* ============================================================
       LIST VIEW
    ============================================================ */
    .proyek-list .proyek-card {
        flex-direction: row;
    }

    .proyek-list .proyek-card .image-wrap {
        width: 280px;
        height: auto;
        min-height: 180px;
        flex-shrink: 0;
    }

    .proyek-list .proyek-card .body {
        flex: 1;
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: var(--radius-xl);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
    }

    .empty-state .icon-wrap {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 42px;
        color: var(--gray-400);
        transition: var(--transition-bounce);
    }

    .empty-state:hover .icon-wrap {
        transform: scale(1.05) rotate(-4deg);
    }

    .empty-state h4 {
        color: var(--gray-700);
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .empty-state p {
        color: var(--gray-500);
        font-size: 14px;
        margin-bottom: 20px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .empty-state .btn-empty {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary-gradient);
        color: white;
        padding: 12px 28px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: var(--transition-bounce);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.25);
    }

    .empty-state .btn-empty:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 32px rgba(99, 102, 241, 0.35);
        color: white;
    }

    /* ============================================================
       PAGINATION - MODERN
    ============================================================ */
    .pagination-wrap {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .pagination-wrap .pagination {
        gap: 6px;
        margin: 0;
    }

    .pagination-wrap .page-item .page-link {
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 8px 16px;
        color: var(--gray-600);
        font-weight: 500;
        font-size: 13px;
        transition: var(--transition-bounce);
        background: white;
        min-width: 40px;
        text-align: center;
    }

    .pagination-wrap .page-item .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.25);
    }

    .pagination-wrap .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.25);
    }

    .pagination-wrap .page-item.disabled .page-link {
        color: var(--gray-300);
        background: var(--gray-50);
        border-color: var(--gray-100);
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    .fade-up {
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-up:nth-child(1) { animation-delay: 0.05s; }
    .fade-up:nth-child(2) { animation-delay: 0.10s; }
    .fade-up:nth-child(3) { animation-delay: 0.15s; }
    .fade-up:nth-child(4) { animation-delay: 0.20s; }
    .fade-up:nth-child(5) { animation-delay: 0.25s; }
    .fade-up:nth-child(6) { animation-delay: 0.30s; }

    .scale-in {
        opacity: 0;
        animation: scaleIn 0.5s ease forwards;
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.96);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .scale-in:nth-child(1) { animation-delay: 0.05s; }
    .scale-in:nth-child(2) { animation-delay: 0.10s; }
    .scale-in:nth-child(3) { animation-delay: 0.15s; }
    .scale-in:nth-child(4) { animation-delay: 0.20s; }
    .scale-in:nth-child(5) { animation-delay: 0.25s; }
    .scale-in:nth-child(6) { animation-delay: 0.30s; }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .proyek-hero h1 {
            font-size: 40px;
        }
    }

    @media (max-width: 992px) {
        .proyek-hero {
            padding: 50px 40px;
        }
        .proyek-hero h1 {
            font-size: 34px;
        }
        .proyek-list .proyek-card .image-wrap {
            width: 220px;
        }
    }

    @media (max-width: 768px) {
        .proyek-hero {
            padding: 36px 24px;
            border-radius: var(--radius-xl);
            text-align: center;
        }
        .proyek-hero h1 {
            font-size: 26px;
        }
        .proyek-hero p {
            font-size: 14px;
            margin-left: auto;
            margin-right: auto;
        }
        .proyek-hero .hero-stats {
            justify-content: center;
            gap: 24px;
            margin-top: 24px;
        }
        .proyek-hero .hero-stats .stat-item .num {
            font-size: 24px;
        }
        .proyek-hero .badge-icon {
            font-size: 12px;
            padding: 6px 16px;
        }

        .filter-modern {
            padding: 18px 20px;
            border-radius: var(--radius-lg);
        }
        .filter-modern .filter-header {
            margin-bottom: 14px;
            padding-bottom: 12px;
        }
        .filter-modern .form-control,
        .filter-modern .form-select {
            height: 38px;
            font-size: 12px;
            padding: 8px 12px;
        }
        .filter-modern .btn-filter,
        .filter-modern .btn-reset {
            height: 38px;
            font-size: 12px;
        }

        .proyek-card .image-wrap {
            height: 180px;
        }
        .proyek-card .body {
            padding: 16px 18px 18px;
        }
        .proyek-card .body h5 {
            font-size: 14px;
            min-height: 40px;
        }
        .proyek-card .body .meta .meta-item {
            font-size: 11px;
        }
        .proyek-card .body .btn-detail {
            padding: 8px 14px;
            font-size: 12px;
        }

        .proyek-list .proyek-card {
            flex-direction: column;
        }
        .proyek-list .proyek-card .image-wrap {
            width: 100%;
            min-height: 180px;
        }

        .result-info .view-toggle {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .proyek-hero {
            padding: 28px 18px;
        }
        .proyek-hero h1 {
            font-size: 22px;
        }
        .proyek-hero p {
            font-size: 13px;
        }
        .proyek-hero .hero-stats {
            gap: 16px;
            margin-top: 20px;
        }
        .proyek-hero .hero-stats .stat-item .num {
            font-size: 20px;
        }
        .proyek-hero .hero-stats .stat-item .label {
            font-size: 10px;
        }

        .filter-modern {
            padding: 14px 16px;
        }
        .filter-modern .filter-header .icon {
            width: 32px;
            height: 32px;
            font-size: 13px;
        }
        .filter-modern .filter-header h5 {
            font-size: 14px;
        }

        .proyek-card .image-wrap {
            height: 150px;
        }
        .proyek-card .body {
            padding: 14px 16px 16px;
        }
        .proyek-card .body .kategori {
            font-size: 9px;
            padding: 2px 8px;
        }
        .proyek-card .body h5 {
            font-size: 13px;
            min-height: 36px;
            margin-bottom: 8px;
        }
        .proyek-card .body .meta .meta-item {
            font-size: 10px;
            gap: 6px;
        }
        .proyek-card .body .btn-detail {
            padding: 7px 12px;
            font-size: 11px;
        }

        .empty-state {
            padding: 50px 20px;
        }
        .empty-state .icon-wrap {
            width: 72px;
            height: 72px;
            font-size: 30px;
            margin-bottom: 16px;
        }
        .empty-state h4 {
            font-size: 16px;
        }
        .empty-state p {
            font-size: 12px;
        }
        .empty-state .btn-empty {
            padding: 10px 22px;
            font-size: 13px;
        }

        .pagination-wrap .page-item .page-link {
            padding: 6px 12px;
            font-size: 12px;
            min-width: 34px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- ============================================================
    HERO HEADER - ULTRA PREMIUM
    ============================================================ -->
    <div class="proyek-hero fade-up">
        <!-- Background Effects -->
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
        <div class="bg-orb bg-orb-3"></div>
        <div class="grid-overlay"></div>

        <div class="content">
            <div class="badge-icon">
                <i class="fas fa-star"></i>
                <span>Portfolio Proyek Terbaik</span>
            </div>

            <h1>
                <i class="fas fa-project-diagram me-3" style="color: #a5b4fc;"></i>
                <span class="gradient-text">Proyek</span> Kami
            </h1>

            <p>
                Kumpulan proyek yang telah kami kerjakan dengan standar kualitas tertinggi 
                dan hasil yang memuaskan
            </p>

            <div class="hero-stats">
                <div class="stat-item">
                    <span class="num">{{ $proyek->total() }}</span>
                    <span class="label">Total Proyek</span>
                </div>
                <div class="stat-item">
                    <span class="num">{{ $proyek->where('status', 'selesai')->count() }}</span>
                    <span class="label">Selesai</span>
                </div>
                <div class="stat-item">
                    <span class="num">{{ $proyek->where('status', 'berjalan')->count() }}</span>
                    <span class="label">Berjalan</span>
                </div>
                <div class="stat-item">
                    <span class="num">{{ $proyek->where('is_featured', true)->count() }}</span>
                    <span class="label">Featured</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    FILTER SECTION - MODERN
    ============================================================ -->
    <div class="filter-modern fade-up">
        <div class="filter-header">
            <div class="icon">
                <i class="fas fa-sliders-h"></i>
            </div>
            <div>
                <h5>Filter & Pencarian</h5>
                <p>Temukan proyek yang Anda cari</p>
            </div>
        </div>

        <form method="GET" action="{{ route('proyek.index') }}" class="row g-3">
            <div class="col-md-3 col-6">
                <label class="form-label">
                    <i class="fas fa-tag"></i> Kategori
                </label>
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris ?? [] as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ ucfirst($kat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-6">
                <label class="form-label">
                    <i class="fas fa-circle"></i> Status
                </label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach($statuses ?? [] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-12">
                <label class="form-label">
                    <i class="fas fa-search"></i> Cari Proyek
                </label>
                <input type="text" name="search" class="form-control" 
                       placeholder="Nama proyek, klien, lokasi..." 
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3 col-12">
                <label class="form-label" style="visibility: hidden;">Aksi</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    @if(request()->hasAny(['kategori', 'status', 'search']))
                        <a href="{{ route('proyek.index') }}" class="btn-reset">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- ============================================================
    RESULT INFO
    ============================================================ -->
    <div class="result-info fade-up">
        <div class="count">
            <i class="fas fa-folder-open" style="color: var(--primary);"></i>
            <span>Menampilkan</span>
            <span class="badge-count">{{ $proyek->total() }}</span>
            <span>proyek</span>
        </div>
        <div class="view-toggle">
            <button type="button" class="active" id="gridView" title="Grid View">
                <i class="fas fa-th-large"></i>
            </button>
            <button type="button" id="listView" title="List View">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    <!-- ============================================================
    PROYEK GRID
    ============================================================ -->
    @if($proyek->isEmpty())
        <div class="empty-state fade-up">
            <div class="icon-wrap">
                <i class="fas fa-folder-open"></i>
            </div>
            <h4>Belum Ada Proyek</h4>
            <p>
                @if(request()->hasAny(['kategori', 'status', 'search']))
                    Tidak ada proyek yang sesuai dengan filter Anda. Coba ubah filter atau reset pencarian.
                @else
                    Belum ada proyek yang ditambahkan. Silakan cek kembali nanti.
                @endif
            </p>
            @if(request()->hasAny(['kategori', 'status', 'search']))
                <a href="{{ route('proyek.index') }}" class="btn-empty">
                    <i class="fas fa-redo"></i> Reset Filter
                </a>
            @endif
        </div>
    @else
        <div class="row g-4" id="proyekGrid">
            @foreach($proyek as $item)
                <div class="col-lg-4 col-md-6 col-12 proyek-item">
                    <div class="proyek-card scale-in" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                        <!-- Image -->
                        <div class="image-wrap">
                            @if($item->cover)
                                <img src="{{ asset('storage/' . $item->cover->foto_url) }}" 
                                     alt="{{ $item->nama_proyek }}"
                                     loading="lazy">
                            @else
                                <div class="placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif

                            <!-- Overlay -->
                            <div class="overlay">
                                <div class="quick-view">
                                    <i class="fas fa-eye"></i>
                                    Lihat Detail Proyek
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <span class="status-badge status-{{ $item->status }}">
                                <span class="dot"></span>
                                {{ $item->status_label }}
                            </span>

                            <!-- Featured Badge -->
                            @if($item->is_featured)
                                <span class="featured-badge">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            @endif
                        </div>

                        <!-- Body -->
                        <div class="body">
                            <div class="kategori-wrap">
                                <span class="kategori">
                                    {{ $item->kategori ?? 'Umum' }}
                                </span>
                            </div>

                            <h5>{{ $item->nama_proyek }}</h5>

                            <div class="meta">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $item->klien ?? 'Klien tidak tersedia' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $item->lokasi ?? 'Lokasi tidak tersedia' }}</span>
                                </div>
                                @if($item->tanggal_mulai)
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('proyek.show', $item->slug) }}" class="btn-detail">
                                <span>Lihat Detail</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ============================================================
        PAGINATION
        ============================================================ -->
        @if($proyek->hasPages())
            <div class="pagination-wrap fade-up">
                {{ $proyek->appends(request()->query())->links() }}
            </div>
        @endif
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== VIEW TOGGLE =====
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        const proyekGrid = document.getElementById('proyekGrid');

        if (gridView && listView && proyekGrid) {
            gridView.addEventListener('click', function() {
                gridView.classList.add('active');
                listView.classList.remove('active');
                proyekGrid.classList.remove('proyek-list');
                proyekGrid.querySelectorAll('.proyek-item').forEach(item => {
                    item.className = 'col-lg-4 col-md-6 col-12 proyek-item';
                });
            });

            listView.addEventListener('click', function() {
                listView.classList.add('active');
                gridView.classList.remove('active');
                proyekGrid.classList.add('proyek-list');
                proyekGrid.querySelectorAll('.proyek-item').forEach(item => {
                    item.className = 'col-12 proyek-item';
                });
            });
        }

        // ===== AUTO SUBMIT FILTER =====
        const filterSelects = document.querySelectorAll('.filter-modern select');
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                // Optional: auto submit on change
                // this.closest('form').submit();
            });
        });

        // ===== KEYBOARD SHORTCUT: Ctrl+K untuk fokus search =====
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[name="search"]');
                if (searchInput) searchInput.focus();
            }
        });

        // ===== LAZY LOAD IMAGES =====
        if ('IntersectionObserver' in window) {
            const images = document.querySelectorAll('.proyek-card img');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            });
            images.forEach(img => imageObserver.observe(img));
        }
    });
</script>
@endsection