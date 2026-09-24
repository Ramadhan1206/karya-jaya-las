@extends('layouts.app')

@section('title', 'Pengaturan - Karya Jaya Las Konstruksi')

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
        background: #f5f7fb;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #1e293b;
    }

    /* ============================================================
       VARIABLES
    ============================================================ */
    :root {
        --primary: #6366f1;
        --primary-50: #eef2ff;
        --primary-100: #e0e7ff;
        --primary-200: #c7d2fe;
        --primary-500: #6366f1;
        --primary-600: #4f46e5;
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

    .animate-in {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .animate-in:nth-child(1) { animation-delay: 0.05s; }
    .animate-in:nth-child(2) { animation-delay: 0.10s; }
    .animate-in:nth-child(3) { animation-delay: 0.15s; }
    .animate-in:nth-child(4) { animation-delay: 0.20s; }
    .animate-in:nth-child(5) { animation-delay: 0.25s; }

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
        opacity: 0.35;
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

    .bg-decoration .orb-3 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #bae6fd, #a5f3fc);
        top: 40%;
        left: 40%;
        opacity: 0.15;
        animation: float 14s ease-in-out infinite;
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

    .page-header .right .status-badge {
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

    .page-header .right .status-badge::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.08), transparent);
        background-size: 200% 100%;
        animation: shimmer 2.5s infinite;
    }

    .page-header .right .status-badge .dot {
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
       LAYOUT
    ============================================================ */
    .settings-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 24px;
        align-items: start;
        position: relative;
        z-index: 1;
    }

    /* ============================================================
       SIDEBAR
    ============================================================ */
    .settings-sidebar {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 14px;
        position: sticky;
        top: 20px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
    }

    .settings-sidebar:hover {
        box-shadow: var(--shadow-md);
    }

    .settings-sidebar .sidebar-header {
        padding: 8px 14px 14px;
        border-bottom: 1px solid var(--gray-100);
        margin-bottom: 10px;
    }

    .settings-sidebar .sidebar-header .label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--gray-400);
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: 'JetBrains Mono', monospace;
    }

    .settings-sidebar .sidebar-header .label::before {
        content: '';
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--primary);
        box-shadow: 0 0 8px var(--primary);
        animation: pulse 2s ease-in-out infinite;
    }

    .settings-sidebar .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 14px;
        border-radius: var(--radius-md);
        font-size: 13px;
        font-weight: 500;
        color: var(--gray-600);
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
        margin-bottom: 3px;
        border: 1px solid transparent;
        background: transparent;
        width: 100%;
        text-align: left;
        position: relative;
        font-family: 'Inter', sans-serif;
    }

    .settings-sidebar .nav-item:last-child {
        margin-bottom: 0;
    }

    .settings-sidebar .nav-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%) scaleY(0);
        width: 3px;
        height: 60%;
        background: var(--primary-gradient);
        border-radius: 0 3px 3px 0;
        transition: var(--transition);
    }

    .settings-sidebar .nav-item:hover {
        background: var(--gray-50);
        color: var(--gray-900);
        border-color: var(--gray-200);
    }

    .settings-sidebar .nav-item:hover::before {
        transform: translateY(-50%) scaleY(1);
    }

    .settings-sidebar .nav-item.active {
        background: linear-gradient(135deg, var(--primary-50), #f5f3ff);
        color: var(--primary-600);
        font-weight: 600;
        border-color: var(--primary-200);
        box-shadow: 0 2px 12px rgba(99, 102, 241, 0.1);
    }

    .settings-sidebar .nav-item.active::before {
        transform: translateY(-50%) scaleY(1);
    }

    .settings-sidebar .nav-item .nav-icon {
        width: 34px;
        height: 34px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
        background: var(--gray-100);
        color: var(--gray-500);
        transition: var(--transition-bounce);
        border: 1px solid transparent;
    }

    .settings-sidebar .nav-item:hover .nav-icon {
        transform: scale(1.08);
        background: var(--primary-50);
        color: var(--primary);
        border-color: var(--primary-200);
    }

    .settings-sidebar .nav-item.active .nav-icon {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    /* ============================================================
       CARDS
    ============================================================ */
    .settings-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .settings-card {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: var(--transition-smooth);
        box-shadow: var(--shadow-sm);
    }

    .settings-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .settings-card:hover::before {
        transform: scaleX(1);
    }

    .settings-card:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    /* Card Header */
    .settings-card .card-head {
        padding: 22px 26px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        position: relative;
    }

    .settings-card .card-head .left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .settings-card .card-head .left .head-icon {
        width: 46px;
        height: 46px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        position: relative;
        transition: var(--transition-bounce);
    }

    .settings-card:hover .card-head .left .head-icon {
        transform: scale(1.06) rotate(-3deg);
    }

    .settings-card .card-head .left .head-icon.indigo {
        background: var(--primary-50);
        color: var(--primary-600);
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.15);
    }

    .settings-card .card-head .left .head-icon.green {
        background: var(--success-50);
        color: var(--success);
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.15);
    }

    .settings-card .card-head .left .head-icon.purple {
        background: #f5f3ff;
        color: #8b5cf6;
        box-shadow: 0 4px 16px rgba(139, 92, 246, 0.15);
    }

    .settings-card .card-head .left .head-icon.amber {
        background: var(--warning-50);
        color: var(--warning);
        box-shadow: 0 4px 16px rgba(245, 158, 11, 0.15);
    }

    .settings-card .card-head .left .head-icon.pink {
        background: #fdf2f8;
        color: #ec4899;
        box-shadow: 0 4px 16px rgba(236, 72, 153, 0.15);
    }

    .settings-card .card-head .left .head-title h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .settings-card .card-head .left .head-title p {
        font-size: 12px;
        color: var(--gray-500);
        margin: 2px 0 0;
        font-weight: 400;
    }

    .settings-card .card-head .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        padding: 6px 14px;
        border-radius: var(--radius-full);
        font-size: 10px;
        font-weight: 700;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-family: 'JetBrains Mono', monospace;
    }

    .settings-card .card-head .badge i {
        font-size: 9px;
        color: var(--primary);
    }

    /* ============================================================
       INFO ROWS
    ============================================================ */
    .info-list {
        display: flex;
        flex-direction: column;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 26px;
        border-bottom: 1px solid var(--gray-100);
        transition: var(--transition);
        gap: 16px;
        position: relative;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: var(--transition);
    }

    .info-row:hover {
        background: linear-gradient(90deg, var(--primary-50) 0%, transparent 60%);
    }

    .info-row:hover::before {
        opacity: 1;
    }

    .info-row .label {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        font-weight: 500;
        color: var(--gray-600);
        min-width: 0;
    }

    .info-row .label .label-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
        background: var(--gray-100);
        color: var(--gray-500);
        transition: var(--transition);
        border: 1px solid transparent;
    }

    .info-row:hover .label .label-icon {
        background: var(--primary-50);
        color: var(--primary);
        border-color: var(--primary-200);
        transform: scale(1.08);
    }

    .info-row .value {
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-900);
        text-align: right;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .info-row .value .code-badge {
        background: var(--gray-50);
        color: var(--gray-700);
        padding: 5px 14px;
        border-radius: var(--radius-sm);
        font-size: 11px;
        font-weight: 600;
        font-family: 'JetBrains Mono', monospace;
        letter-spacing: 0.3px;
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .info-row:hover .value .code-badge {
        border-color: var(--primary-200);
        color: var(--primary-700);
        background: var(--primary-50);
    }

    .info-row .value .code-badge.primary {
        background: var(--primary-50);
        color: var(--primary-700);
        border-color: var(--primary-200);
    }

    .info-row .value .code-badge.success {
        background: var(--success-50);
        color: #065f46;
        border-color: #a7f3d0;
    }

    /* ============================================================
       STATUS BADGES
    ============================================================ */
    .status-badge-custom {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.4px;
        border: 1px solid transparent;
        font-family: 'JetBrains Mono', monospace;
        text-transform: uppercase;
    }

    .status-badge-custom .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 2s ease-in-out infinite;
    }

    .status-badge-custom.success {
        background: var(--success-50);
        color: #065f46;
        border-color: #a7f3d0;
    }
    .status-badge-custom.success .dot { 
        background: var(--success);
        box-shadow: 0 0 6px var(--success);
    }

    .status-badge-custom.warning {
        background: var(--warning-50);
        color: #92400e;
        border-color: #fde68a;
    }
    .status-badge-custom.warning .dot { 
        background: var(--warning);
        box-shadow: 0 0 6px var(--warning);
    }

    .status-badge-custom.danger {
        background: var(--danger-50);
        color: #991b1b;
        border-color: #fecaca;
    }
    .status-badge-custom.danger .dot { 
        background: var(--danger);
        box-shadow: 0 0 6px var(--danger);
    }

    .status-badge-custom.info {
        background: var(--info-50);
        color: #1e40af;
        border-color: #bfdbfe;
    }
    .status-badge-custom.info .dot { 
        background: var(--info);
        box-shadow: 0 0 6px var(--info);
    }

    /* ============================================================
       COMING SOON CARDS
    ============================================================ */
    .coming-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        padding: 24px 26px;
    }

    .coming-card {
        position: relative;
        background: var(--gray-50);
        border: 1.5px dashed var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 26px 20px;
        text-align: center;
        transition: var(--transition-bounce);
        cursor: default;
        overflow: hidden;
    }

    .coming-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .coming-card:hover::before {
        transform: scaleX(1);
    }

    .coming-card:hover {
        border-color: var(--primary-200);
        border-style: solid;
        background: white;
        transform: translateY(-6px) scale(1.02);
        box-shadow: var(--shadow-lg);
    }

    .coming-card .card-icon {
        width: 58px;
        height: 58px;
        border-radius: var(--radius-md);
        background: white;
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 24px;
        color: var(--gray-400);
        transition: var(--transition-bounce);
        position: relative;
        z-index: 1;
    }

    .coming-card:hover .card-icon {
        background: var(--primary-gradient);
        border-color: transparent;
        color: white;
        transform: scale(1.1) rotate(-6deg);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
    }

    .coming-card h6 {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 6px;
        letter-spacing: -0.1px;
        position: relative;
        z-index: 1;
    }

    .coming-card p {
        font-size: 12px;
        color: var(--gray-500);
        margin: 0;
        font-weight: 400;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    .coming-card .status-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 16px;
        padding: 4px 14px;
        border-radius: var(--radius-full);
        font-size: 9px;
        font-weight: 700;
        background: var(--warning-50);
        color: #92400e;
        border: 1px solid #fde68a;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'JetBrains Mono', monospace;
        position: relative;
        z-index: 1;
    }

    .coming-card .status-tag .dot {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--warning);
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 0 6px var(--warning);
    }

    /* ============================================================
       ALERT
    ============================================================ */
    .custom-alert {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 22px;
        border-radius: var(--radius-md);
        background: var(--success-50);
        border: 1px solid #a7f3d0;
        border-left: 3px solid var(--success);
        margin-bottom: 24px;
        animation: fadeInUp 0.4s ease;
        position: relative;
        z-index: 1;
    }

    .custom-alert .alert-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--success);
        font-size: 15px;
        flex-shrink: 0;
        box-shadow: var(--shadow-sm);
    }

    .custom-alert .alert-text {
        font-size: 13px;
        font-weight: 500;
        color: #065f46;
        flex: 1;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1200px) {
        .coming-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 992px) {
        .settings-layout {
            grid-template-columns: 1fr;
        }

        .settings-sidebar {
            position: static;
            display: flex;
            overflow-x: auto;
            gap: 8px;
            padding: 10px;
            scrollbar-width: none;
        }

        .settings-sidebar::-webkit-scrollbar {
            display: none;
        }

        .settings-sidebar .sidebar-header {
            display: none;
        }

        .settings-sidebar .nav-item {
            flex-shrink: 0;
            padding: 10px 16px;
            margin-bottom: 0;
            width: auto;
        }

        .settings-sidebar .nav-item::before {
            display: none;
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
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px 18px;
        }

        .page-header .header-content {
            flex-direction: column;
            align-items: flex-start;
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

        .page-header .right {
            width: 100%;
        }

        .page-header .right .status-badge {
            width: 100%;
            justify-content: center;
            font-size: 12px;
        }

        .coming-grid {
            grid-template-columns: 1fr;
            gap: 12px;
            padding: 18px;
        }

        .info-row {
            padding: 14px 18px;
        }

        .settings-card .card-head {
            padding: 18px;
        }

        .settings-card .card-head .left .head-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .settings-card .card-head .left .head-title h5 {
            font-size: 14px;
        }

        .info-row .label {
            font-size: 12px;
        }

        .info-row .value {
            font-size: 12px;
        }

        .info-row .label .label-icon {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 18px 16px;
            border-radius: var(--radius-lg);
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

        .settings-card .card-head {
            padding: 14px;
        }

        .settings-card .card-head .left .head-icon {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .settings-card .card-head .left .head-title h5 {
            font-size: 13px;
        }

        .settings-card .card-head .left .head-title p {
            font-size: 11px;
        }

        .settings-card .card-head .badge {
            font-size: 9px;
            padding: 4px 10px;
        }

        .info-row {
            padding: 12px 14px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .info-row .value {
            text-align: left;
            width: 100%;
        }

        .info-row .label {
            font-size: 11px;
        }

        .info-row .value .code-badge {
            font-size: 10px;
            padding: 4px 10px;
        }

        .status-badge-custom {
            font-size: 9px;
            padding: 4px 10px;
        }

        .coming-card {
            padding: 20px 16px;
        }

        .coming-card .card-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .coming-card h6 {
            font-size: 13px;
        }

        .coming-card p {
            font-size: 11px;
        }
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
    <div class="orb orb-3"></div>
</div>

<div class="container-fluid" style="position: relative; z-index: 1;">

    <!-- ============================================================
    PAGE HEADER
    ============================================================ -->
    <div class="page-header animate-in">
        <div class="header-content">
            <div class="left">
                <div class="icon-orb">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="title-wrap">
                    <h1>
                        Pengaturan <span class="gradient-text">Sistem</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Kelola konfigurasi dan informasi sistem Anda
                    </p>
                </div>
            </div>
            <div class="right">
                <span class="status-badge">
                    <span class="dot"></span>
                    Sistem Online
                </span>
            </div>
        </div>
    </div>

    <!-- ============================================================
    ALERT
    ============================================================ -->
    @if(session('success'))
        <div class="custom-alert">
            <div class="alert-icon">
                <i class="fas fa-check"></i>
            </div>
            <div class="alert-text">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 11px; opacity: 0.5;"></button>
        </div>
    @endif

    <!-- ============================================================
    LAYOUT
    ============================================================ -->
    <div class="settings-layout">

        <!-- ============================================================
        SIDEBAR
        ============================================================ -->
        <aside class="settings-sidebar animate-in">
            <div class="sidebar-header">
                <div class="label">Navigation</div>
            </div>
            <button class="nav-item active" onclick="scrollToSection('umum', event)">
                <div class="nav-icon"><i class="fas fa-globe"></i></div>
                <span class="nav-text">Umum</span>
            </button>
            <button class="nav-item" onclick="scrollToSection('sistem', event)">
                <div class="nav-icon"><i class="fas fa-microchip"></i></div>
                <span class="nav-text">Sistem</span>
            </button>
            <button class="nav-item" onclick="scrollToSection('keamanan', event)">
                <div class="nav-icon"><i class="fas fa-shield-alt"></i></div>
                <span class="nav-text">Keamanan</span>
            </button>
            <button class="nav-item" onclick="scrollToSection('database', event)">
                <div class="nav-icon"><i class="fas fa-database"></i></div>
                <span class="nav-text">Database</span>
            </button>
            <button class="nav-item" onclick="scrollToSection('fitur', event)">
                <div class="nav-icon"><i class="fas fa-rocket"></i></div>
                <span class="nav-text">Fitur Mendatang</span>
            </button>
        </aside>

        <!-- ============================================================
        CONTENT
        ============================================================ -->
        <div class="settings-content">

            <!-- ===== UMUM ===== -->
            <div class="settings-card animate-in" id="section-umum">
                <div class="card-head">
                    <div class="left">
                        <div class="head-icon indigo"><i class="fas fa-globe"></i></div>
                        <div class="head-title">
                            <h5>Pengaturan Umum</h5>
                            <p>Informasi dasar aplikasi</p>
                        </div>
                    </div>
                    <span class="badge">
                        <i class="fas fa-check-circle"></i>
                        ACTIVE
                    </span>
                </div>
                <div class="info-list">
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-cube"></i></div>
                            Nama Aplikasi
                        </div>
                        <div class="value">
                            <span class="code-badge primary">Karya Jaya Las Konstruksi</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-code-branch"></i></div>
                            Versi Aplikasi
                        </div>
                        <div class="value">
                            <span class="code-badge">v1.0.0</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-server"></i></div>
                            Environment
                        </div>
                        <div class="value">
                            <span class="status-badge-custom {{ app()->environment() === 'production' ? 'success' : 'warning' }}">
                                <span class="dot"></span>
                                {{ strtoupper(app()->environment()) }}
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-clock"></i></div>
                            Timezone
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ config('app.timezone', 'UTC') }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-language"></i></div>
                            Locale
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ config('app.locale', 'en') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== SISTEM ===== -->
            <div class="settings-card animate-in" id="section-sistem">
                <div class="card-head">
                    <div class="left">
                        <div class="head-icon green"><i class="fas fa-microchip"></i></div>
                        <div class="head-title">
                            <h5>Informasi Sistem</h5>
                            <p>Detail teknis server dan runtime</p>
                        </div>
                    </div>
                    <span class="badge">
                        <i class="fas fa-bolt"></i>
                        RUNTIME
                    </span>
                </div>
                <div class="info-list">
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fab fa-php"></i></div>
                            PHP Version
                        </div>
                        <div class="value">
                            <span class="code-badge success">{{ phpversion() }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fab fa-laravel"></i></div>
                            Laravel Version
                        </div>
                        <div class="value">
                            <span class="code-badge success">{{ app()->version() }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-server"></i></div>
                            Web Server
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ $_SERVER['SERVER_SOFTWARE'] ?? 'Laragon' }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-memory"></i></div>
                            Memory Limit
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ ini_get('memory_limit') }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-hourglass-half"></i></div>
                            Max Execution Time
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ ini_get('max_execution_time') }}s</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== KEAMANAN ===== -->
            <div class="settings-card animate-in" id="section-keamanan">
                <div class="card-head">
                    <div class="left">
                        <div class="head-icon purple"><i class="fas fa-shield-alt"></i></div>
                        <div class="head-title">
                            <h5>Keamanan</h5>
                            <p>Status keamanan sistem</p>
                        </div>
                    </div>
                    <span class="badge">
                        <i class="fas fa-lock"></i>
                        PROTECTED
                    </span>
                </div>
                <div class="info-list">
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-key"></i></div>
                            APP_KEY
                        </div>
                        <div class="value">
                            <span class="status-badge-custom success">
                                <span class="dot"></span>
                                TERPASANG
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-bug"></i></div>
                            Debug Mode
                        </div>
                        <div class="value">
                            <span class="status-badge-custom {{ config('app.debug') ? 'danger' : 'success' }}">
                                <span class="dot"></span>
                                {{ config('app.debug') ? 'AKTIF' : 'NONAKTIF' }}
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-user-shield"></i></div>
                            Authentication
                        </div>
                        <div class="value">
                            <span class="status-badge-custom success">
                                <span class="dot"></span>
                                AKTIF
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-shield-alt"></i></div>
                            CSRF Protection
                        </div>
                        <div class="value">
                            <span class="status-badge-custom success">
                                <span class="dot"></span>
                                ENABLED
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-cookie-bite"></i></div>
                            Session Driver
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ config('session.driver') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== DATABASE ===== -->
            <div class="settings-card animate-in" id="section-database">
                <div class="card-head">
                    <div class="left">
                        <div class="head-icon amber"><i class="fas fa-database"></i></div>
                        <div class="head-title">
                            <h5>Database</h5>
                            <p>Konfigurasi koneksi database</p>
                        </div>
                    </div>
                    <span class="badge">
                        <i class="fas fa-plug"></i>
                        CONNECTED
                    </span>
                </div>
                <div class="info-list">
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-database"></i></div>
                            Driver
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ config('database.default') }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-server"></i></div>
                            Host
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ config('database.connections.mysql.host', 'localhost') }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-hdd"></i></div>
                            Database Name
                        </div>
                        <div class="value">
                            <span class="code-badge primary">{{ config('database.connections.mysql.database', 'karyajayalas') }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="label">
                            <div class="label-icon"><i class="fas fa-plug"></i></div>
                            Port
                        </div>
                        <div class="value">
                            <span class="code-badge">{{ config('database.connections.mysql.port', '3306') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== FITUR MENDATANG ===== -->
            <div class="settings-card animate-in" id="section-fitur">
                <div class="card-head">
                    <div class="left">
                        <div class="head-icon pink"><i class="fas fa-rocket"></i></div>
                        <div class="head-title">
                            <h5>Fitur Mendatang</h5>
                            <p>Fitur yang sedang dalam pengembangan</p>
                        </div>
                    </div>
                    <span class="badge">
                        <i class="fas fa-clock"></i>
                        COMING SOON
                    </span>
                </div>
                <div class="coming-grid">
                    <div class="coming-card">
                        <div class="card-icon"><i class="fas fa-user-shield"></i></div>
                        <h6>Manajemen Role</h6>
                        <p>Atur akses user dengan lebih detail dan terstruktur</p>
                        <span class="status-tag">
                            <span class="dot"></span>
                            In Development
                        </span>
                    </div>
                    <div class="coming-card">
                        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                        <h6>Analytics Dashboard</h6>
                        <p>Statistik, grafik, dan laporan yang lebih lengkap</p>
                        <span class="status-tag">
                            <span class="dot"></span>
                            In Development
                        </span>
                    </div>
                    <div class="coming-card">
                        <div class="card-icon"><i class="fas fa-bell"></i></div>
                        <h6>Notifikasi Real-time</h6>
                        <p>Pemberitahuan aktivitas sistem secara langsung</p>
                        <span class="status-tag">
                            <span class="dot"></span>
                            In Development
                        </span>
                    </div>
                    <div class="coming-card">
                        <div class="card-icon"><i class="fas fa-file-export"></i></div>
                        <h6>Export Data</h6>
                        <p>Ekspor data ke Excel, PDF, dan CSV</p>
                        <span class="status-tag">
                            <span class="dot"></span>
                            In Development
                        </span>
                    </div>
                    <div class="coming-card">
                        <div class="card-icon"><i class="fas fa-mobile-alt"></i></div>
                        <h6>Mobile App</h6>
                        <p>Aplikasi mobile untuk akses lebih mudah</p>
                        <span class="status-tag">
                            <span class="dot"></span>
                            In Development
                        </span>
                    </div>
                    <div class="coming-card">
                        <div class="card-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <h6>Cloud Backup</h6>
                        <p>Backup otomatis ke cloud storage</p>
                        <span class="status-tag">
                            <span class="dot"></span>
                            In Development
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== SMOOTH SCROLL =====
        window.scrollToSection = function(section, event) {
            if (event) event.preventDefault();
            
            const element = document.getElementById('section-' + section);
            if (element) {
                const offset = 20;
                const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                document.querySelectorAll('.settings-sidebar .nav-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                if (event && event.currentTarget) {
                    event.currentTarget.classList.add('active');
                }
            }
        };

        // ===== ACTIVE NAV ON SCROLL =====
        const sections = document.querySelectorAll('.settings-card[id^="section-"]');
        const navItems = document.querySelectorAll('.settings-sidebar .nav-item');

        const observerOptions = {
            root: null,
            rootMargin: '-100px 0px -60% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id.replace('section-', '');
                    navItems.forEach(item => {
                        item.classList.remove('active');
                        if (item.getAttribute('onclick')?.includes(`'${id}'`)) {
                            item.classList.add('active');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));

        // ===== AUTO DISMISS ALERT =====
        document.querySelectorAll('.custom-alert').forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

        // ===== KEYBOARD SHORTCUT =====
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K untuk fokus ke pencarian (jika ada)
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                // Bisa ditambahkan fitur search nanti
            }
        });
    });
</script>
@endsection