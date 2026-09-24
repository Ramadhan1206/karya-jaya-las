@extends('layouts.app')

@section('title', 'Manajemen Karyawan - Admin')

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

    body {
        background: #f0f2f8;
        min-height: 100vh;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #4f46e5;
        --primary-light: #818cf8;
        --primary-dark: #3730a3;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --primary-soft: linear-gradient(135deg, #eef2ff 0%, #ede9fe 100%);
        
        --success: #10b981;
        --success-bg: #ecfdf5;
        --warning: #f59e0b;
        --warning-bg: #fffbeb;
        --danger: #ef4444;
        --danger-bg: #fef2f2;
        --info: #3b82f6;
        --info-bg: #eff6ff;
        --gray: #6b7280;
        --gray-light: #f1f5f9;
        
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 8px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 16px 48px rgba(0,0,0,0.08);
        
        --radius: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
        --radius-sm: 8px;
    }

    /* ============================================================
       HERO - ELEGAN PREMIUM
    ============================================================ */
    .hero-karyawan {
        background: var(--primary-gradient);
        border-radius: var(--radius-xl);
        padding: 36px 40px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(79, 70, 229, 0.25);
    }

    .hero-karyawan::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
        animation: floatHero 10s ease-in-out infinite alternate;
    }

    .hero-karyawan::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        animation: floatHero 8s ease-in-out infinite alternate-reverse;
    }

    @keyframes floatHero {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, -20px) scale(1.05); }
    }

    .hero-karyawan .content {
        position: relative;
        z-index: 1;
    }

    .hero-karyawan .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-karyawan .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        padding: 4px 16px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 6px;
    }

    .hero-karyawan .badge i {
        color: #a5b4fc;
    }

    .hero-karyawan h1 {
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 2px;
    }

    .hero-karyawan h1 .highlight {
        background: linear-gradient(90deg, #fcd34d, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-karyawan .subtitle {
        font-size: 14px;
        opacity: 0.5;
        font-weight: 400;
    }

    .hero-karyawan .subtitle i {
        margin-right: 6px;
    }

    .hero-karyawan .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 10px 28px;
        border-radius: var(--radius);
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .hero-karyawan .btn-add:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        color: white;
    }

    .hero-karyawan .btn-add i {
        font-size: 16px;
    }

    .hero-karyawan .mini-stats {
        display: flex;
        gap: 16px;
        margin-top: 14px;
        flex-wrap: wrap;
    }

    .hero-karyawan .mini-stats .item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        opacity: 0.5;
        background: rgba(255,255,255,0.04);
        padding: 3px 14px;
        border-radius: var(--radius-full);
        border: 1px solid rgba(255,255,255,0.03);
    }

    .hero-karyawan .mini-stats .item .num {
        font-weight: 700;
        opacity: 1;
        font-size: 14px;
    }

    /* ============================================================
       STATISTIK - CLEAN
    ============================================================ */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px 18px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: all 0.3s ease;
        cursor: default;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 0 0 4px 4px;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: transparent;
    }

    .stat-card .icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .stat-card:hover .icon {
        transform: scale(1.05) rotate(-3deg);
    }

    .stat-card .number {
        font-size: 26px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.3px;
        color: #0f172a;
    }

    .stat-card .label {
        font-size: 12px;
        color: var(--gray);
        font-weight: 500;
        margin-top: 2px;
    }

    .stat-card .trend {
        font-size: 10px;
        font-weight: 600;
        padding: 2px 12px;
        border-radius: var(--radius-full);
        display: inline-block;
        margin-top: 4px;
    }

    .stat-card .trend.up { background: var(--success-bg); color: var(--success); }
    .stat-card .trend.down { background: var(--danger-bg); color: var(--danger); }
    .stat-card .trend.stable { background: var(--gray-light); color: var(--gray); }

    .stat-card.total::after { background: var(--primary-gradient); }
    .stat-card.total .icon { background: #eef2ff; color: var(--primary); }
    .stat-card.total .number { color: var(--primary); }

    .stat-card.admin::after { background: #f5576c; }
    .stat-card.admin .icon { background: #fef2f2; color: #f5576c; }
    .stat-card.admin .number { color: #f5576c; }

    .stat-card.user::after { background: var(--success); }
    .stat-card.user .icon { background: var(--success-bg); color: var(--success); }
    .stat-card.user .number { color: var(--success); }

    .stat-card.new::after { background: var(--warning); }
    .stat-card.new .icon { background: var(--warning-bg); color: var(--warning); }
    .stat-card.new .number { color: var(--warning); }

    /* ============================================================
       FILTER - CLEAN
    ============================================================ */
    .filter-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px 24px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        margin-bottom: 28px;
        transition: all 0.3s ease;
    }

    .filter-card:hover {
        box-shadow: var(--shadow-md);
    }

    .filter-card .filter-header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .filter-card .filter-header i {
        color: var(--primary);
    }

    .filter-card .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 4px;
    }

    .filter-card .form-label i {
        font-size: 11px;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border-radius: var(--radius);
        border: 1.5px solid #e8ecf1;
        padding: 8px 14px;
        font-size: 13px;
        transition: all 0.3s ease;
        background: #fafbfc;
        height: 42px;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.06);
        background: white;
    }

    .filter-card .form-control::placeholder {
        font-size: 13px;
        color: #94a3b8;
    }

    .btn-filter {
        background: var(--primary-gradient);
        border: none;
        border-radius: var(--radius);
        padding: 8px 24px;
        font-weight: 600;
        color: white;
        font-size: 13px;
        transition: all 0.3s ease;
        height: 42px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        justify-content: center;
        cursor: pointer;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.25);
        color: white;
    }

    .btn-reset {
        background: var(--gray-light);
        border: none;
        border-radius: var(--radius);
        padding: 8px 24px;
        font-weight: 500;
        color: #475569;
        font-size: 13px;
        transition: all 0.3s ease;
        height: 42px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-reset:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: translateY(-2px);
    }

    /* ============================================================
       TABLE - CLEAN PREMIUM
    ============================================================ */
    .table-card {
        background: white;
        border-radius: var(--radius-xl);
        padding: 24px 24px 18px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }

    .table-card:hover {
        box-shadow: var(--shadow-md);
    }

    .table-card .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-card .header .left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-card .header .left .icon-box {
        width: 44px;
        height: 44px;
        border-radius: var(--radius);
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        flex-shrink: 0;
    }

    .table-card .header .left .title h5 {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0;
        font-size: 16px;
    }

    .table-card .header .left .title small {
        color: var(--gray);
        font-size: 12px;
        font-weight: 400;
        display: block;
    }

    .table-card .header .count-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 5px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .table-card .table-wrap {
        overflow-x: auto;
    }

    .table-card table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-card table thead th {
        background: var(--gray-light);
        color: var(--gray);
        font-weight: 600;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 10px 14px;
        border-bottom: 1.5px solid #e8ecf1;
        text-align: left;
        white-space: nowrap;
    }

    .table-card table thead th i {
        margin-right: 6px;
        opacity: 0.4;
    }

    .table-card table thead th:last-child {
        text-align: center;
    }

    .table-card table tbody td {
        padding: 10px 14px;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-light);
        font-size: 13px;
        color: #334155;
    }

    .table-card table tbody tr {
        transition: all 0.2s ease;
    }

    .table-card table tbody tr:hover {
        background: #f8fafc;
    }

    .table-card table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ============================================================
       AVATAR
    ============================================================ */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-cell .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
        background: var(--primary-gradient);
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.15);
        transition: all 0.3s ease;
        position: relative;
    }

    .user-cell .avatar:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(79, 70, 229, 0.25);
    }

    .user-cell .avatar .dot {
        position: absolute;
        bottom: -1px;
        right: -1px;
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

    .user-cell .info .name {
        font-weight: 600;
        color: #0f172a;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .user-cell .info .name .badge-me {
        background: var(--info-bg);
        color: var(--info);
        font-size: 8px;
        padding: 1px 10px;
        border-radius: var(--radius-full);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .user-cell .info .email {
        font-size: 11px;
        color: var(--gray);
        font-weight: 400;
        display: block;
        margin-top: 1px;
    }

    /* ============================================================
       BADGES
    ============================================================ */
    .badge-phone {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #eef2ff;
        color: var(--primary);
        padding: 2px 12px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 500;
    }

    .badge-phone i {
        font-size: 10px;
    }

    .badge-position {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--warning-bg);
        color: var(--warning);
        padding: 2px 12px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 500;
    }

    .badge-position i {
        font-size: 10px;
    }

    .badge-role {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 12px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
    }

    .badge-role.admin {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .badge-role.user {
        background: var(--info-bg);
        color: var(--info);
    }

    .badge-role i {
        font-size: 10px;
    }

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 12px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
    }

    .badge-status.aktif {
        background: var(--success-bg);
        color: var(--success);
    }

    .badge-status .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        background: currentColor;
        animation: pulseDot 2s ease-in-out infinite;
    }

    @keyframes pulseDot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
    }

    /* ============================================================
       ACTION BUTTONS
    ============================================================ */
    .action-compact {
        display: flex;
        gap: 4px;
        justify-content: center;
        align-items: center;
    }

    .btn-action {
        width: 30px;
        height: 30px;
        border-radius: var(--radius-sm);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 12px;
        flex-shrink: 0;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: scale(1.1) translateY(-2px);
    }

    .btn-action.edit {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .btn-action.edit:hover {
        background: var(--warning);
        color: white;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }

    .btn-action.delete {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .btn-action.delete:hover {
        background: var(--danger);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .btn-action.lock {
        background: var(--gray-light);
        color: #cbd5e1;
        cursor: not-allowed;
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
    }

    .empty-state .icon-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--gray-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        font-size: 30px;
        color: #cbd5e1;
        transition: all 0.3s ease;
    }

    .empty-state:hover .icon-circle {
        transform: scale(1.05) rotate(-4deg);
        background: #e8ecf1;
    }

    .empty-state h5 {
        color: #475569;
        font-weight: 700;
        font-size: 17px;
        margin-bottom: 2px;
    }

    .empty-state p {
        color: var(--gray);
        font-size: 13px;
        font-weight: 400;
    }

    .empty-state .btn-empty {
        background: var(--primary-gradient);
        border: none;
        border-radius: var(--radius);
        padding: 10px 28px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        margin-top: 12px;
    }

    .empty-state .btn-empty:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.25);
        color: white;
    }

    /* ============================================================
       PAGINATION - FIXED & COMPACT
    ============================================================ */
    .pagination-wrap {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .pagination-wrap nav {
        display: inline-block;
    }

    .pagination-wrap .pagination {
        margin: 0;
        gap: 4px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        padding: 0;
        list-style: none;
    }

    .pagination-wrap .page-item {
        margin: 0;
    }

    .pagination-wrap .page-link {
        border: none !important;
        border-radius: var(--radius-sm) !important;
        margin: 0 !important;
        padding: 0 !important;
        color: var(--gray) !important;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 12px;
        line-height: 1;
        background: transparent !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        width: auto !important;
        box-shadow: none !important;
        text-decoration: none;
    }

    .pagination-wrap .page-link:hover {
        background: var(--primary-gradient) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
    }

    .pagination-wrap .page-item.active .page-link {
        background: var(--primary-gradient) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
    }

    .pagination-wrap .page-item.disabled .page-link {
        color: #cbd5e1 !important;
        background: transparent !important;
        cursor: not-allowed;
    }

    /* === FIX ICON SVG NEXT/PREVIOUS AGAR TIDAK BESAR === */
    .pagination-wrap .page-link svg {
        width: 12px !important;
        height: 12px !important;
        max-width: 12px !important;
        max-height: 12px !important;
        display: block !important;
        flex-shrink: 0 !important;
    }

    .pagination-wrap .page-link i {
        font-size: 11px !important;
        line-height: 1 !important;
    }

    /* Sembunyikan teks "Previous"/"Next" yang panjang, ganti dengan icon saja */
    .pagination-wrap .page-link span {
        display: inline-block;
        line-height: 1;
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
            transform: translateY(20px);
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

    .slide-in {
        opacity: 0;
        animation: slideIn 0.5s ease forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-16px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .slide-in:nth-child(1) { animation-delay: 0.03s; }
    .slide-in:nth-child(2) { animation-delay: 0.06s; }
    .slide-in:nth-child(3) { animation-delay: 0.09s; }
    .slide-in:nth-child(4) { animation-delay: 0.12s; }
    .slide-in:nth-child(5) { animation-delay: 0.15s; }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .stat-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        .hero-karyawan h1 {
            font-size: 26px;
        }
    }

    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .hero-karyawan {
            padding: 28px 24px;
        }
        .hero-karyawan .top {
            flex-direction: column;
            align-items: flex-start;
        }
        .hero-karyawan .btn-add {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .hero-karyawan {
            padding: 20px 18px;
            border-radius: var(--radius-lg);
        }

        .hero-karyawan h1 {
            font-size: 20px;
        }

        .hero-karyawan .mini-stats {
            gap: 8px;
        }

        .hero-karyawan .mini-stats .item {
            font-size: 11px;
            padding: 2px 10px;
        }

        .hero-karyawan .btn-add {
            padding: 8px 18px;
            font-size: 13px;
        }

        .filter-card {
            padding: 16px 18px;
        }

        .table-card {
            padding: 14px;
            border-radius: var(--radius-lg);
        }

        .table-card .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .table-card .header .left .icon-box {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .table-card .header .left .title h5 {
            font-size: 14px;
        }

        .table-card .header .count-badge {
            padding: 4px 14px;
            font-size: 11px;
        }

        .user-cell .avatar {
            width: 30px;
            height: 30px;
            font-size: 11px;
        }

        .user-cell .info .name {
            font-size: 12px;
        }

        .user-cell .info .email {
            font-size: 10px;
        }

        .badge-phone,
        .badge-position,
        .badge-role,
        .badge-status {
            font-size: 10px;
            padding: 2px 8px;
        }

        .btn-action {
            width: 26px;
            height: 26px;
            font-size: 10px;
        }

        .table-card table thead th {
            font-size: 9px;
            padding: 8px 10px;
        }

        .table-card table tbody td {
            font-size: 12px;
            padding: 8px 10px;
        }

        .stat-card {
            padding: 14px 12px;
        }

        .stat-card .number {
            font-size: 20px;
        }

        .stat-card .icon {
            width: 36px;
            height: 36px;
            font-size: 15px;
            margin-bottom: 6px;
        }

        .stat-card .label {
            font-size: 11px;
        }

        .empty-state .icon-circle {
            width: 56px;
            height: 56px;
            font-size: 22px;
        }

        .empty-state h5 {
            font-size: 15px;
        }

        .empty-state p {
            font-size: 12px;
        }

        .empty-state .btn-empty {
            padding: 8px 20px;
            font-size: 12px;
        }

        /* Pagination Responsive */
        .pagination-wrap .page-link {
            min-width: 28px !important;
            height: 28px !important;
            font-size: 11px;
        }

        .pagination-wrap .page-link svg {
            width: 10px !important;
            height: 10px !important;
            max-width: 10px !important;
            max-height: 10px !important;
        }

        .pagination-wrap .page-link i {
            font-size: 10px !important;
        }
    }

    @media (max-width: 480px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .stat-card {
            padding: 12px 10px;
        }

        .stat-card .number {
            font-size: 17px;
        }

        .stat-card .icon {
            width: 30px;
            height: 30px;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .stat-card .label {
            font-size: 10px;
        }

        .stat-card .trend {
            font-size: 8px;
            padding: 1px 6px;
        }

        .hero-karyawan h1 {
            font-size: 17px;
        }

        .hero-karyawan .subtitle {
            font-size: 12px;
        }

        .hero-karyawan .badge {
            font-size: 10px;
            padding: 3px 12px;
        }

        .hero-karyawan .btn-add {
            padding: 6px 14px;
            font-size: 12px;
        }

        .hero-karyawan .mini-stats .item {
            font-size: 10px;
            padding: 2px 8px;
        }

        .hero-karyawan .mini-stats .item .num {
            font-size: 12px;
        }

        .filter-card {
            padding: 12px 14px;
        }

        .table-card {
            padding: 10px;
        }

        .table-card table thead th {
            font-size: 8px;
            padding: 6px 6px;
            letter-spacing: 0.2px;
        }

        .table-card table tbody td {
            font-size: 11px;
            padding: 6px 6px;
        }

        .user-cell .avatar {
            width: 26px;
            height: 26px;
            font-size: 10px;
        }

        .user-cell .info .name {
            font-size: 11px;
        }

        .user-cell .info .email {
            font-size: 9px;
        }

        .badge-phone,
        .badge-position,
        .badge-role,
        .badge-status {
            font-size: 9px;
            padding: 2px 6px;
        }

        .btn-action {
            width: 22px;
            height: 22px;
            font-size: 9px;
            border-radius: 6px;
        }

        .action-compact {
            gap: 2px;
        }

        /* Pagination Mobile */
        .pagination-wrap .page-link {
            min-width: 26px !important;
            height: 26px !important;
            font-size: 10px;
            padding: 0 !important;
        }

        .pagination-wrap .page-link svg {
            width: 9px !important;
            height: 9px !important;
            max-width: 9px !important;
            max-height: 9px !important;
        }

        .pagination-wrap .page-link i {
            font-size: 9px !important;
        }

        .empty-state .icon-circle {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }

        .empty-state h5 {
            font-size: 14px;
        }

        .empty-state p {
            font-size: 11px;
        }

        .empty-state .btn-empty {
            padding: 6px 16px;
            font-size: 11px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-light);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-gradient);
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- ============================================================
    HERO - ELEGAN
    ============================================================ -->
    <div class="hero-karyawan fade-up">
        <div class="content">
            <div class="top">
                <div>
                    <div class="badge">
                        <i class="fas fa-shield-alt"></i>
                        Panel Admin
                    </div>
                    <h1>
                        <i class="fas fa-users me-2" style="color: #fcd34d;"></i>
                        Manajemen <span class="highlight">Karyawan</span>
                    </h1>
                    <p class="subtitle">
                        <i class="fas fa-address-card"></i>
                        Kelola data karyawan Karya Jaya Las Konstruksi
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.karyawan.create') }}" class="btn-add" id="btnAdd">
                        <i class="fas fa-user-plus"></i>
                        Tambah Karyawan
                    </a>
                </div>
            </div>

            <div class="mini-stats">
                <div class="item">
                    <span class="num">{{ $karyawan->total() ?? 0 }}</span>
                    <span>Total Karyawan</span>
                </div>
                <div class="item">
                    <span class="num">{{ $karyawan->where('role', 'admin')->count() ?? 0 }}</span>
                    <span>Admin</span>
                </div>
                <div class="item">
                    <span class="num">{{ $karyawan->where('role', 'user')->count() ?? 0 }}</span>
                    <span>User</span>
                </div>
                <div class="item">
                    <span class="num">{{ \App\Models\User::whereMonth('created_at', date('m'))->count() ?? 0 }}</span>
                    <span>Baru Bulan Ini</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    ALERT
    ============================================================ -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-up" 
             style="border-radius: var(--radius); border-left: 4px solid var(--success); background: var(--success-bg); padding: 14px 20px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="color: var(--success); font-size: 18px;"></i>
                <span style="font-weight: 500; color: var(--success);">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 12px;"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show fade-up" 
             style="border-radius: var(--radius); border-left: 4px solid var(--danger); background: var(--danger-bg); padding: 14px 20px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2" style="color: var(--danger); font-size: 18px;"></i>
                <span style="font-weight: 500; color: var(--danger);">{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 12px;"></button>
        </div>
    @endif

    <!-- ============================================================
    STATISTIK - CLEAN
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card total fade-up">
            <div class="icon"><i class="fas fa-users"></i></div>
            <div class="number">{{ $karyawan->total() ?? 0 }}</div>
            <div class="label">Total Karyawan</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> Aktif</span>
        </div>
        <div class="stat-card admin fade-up">
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <div class="number">{{ $karyawan->where('role', 'admin')->count() ?? 0 }}</div>
            <div class="label">Admin</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card user fade-up">
            <div class="icon"><i class="fas fa-user"></i></div>
            <div class="number">{{ $karyawan->where('role', 'user')->count() ?? 0 }}</div>
            <div class="label">User</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card new fade-up">
            <div class="icon"><i class="fas fa-calendar-plus"></i></div>
            <div class="number">{{ \App\Models\User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() ?? 0 }}</div>
            <div class="label">Baru Bulan Ini</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> +{{ \App\Models\User::whereMonth('created_at', date('m'))->count() }}</span>
        </div>
    </div>

    <!-- ============================================================
    FILTER - CLEAN
    ============================================================ -->
    <div class="filter-card fade-up">
        <div class="filter-header">
            <i class="fas fa-sliders-h"></i>
            Filter Pencarian
        </div>
        <form method="GET" action="{{ route('admin.karyawan.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label"><i class="fas fa-search"></i> Cari Karyawan</label>
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Nama atau email..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label"><i class="fas fa-filter"></i> Role</label>
                <select name="role" class="form-select">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label"><i class="fas fa-tag"></i> Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.karyawan.index') }}" class="btn-reset" title="Reset">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ============================================================
    TABLE - CLEAN PREMIUM
    ============================================================ -->
    <div class="table-card fade-up">
        <div class="header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-list"></i>
                </div>
                <div class="title">
                    <h5>Daftar Karyawan</h5>
                    <small><i class="fas fa-users"></i> Semua data karyawan</small>
                </div>
            </div>
            <span class="count-badge">
                <i class="fas fa-database"></i>
                {{ $karyawan->total() }} Data
            </span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th style="min-width: 180px;"><i class="fas fa-user"></i> Nama</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-phone"></i> Telepon</th>
                        <th><i class="fas fa-briefcase"></i> Jabatan</th>
                        <th><i class="fas fa-shield-alt"></i> Role</th>
                        <th><i class="fas fa-circle"></i> Status</th>
                        <th style="text-align: center; min-width: 90px;"><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawan as $item)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose', 'indigo'];
                            $color = $colors[$loop->index % count($colors)];
                            $inisial = strtoupper(substr($item->name, 0, 2));
                        @endphp
                        <tr class="slide-in" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                            <td>
                                <span style="font-weight: 600; color: var(--gray); font-size: 12px;">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                        <span class="dot"></span>
                                    </div>
                                    <div class="info">
                                        <span class="name">
                                            {{ $item->name }}
                                            @if($item->id == auth()->id())
                                                <span class="badge-me">Anda</span>
                                            @endif
                                        </span>
                                        <span class="email">{{ $item->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 12px; color: var(--gray);">
                                    {{ $item->email }}
                                </span>
                            </td>
                            <td>
                                @if($item->phone)
                                    <span class="badge-phone">
                                        <i class="fas fa-phone"></i>
                                        {{ $item->phone }}
                                    </span>
                                @else
                                    <span style="color: var(--gray); font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->position)
                                    <span class="badge-position">
                                        <i class="fas fa-briefcase"></i>
                                        {{ $item->position }}
                                    </span>
                                @else
                                    <span style="color: var(--gray); font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-role {{ $item->role }}">
                                    <i class="fas {{ $item->role === 'admin' ? 'fa-shield-alt' : 'fa-user' }}"></i>
                                    {{ ucfirst($item->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-status aktif">
                                    <span class="dot"></span>
                                    Aktif
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="action-compact">
                                    <a href="{{ route('admin.karyawan.edit', $item->id) }}" 
                                       class="btn-action edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($item->id != auth()->id())
                                        <form action="{{ route('admin.karyawan.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus karyawan {{ $item->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn-action lock" disabled title="Tidak bisa hapus sendiri">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="icon-circle">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h5>Belum Ada Karyawan</h5>
                                    <p>Klik tombol "Tambah Karyawan" untuk menambahkan</p>
                                    <a href="{{ route('admin.karyawan.create') }}" class="btn-empty">
                                        <i class="fas fa-plus"></i> Tambah Karyawan
                                    </a>
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
                {{ $karyawan->firstItem() ?? 0 }} - {{ $karyawan->lastItem() ?? 0 }} dari {{ $karyawan->total() ?? 0 }}
            </div>
            <div class="pagination-wrap">
                {{ $karyawan->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Keyboard Shortcut: Ctrl+N ---
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                const btn = document.getElementById('btnAdd');
                if (btn) btn.click();
            }
        });

        // --- Auto-close Alert ---
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                const close = alert.querySelector('.btn-close');
                if (close) close.click();
            }, 5000);
        });
    });
</script>
@endsection