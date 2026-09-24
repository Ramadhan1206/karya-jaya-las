@extends('layouts.app')

@section('title', 'Catatan Gajian - Karya Jaya Las Konstruksi')

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
    }

    /* ============================================================
       HERO - SIMPLE ELEGAN
    ============================================================ */
    .hero-gaji {
        background: var(--primary-gradient);
        border-radius: var(--radius-xl);
        padding: 36px 40px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(79, 70, 229, 0.25);
    }

    .hero-gaji::before {
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

    .hero-gaji::after {
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

    .hero-gaji .content {
        position: relative;
        z-index: 1;
    }

    .hero-gaji .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-gaji .badge-date {
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

    .hero-gaji .badge-date i {
        color: #a5b4fc;
    }

    .hero-gaji .greeting {
        font-size: 14px;
        opacity: 0.7;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2px;
    }

    .hero-gaji .greeting .wave {
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

    .hero-gaji h1 {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 2px;
    }

    .hero-gaji h1 .highlight {
        background: linear-gradient(90deg, #fcd34d, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-gaji .subtitle {
        font-size: 14px;
        opacity: 0.5;
        font-weight: 400;
    }

    .hero-gaji .subtitle i {
        margin-right: 6px;
    }

    .hero-gaji .btn-add {
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

    .hero-gaji .btn-add:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        color: white;
    }

    .hero-gaji .btn-add i {
        font-size: 16px;
    }

    .hero-gaji .mini-stats {
        display: flex;
        gap: 16px;
        margin-top: 14px;
        flex-wrap: wrap;
    }

    .hero-gaji .mini-stats .item {
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

    .hero-gaji .mini-stats .item .num {
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
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(79, 70, 229, 0.06);
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

    .stat-card .icon.primary { background: #eef2ff; color: var(--primary); }
    .stat-card .icon.success { background: var(--success-bg); color: var(--success); }
    .stat-card .icon.warning { background: var(--warning-bg); color: var(--warning); }
    .stat-card .icon.danger { background: var(--danger-bg); color: var(--danger); }

    .stat-card .number {
        font-size: 26px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.3px;
        color: #0f172a;
    }

    .stat-card .number.primary { color: var(--primary); }
    .stat-card .number.success { color: var(--success); }
    .stat-card .number.warning { color: var(--warning); }
    .stat-card .number.danger { color: var(--danger); }

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

    /* ============================================================
       REKAP ABSEN - CLEAN
    ============================================================ */
    .rekap-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px 24px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        margin-bottom: 28px;
        transition: all 0.3s ease;
    }

    .rekap-card:hover {
        box-shadow: var(--shadow-md);
    }

    .rekap-card .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 16px;
    }

    .rekap-card .header .title {
        font-weight: 700;
        color: #0f172a;
        font-size: 15px;
    }

    .rekap-card .header .title i {
        color: var(--primary);
        margin-right: 8px;
    }

    .rekap-card .header .periode {
        font-size: 13px;
        color: var(--gray);
        font-weight: 400;
        margin-left: 4px;
    }

    .rekap-card .header .badge-month {
        background: var(--primary-gradient);
        color: white;
        padding: 4px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
    }

    .rekap-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .rekap-grid .item {
        text-align: center;
        padding: 12px;
        background: var(--gray-light);
        border-radius: var(--radius);
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .rekap-grid .item:hover {
        background: white;
        border-color: rgba(79, 70, 229, 0.06);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .rekap-grid .item .num {
        font-size: 22px;
        font-weight: 800;
        display: block;
        line-height: 1.2;
    }

    .rekap-grid .item .num.success { color: var(--success); }
    .rekap-grid .item .num.warning { color: var(--warning); }
    .rekap-grid .item .num.danger { color: var(--danger); }
    .rekap-grid .item .num.gray { color: var(--gray); }

    .rekap-grid .item .label {
        font-size: 12px;
        color: var(--gray);
        font-weight: 500;
        display: block;
        margin-top: 2px;
    }

    .rekap-grid .item .label i {
        margin-right: 4px;
        font-size: 11px;
    }

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
       USER CELL
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
        border: 2px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }

    .user-cell .avatar:hover {
        transform: scale(1.05);
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
        color: #0f172a;
        font-size: 13px;
        display: block;
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
    .jenis-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        background: var(--gray-light);
        color: var(--gray);
    }

    .jenis-badge.harian { background: #eef2ff; color: var(--primary); }
    .jenis-badge.mingguan { background: #ede9fe; color: #7c3aed; }
    .jenis-badge.bulanan { background: var(--success-bg); color: var(--success); }
    .jenis-badge.bonus { background: var(--warning-bg); color: var(--warning); }

    .status-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-badge.draft { background: var(--gray-light); color: var(--gray); }
    .status-badge.proses { background: var(--warning-bg); color: var(--warning); }
    .status-badge.dibayar { background: var(--success-bg); color: var(--success); }
    .status-badge.batal { background: var(--danger-bg); color: var(--danger); }

    .total-gaji {
        font-weight: 700;
        color: var(--primary);
        font-size: 14px;
    }

    .total-gaji .rupiah {
        font-weight: 400;
        font-size: 11px;
        color: var(--gray);
        margin-right: 2px;
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
        width: 30px;
        height: 30px;
        border-radius: 8px;
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
        background: #eef2ff;
        color: var(--primary);
    }

    .btn-action.view:hover {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
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
       PAGINATION - DIPERBAIKI
    ============================================================ */
    .pagination-wrap {
        display: flex;
        justify-content: flex-end;
    }

    .pagination-wrap .pagination {
        margin: 0;
        gap: 4px;
        flex-wrap: wrap;
    }

    .pagination-wrap .page-item {
        margin: 0;
    }

    .pagination-wrap .page-link {
        border: none !important;
        border-radius: 8px !important;
        margin: 0 !important;
        padding: 0 !important;
        color: var(--gray) !important;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 12px;
        background: transparent !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        line-height: 1 !important;
        box-shadow: none !important;
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
        opacity: 0.5;
    }

    /* Icon panah next & previous - KECIL */
    .pagination-wrap .page-link svg {
        width: 12px !important;
        height: 12px !important;
        max-width: 12px !important;
        max-height: 12px !important;
        display: block !important;
    }

    .pagination-wrap .page-link i {
        font-size: 11px !important;
        line-height: 1 !important;
    }

    /* Sembunyikan teks "Previous"/"Next" jika ada, ganti dengan icon */
    .pagination-wrap .page-item:first-child .page-link,
    .pagination-wrap .page-item:last-child .page-link {
        font-size: 0 !important;
        padding: 0 !important;
    }

    .pagination-wrap .page-item:first-child .page-link svg,
    .pagination-wrap .page-item:first-child .page-link i,
    .pagination-wrap .page-item:last-child .page-link svg,
    .pagination-wrap .page-item:last-child .page-link i {
        font-size: 11px !important;
        width: 12px !important;
        height: 12px !important;
    }

    /* Jika Laravel pakai teks &laquo; &raquo; */
    .pagination-wrap .page-item:first-child .page-link::before,
    .pagination-wrap .page-item:last-child .page-link::after {
        font-size: 14px !important;
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
        .hero-gaji h1 {
            font-size: 24px;
        }
    }

    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .rekap-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .hero-gaji {
            padding: 28px 24px;
        }
        .hero-gaji .top {
            flex-direction: column;
            align-items: flex-start;
        }
        .hero-gaji .btn-add {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .hero-gaji {
            padding: 20px 18px;
            border-radius: var(--radius-lg);
        }

        .hero-gaji h1 {
            font-size: 20px;
        }

        .hero-gaji .mini-stats {
            gap: 8px;
        }

        .hero-gaji .mini-stats .item {
            font-size: 11px;
            padding: 2px 10px;
        }

        .hero-gaji .btn-add {
            padding: 8px 18px;
            font-size: 13px;
        }

        .rekap-card {
            padding: 16px 18px;
        }

        .rekap-grid {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .rekap-grid .item .num {
            font-size: 18px;
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

        .jenis-badge {
            font-size: 10px;
            padding: 2px 10px;
        }

        .status-badge {
            font-size: 10px;
            padding: 2px 10px;
        }

        .total-gaji {
            font-size: 12px;
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

        .stat-card .trend {
            font-size: 9px;
            padding: 1px 8px;
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

        .pagination-wrap .page-link {
            min-width: 28px !important;
            height: 28px !important;
            font-size: 11px;
        }

        .pagination-wrap .page-link svg {
            width: 10px !important;
            height: 10px !important;
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

        .hero-gaji h1 {
            font-size: 17px;
        }

        .hero-gaji .greeting {
            font-size: 12px;
        }

        .hero-gaji .subtitle {
            font-size: 12px;
        }

        .hero-gaji .badge-date {
            font-size: 10px;
            padding: 3px 12px;
        }

        .hero-gaji .btn-add {
            padding: 6px 14px;
            font-size: 12px;
        }

        .hero-gaji .mini-stats .item {
            font-size: 10px;
            padding: 2px 8px;
        }

        .hero-gaji .mini-stats .item .num {
            font-size: 12px;
        }

        .rekap-card {
            padding: 12px 14px;
        }

        .rekap-card .header .title {
            font-size: 13px;
        }

        .rekap-card .header .badge-month {
            font-size: 10px;
            padding: 3px 12px;
        }

        .rekap-grid .item {
            padding: 8px;
        }

        .rekap-grid .item .num {
            font-size: 16px;
        }

        .rekap-grid .item .label {
            font-size: 10px;
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

        .jenis-badge {
            font-size: 9px;
            padding: 2px 8px;
        }

        .status-badge {
            font-size: 9px;
            padding: 2px 8px;
        }

        .total-gaji {
            font-size: 11px;
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

        .pagination-wrap .page-link {
            min-width: 26px !important;
            height: 26px !important;
            font-size: 10px;
        }

        .pagination-wrap .page-link svg {
            width: 9px !important;
            height: 9px !important;
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
    <div class="hero-gaji fade-up">
        <div class="content">
            <div class="top">
                <div>
                    <div class="badge-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <div class="greeting">
                        <span class="wave">👋</span>
                        Halo, <strong>{{ Auth::user()->name ?? 'User' }}</strong>
                    </div>
                    <h1>
                        <i class="fas fa-money-bill-wave me-2" style="color: #fcd34d;"></i>
                        Catatan <span class="highlight">Gajian</span>
                    </h1>
                    <p class="subtitle">
                        <i class="fas fa-user"></i>
                        Kelola data gaji karyawan dengan mudah
                    </p>
                </div>
                <div>
                    <a href="{{ route('user.gajian.create') }}" class="btn-add" id="btnAdd">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Gajian
                    </a>
                </div>
            </div>

            <div class="mini-stats">
                <div class="item">
                    <span class="num">{{ $gajian->total() ?? 0 }}</span>
                    <span>Data Gaji</span>
                </div>
                <div class="item">
                    <span class="num">{{ $totalHadir ?? 0 }}</span>
                    <span>Hadir</span>
                </div>
                <div class="item">
                    <span class="num">{{ $totalIzin ?? 0 }}</span>
                    <span>Izin</span>
                </div>
                <div class="item">
                    <span class="num">{{ $totalSakit ?? 0 }}</span>
                    <span>Sakit</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STATISTIK - CLEAN
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card fade-up">
            <div class="icon primary"><i class="fas fa-coins"></i></div>
            <div class="number primary">Rp {{ number_format($totalGaji ?? 0, 0, ',', '.') }}</div>
            <div class="label">Total Gaji</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> Aktif</span>
        </div>
        <div class="stat-card fade-up">
            <div class="icon success"><i class="fas fa-user-check"></i></div>
            <div class="number success">{{ $totalHadir ?? 0 }}</div>
            <div class="label">Total Hadir</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card fade-up">
            <div class="icon warning"><i class="fas fa-clock"></i></div>
            <div class="number warning">{{ $totalIzin ?? 0 }}</div>
            <div class="label">Total Izin</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card fade-up">
            <div class="icon danger"><i class="fas fa-notes-medical"></i></div>
            <div class="number danger">{{ $totalSakit ?? 0 }}</div>
            <div class="label">Total Sakit</div>
            <span class="trend down"><i class="fas fa-arrow-down"></i> Menurun</span>
        </div>
    </div>

    <!-- ============================================================
    REKAP ABSEN - CLEAN
    ============================================================ -->
    <div class="rekap-card fade-up">
        <div class="header">
            <div class="title">
                <i class="fas fa-clipboard-list"></i>
                Rekap Absen Bulan Ini
                <span class="periode">{{ date('F Y') }}</span>
            </div>
            <span class="badge-month">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ date('F Y') }}
            </span>
        </div>
        <div class="rekap-grid">
            <div class="item">
                <span class="num success">{{ $totalHadir ?? 0 }}</span>
                <span class="label"><i class="fas fa-check-circle"></i> Hadir</span>
            </div>
            <div class="item">
                <span class="num warning">{{ $totalIzin ?? 0 }}</span>
                <span class="label"><i class="fas fa-clock"></i> Izin</span>
            </div>
            <div class="item">
                <span class="num danger">{{ $totalSakit ?? 0 }}</span>
                <span class="label"><i class="fas fa-notes-medical"></i> Sakit</span>
            </div>
            <div class="item">
                <span class="num gray">{{ $totalAlpha ?? 0 }}</span>
                <span class="label"><i class="fas fa-times-circle"></i> Alpha</span>
            </div>
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
                    <h5>Riwayat Gajian</h5>
                    <small><i class="fas fa-clock"></i> Semua data penggajian karyawan</small>
                </div>
            </div>
            <span class="count-badge">
                <i class="fas fa-database"></i>
                {{ $gajian->total() ?? 0 }} Data
            </span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="min-width: 200px;"><i class="fas fa-user"></i> Nama</th>
                        <th><i class="fas fa-calendar"></i> Tanggal</th>
                        <th><i class="fas fa-clock"></i> Periode</th>
                        <th><i class="fas fa-tag"></i> Jenis</th>
                        <th><i class="fas fa-money-bill"></i> Gaji Pokok</th>
                        <th><i class="fas fa-coins"></i> Total</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th style="text-align: center; min-width: 100px;"><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gajian ?? [] as $item)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose', 'indigo', 'amber'];
                            $color = $colors[$loop->index % count($colors)];
                            $inisial = strtoupper(substr($item->user->name ?? 'U', 0, 2));
                            $status = $item->status ?? 'draft';
                            $jenis = $item->jenis_gaji ?? 'harian';
                            
                            $jenisLabel = [
                                'harian' => 'Harian',
                                'mingguan' => 'Mingguan',
                                'bulanan' => 'Bulanan',
                                'bonus' => 'Bonus'
                            ][$jenis] ?? ucfirst($jenis);
                        @endphp
                        <tr class="slide-in" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                            <td>
                                <div class="user-cell">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                    </div>
                                    <div class="info">
                                        <span class="name">{{ $item->user->name ?? 'User Tidak Ditemukan' }}</span>
                                        <span class="email">
                                            <i class="fas fa-envelope"></i>
                                            {{ $item->user->email ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($item->tanggal_gaji)->format('d/m/Y') }}
                                </span>
                                <br>
                                <small class="text-muted" style="font-size: 9px;">
                                    {{ \Carbon\Carbon::parse($item->tanggal_gaji)->format('l') }}
                                </small>
                            </td>
                            <td>
                                @if($item->periode)
                                    <span style="font-size: 12px; font-weight: 500;">
                                        {{ $item->periode }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="jenis-badge {{ $jenis }}">
                                    {{ $jenisLabel }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 500; font-size: 13px;">
                                    Rp {{ number_format($item->gaji_pokok ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="total-gaji">
                                    <span class="rupiah">Rp</span>
                                    {{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge {{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="action-compact">
                                    <a href="{{ route('user.gajian.show', $item->id) }}" 
                                       class="btn-action view" 
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('user.gajian.edit', $item->id) }}" 
                                       class="btn-action edit" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user.gajian.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                    <div class="icon-circle">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h5>Belum Ada Data Gajian</h5>
                                    <p>Mulai catat data gajian karyawan sekarang</p>
                                    <a href="{{ route('user.gajian.create') }}" class="btn-empty">
                                        <i class="fas fa-plus"></i> Tambah Gajian
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
                {{ $gajian->firstItem() ?? 0 }} - {{ $gajian->lastItem() ?? 0 }} dari {{ $gajian->total() ?? 0 }}
            </div>
            <div class="pagination-wrap">
                {{ $gajian->appends(request()->query())->links('pagination::bootstrap-5') }}
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