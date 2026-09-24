@extends('layouts.app')

@section('title', 'Dashboard Catatan Harian')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
        background: #f8fafc;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary-50: #eef2ff;
        --primary-100: #e0e7ff;
        --primary-200: #c7d2fe;
        --primary-300: #a5b4fc;
        --primary-400: #818cf8;
        --primary-500: #6366f1;
        --primary-600: #4f46e5;
        --primary-700: #4338ca;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        
        --success: #10b981;
        --success-50: #ecfdf5;
        --success-100: #d1fae5;
        --warning: #f59e0b;
        --warning-50: #fffbeb;
        --warning-100: #fef3c7;
        --danger: #ef4444;
        --danger-50: #fef2f2;
        --danger-100: #fee2e2;
        --info: #3b82f6;
        --info-50: #eff6ff;
        --info-100: #dbeafe;
        --purple: #8b5cf6;
        --purple-50: #f5f3ff;
        --pink: #ec4899;
        --pink-50: #fdf2f8;
        --cyan: #06b6d4;
        --cyan-50: #ecfeff;
        
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
        
        --shadow-xs: 0 1px 2px rgba(0,0,0,0.04);
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.05);
        --shadow-lg: 0 8px 24px rgba(0,0,0,0.06);
        --shadow-xl: 0 16px 40px rgba(0,0,0,0.08);
        
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
        --radius-xl: 18px;
        --radius-2xl: 24px;
        --radius-full: 9999px;
        
        --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { 
            transform: scale(1); 
            opacity: 1;
        }
        50% { 
            transform: scale(1.15); 
            opacity: 0.7;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-6px); }
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-in {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .animate-in:nth-child(1) { animation-delay: 0.05s; }
    .animate-in:nth-child(2) { animation-delay: 0.10s; }
    .animate-in:nth-child(3) { animation-delay: 0.15s; }
    .animate-in:nth-child(4) { animation-delay: 0.20s; }
    .animate-in:nth-child(5) { animation-delay: 0.25s; }

    .slide-in {
        opacity: 0;
        animation: slideInLeft 0.5s ease forwards;
    }

    /* ============================================================
       BACKGROUND DECORATION
    ============================================================ */
    .bg-decoration {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .bg-decoration .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.3;
    }

    .bg-decoration .orb-1 {
        width: 500px;
        height: 500px;
        background: linear-gradient(135deg, #c7d2fe, #a5b4fc);
        top: -200px;
        right: -100px;
        animation: float 12s ease-in-out infinite;
    }

    .bg-decoration .orb-2 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #ddd6fe, #c4b5fd);
        bottom: -150px;
        left: -100px;
        animation: float 10s ease-in-out infinite reverse;
    }

    /* ============================================================
       PAGE HEADER
    ============================================================ */
    .page-header {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-2xl);
        padding: 32px 36px;
        margin-bottom: 28px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        z-index: 1;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        background-size: 200% 200%;
        animation: gradientShift 6s ease infinite;
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 10s ease-in-out infinite;
        pointer-events: none;
    }

    .page-header .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-header .left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .page-header .icon-orb {
        width: 68px;
        height: 68px;
        border-radius: var(--radius-lg);
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 26px;
        flex-shrink: 0;
        position: relative;
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
    }

    .page-header .icon-orb::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: inherit;
        background: var(--primary-gradient);
        opacity: 0.3;
        filter: blur(12px);
        z-index: -1;
    }

    .page-header .title-wrap h1 {
        font-size: 28px;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.8px;
        margin-bottom: 4px;
        line-height: 1.1;
    }

    .page-header .title-wrap h1 .gradient-text {
        background: var(--primary-gradient);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 5s ease infinite;
    }

    .page-header .title-wrap p {
        font-size: 14px;
        color: var(--gray-500);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 400;
    }

    .page-header .title-wrap p i {
        color: var(--primary);
        font-size: 11px;
        animation: pulse 2s ease-in-out infinite;
    }

    .page-header .right .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--success-50);
        border: 1px solid #a7f3d0;
        padding: 10px 20px;
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 600;
        color: #065f46;
        position: relative;
        overflow: hidden;
    }

    .page-header .right .badge-status::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.08), transparent);
        background-size: 200% 100%;
        animation: shimmer 2.5s infinite;
    }

    .page-header .right .badge-status .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--success);
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
        position: relative;
        z-index: 1;
    }

    /* ============================================================
       STAT GRID - MODERN
    ============================================================ */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 28px;
        position: relative;
        z-index: 1;
    }

    .stat-card {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 20px;
        transition: var(--transition-smooth);
        overflow: hidden;
        cursor: default;
        box-shadow: var(--shadow-xs);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: var(--gray-300);
    }

    .stat-card.total::before { background: var(--primary-gradient); }
    .stat-card.hadir::before { background: linear-gradient(90deg, #10b981, #34d399); }
    .stat-card.izin::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .stat-card.sakit::before { background: linear-gradient(90deg, #ef4444, #f87171); }
    .stat-card.alpha::before { background: linear-gradient(90deg, #64748b, #94a3b8); }

    .stat-card .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 14px;
        transition: var(--transition-bounce);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08) rotate(-4deg);
    }

    .stat-card.total .stat-icon { background: var(--primary-50); color: var(--primary-600); }
    .stat-card.hadir .stat-icon { background: var(--success-50); color: var(--success); }
    .stat-card.izin .stat-icon { background: var(--warning-50); color: var(--warning); }
    .stat-card.sakit .stat-icon { background: var(--danger-50); color: var(--danger); }
    .stat-card.alpha .stat-icon { background: var(--gray-100); color: var(--gray-500); }

    .stat-card .stat-number {
        font-size: 28px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.5px;
        color: var(--gray-900);
        margin-bottom: 2px;
    }

    .stat-card.total .stat-number { color: var(--primary-600); }
    .stat-card.hadir .stat-number { color: var(--success); }
    .stat-card.izin .stat-number { color: var(--warning); }
    .stat-card.sakit .stat-number { color: var(--danger); }
    .stat-card.alpha .stat-number { color: var(--gray-500); }

    .stat-card .stat-label {
        font-size: 12px;
        color: var(--gray-500);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .stat-card .stat-change {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: var(--radius-full);
        letter-spacing: 0.2px;
    }

    .stat-card .stat-change.up { background: var(--success-50); color: var(--success); }
    .stat-card .stat-change.down { background: var(--danger-50); color: var(--danger); }
    .stat-card .stat-change.stable { background: var(--gray-100); color: var(--gray-500); }
    .stat-card .stat-change i { font-size: 9px; }

    /* ============================================================
       FILTER SECTION - MODERN
    ============================================================ */
    .filter-section {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 20px 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-xs);
        transition: var(--transition-smooth);
        z-index: 1;
    }

    .filter-section:hover {
        box-shadow: var(--shadow-md);
        border-color: var(--gray-300);
    }

    .filter-section .filter-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--gray-100);
    }

    .filter-section .filter-header .filter-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        background: var(--primary-50);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 13px;
    }

    .filter-section .filter-header h6 {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .filter-section .form-label {
        font-weight: 600;
        color: var(--gray-600);
        font-size: 11px;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .filter-section .form-label i {
        font-size: 10px;
        color: var(--primary);
    }

    .filter-section .form-control,
    .filter-section .form-select {
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-200);
        padding: 8px 14px;
        font-size: 13px;
        transition: var(--transition);
        background: var(--gray-50);
        height: 38px;
        color: var(--gray-900);
        font-weight: 500;
    }

    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        background: white;
        outline: none;
    }

    .filter-section .form-control::placeholder {
        font-size: 12px;
        color: var(--gray-400);
        font-weight: 400;
    }

    .btn-filter {
        background: var(--primary-gradient);
        background-size: 200% 200%;
        border: none;
        border-radius: var(--radius-md);
        padding: 8px 20px;
        font-weight: 600;
        color: white;
        font-size: 13px;
        transition: var(--transition);
        height: 38px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: 100%;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
        color: white;
        background-position: 100% 50%;
    }

    .btn-filter i {
        font-size: 12px;
    }

    .btn-reset {
        background: var(--gray-100);
        border: none;
        border-radius: var(--radius-md);
        padding: 8px 20px;
        font-weight: 600;
        color: var(--gray-600);
        font-size: 13px;
        transition: var(--transition);
        height: 38px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: 100%;
        justify-content: center;
        text-decoration: none;
    }

    .btn-reset:hover {
        background: var(--gray-200);
        color: var(--gray-900);
        transform: translateY(-2px);
    }

    .btn-reset i {
        font-size: 12px;
    }

    /* ============================================================
       TABLE - MODERN
    ============================================================ */
    .table-wrapper {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
        z-index: 1;
    }

    .table-wrapper:hover {
        box-shadow: var(--shadow-md);
    }

    .table-wrapper .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-100);
        flex-wrap: wrap;
        gap: 12px;
    }

    .table-wrapper .table-header .left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-wrapper .table-header .left .icon-box {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 15px;
        flex-shrink: 0;
    }

    .table-wrapper .table-header .left .title h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .table-wrapper .table-header .left .title p {
        font-size: 12px;
        color: var(--gray-500);
        margin: 0;
        font-weight: 400;
    }

    .table-wrapper .table-header .badge-total {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary-50);
        color: var(--primary-700);
        padding: 6px 16px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        border: 1px solid var(--primary-200);
    }

    .table-wrapper table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-wrapper table thead th {
        background: var(--gray-50);
        color: var(--gray-500);
        font-weight: 700;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 18px;
        border-bottom: 1px solid var(--gray-200);
        text-align: left;
        white-space: nowrap;
    }

    .table-wrapper table thead th i {
        margin-right: 5px;
        opacity: 0.5;
        font-size: 10px;
    }

    .table-wrapper table tbody td {
        padding: 14px 18px;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-100);
        font-size: 13px;
        color: var(--gray-700);
    }

    .table-wrapper table tbody tr {
        transition: var(--transition);
    }

    .table-wrapper table tbody tr:hover {
        background: linear-gradient(90deg, var(--primary-50) 0%, transparent 60%);
    }

    .table-wrapper table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ============================================================
       USER CELL
    ============================================================ */
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
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
        background: var(--primary-gradient);
        color: white;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.2);
        transition: var(--transition-bounce);
    }

    .user-cell .avatar:hover {
        transform: scale(1.08);
    }

    .user-cell .avatar.green { background: linear-gradient(135deg, #34d399, #059669); }
    .user-cell .avatar.orange { background: linear-gradient(135deg, #fbbf24, #d97706); }
    .user-cell .avatar.blue { background: linear-gradient(135deg, #60a5fa, #2563eb); }
    .user-cell .avatar.pink { background: linear-gradient(135deg, #f472b6, #db2777); }
    .user-cell .avatar.purple { background: var(--primary-gradient); }
    .user-cell .avatar.teal { background: linear-gradient(135deg, #2dd4bf, #0d9488); }
    .user-cell .avatar.rose { background: linear-gradient(135deg, #fb7185, #e11d48); }

    .user-cell .info .name {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 13px;
        display: block;
        line-height: 1.3;
    }

    .user-cell .info .email {
        font-size: 11px;
        color: var(--gray-500);
        font-weight: 400;
        display: block;
        line-height: 1.3;
    }

    /* ============================================================
       STATUS BADGE
    ============================================================ */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.2px;
        text-transform: capitalize;
        transition: var(--transition);
    }

    .status-badge:hover {
        transform: scale(1.03);
    }

    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 2s ease-in-out infinite;
    }

    .status-hadir { background: var(--success-50); color: var(--success); border: 1px solid #a7f3d0; }
    .status-hadir .dot { background: var(--success); box-shadow: 0 0 6px var(--success); }

    .status-izin { background: var(--warning-50); color: var(--warning); border: 1px solid #fde68a; }
    .status-izin .dot { background: var(--warning); box-shadow: 0 0 6px var(--warning); }

    .status-sakit { background: var(--danger-50); color: var(--danger); border: 1px solid #fecaca; }
    .status-sakit .dot { background: var(--danger); box-shadow: 0 0 6px var(--danger); }

    .status-alpha { background: var(--gray-100); color: var(--gray-500); border: 1px solid var(--gray-200); }
    .status-alpha .dot { background: var(--gray-400); }

    /* ============================================================
       DURASI BADGE
    ============================================================ */
    .durasi-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary-50);
        color: var(--primary-700);
        padding: 4px 12px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        border: 1px solid var(--primary-200);
        transition: var(--transition);
    }

    .durasi-badge:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        transform: scale(1.04);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    .durasi-badge i {
        font-size: 10px;
    }

    /* ============================================================
       ACTION BUTTONS
    ============================================================ */
    .action-group {
        display: flex;
        gap: 6px;
        justify-content: center;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: var(--radius-md);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        cursor: pointer;
        font-size: 12px;
    }

    .btn-action:hover {
        transform: scale(1.12) translateY(-2px);
    }

    .btn-action.view {
        background: var(--primary-50);
        color: var(--primary-600);
    }

    .btn-action.view:hover {
        background: var(--primary-600);
        color: white;
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
    }

    .btn-action.delete {
        background: var(--danger-50);
        color: var(--danger);
    }

    .btn-action.delete:hover {
        background: var(--danger);
        color: white;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state .icon-wrap {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 32px;
        color: var(--gray-400);
        animation: float 3s ease-in-out infinite;
        border: 2px dashed var(--gray-200);
    }

    .empty-state h5 {
        color: var(--gray-700);
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 4px;
    }

    .empty-state p {
        color: var(--gray-500);
        font-size: 13px;
        margin: 0;
    }

    /* ============================================================
       PAGINATION
    ============================================================ */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        padding: 20px 24px;
        border-top: 1px solid var(--gray-100);
    }

    .pagination-wrap .page-link {
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        padding: 7px 14px;
        margin: 0 3px;
        color: var(--gray-600);
        font-weight: 500;
        font-size: 13px;
        transition: var(--transition-bounce);
        background: white;
    }

    .pagination-wrap .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
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
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .stat-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .page-header {
            padding: 24px 22px;
        }

        .page-header .icon-orb {
            width: 58px;
            height: 58px;
            font-size: 22px;
        }

        .page-header .title-wrap h1 {
            font-size: 22px;
        }

        .page-header .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header .right {
            width: 100%;
        }

        .page-header .right .badge-status {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stat-card {
            padding: 16px;
        }

        .stat-card .stat-number {
            font-size: 22px;
        }

        .stat-card .stat-icon {
            width: 38px;
            height: 38px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .stat-card .stat-label {
            font-size: 11px;
        }

        .page-header {
            padding: 20px 18px;
            border-radius: var(--radius-xl);
        }

        .page-header .icon-orb {
            width: 52px;
            height: 52px;
            font-size: 20px;
        }

        .page-header .title-wrap h1 {
            font-size: 20px;
        }

        .page-header .title-wrap p {
            font-size: 13px;
        }

        .filter-section {
            padding: 16px 18px;
        }

        .filter-section .form-control,
        .filter-section .form-select {
            height: 34px;
            font-size: 12px;
            padding: 6px 10px;
        }

        .btn-filter,
        .btn-reset {
            height: 34px;
            font-size: 12px;
            padding: 6px 14px;
        }

        .table-wrapper .table-header {
            padding: 16px 18px;
            flex-direction: column;
            align-items: flex-start;
        }

        .table-wrapper .table-header .left .icon-box {
            width: 36px;
            height: 36px;
            font-size: 13px;
        }

        .table-wrapper .table-header .left .title h5 {
            font-size: 14px;
        }

        .table-wrapper table thead th {
            font-size: 9px;
            padding: 10px 12px;
        }

        .table-wrapper table tbody td {
            font-size: 12px;
            padding: 10px 12px;
        }

        .user-cell .avatar {
            width: 32px;
            height: 32px;
            font-size: 11px;
        }

        .user-cell .info .name {
            font-size: 12px;
        }

        .user-cell .info .email {
            font-size: 10px;
        }

        .status-badge {
            font-size: 10px;
            padding: 4px 10px;
        }

        .durasi-badge {
            font-size: 10px;
            padding: 3px 10px;
        }

        .btn-action {
            width: 30px;
            height: 30px;
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .stat-card {
            padding: 14px 12px;
        }

        .stat-card .stat-number {
            font-size: 18px;
        }

        .stat-card .stat-icon {
            width: 34px;
            height: 34px;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-card .stat-label {
            font-size: 10px;
        }

        .stat-card .stat-change {
            font-size: 9px;
            padding: 2px 8px;
        }

        .page-header {
            padding: 18px 16px;
        }

        .page-header .icon-orb {
            width: 46px;
            height: 46px;
            font-size: 18px;
        }

        .page-header .title-wrap h1 {
            font-size: 18px;
        }

        .page-header .title-wrap p {
            font-size: 12px;
        }

        .filter-section {
            padding: 14px;
        }

        .filter-section .filter-header h6 {
            font-size: 13px;
        }

        .table-wrapper .table-header {
            padding: 14px;
        }

        .table-wrapper table thead th {
            font-size: 8px;
            padding: 8px 8px;
            letter-spacing: 0.3px;
        }

        .table-wrapper table tbody td {
            font-size: 11px;
            padding: 8px 8px;
        }

        .user-cell .avatar {
            width: 28px;
            height: 28px;
            font-size: 10px;
        }

        .user-cell .info .name {
            font-size: 11px;
        }

        .user-cell .info .email {
            font-size: 9px;
        }

        .status-badge {
            font-size: 9px;
            padding: 3px 8px;
        }

        .durasi-badge {
            font-size: 9px;
            padding: 2px 8px;
        }

        .btn-action {
            width: 26px;
            height: 26px;
            font-size: 10px;
        }

        .empty-state .icon-wrap {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .empty-state h5 {
            font-size: 16px;
        }

        .empty-state p {
            font-size: 12px;
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
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-gradient);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-600);
    }
</style>
@endsection

@section('content')
<!-- Background Decoration -->
<div class="bg-decoration">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
</div>

<div class="container-fluid" style="position: relative; z-index: 1;">

    <!-- ============================================================
    PAGE HEADER
    ============================================================ -->
    <div class="page-header animate-in">
        <div class="header-content">
            <div class="left">
                <div class="icon-orb">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="title-wrap">
                    <h1>
                        Catatan <span class="gradient-text">Harian</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Monitoring aktivitas karyawan secara real-time
                    </p>
                </div>
            </div>
            <div class="right">
                <span class="badge-status">
                    <span class="dot"></span>
                    {{ $catatan->total() ?? 0 }} Total Data
                </span>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STATISTIK
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card total animate-in">
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-number">{{ $totalCatatan ?? 0 }}</div>
            <div class="stat-label">Total Catatan</div>
            <span class="stat-change up">
                <i class="fas fa-arrow-up"></i> Aktif
            </span>
        </div>

        <div class="stat-card hadir animate-in">
            <div class="stat-icon">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-number">{{ $totalHadir ?? 0 }}</div>
            <div class="stat-label">Hadir</div>
            <span class="stat-change up">
                <i class="fas fa-arrow-up"></i> +12%
            </span>
        </div>

        <div class="stat-card izin animate-in">
            <div class="stat-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-number">{{ $totalIzin ?? 0 }}</div>
            <div class="stat-label">Izin</div>
            <span class="stat-change down">
                <i class="fas fa-arrow-down"></i> -3%
            </span>
        </div>

        <div class="stat-card sakit animate-in">
            <div class="stat-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="stat-number">{{ $totalSakit ?? 0 }}</div>
            <div class="stat-label">Sakit</div>
            <span class="stat-change down">
                <i class="fas fa-arrow-down"></i> -5%
            </span>
        </div>

        <div class="stat-card alpha animate-in">
            <div class="stat-icon">
                <i class="fas fa-user-slash"></i>
            </div>
            <div class="stat-number">{{ $totalAlpha ?? 0 }}</div>
            <div class="stat-label">Alpha</div>
            <span class="stat-change stable">
                <i class="fas fa-minus"></i> Stabil
            </span>
        </div>
    </div>

    <!-- ============================================================
    FILTER SECTION
    ============================================================ -->
    <div class="filter-section animate-in">
        <div class="filter-header">
            <div class="filter-icon">
                <i class="fas fa-filter"></i>
            </div>
            <h6>Filter Data</h6>
        </div>

        <form method="GET" action="{{ route('admin.catatan-harian') }}" class="row g-2 align-items-end">
            <div class="col-md-2 col-6">
                <label class="form-label">
                    <i class="fas fa-user"></i> Karyawan
                </label>
                <select name="user_id" class="form-select">
                    <option value="">Semua</option>
                    @foreach($users ?? [] as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-6">
                <label class="form-label">
                    <i class="fas fa-flag"></i> Status
                </label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    @foreach($statuses ?? [] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-6">
                <label class="form-label">
                    <i class="fas fa-calendar"></i> Tanggal
                </label>
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>

            <div class="col-md-3 col-6">
                <label class="form-label">
                    <i class="fas fa-search"></i> Cari
                </label>
                <input type="text" name="search" class="form-control" 
                       placeholder="Nama atau email..." 
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3 col-12">
                <label class="form-label" style="visibility: hidden;">.</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.catatan-harian') }}" class="btn-reset">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ============================================================
    TABLE
    ============================================================ -->
    <div class="table-wrapper animate-in">
        <div class="table-header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-list"></i>
                </div>
                <div class="title">
                    <h5>Daftar Catatan Harian</h5>
                    <p>Semua catatan aktivitas karyawan</p>
                </div>
            </div>
            <span class="badge-total">
                <i class="fas fa-database"></i>
                {{ $catatan->total() ?? 0 }} Data
            </span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;"><i class="fas fa-hashtag"></i> #</th>
                        <th style="min-width: 180px;"><i class="fas fa-user"></i> Nama Lengkap</th>
                        <th style="min-width: 100px;"><i class="fas fa-calendar"></i> Tanggal</th>
                        <th style="width: 100px;"><i class="fas fa-sign-in-alt"></i> Masuk</th>
                        <th style="width: 100px;"><i class="fas fa-sign-out-alt"></i> Pulang</th>
                        <th style="width: 130px;"><i class="fas fa-clock"></i> Durasi</th>
                        <th style="min-width: 130px;"><i class="fas fa-project-diagram"></i> Proyek</th>
                        <th style="width: 100px;"><i class="fas fa-info-circle"></i> Status</th>
                        <th style="width: 100px; text-align: center;"><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($catatan ?? [] as $item)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose'];
                            $color = $colors[$loop->index % count($colors)];
                            $inisial = strtoupper(substr($item->nama_lengkap ?? $item->user->name ?? 'U', 0, 2));
                        @endphp
                        <tr class="slide-in" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                            <td>
                                <span style="font-weight: 700; color: var(--gray-500); font-size: 11px;">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                    </div>
                                    <div class="info">
                                        <span class="name">{{ $item->nama_lengkap ?? $item->user->name ?? '-' }}</span>
                                        <span class="email">
                                            <i class="fas fa-envelope" style="font-size: 9px;"></i>
                                            {{ $item->user->email ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 600; font-size: 12px; color: var(--gray-800);">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                </span>
                                <br>
                                <small style="font-size: 10px; color: var(--gray-500);">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('l') }}
                                </small>
                            </td>
                            <td>
                                @if($item->jam_masuk)
                                    <span style="font-weight: 700; color: var(--success); font-size: 12px;">
                                        <i class="fas fa-sign-in-alt" style="font-size: 10px;"></i>
                                        {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}
                                    </span>
                                @else
                                    <span style="color: var(--gray-300);">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->jam_pulang)
                                    <span style="font-weight: 700; color: var(--danger); font-size: 12px;">
                                        <i class="fas fa-sign-out-alt" style="font-size: 10px;"></i>
                                        {{ \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') }}
                                    </span>
                                @else
                                    <span style="color: var(--gray-300);">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->jam_masuk && $item->jam_pulang)
                                    @php
                                        $masuk = \Carbon\Carbon::parse($item->jam_masuk);
                                        $pulang = \Carbon\Carbon::parse($item->jam_pulang);
                                        $durasi = $pulang->diff($masuk);
                                    @endphp
                                    <span class="durasi-badge">
                                        <i class="fas fa-clock"></i>
                                        {{ $durasi->format('%h jam %i menit') }}
                                    </span>
                                @else
                                    <span style="color: var(--gray-300);">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->proyek)
                                    <span class="badge" style="background: var(--primary-50); color: var(--primary-700); padding: 4px 12px; font-size: 11px; font-weight: 600; border-radius: var(--radius-full); border: 1px solid var(--primary-200);">
                                        <i class="fas fa-project-diagram" style="font-size: 10px;"></i>
                                        {{ $item->proyek }}
                                    </span>
                                @else
                                    <span style="color: var(--gray-300);">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge status-{{ $item->status }}">
                                    <span class="dot"></span>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.catatan-harian.detail', $item->id) }}" 
                                       class="btn-action view" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.catatan-harian.delete', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
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
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="icon-wrap">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h5>Belum Ada Catatan</h5>
                                    <p>Belum ada catatan harian yang tersedia saat ini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($catatan->hasPages())
            <div class="pagination-wrap">
                {{ $catatan->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== AUTO DISMISS ALERT =====
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

        // ===== KEYBOARD SHORTCUT: Ctrl+F untuk fokus ke search =====
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                const searchInput = document.querySelector('input[name="search"]');
                if (searchInput) searchInput.focus();
            }
        });

        // ===== ANIMASI MASUK UNTUK ROW =====
        document.querySelectorAll('tbody tr.slide-in').forEach(function(row, index) {
            row.style.animationDelay = (index * 0.03) + 's';
        });
    });
</script>
@endsection
