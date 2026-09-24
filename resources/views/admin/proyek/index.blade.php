@extends('layouts.app')

@section('title', 'Manajemen Proyek - Karya Jaya Las Konstruksi')

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
        --primary-gradient-soft: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        
        --success: #10b981;
        --success-bg: #ecfdf5;
        --warning: #f59e0b;
        --warning-bg: #fffbeb;
        --danger: #ef4444;
        --danger-bg: #fef2f2;
        --info: #3b82f6;
        --info-bg: #eff6ff;
        --purple: #8b5cf6;
        --purple-bg: #f5f3ff;
        --pink: #ec4899;
        --pink-bg: #fdf2f8;
        
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
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 8px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 16px 48px rgba(0,0,0,0.08);
        
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
    }

    /* ============================================================
       HERO HEADER - ELEGAN
    ============================================================ */
    .hero-proyek {
        background: var(--primary-gradient-soft);
        border-radius: var(--radius-xl);
        padding: 36px 40px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(79, 70, 229, 0.25);
    }

    .hero-proyek::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        animation: floatHero 10s ease-in-out infinite alternate;
    }

    .hero-proyek::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 350px;
        height: 350px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        animation: floatHero 8s ease-in-out infinite alternate-reverse;
    }

    @keyframes floatHero {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, -20px) scale(1.05); }
    }

    .hero-proyek .content {
        position: relative;
        z-index: 1;
    }

    .hero-proyek .top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-proyek .badge-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.10);
        padding: 4px 16px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 6px;
    }

    .hero-proyek .badge-date i {
        color: #c7d2fe;
    }

    .hero-proyek .greeting {
        font-size: 14px;
        opacity: 0.75;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2px;
    }

    .hero-proyek .greeting .wave {
        font-size: 20px;
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

    .hero-proyek h1 {
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 2px;
    }

    .hero-proyek h1 .highlight {
        background: linear-gradient(90deg, #fcd34d, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-proyek .subtitle {
        font-size: 14px;
        opacity: 0.55;
        font-weight: 400;
    }

    .hero-proyek .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.10);
        padding: 10px 28px;
        border-radius: var(--radius-md);
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .hero-proyek .btn-add:hover {
        background: rgba(255,255,255,0.18);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.10);
        color: white;
    }

    .hero-proyek .btn-add i {
        font-size: 16px;
    }

    .hero-proyek .mini-stats {
        display: flex;
        gap: 16px;
        margin-top: 14px;
        flex-wrap: wrap;
    }

    .hero-proyek .mini-stats .item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        opacity: 0.6;
        background: rgba(255,255,255,0.05);
        padding: 3px 14px;
        border-radius: var(--radius-full);
        border: 1px solid rgba(255,255,255,0.03);
    }

    .hero-proyek .mini-stats .item .num {
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

    .stat-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card .icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
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

    .stat-card .icon.primary { background: var(--primary-bg, #eef2ff); color: var(--primary); }
    .stat-card .icon.success { background: var(--success-bg); color: var(--success); }
    .stat-card .icon.warning { background: var(--warning-bg); color: var(--warning); }
    .stat-card .icon.info { background: var(--info-bg); color: var(--info); }

    .stat-card .number {
        font-size: 26px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.3px;
        color: var(--gray-900);
    }

    .stat-card .number.primary { color: var(--primary); }
    .stat-card .number.success { color: var(--success); }
    .stat-card .number.warning { color: var(--warning); }
    .stat-card .number.info { color: var(--info); }

    .stat-card .label {
        font-size: 12px;
        color: var(--gray-400);
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
    .stat-card .trend.stable { background: var(--gray-100); color: var(--gray-500); }

    /* ============================================================
       TABLE - CLEAN
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
        border-radius: var(--radius-md);
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
        color: var(--gray-900);
        margin-bottom: 0;
        font-size: 16px;
    }

    .table-card .header .left .title small {
        color: var(--gray-400);
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
        background: var(--gray-50);
        color: var(--gray-500);
        font-weight: 600;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 10px 14px;
        border-bottom: 1.5px solid var(--gray-200);
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
        border-bottom: 1px solid var(--gray-100);
        font-size: 13px;
        color: var(--gray-700);
    }

    .table-card table tbody tr {
        transition: all 0.2s ease;
    }

    .table-card table tbody tr:hover {
        background: var(--gray-50);
    }

    .table-card table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ============================================================
       PROJECT COVER
    ============================================================ */
    .cover-img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: var(--radius-md);
        border: 2px solid var(--gray-200);
        transition: all 0.3s ease;
    }

    .cover-img:hover {
        transform: scale(1.08);
        border-color: var(--primary-300, #a5b4fc);
        box-shadow: 0 4px 16px rgba(79, 70, 229, 0.15);
    }

    .cover-placeholder {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        background: var(--gray-100);
        border: 2px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-300);
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .cover-placeholder:hover {
        background: var(--gray-200);
        color: var(--gray-400);
    }

    /* ============================================================
       BADGE STATUS
    ============================================================ */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .badge-status.selesai {
        background: var(--success-bg);
        color: var(--success);
    }

    .badge-status.berjalan {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .badge-status.direncanakan {
        background: var(--info-bg);
        color: var(--info);
    }

    .badge-status i {
        font-size: 10px;
    }

    /* ============================================================
       BADGE KATEGORI
    ============================================================ */
    .badge-kategori {
        display: inline-block;
        padding: 3px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .badge-kategori.konstruksi { background: var(--primary-bg, #eef2ff); color: var(--primary); }
    .badge-kategori.renovasi { background: var(--purple-bg); color: var(--purple); }
    .badge-kategori.interior { background: var(--pink-bg); color: var(--pink); }
    .badge-kategori.umum { background: var(--gray-100); color: var(--gray-600); }

    /* ============================================================
       BADGE FEATURED
    ============================================================ */
    .badge-featured {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 12px;
        border-radius: var(--radius-full);
        font-size: 9px;
        font-weight: 700;
        background: linear-gradient(135deg, #fcd34d, #f59e0b);
        color: white;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    /* ============================================================
       ACTION - 1 BARIS COMPACT
    ============================================================ */
    .action-compact {
        display: flex;
        gap: 4px;
        justify-content: center;
        align-items: center;
    }

    .btn-action {
        width: 32px;
        height: 32px;
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

    .btn-action.view {
        background: var(--info-bg);
        color: var(--info);
    }

    .btn-action.view:hover {
        background: var(--info);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
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

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state .icon-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 40px;
        color: var(--gray-300);
        transition: all 0.3s ease;
        border: 2px dashed var(--gray-200);
    }

    .empty-state:hover .icon-circle {
        transform: scale(1.05) rotate(-4deg);
        background: var(--gray-200);
        color: var(--gray-400);
        border-color: var(--gray-300);
    }

    .empty-state h5 {
        color: var(--gray-700);
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 4px;
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
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        margin-top: 16px;
    }

    .empty-state .btn-empty:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.25);
        color: white;
    }

    /* ============================================================
       ALERT
    ============================================================ */
    .alert-custom {
        border-radius: var(--radius-md);
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
        border: none;
    }

    .alert-custom.success {
        background: var(--success-bg);
        color: var(--success);
        border-left: 4px solid var(--success);
    }

    .alert-custom.error {
        background: var(--danger-bg);
        color: var(--danger);
        border-left: 4px solid var(--danger);
    }

    /* ============================================================
       PAGINATION
    ============================================================ */
    .pagination-wrap .page-link {
        border: none;
        border-radius: var(--radius-sm);
        margin: 0 3px;
        padding: 6px 14px;
        color: var(--gray-600);
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 13px;
        background: transparent;
    }

    .pagination-wrap .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .pagination-wrap .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .pagination-wrap .page-item.disabled .page-link {
        color: var(--gray-300);
        background: transparent;
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
        .hero-proyek h1 {
            font-size: 26px;
        }
    }

    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .hero-proyek {
            padding: 28px 24px;
        }
        .hero-proyek .top-row {
            flex-direction: column;
            align-items: flex-start;
        }
        .hero-proyek .btn-add {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .hero-proyek {
            padding: 20px 18px;
            border-radius: var(--radius-lg);
        }

        .hero-proyek h1 {
            font-size: 20px;
        }

        .hero-proyek .mini-stats {
            gap: 8px;
        }

        .hero-proyek .mini-stats .item {
            font-size: 11px;
            padding: 2px 10px;
        }

        .hero-proyek .btn-add {
            padding: 8px 18px;
            font-size: 13px;
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

        .cover-img,
        .cover-placeholder {
            width: 38px;
            height: 38px;
            font-size: 13px;
        }

        .badge-status {
            font-size: 10px;
            padding: 3px 10px;
        }

        .badge-status i {
            font-size: 8px;
        }

        .badge-kategori {
            font-size: 10px;
            padding: 2px 10px;
        }

        .badge-featured {
            font-size: 8px;
            padding: 1px 8px;
        }

        .btn-action {
            width: 28px;
            height: 28px;
            font-size: 10px;
        }

        .action-compact {
            gap: 3px;
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

        .stat-card .trend {
            font-size: 9px;
            padding: 1px 8px;
        }

        .empty-state .icon-circle {
            width: 72px;
            height: 72px;
            font-size: 28px;
        }

        .empty-state h5 {
            font-size: 16px;
        }

        .empty-state p {
            font-size: 12px;
        }

        .empty-state .btn-empty {
            padding: 8px 24px;
            font-size: 12px;
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

        .hero-proyek h1 {
            font-size: 17px;
        }

        .hero-proyek .greeting {
            font-size: 12px;
        }

        .hero-proyek .subtitle {
            font-size: 12px;
        }

        .hero-proyek .badge-date {
            font-size: 10px;
            padding: 3px 12px;
        }

        .hero-proyek .btn-add {
            padding: 6px 14px;
            font-size: 12px;
        }

        .hero-proyek .mini-stats .item {
            font-size: 10px;
            padding: 2px 8px;
        }

        .hero-proyek .mini-stats .item .num {
            font-size: 12px;
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

        .cover-img,
        .cover-placeholder {
            width: 32px;
            height: 32px;
            font-size: 11px;
        }

        .badge-status {
            font-size: 9px;
            padding: 2px 8px;
        }

        .badge-kategori {
            font-size: 9px;
            padding: 2px 8px;
        }

        .badge-featured {
            font-size: 7px;
            padding: 1px 6px;
        }

        .btn-action {
            width: 24px;
            height: 24px;
            font-size: 9px;
            border-radius: 6px;
        }

        .action-compact {
            gap: 2px;
        }

        .pagination-wrap .page-link {
            padding: 4px 10px;
            font-size: 11px;
        }

        .empty-state .icon-circle {
            width: 60px;
            height: 60px;
            font-size: 22px;
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
        background: var(--gray-100);
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
    HERO HEADER - ELEGAN
    ============================================================ -->
    <div class="hero-proyek fade-up">
        <div class="content">
            <div class="top-row">
                <div>
                    <div class="badge-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <div class="greeting">
                        <span class="wave">👋</span>
                        Halo, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                    </div>
                    <h1>
                        <i class="fas fa-project-diagram me-2" style="color: #fcd34d;"></i>
                        Manajemen <span class="highlight">Proyek</span>
                    </h1>
                    <p class="subtitle">
                        <i class="fas fa-folder-open"></i>
                        Kelola data proyek dan foto proyek dengan mudah
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.proyek.create') }}" class="btn-add" id="btnAdd">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Proyek
                    </a>
                </div>
            </div>

            <div class="mini-stats">
                <div class="item">
                    <span class="num">{{ $proyek->total() ?? 0 }}</span>
                    <span>Total Proyek</span>
                </div>
                <div class="item">
                    <span class="num">{{ $proyek->where('status', 'selesai')->count() ?? 0 }}</span>
                    <span>Selesai</span>
                </div>
                <div class="item">
                    <span class="num">{{ $proyek->where('status', 'berjalan')->count() ?? 0 }}</span>
                    <span>Berjalan</span>
                </div>
                <div class="item">
                    <span class="num">{{ $proyek->where('status', 'direncanakan')->count() ?? 0 }}</span>
                    <span>Direncanakan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    ALERT
    ============================================================ -->
    @if(session('success'))
        <div class="alert-custom success fade-up mb-3">
            <i class="fas fa-check-circle" style="font-size: 18px;"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size: 12px;"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom error fade-up mb-3">
            <i class="fas fa-exclamation-circle" style="font-size: 18px;"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size: 12px;"></button>
        </div>
    @endif

    <!-- ============================================================
    STATISTIK - CLEAN
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card fade-up">
            <div class="icon primary"><i class="fas fa-folder"></i></div>
            <div class="number primary">{{ $proyek->total() ?? 0 }}</div>
            <div class="label">Total Proyek</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> Aktif</span>
        </div>
        <div class="stat-card fade-up">
            <div class="icon success"><i class="fas fa-check-circle"></i></div>
            <div class="number success">{{ $proyek->where('status', 'selesai')->count() ?? 0 }}</div>
            <div class="label">Selesai</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> +12%</span>
        </div>
        <div class="stat-card fade-up">
            <div class="icon warning"><i class="fas fa-spinner"></i></div>
            <div class="number warning">{{ $proyek->where('status', 'berjalan')->count() ?? 0 }}</div>
            <div class="label">Berjalan</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card fade-up">
            <div class="icon info"><i class="fas fa-clock"></i></div>
            <div class="number info">{{ $proyek->where('status', 'direncanakan')->count() ?? 0 }}</div>
            <div class="label">Direncanakan</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
    </div>

    <!-- ============================================================
    TABLE - CLEAN
    ============================================================ -->
    <div class="table-card fade-up">
        <div class="header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-list"></i>
                </div>
                <div class="title">
                    <h5>Daftar Proyek</h5>
                    <small><i class="fas fa-clock"></i> Semua proyek yang telah ditambahkan</small>
                </div>
            </div>
            <span class="count-badge">
                <i class="fas fa-folder"></i>
                {{ $proyek->total() ?? 0 }} Proyek
            </span>
        </div>

        @if($proyek->isEmpty())
            <!-- ===== EMPTY STATE ===== -->
            <div class="empty-state">
                <div class="icon-circle">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h5>Belum Ada Proyek</h5>
                <p>Mulai tambahkan proyek pertama Anda sekarang</p>
                <a href="{{ route('admin.proyek.create') }}" class="btn-empty">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Proyek
                </a>
            </div>
        @else
            <!-- ===== TABLE ===== -->
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;"><i class="fas fa-hashtag"></i> #</th>
                            <th style="width: 70px;"><i class="fas fa-image"></i> Foto</th>
                            <th><i class="fas fa-folder"></i> Nama Proyek</th>
                            <th><i class="fas fa-user"></i> Klien</th>
                            <th style="width: 110px;"><i class="fas fa-tag"></i> Kategori</th>
                            <th style="width: 130px;"><i class="fas fa-info-circle"></i> Status</th>
                            <th style="width: 120px; text-align: center;"><i class="fas fa-cog"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyek as $index => $item)
                            @php
                                $statusClass = $item->status ?? 'direncanakan';
                                $kategoriClass = strtolower($item->kategori ?? 'umum');
                                if (!in_array($kategoriClass, ['konstruksi', 'renovasi', 'interior', 'umum'])) {
                                    $kategoriClass = 'umum';
                                }
                            @endphp
                            <tr class="slide-in" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                                <td>
                                    <span style="font-weight: 600; color: var(--gray-400); font-size: 12px;">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->cover)
                                        <img src="{{ asset('storage/' . $item->cover->foto_url) }}" 
                                             class="cover-img"
                                             alt="{{ $item->nama_proyek }}">
                                    @else
                                        <div class="cover-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                        <strong style="font-size: 13px; color: var(--gray-900);">
                                            {{ $item->nama_proyek }}
                                        </strong>
                                        @if($item->is_featured)
                                            <span class="badge-featured">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span style="font-size: 13px; color: var(--gray-600);">
                                        {{ $item->klien ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-kategori {{ $kategoriClass }}">
                                        {{ ucfirst($item->kategori ?? 'Umum') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status {{ $statusClass }}">
                                        <i class="fas {{ $statusClass === 'selesai' ? 'fa-check-circle' : ($statusClass === 'berjalan' ? 'fa-spinner' : 'fa-clock') }}"></i>
                                        {{ $item->status_label ?? ucfirst($statusClass) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <!-- ===== ACTION 1 BARIS COMPACT ===== -->
                                    <div class="action-compact">
                                        <a href="{{ route('admin.proyek.show', $item->id) }}" 
                                           class="btn-action view" 
                                           title="Detail Proyek">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.proyek.edit', $item->id) }}" 
                                           class="btn-action edit" 
                                           title="Edit Proyek">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.proyek.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus proyek {{ $item->nama_proyek }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Hapus Proyek">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <div class="text-muted" style="font-size: 12px; font-weight: 500;">
                    <i class="fas fa-info-circle me-1"></i>
                    {{ $proyek->firstItem() ?? 0 }} - {{ $proyek->lastItem() ?? 0 }} dari {{ $proyek->total() ?? 0 }} proyek
                </div>
                <div class="pagination-wrap">
                    {{ $proyek->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
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
        document.querySelectorAll('.alert-custom').forEach(function(alert) {
            setTimeout(function() {
                const close = alert.querySelector('.btn-close');
                if (close) close.click();
            }, 5000);
        });

        // --- Animasi Cover Image ---
        document.querySelectorAll('.cover-img').forEach(function(img) {
            img.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.08)';
                this.style.borderColor = 'var(--primary-300)';
                this.style.boxShadow = '0 4px 16px rgba(79, 70, 229, 0.15)';
            });
            img.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.borderColor = 'var(--gray-200)';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endsection