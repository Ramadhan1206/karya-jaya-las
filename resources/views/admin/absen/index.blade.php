@extends('layouts.app')

@section('title', 'Data Absensi - Admin')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
        background: #fafbfc;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #0f172a;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #6366f1;
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
        --success-500: #10b981;
        --success-600: #059669;

        --warning: #f59e0b;
        --warning-50: #fffbeb;
        --warning-100: #fef3c7;
        --warning-500: #f59e0b;
        --warning-600: #d97706;

        --danger: #ef4444;
        --danger-50: #fef2f2;
        --danger-100: #fee2e2;
        --danger-500: #ef4444;
        --danger-600: #dc2626;

        --info: #3b82f6;
        --info-50: #eff6ff;
        --info-100: #dbeafe;

        --purple: #8b5cf6;
        --purple-50: #f5f3ff;
        --purple-100: #ede9fe;

        --pink: #ec4899;
        --pink-50: #fdf2f8;

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
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.05), 0 2px 4px rgba(0,0,0,0.03);
        --shadow-lg: 0 8px 24px rgba(0,0,0,0.06), 0 4px 8px rgba(0,0,0,0.03);
        --shadow-xl: 0 16px 40px rgba(0,0,0,0.08), 0 8px 16px rgba(0,0,0,0.04);

        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-full: 9999px;

        --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInScale {
        from { opacity: 0; transform: scale(0.96); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.15); opacity: 0.6; }
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

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .animate-in {
        opacity: 0;
        animation: fadeInUp 0.5s ease forwards;
    }

    .animate-in:nth-child(1) { animation-delay: 0.03s; }
    .animate-in:nth-child(2) { animation-delay: 0.06s; }
    .animate-in:nth-child(3) { animation-delay: 0.09s; }
    .animate-in:nth-child(4) { animation-delay: 0.12s; }
    .animate-in:nth-child(5) { animation-delay: 0.15s; }
    .animate-in:nth-child(6) { animation-delay: 0.18s; }
    .animate-in:nth-child(7) { animation-delay: 0.21s; }

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
        filter: blur(120px);
        opacity: 0.25;
    }

    .bg-decoration .orb-1 {
        width: 500px;
        height: 500px;
        background: linear-gradient(135deg, #c7d2fe, #a5b4fc);
        top: -200px;
        right: -100px;
        animation: float 14s ease-in-out infinite;
    }

    .bg-decoration .orb-2 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #ddd6fe, #c4b5fd);
        bottom: -150px;
        left: -100px;
        animation: float 12s ease-in-out infinite reverse;
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

    .page-header .title-wrap .badge-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary-50);
        color: var(--primary-700);
        padding: 5px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 8px;
        border: 1px solid var(--primary-100);
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
    }

    .page-header .right .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
        padding: 10px 20px;
        border-radius: var(--radius-md);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .page-header .right .btn-back:hover {
        background: white;
        border-color: var(--primary-200);
        color: var(--primary-700);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .page-header .right .btn-back i {
        transition: var(--transition);
    }

    .page-header .right .btn-back:hover i {
        transform: translateX(-4px);
    }

    /* ============================================================
       STAT GRID - 5 CARDS MODERN
    ============================================================ */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 24px;
        position: relative;
        z-index: 1;
    }

    .stat-card {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 20px;
        box-shadow: var(--shadow-xs);
        transition: var(--transition-smooth);
        overflow: hidden;
        cursor: default;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        transition: var(--transition);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 150%;
        height: 150%;
        border-radius: 50%;
        opacity: 0;
        transition: var(--transition);
        pointer-events: none;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--gray-300);
    }

    .stat-card:hover::after {
        opacity: 0.03;
        transform: scale(1.2);
    }

    .stat-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 12px;
        transition: var(--transition-bounce);
        position: relative;
        z-index: 1;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-4deg);
    }

    .stat-card .stat-value {
        font-size: 28px;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.5px;
        position: relative;
        z-index: 1;
        margin-bottom: 4px;
    }

    .stat-card .stat-label {
        font-size: 11px;
        color: var(--gray-500);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        position: relative;
        z-index: 1;
    }

    .stat-card .stat-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: var(--radius-full);
        margin-top: 10px;
        position: relative;
        z-index: 1;
        letter-spacing: 0.3px;
    }

    .stat-card.total::before { background: var(--primary-gradient); }
    .stat-card.total .stat-icon { background: var(--primary-50); color: var(--primary-600); }
    .stat-card.total .stat-value { color: var(--primary-600); }
    .stat-card.total .stat-badge { background: var(--primary-50); color: var(--primary-700); }
    .stat-card.total::after { background: var(--primary); }

    .stat-card.hadir::before { background: linear-gradient(90deg, #10b981, #34d399); }
    .stat-card.hadir .stat-icon { background: var(--success-50); color: var(--success); }
    .stat-card.hadir .stat-value { color: var(--success); }
    .stat-card.hadir .stat-badge { background: var(--success-50); color: #065f46; }
    .stat-card.hadir::after { background: var(--success); }

    .stat-card.izin::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .stat-card.izin .stat-icon { background: var(--warning-50); color: var(--warning); }
    .stat-card.izin .stat-value { color: var(--warning); }
    .stat-card.izin .stat-badge { background: var(--warning-50); color: #92400e; }
    .stat-card.izin::after { background: var(--warning); }

    .stat-card.sakit::before { background: linear-gradient(90deg, #ef4444, #f87171); }
    .stat-card.sakit .stat-icon { background: var(--danger-50); color: var(--danger); }
    .stat-card.sakit .stat-value { color: var(--danger); }
    .stat-card.sakit .stat-badge { background: var(--danger-50); color: #991b1b; }
    .stat-card.sakit::after { background: var(--danger); }

    .stat-card.alpha::before { background: linear-gradient(90deg, #64748b, #94a3b8); }
    .stat-card.alpha .stat-icon { background: var(--gray-100); color: var(--gray-500); }
    .stat-card.alpha .stat-value { color: var(--gray-500); }
    .stat-card.alpha .stat-badge { background: var(--gray-100); color: #334155; }
    .stat-card.alpha::after { background: var(--gray-500); }

    /* ============================================================
       FILTER CARD
    ============================================================ */
    .filter-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 22px 24px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
        transition: var(--transition-smooth);
        position: relative;
        z-index: 1;
    }

    .filter-card:hover {
        box-shadow: var(--shadow-md);
    }

    .filter-card .filter-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--gray-100);
    }

    .filter-card .filter-header .icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        background: var(--primary-50);
        color: var(--primary-600);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .filter-card .filter-header h6 {
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-800);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-card .filter-header .reset-btn {
        margin-left: auto;
        background: transparent;
        border: 1px solid var(--gray-200);
        color: var(--gray-600);
        padding: 5px 12px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .filter-card .filter-header .reset-btn:hover {
        background: var(--danger-50);
        color: var(--danger);
        border-color: #fecaca;
    }

    .filter-card .form-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-200);
        padding: 10px 14px;
        font-size: 13px;
        transition: var(--transition);
        background: var(--gray-50);
        font-weight: 500;
        color: var(--gray-800);
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        outline: none;
    }

    .filter-card .btn-apply {
        background: var(--primary-gradient);
        background-size: 200% 200%;
        border: none;
        border-radius: var(--radius-md);
        padding: 10px 24px;
        font-weight: 700;
        color: white;
        font-size: 13px;
        cursor: pointer;
        transition: var(--transition-bounce);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        justify-content: center;
        letter-spacing: 0.3px;
        position: relative;
        overflow: hidden;
    }

    .filter-card .btn-apply::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }

    .filter-card .btn-apply:hover::before {
        left: 100%;
    }

    .filter-card .btn-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
        background-position: 100% 50%;
    }

    /* ============================================================
       TABLE CARD
    ============================================================ */
    .table-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
        position: relative;
        z-index: 1;
    }

    .table-card:hover {
        box-shadow: var(--shadow-md);
    }

    .table-card .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .table-card .card-header .left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-card .card-header .left .icon-box {
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
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    .table-card .card-header .left .title h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .table-card .card-header .left .title p {
        font-size: 12px;
        color: var(--gray-500);
        margin: 0;
        font-weight: 400;
    }

    .table-card .card-header .count-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary-gradient);
        color: white;
        padding: 7px 16px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        letter-spacing: 0.3px;
    }

    .table-card .card-header .count-badge i {
        font-size: 11px;
    }

    /* ============================================================
       TABLE
    ============================================================ */
    .table-card .table-responsive {
        overflow-x: auto;
    }

    .table-card table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table-card table thead th {
        background: var(--gray-50);
        color: var(--gray-500);
        font-weight: 700;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-200);
        text-align: left;
        white-space: nowrap;
    }

    .table-card table thead th i {
        margin-right: 6px;
        opacity: 0.5;
        font-size: 10px;
    }

    .table-card table thead th.text-center {
        text-align: center;
    }

    .table-card table tbody td {
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-100);
        font-size: 13px;
        color: var(--gray-700);
        vertical-align: middle;
    }

    .table-card table tbody tr {
        transition: var(--transition);
    }

    .table-card table tbody tr:hover {
        background: var(--gray-50);
    }

    .table-card table tbody tr:last-child td {
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
        background: var(--primary-gradient);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        transition: var(--transition-bounce);
        position: relative;
    }

    .user-cell .avatar.green { background: linear-gradient(135deg, #34d399, #059669); }
    .user-cell .avatar.orange { background: linear-gradient(135deg, #fbbf24, #d97706); }
    .user-cell .avatar.blue { background: linear-gradient(135deg, #60a5fa, #2563eb); }
    .user-cell .avatar.pink { background: linear-gradient(135deg, #f472b6, #db2777); }
    .user-cell .avatar.purple { background: var(--primary-gradient); }
    .user-cell .avatar.teal { background: linear-gradient(135deg, #2dd4bf, #0d9488); }
    .user-cell .avatar.rose { background: linear-gradient(135deg, #fb7185, #e11d48); }

    .user-cell:hover .avatar {
        transform: scale(1.08) rotate(-4deg);
    }

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
       DATE CELL
    ============================================================ */
    .date-cell {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .date-cell .date-main {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 13px;
    }

    .date-cell .date-day {
        font-size: 11px;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* ============================================================
       TIME CELL
    ============================================================ */
    .time-cell {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 13px;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        transition: var(--transition);
    }

    .time-cell.in {
        color: var(--success);
        background: var(--success-50);
    }

    .time-cell.out {
        color: var(--danger);
        background: var(--danger-50);
    }

    .time-cell .time-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
        animation: pulse 2s ease-in-out infinite;
    }

    .time-cell.in .time-dot {
        background: var(--success);
        box-shadow: 0 0 6px var(--success);
    }

    .time-cell.out .time-dot {
        background: var(--danger);
        box-shadow: 0 0 6px var(--danger);
    }

    .time-cell.empty {
        color: var(--gray-400);
        font-weight: 400;
        background: transparent;
    }

    /* ============================================================
       STATUS BADGE
    ============================================================ */
    .status-badge-premium {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
        transition: var(--transition-bounce);
        cursor: default;
        white-space: nowrap;
    }

    .status-badge-premium:hover {
        transform: scale(1.05);
    }

    .status-badge-premium i {
        font-size: 10px;
    }

    .status-badge-premium.hadir {
        background: var(--success-50);
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .status-badge-premium.izin {
        background: var(--warning-50);
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .status-badge-premium.sakit {
        background: var(--danger-50);
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .status-badge-premium.alpha {
        background: var(--gray-100);
        color: #334155;
        border: 1px solid var(--gray-200);
    }

    /* ============================================================
       ACTION BUTTON
    ============================================================ */
    .btn-detail-premium {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
        padding: 7px 14px;
        border-radius: var(--radius-md);
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-detail-premium i {
        font-size: 11px;
        transition: var(--transition);
    }

    .btn-detail-premium:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        color: white;
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-detail-premium:hover i {
        transform: scale(1.15);
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 32px;
        color: var(--gray-400);
        transition: var(--transition-bounce);
    }

    .empty-state:hover .icon-circle {
        transform: scale(1.08) rotate(-6deg);
        background: var(--primary-50);
        color: var(--primary);
    }

    .empty-state h5 {
        font-size: 17px;
        font-weight: 700;
        color: var(--gray-700);
        margin-bottom: 4px;
    }

    .empty-state p {
        font-size: 13px;
        color: var(--gray-500);
        margin: 0;
    }

    /* ============================================================
       PAGINATION
    ============================================================ */
    .pagination-wrap {
        padding: 18px 24px;
        border-top: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .pagination-wrap .info {
        font-size: 12px;
        color: var(--gray-500);
        font-weight: 500;
    }

    .pagination-wrap .info strong {
        color: var(--gray-700);
        font-weight: 700;
    }

    .pagination-wrap .pagination {
        margin: 0;
        gap: 4px;
    }

    .pagination-wrap .pagination .page-link {
        border: none;
        border-radius: var(--radius-sm);
        padding: 7px 14px;
        color: var(--gray-600);
        font-size: 13px;
        font-weight: 600;
        transition: var(--transition-bounce);
        background: transparent;
    }

    .pagination-wrap .pagination .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .pagination-wrap .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .pagination-wrap .pagination .page-item.disabled .page-link {
        color: var(--gray-300);
        background: transparent;
        cursor: not-allowed;
    }

    .pagination-wrap .pagination .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .stat-grid { grid-template-columns: repeat(5, 1fr); gap: 12px; }
    }

    @media (max-width: 992px) {
        .stat-grid { grid-template-columns: repeat(3, 1fr); }
        .page-header { padding: 24px 22px; }
        .page-header .header-content { flex-direction: column; align-items: flex-start; }
        .page-header .icon-orb { width: 58px; height: 58px; font-size: 22px; }
        .page-header .title-wrap h1 { font-size: 22px; }
        .page-header .right { width: 100%; }
        .page-header .right .btn-back { width: 100%; justify-content: center; }
    }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .page-header { padding: 20px 18px; }
        .page-header .icon-orb { width: 52px; height: 52px; font-size: 20px; }
        .page-header .title-wrap h1 { font-size: 20px; }
        .stat-card { padding: 16px; }
        .stat-card .stat-value { font-size: 24px; }
        .stat-card .stat-icon { width: 38px; height: 38px; font-size: 15px; margin-bottom: 10px; }
        .filter-card { padding: 18px; }
        .table-card .card-header { padding: 16px; }
        .table-card .card-header .left .icon-box { width: 36px; height: 36px; font-size: 13px; }
        .table-card table thead th { padding: 10px 14px; font-size: 9px; }
        .table-card table tbody td { padding: 10px 14px; font-size: 12px; }
        .user-cell .avatar { width: 34px; height: 34px; font-size: 11px; }
        .user-cell .info .name { font-size: 12px; }
        .user-cell .info .email { font-size: 10px; }
        .status-badge-premium { font-size: 10px; padding: 4px 10px; }
        .btn-detail-premium { padding: 5px 10px; font-size: 11px; }
        .pagination-wrap { padding: 14px 16px; flex-direction: column; }
    }

    @media (max-width: 480px) {
        .stat-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
        .stat-card { padding: 14px 12px; }
        .stat-card .stat-value { font-size: 20px; }
        .stat-card .stat-label { font-size: 10px; }
        .stat-card .stat-icon { width: 32px; height: 32px; font-size: 13px; }
        .page-header { padding: 18px 16px; border-radius: var(--radius-lg); }
        .page-header .icon-orb { width: 46px; height: 46px; font-size: 18px; }
        .page-header .title-wrap h1 { font-size: 18px; }
        .page-header .title-wrap p { font-size: 12px; }
        .filter-card { padding: 14px; }
        .table-card .card-header { padding: 14px; }
        .table-card .card-header .left .title h5 { font-size: 13px; }
        .table-card table thead th { padding: 8px 10px; font-size: 8px; }
        .table-card table tbody td { padding: 8px 10px; font-size: 11px; }
        .user-cell { gap: 8px; }
        .user-cell .avatar { width: 30px; height: 30px; font-size: 10px; }
        .user-cell .info .name { font-size: 11px; }
        .user-cell .info .email { display: none; }
        .status-badge-premium { font-size: 9px; padding: 3px 8px; }
        .btn-detail-premium { padding: 4px 8px; font-size: 10px; }
        .btn-detail-premium span { display: none; }
        .pagination-wrap .pagination .page-link { padding: 5px 10px; font-size: 11px; }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #c7d2fe, #a5b4fc);
        border-radius: 10px;
        border: 2px solid var(--gray-100);
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #a5b4fc, #818cf8);
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
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="title-wrap">
                    <span class="badge-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </span>
                    <h1>
                        Data <span class="gradient-text">Absensi</span>
                    </h1>
                    <p>
                        <i class="fas fa-users"></i>
                        Kelola data absensi semua karyawan
                    </p>
                </div>
            </div>
            <div class="right">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STAT CARDS
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card total animate-in">
            <div class="stat-icon"><i class="fas fa-database"></i></div>
            <div class="stat-value" data-target="{{ $totalSemua ?? 0 }}">{{ $totalSemua ?? 0 }}</div>
            <div class="stat-label">Total Semua</div>
            <span class="stat-badge"><i class="fas fa-chart-line"></i> Keseluruhan</span>
        </div>
        <div class="stat-card hadir animate-in">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-value" data-target="{{ $totalHadir ?? 0 }}">{{ $totalHadir ?? 0 }}</div>
            <div class="stat-label">Hadir</div>
            <span class="stat-badge"><i class="fas fa-arrow-up"></i> Aktif</span>
        </div>
        <div class="stat-card izin animate-in">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-value" data-target="{{ $totalIzin ?? 0 }}">{{ $totalIzin ?? 0 }}</div>
            <div class="stat-label">Izin</div>
            <span class="stat-badge"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card sakit animate-in">
            <div class="stat-icon"><i class="fas fa-notes-medical"></i></div>
            <div class="stat-value" data-target="{{ $totalSakit ?? 0 }}">{{ $totalSakit ?? 0 }}</div>
            <div class="stat-label">Sakit</div>
            <span class="stat-badge"><i class="fas fa-arrow-down"></i> Menurun</span>
        </div>
        <div class="stat-card alpha animate-in">
            <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
            <div class="stat-value" data-target="{{ $totalAlpha ?? 0 }}">{{ $totalAlpha ?? 0 }}</div>
            <div class="stat-label">Alpha</div>
            <span class="stat-badge"><i class="fas fa-circle"></i> Terpantau</span>
        </div>
    </div>

    <!-- ============================================================
    FILTER
    ============================================================ -->
    <div class="filter-card animate-in">
        <div class="filter-header">
            <div class="icon"><i class="fas fa-filter"></i></div>
            <h6>Filter Data Absensi</h6>
            @if(request()->hasAny(['user_id', 'status', 'tanggal']))
                <a href="{{ route('admin.absen') }}" class="reset-btn">
                    <i class="fas fa-times"></i> Reset Filter
                </a>
            @endif
        </div>
        <form method="GET" action="{{ route('admin.absen') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Karyawan</label>
                <select name="user_id" class="form-select">
                    <option value="">Semua Karyawan</option>
                    @foreach($users ?? [] as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach($statuses ?? [] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn-apply">
                    <i class="fas fa-search"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- ============================================================
    TABLE
    ============================================================ -->
    <div class="table-card animate-in">
        <div class="card-header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="title">
                    <h5>Daftar Absensi Karyawan</h5>
                    <p>Semua data absensi karyawan</p>
                </div>
            </div>
            <span class="count-badge">
                <i class="fas fa-file-alt"></i>
                {{ $absensi->total() ?? 0 }} Data
            </span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-user"></i> Nama Karyawan</th>
                        <th><i class="fas fa-calendar"></i> Tanggal</th>
                        <th><i class="fas fa-sign-in-alt"></i> Jam Masuk</th>
                        <th><i class="fas fa-sign-out-alt"></i> Jam Pulang</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th class="text-center"><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi ?? [] as $item)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose'];
                            $color = $colors[$loop->index % count($colors)];
                            $inisial = strtoupper(substr($item->nama_lengkap ?? $item->user->name ?? 'U', 0, 2));

                            $statusIcon = [
                                'hadir' => 'fa-check-circle',
                                'izin' => 'fa-clock',
                                'sakit' => 'fa-notes-medical',
                                'alpha' => 'fa-times-circle'
                            ][$item->status] ?? 'fa-circle';
                        @endphp
                        <tr class="animate-in" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                            <td>
                                <div class="user-cell">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                    </div>
                                    <div class="info">
                                        <span class="name">{{ $item->nama_lengkap ?? $item->user->name ?? 'User' }}</span>
                                        <span class="email">{{ $item->user->email ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date-cell">
                                    <span class="date-main">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                    <span class="date-day">{{ \Carbon\Carbon::parse($item->tanggal)->format('l') }}</span>
                                </div>
                            </td>
                            <td>
                                @if($item->jam_masuk)
                                    <span class="time-cell in">
                                        <span class="time-dot"></span>
                                        {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}
                                    </span>
                                @else
                                    <span class="time-cell empty">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->jam_pulang)
                                    <span class="time-cell out">
                                        <span class="time-dot"></span>
                                        {{ \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') }}
                                    </span>
                                @else
                                    <span class="time-cell empty">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge-premium {{ $item->status }}">
                                    <i class="fas {{ $statusIcon }}"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.absen.detail', $item->id) }}" class="btn-detail-premium">
                                    <i class="fas fa-eye"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="icon-circle">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h5>Belum Ada Data Absensi</h5>
                                    <p>Belum ada data absensi yang tersedia saat ini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ===== PAGINATION ===== -->
        @if(($absensi ?? null) && $absensi->hasPages())
            <div class="pagination-wrap">
                <div class="info">
                    Menampilkan <strong>{{ $absensi->firstItem() ?? 0 }}</strong> -
                    <strong>{{ $absensi->lastItem() ?? 0 }}</strong> dari
                    <strong>{{ $absensi->total() }}</strong> data
                </div>
                <div>
                    {{ $absensi->appends(request()->query())->links() }}
                </div>
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
                const close = alert.querySelector('.btn-close');
                if (close) close.click();
            }, 5000);
        });

        // ===== KEYBOARD SHORTCUT: Ctrl+K =====
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const filter = document.querySelector('.filter-card select');
                if (filter) filter.focus();
            }
        });

        // ===== ANIMASI COUNTER (FIXED) =====
        // Sebelumnya pakai pendekatan "current += increment" per-frame,
        // yang bisa MACET di angka kecil (termasuk 0) kalau tab browser
        // sempat tidak fokus, karena requestAnimationFrame di-throttle
        // oleh browser saat tab di background.
        //
        // Sekarang pakai pendekatan berbasis WAKTU ASLI (performance.now()),
        // jadi progress animasi selalu dihitung ulang dari selisih waktu,
        // bukan dari jumlah frame yang sudah berjalan. Hasil akhir juga
        // dipaksa (force) sama dengan nilai asli dari server (data-target),
        // jadi angka final DIJAMIN benar walau animasi ter-skip sekalipun.
        document.querySelectorAll('.stat-card .stat-value').forEach(function (counter) {
            const target = parseInt(counter.getAttribute('data-target'), 10) || 0;

            if (target <= 0) {
                counter.textContent = '0';
                return;
            }

            const duration = 1000; // ms
            let startTime = null;

            function step(timestamp) {
                if (startTime === null) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                const current = Math.floor(progress * target);
                counter.textContent = current.toLocaleString('id-ID');

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    // Pastikan nilai akhir selalu sama dengan data asli
                    counter.textContent = target.toLocaleString('id-ID');
                }
            }

            requestAnimationFrame(step);
        });

        // ===== HOVER EFFECT UNTUK STAT CARD =====
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)';
            });
        });
    });
</script>
@endsection
