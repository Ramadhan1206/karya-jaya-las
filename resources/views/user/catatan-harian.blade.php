@extends('layouts.app')

@section('title', 'Catatan Harian - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    /* ============================================================
       ROOT VARIABLES
    ============================================================ */
    :root {
        --primary-50: #f0f4ff;
        --primary-100: #e0e7ff;
        --primary-200: #c7d2fe;
        --primary-300: #a5b4fc;
        --primary-400: #818cf8;
        --primary-500: #6366f1;
        --primary-600: #4f46e5;
        --primary-700: #4338ca;
        --primary-800: #3730a3;
        --primary-900: #312e81;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        --primary-gradient-soft: linear-gradient(135deg, #818cf8 0%, #a78bfa 100%);
        --primary-glow: 0 8px 32px rgba(99, 102, 241, 0.30);
        --primary-glow-soft: 0 4px 16px rgba(99, 102, 241, 0.12);

        --success: #10b981;
        --success-50: #ecfdf5;
        --success-100: #d1fae5;
        --success-500: #10b981;
        --success-600: #059669;
        --success-glow: 0 4px 16px rgba(16, 185, 129, 0.25);

        --warning: #f59e0b;
        --warning-50: #fffbeb;
        --warning-100: #fef3c7;
        --warning-500: #f59e0b;
        --warning-600: #d97706;
        --warning-glow: 0 4px 16px rgba(245, 158, 11, 0.25);

        --danger: #ef4444;
        --danger-50: #fef2f2;
        --danger-100: #fee2e2;
        --danger-500: #ef4444;
        --danger-600: #dc2626;
        --danger-glow: 0 4px 16px rgba(239, 68, 68, 0.25);

        --info: #3b82f6;
        --info-50: #eff6ff;
        --info-100: #dbeafe;

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

        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-full: 9999px;

        --transition-fast: all 0.15s ease;
        --transition-base: all 0.3s ease;
        --transition-slow: all 0.5s ease;
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);

        --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* ============================================================
       GLOBAL
    ============================================================ */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: var(--font-family);
    }

    body {
        background: #f0f2f8;
        min-height: 100vh;
    }

    /* ============================================================
       HERO - ELEGANT PREMIUM
    ============================================================ */
    .hero-elegant {
        position: relative;
        border-radius: var(--radius-2xl);
        padding: 40px 44px;
        margin-bottom: 28px;
        overflow: hidden;
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 20px 60px rgba(99, 102, 241, 0.30);
        isolation: isolate;
    }

    .hero-elegant .bg-decoration {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }

    .hero-elegant .bg-decoration .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.08;
    }

    .hero-elegant .bg-decoration .circle-1 {
        width: 500px;
        height: 500px;
        background: white;
        top: -200px;
        right: -150px;
        animation: floatCircle 12s ease-in-out infinite;
    }

    .hero-elegant .bg-decoration .circle-2 {
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        bottom: -100px;
        left: -80px;
        animation: floatCircle 10s ease-in-out infinite reverse;
    }

    .hero-elegant .bg-decoration .circle-3 {
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.03);
        top: 50%;
        right: 30%;
        animation: floatCircle 14s ease-in-out infinite alternate;
    }

    @keyframes floatCircle {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -20px) scale(1.05); }
        66% { transform: translate(-15px, 15px) scale(0.95); }
    }

    .hero-elegant .content {
        position: relative;
        z-index: 1;
    }

    .hero-elegant .top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-elegant .badge-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.10);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.06);
        padding: 5px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 0.3px;
        margin-bottom: 6px;
    }

    .hero-elegant .greeting {
        font-size: 14px;
        opacity: 0.75;
        font-weight: 400;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1px;
    }

    .hero-elegant .greeting .wave {
        font-size: 22px;
        animation: wave 2.5s ease-in-out infinite;
        display: inline-block;
    }

    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        10% { transform: rotate(14deg); }
        20% { transform: rotate(-6deg); }
        30% { transform: rotate(14deg); }
        40% { transform: rotate(-4deg); }
        50% { transform: rotate(10deg); }
        60%, 100% { transform: rotate(0deg); }
    }

    .hero-elegant h1 {
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.15;
        margin-bottom: 2px;
    }

    .hero-elegant h1 .highlight {
        background: linear-gradient(90deg, #fbbf24, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
    }

    .hero-elegant .subtitle {
        font-size: 14px;
        opacity: 0.55;
        font-weight: 400;
    }

    .hero-elegant .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: var(--radius-md);
        padding: 12px 32px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition-bounce);
        cursor: pointer;
        box-shadow: 0 2px 16px rgba(0,0,0,0.04);
    }

    .hero-elegant .btn-add:hover {
        transform: translateY(-3px) scale(1.02);
        background: rgba(255,255,255,0.15);
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        color: white;
    }

    .hero-elegant .btn-add i {
        font-size: 18px;
    }

    .hero-elegant .mini-stats {
        display: flex;
        gap: 20px;
        margin-top: 14px;
        flex-wrap: wrap;
    }

    .hero-elegant .mini-stats .item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        opacity: 0.6;
        background: rgba(255,255,255,0.04);
        padding: 3px 14px;
        border-radius: var(--radius-full);
        border: 1px solid rgba(255,255,255,0.03);
    }

    .hero-elegant .mini-stats .item .num {
        font-weight: 700;
        opacity: 1;
        font-size: 14px;
    }

    /* ============================================================
       STATISTIK - CLEAN MODERN
    ============================================================ */
    .stat-grid-modern {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }

    .stat-modern {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px 18px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    .stat-modern:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-200);
    }

    .stat-modern .icon-box {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 10px;
        transition: var(--transition-bounce);
    }

    .stat-modern:hover .icon-box {
        transform: scale(1.05) rotate(-3deg);
    }

    .stat-modern .icon-box.primary { background: var(--primary-100); color: var(--primary-600); }
    .stat-modern .icon-box.success { background: var(--success-100); color: var(--success-600); }
    .stat-modern .icon-box.warning { background: var(--warning-100); color: var(--warning-600); }
    .stat-modern .icon-box.danger { background: var(--danger-100); color: var(--danger-600); }
    .stat-modern .icon-box.gray { background: var(--gray-100); color: var(--gray-500); }

    .stat-modern .number {
        font-size: 28px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.3px;
    }

    .stat-modern .number.primary { color: var(--primary-600); }
    .stat-modern .number.success { color: var(--success-600); }
    .stat-modern .number.warning { color: var(--warning-600); }
    .stat-modern .number.danger { color: var(--danger-600); }
    .stat-modern .number.gray { color: var(--gray-500); }

    .stat-modern .label {
        font-size: 12px;
        color: var(--gray-400);
        font-weight: 500;
        margin-top: 1px;
    }

    .stat-modern .trend {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        font-weight: 600;
        padding: 2px 12px;
        border-radius: var(--radius-full);
        margin-top: 4px;
    }

    .stat-modern .trend.up { background: var(--success-50); color: var(--success-600); }
    .stat-modern .trend.down { background: var(--danger-50); color: var(--danger-600); }
    .stat-modern .trend.stable { background: var(--gray-100); color: var(--gray-500); }

    /* ============================================================
       TABLE - CLEAN PREMIUM
    ============================================================ */
    .table-premium {
        background: white;
        border-radius: var(--radius-xl);
        padding: 24px 24px 18px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: var(--transition-slow);
    }

    .table-premium:hover {
        box-shadow: var(--shadow-lg);
    }

    .table-premium .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-premium .header .left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .table-premium .header .left .icon-wrap {
        width: 46px;
        height: 46px;
        border-radius: var(--radius-md);
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        box-shadow: var(--primary-glow);
        flex-shrink: 0;
    }

    .table-premium .header .left .title h5 {
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0;
        font-size: 17px;
    }

    .table-premium .header .left .title small {
        color: var(--gray-400);
        font-size: 12px;
        font-weight: 400;
        display: block;
    }

    .table-premium .header .count-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 6px 20px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        box-shadow: var(--primary-glow);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .table-premium .table-wrap {
        overflow-x: auto;
        border-radius: var(--radius-md);
    }

    .table-premium table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-premium table thead th {
        background: var(--gray-50);
        color: var(--gray-500);
        font-weight: 600;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        white-space: nowrap;
        border-bottom: 1.5px solid var(--gray-200);
        text-align: left;
    }

    .table-premium table thead th i {
        margin-right: 6px;
        opacity: 0.5;
        font-size: 10px;
    }

    .table-premium table tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-100);
        font-size: 13px;
        color: var(--gray-700);
    }

    .table-premium table tbody tr {
        transition: var(--transition-fast);
    }

    .table-premium table tbody tr:hover {
        background: var(--gray-50);
    }

    .table-premium table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-cell .avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 13px;
        flex-shrink: 0;
        background: var(--primary-gradient);
        border: 2px solid var(--gray-100);
        transition: var(--transition-fast);
        position: relative;
    }

    .user-cell .avatar:hover {
        transform: scale(1.05);
        border-color: var(--primary-300);
    }

    .user-cell .avatar .dot {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid white;
        background: var(--success);
    }

    .user-cell .avatar.green { background: linear-gradient(135deg, #34d399, #059669); }
    .user-cell .avatar.orange { background: linear-gradient(135deg, #fbbf24, #d97706); }
    .user-cell .avatar.blue { background: linear-gradient(135deg, #60a5fa, #2563eb); }
    .user-cell .avatar.pink { background: linear-gradient(135deg, #f472b6, #db2777); }
    .user-cell .avatar.purple { background: var(--primary-gradient); }
    .user-cell .avatar.teal { background: linear-gradient(135deg, #2dd4bf, #0d9488); }
    .user-cell .avatar.rose { background: linear-gradient(135deg, #fb7185, #e11d48); }
    .user-cell .avatar.indigo { background: linear-gradient(135deg, #818cf8, #4f46e5); }
    .user-cell .avatar.amber { background: linear-gradient(135deg, #fcd34d, #b45309); }

    .user-cell .info .name {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .user-cell .info .name .badge-me {
        background: var(--info-100);
        color: var(--info-600);
        font-size: 8px;
        padding: 1px 12px;
        border-radius: var(--radius-full);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .user-cell .info .email {
        font-size: 11px;
        color: var(--gray-400);
        font-weight: 400;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 16px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.2px;
        text-transform: capitalize;
    }

    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.7); }
    }

    .status-badge.hadir { background: var(--success-50); color: var(--success-600); }
    .status-badge.hadir .dot { background: var(--success-500); }
    .status-badge.izin { background: var(--warning-50); color: var(--warning-600); }
    .status-badge.izin .dot { background: var(--warning-500); }
    .status-badge.sakit { background: var(--danger-50); color: var(--danger-600); }
    .status-badge.sakit .dot { background: var(--danger-500); }
    .status-badge.alpha { background: var(--gray-100); color: var(--gray-500); }
    .status-badge.alpha .dot { background: var(--gray-400); }

    .durasi-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--primary-50);
        color: var(--primary-600);
        padding: 4px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 500;
    }

    .action-group {
        display: flex;
        gap: 4px;
        justify-content: center;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: var(--radius-sm);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        cursor: pointer;
        font-size: 13px;
    }

    .btn-action:hover {
        transform: scale(1.10) translateY(-2px);
    }

    .btn-action.edit {
        background: var(--primary-50);
        color: var(--primary-600);
    }

    .btn-action.edit:hover {
        background: var(--primary-600);
        color: white;
        box-shadow: var(--primary-glow);
    }

    .btn-action.delete {
        background: var(--danger-50);
        color: var(--danger-600);
    }

    .btn-action.delete:hover {
        background: var(--danger-600);
        color: white;
        box-shadow: var(--danger-glow);
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }

    .empty-state .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 32px;
        color: var(--gray-300);
        transition: var(--transition-bounce);
    }

    .empty-state:hover .icon-circle {
        transform: scale(1.05) rotate(-4deg);
        background: var(--gray-200);
        color: var(--gray-400);
    }

    .empty-state h5 {
        color: var(--gray-700);
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 2px;
    }

    .empty-state p {
        color: var(--gray-400);
        font-size: 13px;
        font-weight: 400;
    }

    .empty-state .btn-empty {
        background: var(--primary-gradient);
        border: none;
        border-radius: var(--radius-md);
        padding: 10px 32px;
        font-weight: 600;
        color: white;
        transition: var(--transition-bounce);
        box-shadow: var(--primary-glow);
        margin-top: 12px;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .empty-state .btn-empty:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 40px rgba(99,102,241,0.35);
        color: white;
    }

    /* ============================================================
       PAGINATION - FIXED
    ============================================================ */
    .pagination-wrap {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .pagination-wrap nav {
        display: flex;
        align-items: center;
    }

    .pagination-wrap .pagination {
        margin: 0;
        gap: 4px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .pagination-wrap .page-item {
        display: inline-block;
    }

    .pagination-wrap .page-link {
        border: none;
        border-radius: var(--radius-sm);
        margin: 0;
        padding: 0 10px;
        color: var(--gray-600);
        transition: var(--transition-bounce);
        font-weight: 500;
        font-size: 12px;
        line-height: 1;
        background: transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        text-decoration: none;
        position: relative;
    }

    .pagination-wrap .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--primary-glow);
    }

    .pagination-wrap .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: var(--primary-glow);
    }

    .pagination-wrap .page-item.disabled .page-link {
        color: var(--gray-300);
        background: transparent;
        cursor: not-allowed;
    }

    /* PERKECIL ICON SVG - INI YANG PENTING */
    .pagination-wrap .page-link svg {
        width: 12px !important;
        height: 12px !important;
        max-width: 12px !important;
        max-height: 12px !important;
        display: inline-block;
        vertical-align: middle;
        flex-shrink: 0;
    }

    .pagination-wrap .page-link i,
    .pagination-wrap .page-link .fa,
    .pagination-wrap .page-link .fas,
    .pagination-wrap .page-link .far {
        font-size: 11px !important;
        width: 12px;
        height: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Sembunyikan teks "Previous"/"Next" agar tidak terlalu lebar */
    .pagination-wrap .page-link .page-text,
    .pagination-wrap .page-link span:not(.sr-only):not([aria-current]) {
        font-size: 12px;
    }

    .pagination-wrap .page-link[rel="prev"],
    .pagination-wrap .page-link[rel="next"] {
        padding: 0 8px;
        min-width: 34px;
    }

    /* ============================================================
       MODAL - CLEAN PREMIUM
    ============================================================ */
    .modal-premium .modal-content {
        border-radius: var(--radius-xl) !important;
        border: none !important;
        overflow: hidden;
        box-shadow: var(--shadow-2xl) !important;
        background: white;
    }

    .modal-premium .modal-header {
        padding: 20px 28px !important;
        border: none !important;
    }

    .modal-premium .modal-header .modal-title {
        font-weight: 700;
        font-size: 18px;
        letter-spacing: -0.2px;
    }

    .modal-premium .modal-header .btn-close-custom {
        background: transparent;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        color: inherit;
        font-size: 18px;
        cursor: pointer;
    }

    .modal-premium .modal-header .btn-close-custom:hover {
        background: rgba(255,255,255,0.15);
        transform: rotate(90deg);
    }

    .modal-premium .modal-body {
        padding: 28px !important;
    }

    .modal-premium .modal-footer {
        padding: 16px 28px !important;
        border-top: 1px solid var(--gray-100) !important;
    }

    .modal-premium .form-control {
        border-radius: var(--radius-md) !important;
        border: 1.5px solid var(--gray-200) !important;
        padding: 10px 16px !important;
        transition: var(--transition-fast);
        font-size: 14px;
        background: white;
        width: 100%;
    }

    .modal-premium .form-control:focus {
        border-color: var(--primary-400) !important;
        box-shadow: 0 0 0 4px rgba(99,102,241,0.06) !important;
        outline: none;
    }

    .modal-premium .form-control::placeholder {
        color: var(--gray-300);
    }

    .modal-premium .form-label {
        font-weight: 600;
        font-size: 13px;
        color: var(--gray-700);
        margin-bottom: 4px;
        display: block;
    }

    .modal-premium .form-label i {
        margin-right: 6px;
        color: var(--primary-400);
        width: 16px;
    }

    .modal-premium .btn-primary-modal {
        background: var(--primary-gradient);
        border: none !important;
        border-radius: var(--radius-md) !important;
        padding: 10px 32px !important;
        font-weight: 600;
        color: white;
        transition: var(--transition-bounce);
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .modal-premium .btn-primary-modal:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: var(--primary-glow);
        color: white;
    }

    .modal-premium .btn-secondary-modal {
        background: var(--gray-100);
        border: none !important;
        border-radius: var(--radius-md) !important;
        padding: 10px 32px !important;
        font-weight: 500;
        color: var(--gray-600);
        transition: var(--transition-fast);
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .modal-premium .btn-secondary-modal:hover {
        background: var(--gray-200);
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    .fade-up {
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-up:nth-child(1) { animation-delay: 0.04s; }
    .fade-up:nth-child(2) { animation-delay: 0.08s; }
    .fade-up:nth-child(3) { animation-delay: 0.12s; }
    .fade-up:nth-child(4) { animation-delay: 0.16s; }
    .fade-up:nth-child(5) { animation-delay: 0.20s; }

    .slide-in {
        opacity: 0;
        animation: slideIn 0.5s ease forwards;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .slide-in:nth-child(1) { animation-delay: 0.03s; }
    .slide-in:nth-child(2) { animation-delay: 0.06s; }
    .slide-in:nth-child(3) { animation-delay: 0.09s; }
    .slide-in:nth-child(4) { animation-delay: 0.12s; }
    .slide-in:nth-child(5) { animation-delay: 0.15s; }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: var(--gray-100); border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--primary-gradient); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary-600); }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .stat-grid-modern { grid-template-columns: repeat(4, 1fr); }
        .hero-elegant h1 { font-size: 28px; }
    }

    @media (max-width: 992px) {
        .stat-grid-modern { grid-template-columns: repeat(3, 1fr); }
        .hero-elegant { padding: 32px 28px; }
        .hero-elegant .top-row { flex-direction: column; align-items: flex-start; }
        .hero-elegant .btn-add { width: 100%; justify-content: center; }
    }

    @media (max-width: 768px) {
        .stat-grid-modern { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .hero-elegant { padding: 24px 18px; border-radius: var(--radius-xl); }
        .hero-elegant h1 { font-size: 22px; }
        .hero-elegant .mini-stats { gap: 10px; }
        .hero-elegant .mini-stats .item { font-size: 11px; padding: 2px 10px; }
        .hero-elegant .btn-add { padding: 10px 20px; font-size: 13px; }
        .table-premium { padding: 16px; border-radius: var(--radius-lg); }
        .table-premium .header { flex-direction: column; align-items: flex-start; gap: 10px; }
        .table-premium .header .left .icon-wrap { width: 38px; height: 38px; font-size: 15px; }
        .table-premium .header .left .title h5 { font-size: 15px; }
        .table-premium .header .count-badge { padding: 5px 16px; font-size: 11px; }
        .user-cell .avatar { width: 32px; height: 32px; font-size: 11px; }
        .user-cell .avatar .dot { width: 8px; height: 8px; }
        .user-cell .info .name { font-size: 12px; }
        .user-cell .info .email { font-size: 10px; }
        .status-badge { font-size: 10px; padding: 3px 12px; }
        .durasi-badge { font-size: 10px; padding: 3px 12px; }
        .btn-action { width: 30px; height: 30px; font-size: 12px; }
        .table-premium table thead th { font-size: 9px; padding: 8px 10px; }
        .table-premium table tbody td { font-size: 12px; padding: 8px 10px; }
        .modal-premium .modal-body { padding: 20px !important; }
        .modal-premium .modal-header { padding: 16px 20px !important; }
        .modal-premium .modal-footer { padding: 14px 20px !important; }
        .modal-premium .form-control { padding: 8px 12px !important; font-size: 13px; }
        .modal-premium .btn-primary-modal,
        .modal-premium .btn-secondary-modal { padding: 8px 20px !important; font-size: 13px; }
        .empty-state .icon-circle { width: 60px; height: 60px; font-size: 24px; }
        .empty-state h5 { font-size: 16px; }
        .empty-state p { font-size: 12px; }
        .empty-state .btn-empty { padding: 8px 24px; font-size: 12px; }

        /* Pagination responsive */
        .pagination-wrap .page-link {
            padding: 0 8px;
            min-width: 30px;
            height: 30px;
            font-size: 11px;
        }
        .pagination-wrap .page-link svg {
            width: 10px !important;
            height: 10px !important;
            max-width: 10px !important;
            max-height: 10px !important;
        }
        .pagination-wrap .page-link i,
        .pagination-wrap .page-link .fa,
        .pagination-wrap .page-link .fas {
            font-size: 10px !important;
            width: 10px;
            height: 10px;
        }
    }

    @media (max-width: 480px) {
        .stat-grid-modern { grid-template-columns: 1fr 1fr; gap: 8px; }
        .stat-modern { padding: 14px 12px; }
        .stat-modern .number { font-size: 20px; }
        .stat-modern .label { font-size: 11px; }
        .stat-modern .icon-box { width: 34px; height: 34px; font-size: 14px; margin-bottom: 6px; }
        .stat-modern .trend { font-size: 9px; padding: 1px 8px; }
        .hero-elegant h1 { font-size: 18px; }
        .hero-elegant .greeting { font-size: 12px; }
        .hero-elegant .subtitle { font-size: 12px; }
        .hero-elegant .badge-date { font-size: 10px; padding: 4px 14px; }
        .hero-elegant .btn-add { padding: 8px 16px; font-size: 12px; }
        .hero-elegant .mini-stats .item { font-size: 10px; padding: 2px 8px; }
        .hero-elegant .mini-stats .item .num { font-size: 12px; }
        .table-premium { padding: 10px; }
        .table-premium table thead th { font-size: 8px; padding: 6px 6px; letter-spacing: 0.3px; }
        .table-premium table tbody td { font-size: 11px; padding: 6px 6px; }
        .user-cell .avatar { width: 28px; height: 28px; font-size: 10px; }
        .user-cell .avatar .dot { width: 7px; height: 7px; }
        .user-cell .info .name { font-size: 11px; }
        .user-cell .info .email { font-size: 9px; }
        .status-badge { font-size: 9px; padding: 2px 10px; gap: 4px; }
        .status-badge .dot { width: 5px; height: 5px; }
        .durasi-badge { font-size: 9px; padding: 2px 10px; }
        .btn-action { width: 26px; height: 26px; font-size: 10px; }
        .modal-premium .modal-title { font-size: 16px !important; }
        .modal-premium .form-label { font-size: 12px; }
        .modal-premium .form-control { padding: 6px 10px !important; font-size: 12px; }

        /* Pagination responsive */
        .pagination-wrap .page-link {
            padding: 0 6px;
            min-width: 26px;
            height: 26px;
            font-size: 10px;
        }
        .pagination-wrap .page-link svg {
            width: 9px !important;
            height: 9px !important;
            max-width: 9px !important;
            max-height: 9px !important;
        }
        .pagination-wrap .page-link i,
        .pagination-wrap .page-link .fa,
        .pagination-wrap .page-link .fas {
            font-size: 9px !important;
            width: 9px;
            height: 9px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- HERO -->
    <div class="hero-elegant fade-up">
        <div class="bg-decoration">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>

        <div class="content">
            <div class="top-row">
                <div>
                    <div class="badge-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>
                    <div class="greeting">
                        <span class="wave">👋</span>
                        Halo, <strong>{{ $user->name }}</strong>
                    </div>
                    <h1>
                        <i class="fas fa-clipboard-list me-2" style="color: #fbbf24;"></i>
                        Catatan <span class="highlight">Harian</span>
                    </h1>
                    <p class="subtitle">Kelola aktivitas dan kehadiran Anda dengan mudah</p>
                </div>
                <div>
                    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah" id="btnAdd">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Catatan
                    </button>
                </div>
            </div>

            <div class="mini-stats">
                <div class="item"><span class="num">{{ $riwayat->total() }}</span><span>Total</span></div>
                <div class="item"><span class="num">{{ $totalHadir ?? 0 }}</span><span>Hadir</span></div>
                <div class="item"><span class="num">{{ $totalIzin ?? 0 }}</span><span>Izin</span></div>
                <div class="item"><span class="num">{{ $totalSakit ?? 0 }}</span><span>Sakit</span></div>
                <div class="item"><span class="num">{{ $totalAlpha ?? 0 }}</span><span>Alpha</span></div>
            </div>
        </div>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-up"
             style="border-radius: var(--radius-lg); border-left: 4px solid var(--success); background: var(--success-50); padding: 14px 20px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="color: var(--success); font-size: 18px;"></i>
                <span style="font-weight: 500; color: var(--success-600);">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 12px;"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show fade-up"
             style="border-radius: var(--radius-lg); border-left: 4px solid var(--danger); background: var(--danger-50); padding: 14px 20px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2" style="color: var(--danger); font-size: 18px;"></i>
                <span style="font-weight: 500; color: var(--danger-600);">{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 12px;"></button>
        </div>
    @endif

    <!-- STATISTIK -->
    <div class="stat-grid-modern">
        <div class="stat-modern fade-up">
            <div class="icon-box primary"><i class="fas fa-file-alt"></i></div>
            <div class="number primary">{{ $riwayat->total() }}</div>
            <div class="label">Total Catatan</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> 12%</span>
        </div>
        <div class="stat-modern fade-up">
            <div class="icon-box success"><i class="fas fa-check-circle"></i></div>
            <div class="number success">{{ $totalHadir ?? 0 }}</div>
            <div class="label">Hadir</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> 8%</span>
        </div>
        <div class="stat-modern fade-up">
            <div class="icon-box warning"><i class="fas fa-clock"></i></div>
            <div class="number warning">{{ $totalIzin ?? 0 }}</div>
            <div class="label">Izin</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-modern fade-up">
            <div class="icon-box danger"><i class="fas fa-notes-medical"></i></div>
            <div class="number danger">{{ $totalSakit ?? 0 }}</div>
            <div class="label">Sakit</div>
            <span class="trend down"><i class="fas fa-arrow-down"></i> 3%</span>
        </div>
        <div class="stat-modern fade-up">
            <div class="icon-box gray"><i class="fas fa-times-circle"></i></div>
            <div class="number gray">{{ $totalAlpha ?? 0 }}</div>
            <div class="label">Alpha</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-premium fade-up">
        <div class="header">
            <div class="left">
                <div class="icon-wrap"><i class="fas fa-history"></i></div>
                <div class="title">
                    <h5>Riwayat Catatan</h5>
                    <small><i class="fas fa-clock"></i> Semua aktivitas harian</small>
                </div>
            </div>
            <span class="count-badge">
                <i class="fas fa-database"></i>
                {{ $riwayat->total() }} Data
            </span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-user"></i> Nama</th>
                        <th><i class="fas fa-calendar"></i> Tanggal</th>
                        <th><i class="fas fa-sign-in-alt"></i> Masuk</th>
                        <th><i class="fas fa-sign-out-alt"></i> Pulang</th>
                        <th><i class="fas fa-hourglass-half"></i> Durasi</th>
                        <th><i class="fas fa-project-diagram"></i> Proyek</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th style="text-align: center;"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $item)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose', 'indigo', 'amber'];
                            $color = $colors[$loop->index % count($colors)];
                            $inisial = strtoupper(substr($item->nama_lengkap ?? $item->user->name ?? 'U', 0, 2));
                            $isYou = ($item->user_id ?? 0) == auth()->id();
                            $statusClass = $item->status ?? 'hadir';

                            $durasi = '-';
                            if ($item->jam_masuk && $item->jam_pulang) {
                                $masuk = \Carbon\Carbon::parse($item->jam_masuk);
                                $pulang = \Carbon\Carbon::parse($item->jam_pulang);
                                $diff = $masuk->diff($pulang);
                                $durasi = $diff->format('%h jam %i menit');
                            }
                        @endphp
                        <tr class="slide-in" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                            <td>
                                <div class="user-cell">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                        @if($isYou)<span class="dot"></span>@endif
                                    </div>
                                    <div class="info">
                                        <div class="name">
                                            {{ $item->nama_lengkap ?? $item->user->name ?? 'User' }}
                                            @if($isYou)<span class="badge-me">Anda</span>@endif
                                        </div>
                                        <div class="email">{{ $item->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}</td>
                            <td><span style="color: var(--success-600); font-weight: 600;">{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</span></td>
                            <td><span style="color: var(--danger-600); font-weight: 600;">{{ $item->jam_pulang ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') : '-' }}</span></td>
                            <td>
                                @if($durasi != '-')
                                    <span class="durasi-badge"><i class="fas fa-clock"></i> {{ $durasi }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->proyek)
                                    <span class="badge" style="background: var(--primary-50); color: var(--primary-600); font-size: 11px; padding: 3px 14px; border-radius: var(--radius-full); font-weight: 500;">
                                        <i class="fas fa-project-diagram me-1"></i> {{ $item->proyek }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    <span class="dot"></span> {{ ucfirst($statusClass) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="action-group">
                                    <button class="btn-action edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="{{ route('user.catatan-harian.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="icon-circle"><i class="fas fa-inbox"></i></div>
                                    <h5>Belum Ada Catatan</h5>
                                    <p>Mulai catat aktivitas harian Anda sekarang</p>
                                    <button class="btn-empty" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                        <i class="fas fa-plus"></i> Tambah Catatan
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
            <div class="text-muted" style="font-size: 12px; font-weight: 500;">
                <i class="fas fa-info-circle me-1"></i>
                {{ $riwayat->firstItem() ?? 0 }} - {{ $riwayat->lastItem() ?? 0 }} dari {{ $riwayat->total() }} data
            </div>
            <div class="pagination-wrap">
                {{ $riwayat->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal modal-premium fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--primary-gradient); color: white;">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Tambah Catatan</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('user.catatan-harian.store') }}" id="formTambah">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-user"></i>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $user->name) }}" placeholder="Masukkan nama" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-calendar"></i>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-clock"></i>Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" value="{{ old('jam_masuk') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-clock"></i>Jam Pulang</label>
                            <input type="time" class="form-control" name="jam_pulang" value="{{ old('jam_pulang') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label"><i class="fas fa-project-diagram"></i>Proyek</label>
                            <input type="text" class="form-control" name="proyek" placeholder="Nama proyek" value="{{ old('proyek') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label"><i class="fas fa-tasks"></i>Pekerjaan</label>
                            <textarea class="form-control" name="pekerjaan" rows="2" placeholder="Deskripsi pekerjaan">{{ old('pekerjaan') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-sticky-note"></i>Catatan</label>
                            <textarea class="form-control" name="catatan" rows="2" placeholder="Catatan tambahan">{{ old('catatan') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-info-circle"></i>Status</label>
                            <select class="form-control" name="status" required>
                                <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>✅ Hadir</option>
                                <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>⏰ Izin</option>
                                <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>🏥 Sakit</option>
                                <option value="alpha" {{ old('status') == 'alpha' ? 'selected' : '' }}>❌ Alpha</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn-primary-modal"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
@foreach($riwayat as $item)
    <div class="modal modal-premium fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Catatan</h5>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <form method="POST" action="{{ route('user.catatan-harian.update', $item->id) }}" id="formEdit{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><i class="fas fa-user"></i>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap ?? $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fas fa-calendar"></i>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fas fa-clock"></i>Jam Masuk</label>
                                <input type="time" class="form-control" name="jam_masuk" value="{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fas fa-clock"></i>Jam Pulang</label>
                                <input type="time" class="form-control" name="jam_pulang" value="{{ $item->jam_pulang ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') : '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label"><i class="fas fa-project-diagram"></i>Proyek</label>
                                <input type="text" class="form-control" name="proyek" value="{{ $item->proyek }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label"><i class="fas fa-tasks"></i>Pekerjaan</label>
                                <textarea class="form-control" name="pekerjaan" rows="2">{{ $item->pekerjaan }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fas fa-sticky-note"></i>Catatan</label>
                                <textarea class="form-control" name="catatan" rows="2">{{ $item->catatan }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fas fa-info-circle"></i>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="hadir" {{ $item->status == 'hadir' ? 'selected' : '' }}>✅ Hadir</option>
                                    <option value="izin" {{ $item->status == 'izin' ? 'selected' : '' }}>⏰ Izin</option>
                                    <option value="sakit" {{ $item->status == 'sakit' ? 'selected' : '' }}>🏥 Sakit</option>
                                    <option value="alpha" {{ $item->status == 'alpha' ? 'selected' : '' }}>❌ Alpha</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn-primary-modal" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);"><i class="fas fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Loading State
        document.querySelectorAll('form[id^="formTambah"], form[id^="formEdit"]').forEach(function(form) {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('.btn-primary-modal');
                if (btn) {
                    const original = btn.innerHTML;
                    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" style="width: 14px; height: 14px;"></span>Menyimpan...`;
                    btn.disabled = true;
                    setTimeout(() => {
                        btn.innerHTML = original;
                        btn.disabled = false;
                    }, 3000);
                }
            });
        });

        // Reset Modal
        document.querySelectorAll('.modal-premium').forEach(function(modal) {
            modal.addEventListener('hidden.bs.modal', function() {
                const form = this.querySelector('form');
                if (form) {
                    const btn = form.querySelector('.btn-primary-modal');
                    if (btn) {
                        const isEdit = btn.textContent.trim().includes('Update');
                        btn.innerHTML = isEdit ? '<i class="fas fa-save"></i> Update' : '<i class="fas fa-save"></i> Simpan';
                        btn.disabled = false;
                    }
                }
            });
        });

        // Auto-close Alert
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                const close = alert.querySelector('.btn-close');
                if (close) close.click();
            }, 5000);
        });

        // Keyboard Shortcut: Ctrl+N
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                const btn = document.getElementById('btnAdd');
                if (btn) btn.click();
            }
        });
    });
</script>
@endsection