@extends('layouts.app')

@section('title', 'Manajemen User - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    /* ===== ROOT ===== */
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --bg-dark: #0f0c29;
        --bg-mid: #302b63;
        --bg-light: #24243e;
        --card-radius: 20px;
        --shadow: 0 8px 32px rgba(0,0,0,0.06);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== HERO HEADER ===== */
    .hero-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-mid) 50%, var(--bg-light) 100%);
        border-radius: var(--card-radius);
        padding: 40px 45px;
        color: white;
        margin-bottom: 35px;
        position: relative;
        overflow: hidden;
    }
    .hero-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(102, 126, 234, 0.06);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }
    .hero-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(118, 75, 162, 0.04);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite reverse;
    }
    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(30px, -20px); }
    }
    .hero-header .content {
        position: relative;
        z-index: 1;
    }
    .hero-header .date-badge {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 12px;
        display: inline-block;
        border: 1px solid rgba(255,255,255,0.06);
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .hero-header .date-badge i {
        margin-right: 8px;
        color: #667eea;
    }
    .hero-header h2 {
        font-weight: 800;
        font-size: 30px;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
    }
    .hero-header h2 span {
        background: linear-gradient(90deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-header h2 i {
        color: #667eea;
        margin-right: 12px;
        -webkit-text-fill-color: initial;
    }
    .hero-header p {
        opacity: 0.7;
        font-size: 15px;
        margin-bottom: 0;
    }
    .hero-header .header-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .hero-header .badge-total {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 13px;
        border: 1px solid rgba(255,255,255,0.06);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .hero-header .badge-total i {
        color: #667eea;
    }

    /* ===== STATISTIK ===== */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 35px;
    }
    .stat-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 24px 22px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.03);
        transition: var(--transition);
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
        border-radius: 0 0 10px 10px;
    }
    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 48px rgba(0,0,0,0.08);
    }
    .stat-card .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .stat-card .stat-icon.blue { background: #eef2ff; color: #4f46e5; }
    .stat-card .stat-icon.green { background: #ecfdf5; color: #059669; }
    .stat-card .stat-icon.purple { background: #f5f3ff; color: #7c3aed; }
    .stat-card .stat-icon.orange { background: #fffbeb; color: #d97706; }
    
    .stat-card .stat-number {
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .stat-card .stat-label {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 2px;
    }
    .stat-card .stat-change {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 12px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .stat-change.up { background: #ecfdf5; color: #059669; }
    .stat-change.down { background: #fef2f2; color: #dc2626; }
    .stat-change.stable { background: #f1f5f9; color: #64748b; }
    
    .stat-card.total::after { background: linear-gradient(90deg, #667eea, #764ba2); }
    .stat-card.user::after { background: #059669; }
    .stat-card.admin::after { background: #7c3aed; }
    .stat-card.new::after { background: #d97706; }

    /* ===== TABLE ===== */
    .table-wrapper {
        background: white;
        border-radius: var(--card-radius);
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.03);
    }
    .table-wrapper .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 2px solid #f1f5f9;
    }
    .table-wrapper .table-header h5 {
        font-weight: 700;
        color: #0f172a;
        font-size: 17px;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .table-wrapper .table-header h5 i {
        color: #667eea;
    }
    .table-wrapper .table-header .badge-count {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .table-wrapper table {
        margin-bottom: 0;
    }
    .table-wrapper table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e8ecf1;
        padding: 12px 16px;
    }
    .table-wrapper table tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #334155;
    }
    .table-wrapper table tbody tr:hover {
        background: #fafbff;
    }
    .table-wrapper table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ===== USER AVATAR ===== */
    .user-avatar-sm {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        color: white;
        margin-right: 14px;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
    }
    .user-avatar-sm.blue { background: linear-gradient(135deg, #667eea, #764ba2); }
    .user-avatar-sm.green { background: linear-gradient(135deg, #059669, #10b981); }
    .user-avatar-sm.purple { background: linear-gradient(135deg, #7c3aed, #8b5cf6); }
    .user-avatar-sm.orange { background: linear-gradient(135deg, #d97706, #f59e0b); }
    .user-avatar-sm.pink { background: linear-gradient(135deg, #db2777, #ec4899); }
    .user-avatar-sm.cyan { background: linear-gradient(135deg, #0891b2, #06b6d4); }

    .user-cell {
        display: flex;
        align-items: center;
    }
    .user-cell .info {
        display: flex;
        flex-direction: column;
    }
    .user-cell .info .name {
        font-weight: 600;
        color: #0f172a;
        font-size: 14px;
    }
    .user-cell .info .email {
        font-size: 12px;
        color: #94a3b8;
    }
    .user-cell .info .badge-you {
        background: #d1fae5;
        color: #065f46;
        font-size: 10px;
        padding: 1px 10px;
        border-radius: 50px;
        font-weight: 600;
        margin-left: 8px;
        display: inline-block;
    }

    /* ===== ROLE BADGE ===== */
    .role-badge {
        padding: 5px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .role-badge .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    .role-badge.admin { background: #fef2f2; color: #dc2626; }
    .role-badge.admin .dot { background: #dc2626; }
    .role-badge.user { background: #eef2ff; color: #4f46e5; }
    .role-badge.user .dot { background: #4f46e5; }

    /* ===== ACTION BUTTONS ===== */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }
    .btn-action:hover {
        transform: scale(1.1);
        color: white;
        text-decoration: none;
    }
    .btn-action.edit { background: #fffbeb; color: #d97706; }
    .btn-action.edit:hover { background: #d97706; color: white; box-shadow: 0 4px 15px rgba(217, 119, 6, 0.3); }
    .btn-action.delete { background: #fef2f2; color: #dc2626; }
    .btn-action.delete:hover { background: #dc2626; color: white; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3); }
    .btn-action.locked { background: #f1f5f9; color: #94a3b8; cursor: not-allowed; }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state .icon {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 16px;
    }
    .empty-state h5 {
        color: #475569;
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 4px;
    }
    .empty-state p {
        color: #94a3b8;
        font-size: 14px;
    }

    /* ============================================================
       PAGINATION - FINAL FIX
    ============================================================ */
    .table-wrapper nav {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .table-wrapper .pagination {
        margin: 0;
        padding: 0;
        gap: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        list-style: none;
    }

    .table-wrapper .pagination .page-item {
        margin: 0;
    }

    .table-wrapper .pagination .page-link {
        border: none !important;
        border-radius: 10px !important;
        margin: 0 !important;
        padding: 6px 10px !important;
        color: #475569 !important;
        transition: var(--transition);
        font-weight: 500 !important;
        font-size: 12px !important;
        line-height: 1 !important;
        background: transparent !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 34px !important;
        height: 34px !important;
        text-decoration: none !important;
        box-shadow: none !important;
    }

    .table-wrapper .pagination .page-link:hover {
        background: #667eea !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
    }

    .table-wrapper .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
    }

    .table-wrapper .pagination .page-item.disabled .page-link {
        color: #cbd5e1 !important;
        background: transparent !important;
        opacity: 0.6;
    }

    /* ====== KUNCI: perkecil SVG next/prev ====== */
    .table-wrapper .pagination .page-link svg {
        width: 12px !important;
        height: 12px !important;
        max-width: 12px !important;
        max-height: 12px !important;
        display: block !important;
        flex-shrink: 0 !important;
    }

    .table-wrapper .pagination .page-link i {
        font-size: 11px !important;
        line-height: 1 !important;
    }

    /* Sembunyikan teks "Previous"/"Next" jika masih muncul, ganti jadi simbol saja */
    .table-wrapper .pagination .page-link span {
        font-size: 12px !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-wrapper .pagination .page-link {
            padding: 5px 8px !important;
            min-width: 30px !important;
            height: 30px !important;
            font-size: 11px !important;
        }
        .table-wrapper .pagination .page-link svg {
            width: 10px !important;
            height: 10px !important;
            max-width: 10px !important;
            max-height: 10px !important;
        }
    }

    @media (max-width: 480px) {
        .table-wrapper .pagination .page-link {
            padding: 4px 6px !important;
            min-width: 26px !important;
            height: 26px !important;
            font-size: 10px !important;
        }
        .table-wrapper .pagination .page-link svg {
            width: 9px !important;
            height: 9px !important;
            max-width: 9px !important;
            max-height: 9px !important;
        }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .hero-header {
            padding: 28px 20px;
            text-align: center;
        }
        .hero-header .header-actions {
            justify-content: center;
            margin-top: 12px;
        }
        .hero-header .text-end {
            text-align: center !important;
        }
        .hero-header h2 {
            font-size: 24px;
        }
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .stat-card {
            padding: 16px;
        }
        .stat-card .stat-number {
            font-size: 22px;
        }
        .table-wrapper {
            padding: 12px;
        }
        .table-wrapper .table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        .user-avatar-sm {
            width: 34px;
            height: 34px;
            font-size: 11px;
            margin-right: 10px;
        }
        .user-cell .info .name {
            font-size: 13px;
        }
        .user-cell .info .email {
            font-size: 11px;
        }
        .btn-action {
            width: 30px;
            height: 30px;
            font-size: 12px;
        }
        .role-badge {
            font-size: 11px;
            padding: 4px 12px;
        }
    }
    @media (max-width: 480px) {
        .stat-grid {
            grid-template-columns: 1fr;
        }
        .hero-header h2 {
            font-size: 20px;
        }
        .hero-header .badge-total {
            font-size: 12px;
            padding: 6px 14px;
        }
        .table-wrapper table thead th {
            font-size: 10px;
            padding: 8px 10px;
        }
        .table-wrapper table tbody td {
            font-size: 12px;
            padding: 8px 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ===== HERO HEADER ===== -->
    <div class="hero-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="content">
                    <div class="date-badge">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <h2>
                        <i class="fas fa-users-cog"></i>
                        Manajemen <span>User</span>
                    </h2>
                    <p>
                        Kelola semua user yang terdaftar di sistem
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="header-actions justify-content-end">
                    <span class="badge-total">
                        <i class="fas fa-users"></i>
                        Total: <strong>{{ $users->total() ?? 0 }}</strong> User
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== STATISTIK ===== -->
    <div class="stat-grid">
        <div class="stat-card total">
            <div class="stat-top">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <span class="stat-change stable">
                    <i class="fas fa-minus"></i> Stabil
                </span>
            </div>
            <div class="stat-number">{{ $users->total() ?? 0 }}</div>
            <div class="stat-label">Total User</div>
        </div>
        <div class="stat-card user">
            <div class="stat-top">
                <div class="stat-icon green">
                    <i class="fas fa-user"></i>
                </div>
                <span class="stat-change up">
                    <i class="fas fa-arrow-up"></i> Aktif
                </span>
            </div>
            <div class="stat-number">
                {{ \App\Models\User::where('role', 'user')->count() }}
            </div>
            <div class="stat-label">User Biasa</div>
        </div>
        <div class="stat-card admin">
            <div class="stat-top">
                <div class="stat-icon purple">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="stat-change stable">
                    <i class="fas fa-minus"></i> Stabil
                </span>
            </div>
            <div class="stat-number">
                {{ \App\Models\User::where('role', 'admin')->count() }}
            </div>
            <div class="stat-label">Admin</div>
        </div>
        <div class="stat-card new">
            <div class="stat-top">
                <div class="stat-icon orange">
                    <i class="fas fa-user-plus"></i>
                </div>
                <span class="stat-change up">
                    <i class="fas fa-arrow-up"></i> +Baru
                </span>
            </div>
            <div class="stat-number">
                {{ \App\Models\User::whereDate('created_at', today())->count() }}
            </div>
            <div class="stat-label">User Baru Hari Ini</div>
        </div>
    </div>

    <!-- ===== TABLE ===== -->
    <div class="table-wrapper">
        <div class="table-header">
            <h5>
                <i class="fas fa-list"></i>
                Daftar User
            </h5>
            <span class="badge-count">{{ $users->total() ?? 0 }} Data</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>USER</th>
                        <th>ROLE</th>
                        <th>BERGABUNG</th>
                        <th style="width: 130px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-cell">
                                    @php
                                        $colors = ['blue', 'green', 'purple', 'orange', 'pink', 'cyan'];
                                        $color = $colors[array_rand($colors)];
                                    @endphp
                                    <div class="user-avatar-sm {{ $color }}">
                                        {{ strtoupper(substr($item->name, 0, 2)) }}
                                    </div>
                                    <div class="info">
                                        <span class="name">
                                            {{ $item->name }}
                                            @if($item->id == auth()->id())
                                                <span class="badge-you">Anda</span>
                                            @endif
                                        </span>
                                        <span class="email">{{ $item->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="role-badge {{ $item->role === 'admin' ? 'admin' : 'user' }}">
                                    <span class="dot"></span>
                                    {{ ucfirst($item->role) }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.users.edit', $item->id) }}" 
                                       class="btn-action edit" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($item->id != auth()->id())
                                        <form action="{{ route('admin.users.delete', $item->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus user {{ $item->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Hapus User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn-action locked" title="Tidak bisa hapus sendiri" disabled>
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h5>Belum Ada User</h5>
                                    <p>Belum ada user yang terdaftar di sistem</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection