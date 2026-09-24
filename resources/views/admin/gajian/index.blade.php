@extends('layouts.app')

@section('title', 'Data Gajian - Admin')

@section('styles')
<style>
    /* ============================================================
       IMPORTS
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    body {
        background: #f0f2f8;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #6366f1;
        --primary-600: #4f46e5;
        --primary-700: #4338ca;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        --primary-gradient-dark: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        
        --success: #10b981;
        --success-bg: #ecfdf5;
        --warning: #f59e0b;
        --warning-bg: #fffbeb;
        --danger: #ef4444;
        --danger-bg: #fef2f2;
        --info: #3b82f6;
        --info-bg: #eff6ff;
        
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
        --shadow-lg: 0 12px 40px rgba(0,0,0,0.08);
        --shadow-xl: 0 20px 60px rgba(0,0,0,0.10);
        --shadow-glow: 0 8px 32px rgba(99, 102, 241, 0.25);
        
        --radius: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
        
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ============================================================
       HERO - KEREN DENGAN ANIMASI
    ============================================================ */
    .hero-keren {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        border-radius: var(--radius-xl);
        padding: 40px 44px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        color: white;
        box-shadow: 0 20px 60px rgba(15, 12, 41, 0.35);
        isolation: isolate;
    }

    /* Animasi Orbs */
    .hero-keren .orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }
    .hero-keren .orb-1 {
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
        top: -200px;
        right: -150px;
        animation: floatOrb 12s ease-in-out infinite;
    }
    .hero-keren .orb-2 {
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(168,85,247,0.10) 0%, transparent 70%);
        bottom: -150px;
        left: -100px;
        animation: floatOrb 15s ease-in-out infinite reverse;
    }
    .hero-keren .orb-3 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(251,191,36,0.06) 0%, transparent 70%);
        top: 40%;
        left: 40%;
        animation: floatOrb 18s ease-in-out infinite;
    }

    @keyframes floatOrb {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(40px, -30px) scale(1.05); }
        66% { transform: translate(-20px, 20px) scale(0.95); }
    }

    /* Grid Pattern */
    .hero-keren .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
        z-index: 0;
    }

    /* Partikel Bintang */
    .hero-keren .star {
        position: absolute;
        width: 2px;
        height: 2px;
        background: white;
        border-radius: 50%;
        opacity: 0.3;
        animation: twinkle 3s ease-in-out infinite;
    }
    .hero-keren .star:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
    .hero-keren .star:nth-child(2) { top: 60%; left: 25%; animation-delay: 0.5s; }
    .hero-keren .star:nth-child(3) { top: 30%; left: 70%; animation-delay: 1s; }
    .hero-keren .star:nth-child(4) { top: 75%; left: 85%; animation-delay: 1.5s; }
    .hero-keren .star:nth-child(5) { top: 45%; left: 50%; animation-delay: 2s; }
    .hero-keren .star:nth-child(6) { top: 15%; left: 90%; animation-delay: 2.5s; }

    @keyframes twinkle {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.5); }
    }

    .hero-keren .content {
        position: relative;
        z-index: 1;
    }

    .hero-keren .top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-keren .badge-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(12px);
        padding: 6px 20px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 10px;
    }
    .hero-keren .badge-date i {
        color: #a5b4fc;
        font-size: 13px;
    }

    .hero-keren h2 {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .hero-keren h2 .highlight {
        background: linear-gradient(90deg, #fcd34d, #fbbf24, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
    }
    .hero-keren h2 .highlight::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #fcd34d, #fbbf24);
        border-radius: 3px;
        opacity: 0.3;
    }

    .hero-keren p {
        opacity: 0.55;
        font-size: 14px;
        font-weight: 400;
    }

    .hero-keren .badge-company {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(12px);
        padding: 8px 22px;
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.06);
    }
    .hero-keren .badge-company i {
        color: #a5b4fc;
    }

    /* Floating Icon Animation */
    .hero-keren .floating-icon {
        position: absolute;
        font-size: 80px;
        opacity: 0.03;
        z-index: 0;
        animation: floatIcon 6s ease-in-out infinite;
    }
    .hero-keren .floating-icon.fa-1 { top: 10%; right: 15%; animation-delay: 0s; }
    .hero-keren .floating-icon.fa-2 { bottom: 15%; right: 30%; animation-delay: 2s; font-size: 60px; }
    .hero-keren .floating-icon.fa-3 { top: 50%; right: 45%; animation-delay: 4s; font-size: 50px; }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    /* ============================================================
       STATISTIK CARDS - PREMIUM
    ============================================================ */
    .stat-grid-keren {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-keren {
        background: white;
        border-radius: var(--radius-lg);
        padding: 24px 22px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }

    .stat-keren::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 0 0 4px 4px;
        opacity: 0;
        transition: var(--transition);
    }

    .stat-keren:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }

    .stat-keren:hover::before {
        opacity: 1;
    }

    .stat-keren.purple::before { background: var(--primary-gradient); }
    .stat-keren.green::before { background: var(--success); }
    .stat-keren.yellow::before { background: var(--warning); }
    .stat-keren.red::before { background: var(--danger); }

    .stat-keren .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .stat-keren .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: var(--transition-bounce);
    }

    .stat-keren:hover .stat-icon {
        transform: scale(1.08) rotate(-4deg);
    }

    .stat-keren .stat-icon.purple { background: #eef2ff; color: var(--primary); }
    .stat-keren .stat-icon.green { background: var(--success-bg); color: var(--success); }
    .stat-keren .stat-icon.yellow { background: var(--warning-bg); color: var(--warning); }
    .stat-keren .stat-icon.red { background: var(--danger-bg); color: var(--danger); }

    .stat-keren .stat-trend {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .stat-keren .stat-trend.up { background: var(--success-bg); color: var(--success); }
    .stat-keren .stat-trend.down { background: var(--danger-bg); color: var(--danger); }
    .stat-keren .stat-trend.stable { background: var(--gray-100); color: var(--gray-500); }

    .stat-keren .stat-number {
        font-size: 26px;
        font-weight: 800;
        color: var(--gray-900);
        line-height: 1.2;
        letter-spacing: -0.3px;
        margin-bottom: 2px;
    }

    .stat-keren .stat-number .currency {
        font-size: 15px;
        font-weight: 600;
        color: var(--gray-400);
        margin-right: 2px;
    }

    .stat-keren .stat-number.purple { color: var(--primary); }
    .stat-keren .stat-number.green { color: var(--success); }
    .stat-keren .stat-number.yellow { color: var(--warning); }
    .stat-keren .stat-number.red { color: var(--danger); }

    .stat-keren .stat-label {
        font-size: 13px;
        color: var(--gray-400);
        font-weight: 500;
    }

    /* Mini Progress Bar */
    .stat-keren .mini-bar {
        width: 100%;
        height: 3px;
        background: var(--gray-100);
        border-radius: 10px;
        margin-top: 10px;
        overflow: hidden;
    }

    .stat-keren .mini-bar .fill {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease;
    }

    .stat-keren .mini-bar .fill.purple { background: var(--primary-gradient); }
    .stat-keren .mini-bar .fill.green { background: var(--success); }
    .stat-keren .mini-bar .fill.yellow { background: var(--warning); }
    .stat-keren .mini-bar .fill.red { background: var(--danger); }

    /* ============================================================
       STATUS MINI CARDS - KEREN
    ============================================================ */
    .status-mini-grid-keren {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .status-mini-keren {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px 22px;
        border: 1px solid rgba(0,0,0,0.02);
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: var(--transition-bounce);
        cursor: default;
        position: relative;
        overflow: hidden;
    }

    .status-mini-keren::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        border-radius: 0 4px 4px 0;
        transition: var(--transition);
    }

    .status-mini-keren.green::before { background: var(--success); }
    .status-mini-keren.yellow::before { background: var(--warning); }
    .status-mini-keren.red::before { background: var(--danger); }

    .status-mini-keren:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .status-mini-keren .left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .status-mini-keren .left .dot-wrap {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .status-mini-keren .left .dot-wrap.green { background: var(--success-bg); color: var(--success); }
    .status-mini-keren .left .dot-wrap.yellow { background: var(--warning-bg); color: var(--warning); }
    .status-mini-keren .left .dot-wrap.red { background: var(--danger-bg); color: var(--danger); }

    .status-mini-keren .left .label {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 14px;
    }

    .status-mini-keren .left .sub {
        font-size: 12px;
        color: var(--gray-400);
        font-weight: 400;
    }

    .status-mini-keren .right {
        text-align: right;
    }

    .status-mini-keren .right .count {
        font-size: 24px;
        font-weight: 800;
        color: var(--gray-900);
        line-height: 1.2;
    }

    .status-mini-keren .right .status-text {
        font-size: 11px;
        font-weight: 600;
        display: block;
        margin-top: 2px;
    }

    .status-text.success { color: var(--success); }
    .status-text.warning { color: var(--warning); }
    .status-text.danger { color: var(--danger); }

    /* ============================================================
       FILTER SECTION - KEREN
    ============================================================ */
    .filter-keren {
        background: white;
        border-radius: var(--radius-lg);
        padding: 22px 26px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        margin-bottom: 28px;
        transition: var(--transition);
    }

    .filter-keren:hover {
        box-shadow: var(--shadow-md);
    }

    .filter-keren .form-control,
    .filter-keren .form-select {
        border-radius: var(--radius);
        border: 2px solid var(--gray-200);
        padding: 10px 16px;
        font-size: 14px;
        transition: var(--transition);
        background: var(--gray-50);
        height: 44px;
    }

    .filter-keren .form-control:focus,
    .filter-keren .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99,102,241,0.08);
        background: white;
        outline: none;
    }

    .filter-keren .form-label {
        font-weight: 600;
        color: var(--gray-700);
        font-size: 12px;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .filter-keren .form-label i {
        color: var(--primary);
        margin-right: 4px;
    }

    .btn-filter-keren {
        background: var(--primary-gradient);
        border: none;
        border-radius: var(--radius);
        padding: 10px 28px;
        font-weight: 600;
        color: white;
        transition: var(--transition-bounce);
        font-size: 14px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        box-shadow: 0 4px 16px rgba(99,102,241,0.15);
    }

    .btn-filter-keren:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow);
        color: white;
    }

    .btn-reset-keren {
        background: var(--gray-100);
        border: none;
        border-radius: var(--radius);
        padding: 10px 28px;
        font-weight: 600;
        color: var(--gray-600);
        transition: var(--transition);
        font-size: 14px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        text-decoration: none;
    }

    .btn-reset-keren:hover {
        background: var(--gray-200);
        color: var(--gray-800);
        transform: translateY(-2px);
    }

    /* ============================================================
       TABLE - KEREN
    ============================================================ */
    .table-keren {
        background: white;
        border-radius: var(--radius-xl);
        padding: 24px 24px 18px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: var(--transition);
    }

    .table-keren:hover {
        box-shadow: var(--shadow-md);
    }

    .table-keren .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-keren .header .left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .table-keren .header .left .icon-box {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(99,102,241,0.2);
    }

    .table-keren .header .left h5 {
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0;
        font-size: 17px;
    }

    .table-keren .header .left small {
        color: var(--gray-400);
        font-size: 12px;
        font-weight: 400;
        display: block;
    }

    .table-keren .header .count-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 7px 20px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 16px rgba(99,102,241,0.2);
    }

    .table-keren .table-wrap {
        overflow-x: auto;
        border-radius: var(--radius);
    }

    .table-keren table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-keren table thead th {
        background: var(--gray-50);
        color: var(--gray-500);
        font-weight: 700;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-bottom: 1.5px solid var(--gray-200);
        text-align: left;
        white-space: nowrap;
    }

    .table-keren table thead th i {
        margin-right: 6px;
        opacity: 0.4;
    }

    .table-keren table thead th:last-child {
        text-align: center;
    }

    .table-keren table tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-100);
        font-size: 13px;
        color: var(--gray-700);
    }

    .table-keren table tbody tr {
        transition: var(--transition);
    }

    .table-keren table tbody tr:hover {
        background: var(--gray-50);
    }

    .table-keren table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ============================================================
       USER INFO
    ============================================================ */
    .user-info-keren {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-info-keren .avatar {
        width: 38px;
        height: 38px;
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
        box-shadow: 0 2px 8px rgba(99,102,241,0.15);
        transition: var(--transition-bounce);
    }

    .user-info-keren .avatar:hover {
        transform: scale(1.08);
    }

    .user-info-keren .avatar.green { background: linear-gradient(135deg, #34d399, #059669); }
    .user-info-keren .avatar.orange { background: linear-gradient(135deg, #fbbf24, #d97706); }
    .user-info-keren .avatar.blue { background: linear-gradient(135deg, #60a5fa, #2563eb); }
    .user-info-keren .avatar.pink { background: linear-gradient(135deg, #f472b6, #db2777); }
    .user-info-keren .avatar.purple { background: var(--primary-gradient); }
    .user-info-keren .avatar.teal { background: linear-gradient(135deg, #2dd4bf, #0d9488); }
    .user-info-keren .avatar.rose { background: linear-gradient(135deg, #fb7185, #e11d48); }
    .user-info-keren .avatar.indigo { background: linear-gradient(135deg, #818cf8, #4f46e5); }
    .user-info-keren .avatar.amber { background: linear-gradient(135deg, #fcd34d, #b45309); }

    .user-info-keren .info .name {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 13px;
        display: block;
    }

    .user-info-keren .info .email {
        font-size: 11px;
        color: var(--gray-400);
        font-weight: 400;
        display: block;
        margin-top: 1px;
    }

    /* ============================================================
       STATUS BADGE - KEREN
    ============================================================ */
    .status-badge-keren {
        padding: 5px 16px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.2px;
        text-transform: capitalize;
        transition: var(--transition);
    }

    .status-badge-keren:hover {
        transform: scale(1.03);
    }

    .status-badge-keren .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }

    .badge-draft { background: var(--gray-100); color: var(--gray-500); }
    .badge-draft .dot { background: var(--gray-400); }

    .badge-proses { 
        background: var(--warning-bg); 
        color: var(--warning);
        animation: pulseBadge 2s ease-in-out infinite;
    }
    .badge-proses .dot { background: var(--warning); }

    .badge-dibayar { background: var(--success-bg); color: var(--success); }
    .badge-dibayar .dot { background: var(--success); }

    .badge-batal { background: var(--danger-bg); color: var(--danger); }
    .badge-batal .dot { background: var(--danger); }

    @keyframes pulseBadge {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.65; }
    }

    /* ============================================================
       ACTION BUTTONS - KEREN
    ============================================================ */
    .action-group-keren {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .btn-action-keren {
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
        flex-shrink: 0;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .btn-action-keren::before {
        content: '';
        position: absolute;
        inset: 0;
        background: currentColor;
        opacity: 0;
        transition: var(--transition);
        border-radius: inherit;
    }

    .btn-action-keren:hover::before {
        opacity: 0.08;
    }

    .btn-action-keren:hover {
        transform: scale(1.12) translateY(-2px);
        text-decoration: none;
    }

    .btn-action-keren.view {
        background: #eef2ff;
        color: var(--primary);
    }
    .btn-action-keren.view:hover {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 16px rgba(99,102,241,0.3);
    }

    .btn-action-keren.edit {
        background: var(--warning-bg);
        color: var(--warning);
    }
    .btn-action-keren.edit:hover {
        background: var(--warning);
        color: white;
        box-shadow: 0 4px 16px rgba(245,158,11,0.3);
    }

    .btn-action-keren.delete {
        background: var(--danger-bg);
        color: var(--danger);
    }
    .btn-action-keren.delete:hover {
        background: var(--danger);
        color: white;
        box-shadow: 0 4px 16px rgba(239,68,68,0.3);
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-keren {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-keren .icon-wrap {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 36px;
        color: var(--gray-300);
        transition: var(--transition-bounce);
    }

    .empty-keren:hover .icon-wrap {
        transform: scale(1.05) rotate(-6deg);
        background: var(--gray-200);
        color: var(--gray-400);
    }

    .empty-keren h5 {
        color: var(--gray-700);
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 4px;
    }

    .empty-keren p {
        color: var(--gray-400);
        font-size: 13px;
        font-weight: 400;
    }

    /* ============================================================
       MODAL - KEREN
    ============================================================ */
    .modal-keren .modal-content {
        border-radius: var(--radius-xl) !important;
        border: none !important;
        overflow: hidden;
        box-shadow: var(--shadow-xl) !important;
        background: white;
    }

    .modal-keren .modal-header {
        padding: 24px 28px !important;
        border: none !important;
        background: var(--primary-gradient-dark);
        color: white;
    }

    .modal-keren .modal-header .modal-title {
        font-weight: 700;
        font-size: 18px;
        letter-spacing: -0.2px;
    }

    .modal-keren .modal-header .btn-close {
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        opacity: 1;
    }

    .modal-keren .modal-header .btn-close:hover {
        background: rgba(255,255,255,0.25);
        transform: rotate(90deg);
    }

    .modal-keren .modal-body {
        padding: 28px !important;
    }

    .modal-keren .modal-footer {
        padding: 16px 28px !important;
        border-top: 1px solid var(--gray-100) !important;
    }

    .modal-keren .form-control,
    .modal-keren .form-select {
        border-radius: var(--radius) !important;
        border: 2px solid var(--gray-200) !important;
        padding: 10px 16px !important;
        transition: var(--transition);
        font-size: 14px;
        background: white;
    }

    .modal-keren .form-control:focus,
    .modal-keren .form-select:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 4px rgba(99,102,241,0.08) !important;
        outline: none;
    }

    .modal-keren .form-label {
        font-weight: 600;
        font-size: 13px;
        color: var(--gray-700);
        margin-bottom: 6px;
        display: block;
    }

    .modal-keren .form-label i {
        color: var(--primary);
        margin-right: 6px;
    }

    .btn-modal-keren {
        background: var(--primary-gradient);
        border: none !important;
        border-radius: var(--radius) !important;
        padding: 10px 32px !important;
        font-weight: 600;
        color: white;
        transition: var(--transition-bounce);
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-modal-keren:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: var(--shadow-glow);
        color: white;
    }

    .btn-modal-secondary {
        background: var(--gray-100);
        border: none !important;
        border-radius: var(--radius) !important;
        padding: 10px 32px !important;
        font-weight: 600;
        color: var(--gray-600);
        transition: var(--transition);
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-modal-secondary:hover {
        background: var(--gray-200);
        color: var(--gray-800);
    }

    /* ============================================================
       ANIMATIONS
    ============================================================ */
    .fade-up-keren {
        opacity: 0;
        animation: fadeUpKeren 0.6s ease forwards;
    }

    @keyframes fadeUpKeren {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-up-keren:nth-child(1) { animation-delay: 0.04s; }
    .fade-up-keren:nth-child(2) { animation-delay: 0.08s; }
    .fade-up-keren:nth-child(3) { animation-delay: 0.12s; }
    .fade-up-keren:nth-child(4) { animation-delay: 0.16s; }

    .slide-in-keren {
        opacity: 0;
        animation: slideInKeren 0.5s ease forwards;
    }

    @keyframes slideInKeren {
        from {
            opacity: 0;
            transform: translateX(-16px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .slide-in-keren:nth-child(1) { animation-delay: 0.03s; }
    .slide-in-keren:nth-child(2) { animation-delay: 0.06s; }
    .slide-in-keren:nth-child(3) { animation-delay: 0.09s; }
    .slide-in-keren:nth-child(4) { animation-delay: 0.12s; }
    .slide-in-keren:nth-child(5) { animation-delay: 0.15s; }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .stat-grid-keren {
            grid-template-columns: repeat(4, 1fr);
        }
        .hero-keren h2 {
            font-size: 28px;
        }
    }

    @media (max-width: 992px) {
        .stat-grid-keren {
            grid-template-columns: repeat(2, 1fr);
        }
        .status-mini-grid-keren {
            grid-template-columns: repeat(3, 1fr);
        }
        .hero-keren {
            padding: 30px 26px;
        }
        .hero-keren .top-row {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .stat-grid-keren {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .status-mini-grid-keren {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .hero-keren {
            padding: 24px 20px;
            border-radius: var(--radius-lg);
        }

        .hero-keren h2 {
            font-size: 22px;
        }

        .hero-keren p {
            font-size: 13px;
        }

        .hero-keren .badge-company {
            padding: 6px 16px;
            font-size: 12px;
        }

        .filter-keren {
            padding: 16px 18px;
        }

        .filter-keren .form-control,
        .filter-keren .form-select {
            height: 38px;
            font-size: 13px;
            padding: 6px 12px;
        }

        .btn-filter-keren,
        .btn-reset-keren {
            height: 38px;
            font-size: 13px;
            padding: 6px 18px;
        }

        .table-keren {
            padding: 14px;
            border-radius: var(--radius-lg);
        }

        .table-keren .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .table-keren .header .left .icon-box {
            width: 38px;
            height: 38px;
            font-size: 15px;
        }

        .table-keren .header .left h5 {
            font-size: 15px;
        }

        .table-keren .header .count-badge {
            padding: 5px 16px;
            font-size: 11px;
        }

        .user-info-keren .avatar {
            width: 32px;
            height: 32px;
            font-size: 11px;
        }

        .user-info-keren .info .name {
            font-size: 12px;
        }

        .user-info-keren .info .email {
            font-size: 10px;
        }

        .status-badge-keren {
            font-size: 10px;
            padding: 3px 12px;
        }

        .btn-action-keren {
            width: 30px;
            height: 30px;
            font-size: 11px;
        }

        .table-keren table thead th {
            font-size: 9px;
            padding: 8px 10px;
        }

        .table-keren table tbody td {
            font-size: 12px;
            padding: 8px 10px;
        }

        .stat-keren {
            padding: 16px 14px;
        }

        .stat-keren .stat-number {
            font-size: 20px;
        }

        .stat-keren .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .modal-keren .modal-body {
            padding: 20px !important;
        }

        .modal-keren .modal-header {
            padding: 18px 20px !important;
        }

        .modal-keren .modal-footer {
            padding: 14px 20px !important;
        }
    }

    @media (max-width: 480px) {
        .stat-grid-keren {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .status-mini-grid-keren {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .stat-keren {
            padding: 12px 10px;
        }

        .stat-keren .stat-number {
            font-size: 17px;
        }

        .stat-keren .stat-icon {
            width: 34px;
            height: 34px;
            font-size: 14px;
        }

        .stat-keren .stat-label {
            font-size: 10px;
        }

        .stat-keren .stat-trend {
            font-size: 9px;
            padding: 2px 8px;
        }

        .hero-keren h2 {
            font-size: 18px;
        }

        .hero-keren .badge-date {
            font-size: 10px;
            padding: 4px 14px;
        }

        .hero-keren .badge-company {
            padding: 4px 12px;
            font-size: 11px;
        }

        .status-mini-keren {
            padding: 14px 16px;
        }

        .status-mini-keren .left .dot-wrap {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

        .status-mini-keren .left .label {
            font-size: 12px;
        }

        .status-mini-keren .left .sub {
            font-size: 10px;
        }

        .status-mini-keren .right .count {
            font-size: 18px;
        }

        .status-mini-keren .right .status-text {
            font-size: 9px;
        }

        .table-keren {
            padding: 10px;
        }

        .table-keren table thead th {
            font-size: 8px;
            padding: 6px 6px;
            letter-spacing: 0.2px;
        }

        .table-keren table tbody td {
            font-size: 11px;
            padding: 6px 6px;
        }

        .user-info-keren .avatar {
            width: 28px;
            height: 28px;
            font-size: 10px;
        }

        .user-info-keren .info .name {
            font-size: 11px;
        }

        .user-info-keren .info .email {
            font-size: 9px;
        }

        .status-badge-keren {
            font-size: 9px;
            padding: 2px 10px;
        }

        .status-badge-keren .dot {
            width: 5px;
            height: 5px;
        }

        .btn-action-keren {
            width: 26px;
            height: 26px;
            font-size: 9px;
            border-radius: 6px;
        }

        .action-group-keren {
            gap: 3px;
        }
    }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar {
        width: 5px;
        height: 5px;
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
<div class="container-fluid">
    
    <!-- ============================================================
    HERO - KEREN
    ============================================================ -->
    <div class="hero-keren fade-up-keren">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grid-pattern"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <i class="fas fa-money-bill-wave floating-icon fa-1"></i>
        <i class="fas fa-coins floating-icon fa-2"></i>
        <i class="fas fa-chart-line floating-icon fa-3"></i>

        <div class="content">
            <div class="top-row">
                <div>
                    <div class="badge-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <h2>
                        <i class="fas fa-money-bill-wave me-2" style="color: #fcd34d;"></i>
                        Data <span class="highlight">Gajian</span>
                    </h2>
                    <p>
                        <i class="fas fa-chart-line me-2"></i>
                        Kelola data gajian semua karyawan dengan mudah
                    </p>
                </div>
                <div>
                    <span class="badge-company">
                        <i class="fas fa-building"></i>
                        Karya Jaya Las Konstruksi
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STATISTIK - KEREN
    ============================================================ -->
    <div class="stat-grid-keren">
        <div class="stat-keren purple fade-up-keren">
            <div class="stat-top">
                <div class="stat-icon purple">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> +12%
                </span>
            </div>
            <div class="stat-number purple">
                <span class="currency">Rp</span> {{ number_format($totalGaji ?? 0, 0, ',', '.') }}
            </div>
            <div class="stat-label">Total Gaji</div>
            <div class="mini-bar">
                <div class="fill purple" style="width: 75%;"></div>
            </div>
        </div>

        <div class="stat-keren green fade-up-keren">
            <div class="stat-top">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <span class="stat-trend stable">
                    <i class="fas fa-check"></i> Selesai
                </span>
            </div>
            <div class="stat-number green">{{ $totalDibayar ?? 0 }}</div>
            <div class="stat-label">Dibayar</div>
            <div class="mini-bar">
                <div class="fill green" style="width: 60%;"></div>
            </div>
        </div>

        <div class="stat-keren yellow fade-up-keren">
            <div class="stat-top">
                <div class="stat-icon yellow">
                    <i class="fas fa-spinner"></i>
                </div>
                <span class="stat-trend stable">
                    <i class="fas fa-clock"></i> Menunggu
                </span>
            </div>
            <div class="stat-number yellow">{{ $totalProses ?? 0 }}</div>
            <div class="stat-label">Diproses</div>
            <div class="mini-bar">
                <div class="fill yellow" style="width: 35%;"></div>
            </div>
        </div>

        <div class="stat-keren red fade-up-keren">
            <div class="stat-top">
                <div class="stat-icon red">
                    <i class="fas fa-times-circle"></i>
                </div>
                <span class="stat-trend down">
                    <i class="fas fa-ban"></i> Dibatalkan
                </span>
            </div>
            <div class="stat-number red">{{ $totalBatal ?? 0 }}</div>
            <div class="stat-label">Batal</div>
            <div class="mini-bar">
                <div class="fill red" style="width: 15%;"></div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    STATUS MINI CARDS - KEREN
    ============================================================ -->
    <div class="status-mini-grid-keren">
        <div class="status-mini-keren green fade-up-keren">
            <div class="left">
                <div class="dot-wrap green">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <div class="label">Dibayar</div>
                    <div class="sub">Gaji sudah dibayarkan</div>
                </div>
            </div>
            <div class="right">
                <div class="count">{{ $totalDibayar ?? 0 }}</div>
                <span class="status-text success">✔ Selesai</span>
            </div>
        </div>

        <div class="status-mini-keren yellow fade-up-keren">
            <div class="left">
                <div class="dot-wrap yellow">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="label">Diproses</div>
                    <div class="sub">Gaji sedang diproses</div>
                </div>
            </div>
            <div class="right">
                <div class="count">{{ $totalProses ?? 0 }}</div>
                <span class="status-text warning">⏳ Menunggu</span>
            </div>
        </div>

        <div class="status-mini-keren red fade-up-keren">
            <div class="left">
                <div class="dot-wrap red">
                    <i class="fas fa-ban"></i>
                </div>
                <div>
                    <div class="label">Batal</div>
                    <div class="sub">Gaji dibatalkan</div>
                </div>
            </div>
            <div class="right">
                <div class="count">{{ $totalBatal ?? 0 }}</div>
                <span class="status-text danger">✖ Dibatalkan</span>
            </div>
        </div>
    </div>

    <!-- ============================================================
    FILTER - KEREN
    ============================================================ -->
    <div class="filter-keren fade-up-keren">
        <form method="GET" action="{{ route('admin.gajian') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">
                    <i class="fas fa-user"></i> Karyawan
                </label>
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
                <label class="form-label">
                    <i class="fas fa-tag"></i> Status
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
            <div class="col-md-3">
                <label class="form-label">
                    <i class="fas fa-calendar"></i> Tanggal
                </label>
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-filter-keren">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.gajian') }}" class="btn-reset-keren">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ============================================================
    TABLE - KEREN
    ============================================================ -->
    <div class="table-keren fade-up-keren">
        <div class="header">
            <div class="left">
                <div class="icon-box">
                    <i class="fas fa-list"></i>
                </div>
                <div>
                    <h5>Daftar Gajian</h5>
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
                        <th style="width: 50px;"><i class="fas fa-hashtag"></i></th>
                        <th style="min-width: 200px;"><i class="fas fa-user"></i> Karyawan</th>
                        <th><i class="fas fa-calendar"></i> Tanggal Gaji</th>
                        <th><i class="fas fa-clock"></i> Periode</th>
                        <th><i class="fas fa-money-bill"></i> Total Gaji</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th style="text-align: center; min-width: 120px;"><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gajian ?? [] as $item)
                        @php
                            $colors = ['purple', 'green', 'orange', 'blue', 'pink', 'teal', 'rose', 'indigo', 'amber'];
                            $color = $colors[$loop->index % count($colors)];
                            $inisial = strtoupper(substr($item->user->name ?? 'U', 0, 2));
                            $status = $item->status ?? 'draft';
                        @endphp
                        <tr class="slide-in-keren" style="animation-delay: {{ $loop->index * 0.03 }}s;">
                            <td>
                                <span style="font-weight: 700; color: var(--gray-400); font-size: 12px;">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="user-info-keren">
                                    <div class="avatar {{ $color }}">
                                        {{ $inisial }}
                                    </div>
                                    <div class="info">
                                        <span class="name">{{ $item->user->name ?? '-' }}</span>
                                        <span class="email">
                                            <i class="fas fa-envelope me-1"></i>
                                            {{ $item->user->email ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($item->tanggal_gaji)->isoFormat('dddd, D MMMM YYYY') }}
                                </span>
                                <br>
                                <small class="text-muted" style="font-size: 10px;">
                                    <i class="far fa-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB
                                </small>
                            </td>
                            <td>
                                @if($item->periode)
                                    <span class="badge" style="background: var(--gray-100); color: var(--gray-600); font-size: 11px; padding: 4px 12px; border-radius: var(--radius-full); font-weight: 600;">
                                        {{ $item->periode }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-weight: 700; color: var(--primary); font-size: 14px;">
                                    Rp {{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge-keren badge-{{ $status }}">
                                    <span class="dot"></span>
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="action-group-keren">
                                    <!-- Detail -->
                                    <a href="{{ route('admin.gajian.detail', $item->id) }}" 
                                       class="btn-action-keren view" title="Detail Gajian">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Ubah Status -->
                                    <button class="btn-action-keren edit" title="Ubah Status" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalStatus{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Hapus -->
                                    <form action="{{ route('admin.gajian.delete', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data gajian ini? Data yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-keren delete" title="Hapus Gajian">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-keren">
                                    <div class="icon-wrap">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h5>Belum Ada Data Gajian</h5>
                                    <p>Belum ada data gajian yang tersedia saat ini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($gajian->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $gajian->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<!-- ============================================================
MODAL STATUS - KEREN
============================================================ -->
@foreach($gajian ?? [] as $item)
    <div class="modal modal-keren fade" id="modalStatus{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Ubah Status Gajian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.gajian.update-status', $item->id) }}" id="formStatus{{ $item->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-info-circle"></i>Status
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="draft" {{ ($item->status ?? '') == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                                <option value="proses" {{ ($item->status ?? '') == 'proses' ? 'selected' : '' }}>⏳ Proses</option>
                                <option value="dibayar" {{ ($item->status ?? '') == 'dibayar' ? 'selected' : '' }}>✅ Dibayar</option>
                                <option value="batal" {{ ($item->status ?? '') == 'batal' ? 'selected' : '' }}>❌ Batal</option>
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">
                                <i class="fas fa-sticky-note"></i>Keterangan
                            </label>
                            <textarea name="keterangan" class="form-control" rows="3" 
                                      placeholder="Tambahkan keterangan (opsional)">{{ $item->keterangan ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-keren">
                            <i class="fas fa-save"></i> Simpan
                        </button>
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
        // ===== LOADING STATE PADA SUBMIT =====
        document.querySelectorAll('form[id^="formStatus"]').forEach(function(form) {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('.btn-modal-keren');
                if (btn) {
                    const original = btn.innerHTML;
                    btn.innerHTML = `
                        <span class="spinner-border spinner-border-sm me-2" style="width: 14px; height: 14px;"></span>
                        Menyimpan...
                    `;
                    btn.disabled = true;
                    setTimeout(() => {
                        btn.innerHTML = original;
                        btn.disabled = false;
                    }, 3000);
                }
            });
        });

        // ===== ANIMASI PROGRESS BAR =====
        document.querySelectorAll('.mini-bar .fill').forEach(function(bar) {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(function() {
                bar.style.width = width;
            }, 300);
        });

        // ===== AUTO CLOSE ALERTS =====
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                const close = alert.querySelector('.btn-close');
                if (close) close.click();
            }, 5000);
        });

        // ===== KEYBOARD SHORTCUT =====
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[name="search"]');
                if (searchInput) searchInput.focus();
            }
        });

        // ===== TOOLTIP UNTUK ACTION BUTTON =====
        document.querySelectorAll('.btn-action-keren').forEach(function(btn) {
            btn.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
            });
        });
    });
</script>
@endsection