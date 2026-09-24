@extends('layouts.app')

@section('title', 'Admin Dashboard - Karya Jaya Las Konstruksi')

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
       HERO HEADER - PREMIUM
    ============================================================ */
    .hero-admin {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        border-radius: var(--radius-xl);
        padding: 40px 44px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(49, 46, 129, 0.35);
    }

    .hero-admin::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: floatHero 12s ease-in-out infinite alternate;
    }

    .hero-admin::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(236, 72, 153, 0.10) 0%, transparent 70%);
        border-radius: 50%;
        animation: floatHero 15s ease-in-out infinite alternate-reverse;
    }

    @keyframes floatHero {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, -20px) scale(1.08); }
    }

    .hero-admin .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    .hero-admin .content {
        position: relative;
        z-index: 2;
    }

    .hero-admin .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .hero-admin .badge-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.06);
        padding: 5px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 8px;
    }

    .hero-admin .badge-date i {
        color: #a5b4fc;
    }

    .hero-admin h1 {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }

    .hero-admin h1 .highlight {
        background: linear-gradient(90deg, #c4b5fd, #a78bfa, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-admin .subtitle {
        font-size: 14px;
        opacity: 0.6;
        font-weight: 400;
    }

    .hero-admin .badge-company {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.06);
        padding: 6px 20px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.06);
        margin-top: 4px;
    }

    .hero-admin .badge-company i {
        color: #fcd34d;
    }

    .hero-admin .admin-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.3), rgba(236, 72, 153, 0.3));
        border: 3px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        color: white;
        position: relative;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .hero-admin .admin-avatar:hover {
        transform: scale(1.05);
        border-color: rgba(255,255,255,0.2);
    }

    .hero-admin .admin-avatar .status-dot {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #10b981;
        border: 3px solid #1e1b4b;
        animation: pulseDot 2s ease-in-out infinite;
    }

    @keyframes pulseDot {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        50% { transform: scale(0.9); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
    }

    /* ============================================================
       STAT CARD - MODERN
    ============================================================ */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 22px 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: all 0.3s ease;
        position: relative;
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
        border-radius: 0 0 4px 4px;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: rgba(79, 70, 229, 0.06);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card.blue::before { background: linear-gradient(90deg, #4f46e5, #7c3aed); }
    .stat-card.green::before { background: linear-gradient(90deg, #10b981, #34d399); }
    .stat-card.purple::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
    .stat-card.orange::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

    .stat-card .icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }

    .stat-card:hover .icon-wrap {
        transform: scale(1.06) rotate(-3deg);
    }

    .stat-card .icon-wrap.blue { background: #eef2ff; color: #4f46e5; }
    .stat-card .icon-wrap.green { background: var(--success-bg); color: var(--success); }
    .stat-card .icon-wrap.purple { background: var(--purple-bg); color: var(--purple); }
    .stat-card .icon-wrap.orange { background: var(--warning-bg); color: var(--warning); }

    .stat-card .number {
        font-size: 30px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.5px;
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
        margin-top: 6px;
    }

    .stat-card .trend.up { background: var(--success-bg); color: var(--success); }
    .stat-card .trend.neutral { background: var(--gray-light); color: var(--gray); }

    /* ============================================================
       MENU CARD - PREMIUM
    ============================================================ */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .menu-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 24px 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-align: center;
        text-decoration: none;
        display: block;
        color: inherit;
        position: relative;
        overflow: hidden;
    }

    .menu-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--primary-gradient);
        opacity: 0;
        transition: all 0.35s ease;
        border-radius: inherit;
    }

    .menu-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: var(--shadow-lg);
        border-color: rgba(79, 70, 229, 0.08);
        color: inherit;
        text-decoration: none;
    }

    .menu-card:hover::before {
        opacity: 0.02;
    }

    .menu-card .menu-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 12px;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        z-index: 1;
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.08) rotate(-4deg);
    }

    .menu-card .menu-icon.blue { background: #eef2ff; color: #4f46e5; }
    .menu-card .menu-icon.green { background: var(--success-bg); color: var(--success); }
    .menu-card .menu-icon.orange { background: var(--warning-bg); color: var(--warning); }
    .menu-card .menu-icon.purple { background: var(--purple-bg); color: var(--purple); }
    .menu-card .menu-icon.pink { background: var(--pink-bg); color: var(--pink); }
    .menu-card .menu-icon.red { background: var(--danger-bg); color: var(--danger); }

    .menu-card h6 {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }

    .menu-card small {
        color: var(--gray);
        font-size: 12px;
        display: block;
        position: relative;
        z-index: 1;
    }

    .menu-card .arrow {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
        font-size: 11px;
        font-weight: 600;
        color: var(--primary);
        opacity: 0;
        transform: translateX(-8px);
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .menu-card:hover .arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* ============================================================
       TABLE CARD - CLEAN
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
        box-shadow: 0 4px 16px rgba(79, 70, 229, 0.2);
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

    .table-card .header .btn-view-all {
        background: var(--gray-light);
        border: none;
        padding: 6px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .table-card .header .btn-view-all:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(79, 70, 229, 0.2);
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

    .table-card table tbody td {
        padding: 12px 14px;
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

    .user-cell .info .email i {
        margin-right: 4px;
        font-size: 10px;
    }

    /* ============================================================
       ROLE BADGE
    ============================================================ */
    .badge-role {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .badge-role.admin {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .badge-role.user {
        background: var(--info-bg);
        color: var(--info);
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

    .empty-state h6 {
        color: #475569;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 2px;
    }

    .empty-state p {
        color: var(--gray);
        font-size: 13px;
        font-weight: 400;
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
    .fade-up:nth-child(5) { animation-delay: 0.25s; }
    .fade-up:nth-child(6) { animation-delay: 0.30s; }
    .fade-up:nth-child(7) { animation-delay: 0.35s; }
    .fade-up:nth-child(8) { animation-delay: 0.40s; }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .stat-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        .menu-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        .hero-admin h1 {
            font-size: 28px;
        }
    }

    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .menu-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        .hero-admin {
            padding: 32px 28px;
        }
        .hero-admin .top {
            flex-direction: column;
            align-items: flex-start;
        }
        .hero-admin .admin-avatar {
            width: 64px;
            height: 64px;
            font-size: 26px;
        }
    }

    @media (max-width: 768px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .menu-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .hero-admin {
            padding: 24px 20px;
            border-radius: var(--radius-lg);
        }

        .hero-admin h1 {
            font-size: 22px;
        }

        .hero-admin .admin-avatar {
            width: 56px;
            height: 56px;
            font-size: 22px;
        }

        .hero-admin .admin-avatar .status-dot {
            width: 12px;
            height: 12px;
            border-width: 2px;
        }

        .stat-card {
            padding: 16px 14px;
        }

        .stat-card .number {
            font-size: 22px;
        }

        .stat-card .icon-wrap {
            width: 38px;
            height: 38px;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .stat-card .label {
            font-size: 11px;
        }

        .menu-card {
            padding: 18px 14px;
        }

        .menu-card .menu-icon {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }

        .menu-card h6 {
            font-size: 13px;
        }

        .menu-card small {
            font-size: 11px;
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

        .table-card table thead th {
            font-size: 9px;
            padding: 8px 10px;
        }

        .table-card table tbody td {
            font-size: 12px;
            padding: 8px 10px;
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

        .badge-role {
            font-size: 10px;
            padding: 2px 10px;
        }

        .empty-state .icon-circle {
            width: 56px;
            height: 56px;
            font-size: 22px;
        }

        .empty-state h6 {
            font-size: 14px;
        }

        .empty-state p {
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
            font-size: 18px;
        }

        .stat-card .icon-wrap {
            width: 32px;
            height: 32px;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .stat-card .label {
            font-size: 10px;
        }

        .stat-card .trend {
            font-size: 9px;
            padding: 1px 8px;
        }

        .hero-admin h1 {
            font-size: 18px;
        }

        .hero-admin .subtitle {
            font-size: 12px;
        }

        .hero-admin .badge-date {
            font-size: 10px;
            padding: 3px 12px;
        }

        .hero-admin .badge-company {
            font-size: 10px;
            padding: 4px 14px;
        }

        .hero-admin .admin-avatar {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }

        .menu-grid {
            gap: 8px;
        }

        .menu-card {
            padding: 14px 10px;
        }

        .menu-card .menu-icon {
            width: 36px;
            height: 36px;
            font-size: 15px;
            margin-bottom: 8px;
        }

        .menu-card h6 {
            font-size: 11px;
        }

        .menu-card small {
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

        .badge-role {
            font-size: 9px;
            padding: 2px 8px;
        }

        .empty-state .icon-circle {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }

        .empty-state h6 {
            font-size: 13px;
        }

        .empty-state p {
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
    HERO HEADER - PREMIUM
    ============================================================ -->
    <div class="hero-admin fade-up">
        <div class="grid-pattern"></div>
        <div class="content">
            <div class="top">
                <div>
                    <div class="badge-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <h1>
                        <i class="fas fa-shield-alt me-3" style="color: #c4b5fd;"></i>
                        Admin <span class="highlight">Panel</span>
                    </h1>
                    <p class="subtitle">
                        <i class="fas fa-user me-1"></i>
                        Selamat datang, <strong>{{ Auth::user()->name }}</strong>
                    </p>
                    <div class="badge-company">
                        <i class="fas fa-building"></i>
                        Karya Jaya Las Konstruksi
                    </div>
                </div>
                <div>
                    <div class="admin-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        <span class="status-dot"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STATISTIK - MODERN
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card blue fade-up">
            <div class="icon-wrap blue"><i class="fas fa-users"></i></div>
            <div class="number">{{ $totalUsers ?? 0 }}</div>
            <div class="label">Total Users</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> +{{ $totalUsersToday ?? 0 }} hari ini</span>
        </div>
        <div class="stat-card green fade-up">
            <div class="icon-wrap green"><i class="fas fa-user-plus"></i></div>
            <div class="number">{{ $totalUsersToday ?? 0 }}</div>
            <div class="label">New Users Today</div>
            <span class="trend {{ ($totalUsersToday ?? 0) > 0 ? 'up' : 'neutral' }}">
                <i class="fas fa-{{ ($totalUsersToday ?? 0) > 0 ? 'arrow-up' : 'minus' }}"></i>
                {{ ($totalUsersToday ?? 0) > 0 ? 'Ada pertumbuhan' : 'Tidak ada' }}
            </span>
        </div>
        <div class="stat-card purple fade-up">
            <div class="icon-wrap purple"><i class="fas fa-user-shield"></i></div>
            <div class="number">{{ $totalAdmins ?? 0 }}</div>
            <div class="label">Total Admin</div>
            <span class="trend neutral"><i class="fas fa-check-circle"></i> Akses penuh</span>
        </div>
        <div class="stat-card orange fade-up">
            <div class="icon-wrap orange"><i class="fas fa-user"></i></div>
            <div class="number">{{ $totalUsersOnly ?? 0 }}</div>
            <div class="label">Total Users</div>
            <span class="trend neutral"><i class="fas fa-circle"></i> Aktif</span>
        </div>
    </div>

    <!-- ============================================================
    MENU CARD - PREMIUM
    ============================================================ -->
    <div class="menu-grid">
        <a href="{{ route('admin.users') }}" class="menu-card fade-up">
            <div class="menu-icon blue"><i class="fas fa-user-cog"></i></div>
            <h6>Manajemen User</h6>
            <small>Kelola data user</small>
            <span class="arrow">Kelola <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('admin.karyawan.index') }}" class="menu-card fade-up">
            <div class="menu-icon green"><i class="fas fa-users"></i></div>
            <h6>Kelola Karyawan</h6>
            <small>Tambah, edit, hapus</small>
            <span class="arrow">Kelola <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('admin.absen') }}" class="menu-card fade-up">
            <div class="menu-icon orange"><i class="fas fa-clipboard-check"></i></div>
            <h6>Data Absensi</h6>
            <small>Lihat semua absensi</small>
            <span class="arrow">Lihat <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('admin.gajian') }}" class="menu-card fade-up">
            <div class="menu-icon purple"><i class="fas fa-money-bill-wave"></i></div>
            <h6>Data Gajian</h6>
            <small>Kelola penggajian</small>
            <span class="arrow">Kelola <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('admin.proyek.index') }}" class="menu-card fade-up">
            <div class="menu-icon pink"><i class="fas fa-project-diagram"></i></div>
            <h6>Manajemen Proyek</h6>
            <small>Kelola proyek & foto</small>
            <span class="arrow">Kelola <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('admin.catatan-harian') }}" class="menu-card fade-up">
            <div class="menu-icon purple"><i class="fas fa-clipboard-list"></i></div>
            <h6>Catatan Harian</h6>
            <small>Lihat semua catatan</small>
            <span class="arrow">Lihat <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('admin.settings') }}" class="menu-card fade-up">
            <div class="menu-icon orange"><i class="fas fa-cog"></i></div>
            <h6>Pengaturan</h6>
            <small>Pengaturan sistem</small>
            <span class="arrow">Buka <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('logout') }}" class="menu-card fade-up" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="menu-icon red"><i class="fas fa-sign-out-alt"></i></div>
            <h6>Logout</h6>
            <small>Keluar dari sistem</small>
            <span class="arrow">Keluar <i class="fas fa-arrow-right"></i></span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- ============================================================
    TABLE - USER TERBARU
    ============================================================ -->
    <div class="table-card fade-up">
        <div class="header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-users"></i>
                </div>
                <div class="title">
                    <h5>User Terbaru</h5>
                    <small><i class="fas fa-clock"></i> User yang baru bergabung</small>
                </div>
            </div>
            <a href="{{ route('admin.users') }}" class="btn-view-all">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        @if(($latestUsers ?? [])->isEmpty())
            <div class="empty-state">
                <div class="icon-circle">
                    <i class="fas fa-inbox"></i>
                </div>
                <h6>Belum Ada User</h6>
                <p>Belum ada user yang terdaftar saat ini</p>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;"><i class="fas fa-hashtag"></i> #</th>
                            <th><i class="fas fa-user"></i> Nama</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-tag"></i> Role</th>
                            <th><i class="fas fa-calendar"></i> Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestUsers as $user)
                            @php
                                $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose', 'indigo'];
                                $color = $colors[$loop->index % count($colors)];
                                $inisial = strtoupper(substr($user->name, 0, 2));
                            @endphp
                            <tr>
                                <td>
                                    <span style="font-weight: 600; color: var(--gray);">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td>
                                    <div class="user-cell">
                                        <div class="avatar {{ $color }}">
                                            {{ $inisial }}
                                        </div>
                                        <div class="info">
                                            <span class="name">{{ $user->name }}</span>
                                            <span class="email">
                                                <i class="fas fa-envelope"></i>
                                                {{ $user->email }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-weight: 500; color: #475569;">
                                        {{ $user->email }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-role {{ $user->role === 'admin' ? 'admin' : 'user' }}">
                                        <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : 'user' }}"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 500;">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </span>
                                    <br>
                                    <small class="text-muted" style="font-size: 10px;">
                                        {{ $user->created_at->diffForHumans() }}
                                    </small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Keyboard Shortcut: Ctrl+Shift+L untuk Logout ---
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'L') {
                e.preventDefault();
                if (confirm('Yakin ingin logout?')) {
                    document.getElementById('logout-form').submit();
                }
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
