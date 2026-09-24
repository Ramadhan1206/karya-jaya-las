@extends('layouts.app')

@section('title', 'Dashboard - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ============================================================
       IMPORTS & RESET
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
        background: #f0f2f8;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #4f46e5;
        --primary-light: #818cf8;
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
        --teal: #14b8a6;
        --teal-bg: #f0fdfa;
        --gray: #6b7280;
        --gray-light: #f1f5f9;
        --dark: #0f172a;
        
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
       WELCOME CARD - PREMIUM
    ============================================================ */
    .welcome-card {
        background: var(--primary-gradient);
        border-radius: var(--radius-xl);
        padding: 36px 40px;
        color: white;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(79, 70, 229, 0.25);
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 450px;
        height: 450px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
        animation: floatWelcome 10s ease-in-out infinite alternate;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 320px;
        height: 320px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        animation: floatWelcome 8s ease-in-out infinite alternate-reverse;
    }

    @keyframes floatWelcome {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, -20px) scale(1.05); }
    }

    .welcome-card .content {
        position: relative;
        z-index: 1;
    }

    .welcome-card .avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
        border: 3px solid rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        flex-shrink: 0;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .welcome-card .avatar:hover {
        transform: scale(1.05) rotate(-5deg);
        background: rgba(255,255,255,0.18);
    }

    .welcome-card h2 {
        font-weight: 800;
        font-size: 26px;
        margin-bottom: 2px;
        letter-spacing: -0.5px;
    }

    .welcome-card h2 .highlight {
        background: linear-gradient(90deg, #fcd34d, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .welcome-card .date-text {
        opacity: 0.7;
        font-size: 14px;
        font-weight: 400;
    }

    .welcome-card .date-text i {
        margin-right: 8px;
        color: #a5b4fc;
    }

    .welcome-card .badge-role {
        background: rgba(255,255,255,0.08);
        padding: 5px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.06);
    }

    .welcome-card .badge-role i {
        font-size: 12px;
    }

    .welcome-card .illustration {
        font-size: 100px;
        opacity: 0.06;
        position: relative;
        z-index: 1;
    }

    /* ============================================================
       STAT CARD - PREMIUM
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
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
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
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: var(--shadow-lg);
        border-color: rgba(79, 70, 229, 0.06);
    }

    .stat-card:hover::before {
        height: 4px;
    }

    .stat-card .icon-box {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 12px;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .stat-card:hover .icon-box {
        transform: scale(1.08) rotate(-4deg);
    }

    .stat-card .icon-box.primary { background: #eef2ff; color: var(--primary); }
    .stat-card .icon-box.success { background: var(--success-bg); color: var(--success); }
    .stat-card .icon-box.warning { background: var(--warning-bg); color: var(--warning); }
    .stat-card .icon-box.purple { background: var(--purple-bg); color: var(--purple); }

    .stat-card .number {
        font-size: 32px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    .stat-card .number.primary { color: var(--primary); }
    .stat-card .number.success { color: var(--success); }
    .stat-card .number.warning { color: var(--warning); }
    .stat-card .number.purple { color: var(--purple); }

    .stat-card .label {
        font-size: 12px;
        color: var(--gray);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
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
    .stat-card .trend.stable { background: var(--gray-light); color: var(--gray); }
    .stat-card .trend.down { background: var(--danger-bg); color: var(--danger); }

    .stat-card::before { background: var(--primary-gradient); }
    .stat-card.green::before { background: var(--success); }
    .stat-card.orange::before { background: var(--warning); }
    .stat-card.purple::before { background: var(--purple); }

    /* ============================================================
       MENU GRID - PREMIUM
    ============================================================ */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }

    .menu-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 22px 16px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
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
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(79, 70, 229, 0.08);
        text-decoration: none;
        color: inherit;
    }

    .menu-card:hover::before {
        opacity: 1;
    }

    .menu-card .icon {
        font-size: 28px;
        margin-bottom: 10px;
        display: block;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .menu-card:hover .icon {
        transform: scale(1.1) translateY(-2px);
    }

    .menu-card .icon.blue { color: var(--primary); }
    .menu-card .icon.green { color: var(--success); }
    .menu-card .icon.orange { color: var(--warning); }
    .menu-card .icon.purple { color: var(--purple); }
    .menu-card .icon.pink { color: var(--pink); }
    .menu-card .icon.teal { color: var(--teal); }

    .menu-card h6 {
        font-weight: 700;
        color: var(--dark);
        font-size: 13px;
        margin-bottom: 2px;
        letter-spacing: -0.2px;
    }

    .menu-card small {
        color: var(--gray);
        font-size: 11px;
        font-weight: 400;
    }

    /* ============================================================
       TABLE CARD - PREMIUM
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

    .table-card .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1.5px solid var(--gray-light);
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-card .table-header .left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-card .table-header .left .icon-box {
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

    .table-card .table-header .left h6 {
        font-weight: 700;
        color: var(--dark);
        font-size: 16px;
        margin-bottom: 0;
    }

    .table-card .table-header .left small {
        color: var(--gray);
        font-size: 12px;
        display: block;
    }

    .table-card .table-header .badge-count {
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

    .table-card thead th {
        background: var(--gray-light);
        color: var(--gray);
        font-weight: 600;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border-bottom: 1.5px solid #e8ecf1;
        padding: 10px 14px;
        white-space: nowrap;
    }

    .table-card thead th i {
        margin-right: 6px;
        opacity: 0.4;
    }

    .table-card tbody td {
        padding: 10px 14px;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-light);
        font-size: 13px;
        color: #334155;
    }

    .table-card tbody tr {
        transition: all 0.2s ease;
    }

    .table-card tbody tr:hover {
        background: #f8fafc;
    }

    .table-card tbody tr:last-child td {
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

    .user-cell .info .name {
        font-weight: 600;
        color: var(--dark);
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .user-cell .info .email {
        font-size: 11px;
        color: var(--gray);
        font-weight: 400;
    }

    /* ============================================================
       BADGES
    ============================================================ */
    .badge-role {
        padding: 4px 14px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        text-transform: capitalize;
    }

    .badge-role-admin {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .badge-role-user {
        background: var(--info-bg);
        color: var(--info);
    }

    .badge-you {
        background: var(--success-bg);
        color: var(--success);
        font-size: 9px;
        padding: 2px 10px;
        border-radius: var(--radius-full);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .menu-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .welcome-card {
            padding: 28px 24px;
        }
        .welcome-card h2 {
            font-size: 22px;
        }
        .menu-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .welcome-card {
            padding: 22px 18px;
            text-align: center;
            border-radius: var(--radius-lg);
        }

        .welcome-card .d-flex {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .welcome-card .avatar {
            width: 60px;
            height: 60px;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .welcome-card h2 {
            font-size: 18px;
        }

        .welcome-card .date-text {
            font-size: 12px;
        }

        .welcome-card .badge-role {
            font-size: 10px;
            padding: 4px 14px;
        }

        .welcome-card .illustration {
            display: none;
        }

        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .stat-card {
            padding: 16px 14px;
        }

        .stat-card .number {
            font-size: 22px;
        }

        .stat-card .icon-box {
            width: 38px;
            height: 38px;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .stat-card .label {
            font-size: 10px;
        }

        .menu-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .menu-card {
            padding: 16px 10px;
        }

        .menu-card .icon {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .menu-card h6 {
            font-size: 11px;
        }

        .menu-card small {
            display: none;
        }

        .table-card {
            padding: 16px;
            border-radius: var(--radius-lg);
        }

        .table-card .table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .table-card .table-header .left .icon-box {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .table-card .table-header .left h6 {
            font-size: 14px;
        }

        .table-card .table-header .badge-count {
            padding: 4px 14px;
            font-size: 11px;
        }

        .table-card thead th {
            font-size: 9px;
            padding: 8px 10px;
        }

        .table-card tbody td {
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
            padding: 3px 10px;
        }
    }

    @media (max-width: 480px) {
        .welcome-card {
            padding: 18px 14px;
        }

        .welcome-card .avatar {
            width: 50px;
            height: 50px;
            font-size: 18px;
        }

        .welcome-card h2 {
            font-size: 16px;
        }

        .welcome-card .date-text {
            font-size: 11px;
        }

        .welcome-card .badge-role {
            font-size: 9px;
            padding: 3px 12px;
        }

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

        .stat-card .icon-box {
            width: 32px;
            height: 32px;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .stat-card .label {
            font-size: 9px;
        }

        .stat-card .trend {
            font-size: 8px;
            padding: 1px 8px;
        }

        .menu-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .menu-card {
            padding: 12px 8px;
        }

        .menu-card .icon {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .menu-card h6 {
            font-size: 10px;
        }

        .table-card {
            padding: 12px;
        }

        .table-card thead th {
            font-size: 8px;
            padding: 6px 6px;
        }

        .table-card tbody td {
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
    WELCOME CARD - PREMIUM
    ============================================================ -->
    <div class="welcome-card fade-up">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="content d-flex align-items-center gap-3">
                    <div class="avatar">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h2>
                            Selamat datang, <span class="highlight">{{ $user->name }}</span>!
                        </h2>
                        <p class="date-text mb-0">
                            <i class="fas fa-calendar-alt"></i>
                            {{ now()->format('l, d F Y') }}
                        </p>
                        <div class="mt-2 d-flex flex-wrap gap-2">
                            <span class="badge-role">
                                <i class="fas fa-building"></i>
                                Karya Jaya Las
                            </span>
                            <span class="badge-role">
                                <i class="fas fa-user-tag"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <div class="illustration">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STATISTIK - PREMIUM
    ============================================================ -->
    <div class="stat-grid">
        <div class="stat-card fade-up">
            <div class="icon-box primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="number primary">{{ $totalKaryawan }}</div>
            <div class="label">Total Karyawan</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> Aktif</span>
        </div>
        <div class="stat-card green fade-up">
            <div class="icon-box success">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="number success">{{ $totalAdmin }}</div>
            <div class="label">Admin</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card orange fade-up">
            <div class="icon-box warning">
                <i class="fas fa-user"></i>
            </div>
            <div class="number warning">{{ $totalUser }}</div>
            <div class="label">User</div>
            <span class="trend stable"><i class="fas fa-minus"></i> Stabil</span>
        </div>
        <div class="stat-card purple fade-up">
            <div class="icon-box purple">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="number purple">{{ $totalCatatanHarian ?? 0 }}</div>
            <div class="label">Catatan Harian</div>
            <span class="trend up"><i class="fas fa-arrow-up"></i> Aktif</span>
        </div>
    </div>

    <!-- ============================================================
    MENU CEPAT - PREMIUM
    ============================================================ -->
    <div class="menu-grid">
        <a href="{{ route('profile') }}" class="menu-card fade-up">
            <span class="icon blue"><i class="fas fa-user-circle"></i></span>
            <h6>Profile</h6>
            <small>Lihat profile</small>
        </a>
        <a href="{{ route('profile.change-password') }}" class="menu-card fade-up">
            <span class="icon orange"><i class="fas fa-key"></i></span>
            <h6>Ubah Password</h6>
            <small>Ganti password</small>
        </a>
        <a href="{{ route('user.catatan-harian') }}" class="menu-card fade-up">
            <span class="icon green"><i class="fas fa-clipboard-list"></i></span>
            <h6>Catatan Harian</h6>
            <small>Catatan aktivitas</small>
        </a>
        <a href="{{ route('proyek.index') }}" class="menu-card fade-up">
            <span class="icon teal"><i class="fas fa-project-diagram"></i></span>
            <h6>Proyek</h6>
            <small>Lihat proyek</small>
        </a>
        <a href="{{ route('user.gajian.index') }}" class="menu-card fade-up">
            <span class="icon purple"><i class="fas fa-money-bill-wave"></i></span>
            <h6>Gajian</h6>
            <small>Data gajian</small>
        </a>
        <a href="{{ route('logout') }}" class="menu-card fade-up" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer;">
            <span class="icon pink"><i class="fas fa-sign-out-alt"></i></span>
            <h6>Logout</h6>
            <small>Keluar</small>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- ============================================================
    DAFTAR KARYAWAN - PREMIUM
    ============================================================ -->
    <div class="table-card fade-up">
        <div class="table-header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h6>Daftar Karyawan</h6>
                    <small><i class="fas fa-clock"></i> Semua karyawan terdaftar</small>
                </div>
            </div>
            <span class="badge-count">
                <i class="fas fa-database"></i>
                {{ $totalKaryawan }} Orang
            </span>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th><i class="fas fa-user"></i> Nama</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-tag"></i> Role</th>
                        <th><i class="fas fa-phone"></i> Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawan as $index => $k)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal'];
                            $color = $colors[$index % count($colors)];
                            $inisial = strtoupper(substr($k->name ?? 'U', 0, 2));
                        @endphp
                        <tr class="fade-up" style="animation-delay: {{ $index * 0.03 }}s;">
                            <td>
                                <span class="badge bg-light text-dark" style="font-weight: 700; font-size: 11px;">
                                    {{ $index + 1 }}
                                </span>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                    </div>
                                    <div class="info">
                                        <span class="name">
                                            {{ $k->name }}
                                            @if($k->id == $user->id)
                                                <span class="badge-you">Anda</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 13px;">
                                    <i class="fas fa-envelope text-muted me-1" style="font-size: 11px;"></i>
                                    {{ $k->email }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-role {{ $k->role === 'admin' ? 'badge-role-admin' : 'badge-role-user' }}">
                                    {{ ucfirst($k->role) }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 13px;">
                                    <i class="fas fa-phone text-muted me-1" style="font-size: 11px;"></i>
                                    {{ $k->phone ?? '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center py-5">
                                    <div style="font-size: 48px; color: #cbd5e1; margin-bottom: 12px;">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h5 style="color: #475569; font-weight: 700; font-size: 17px;">
                                        Belum Ada Karyawan
                                    </h5>
                                    <p style="color: #94a3b8; font-size: 13px;">
                                        Data karyawan akan muncul di sini
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Hover Effect untuk Stat Cards ---
        document.querySelectorAll('.stat-card').forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)';
            });
        });

        // --- Auto Close Alert ---
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                const close = alert.querySelector('.btn-close');
                if (close) close.click();
            }, 5000);
        });
    });
</script>
@endsection