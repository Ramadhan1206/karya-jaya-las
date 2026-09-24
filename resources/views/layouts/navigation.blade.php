<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%); box-shadow: 0 4px 25px rgba(0,0,0,0.2); padding: 12px 0;">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('home') }}" style="font-weight: 700; font-size: 22px; padding: 5px 0; display: flex; align-items: center; transition: all 0.3s ease;">
            <i class="fas fa-bolt me-2" style="color: #667eea; font-size: 24px;"></i>
            <span style="background: linear-gradient(90deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Karya Jaya Las
            </span>
        </a>
        
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: rgba(255,255,255,0.15); padding: 8px 12px; border-radius: 10px;">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style="gap: 6px; align-items: center;">
                @auth
                    <!-- ===== DASHBOARD ===== -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}"
                           style="color: rgba(255,255,255,0.8); font-weight: 500; font-size: 14px; padding: 10px 20px; border-radius: 10px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                            <i class="fas fa-home" style="font-size: 14px;"></i> Dashboard
                            <span class="nav-indicator" style="position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(90deg, #667eea, #764ba2); border-radius: 2px; opacity: 0; transition: all 0.3s ease;"></span>
                        </a>
                    </li>
                    
                    <!-- ===== PROFILE ===== -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" 
                           href="{{ route('profile') }}"
                           style="color: rgba(255,255,255,0.8); font-weight: 500; font-size: 14px; padding: 10px 20px; border-radius: 10px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                            <i class="fas fa-user" style="font-size: 14px;"></i> Profile
                            <span class="nav-indicator" style="position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(90deg, #667eea, #764ba2); border-radius: 2px; opacity: 0; transition: all 0.3s ease;"></span>
                        </a>
                    </li>
                    
                    <!-- ===== UBAH PASSWORD ===== -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.change-password') ? 'active' : '' }}" 
                           href="{{ route('profile.change-password') }}"
                           style="color: rgba(255,255,255,0.8); font-weight: 500; font-size: 14px; padding: 10px 20px; border-radius: 10px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                            <i class="fas fa-key" style="font-size: 14px;"></i> Ubah Password
                            <span class="nav-indicator" style="position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(90deg, #667eea, #764ba2); border-radius: 2px; opacity: 0; transition: all 0.3s ease;"></span>
                        </a>
                    </li>
                    
                    <!-- ===== CATATAN HARIAN DIHAPUS ===== -->
                    <!-- ===== PROYEK DIHAPUS ===== -->
                    <!-- ===== GAJIAN DIHAPUS ===== -->
                    
                    <!-- ===== ADMIN DROPDOWN ===== -->
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               style="color: rgba(255,255,255,0.8); font-weight: 500; font-size: 14px; padding: 10px 20px; border-radius: 10px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; background: rgba(102,126,234,0.1); border: 1px solid rgba(102,126,234,0.2);">
                                <i class="fas fa-shield-alt" style="font-size: 14px; color: #667eea;"></i> Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="background: #1a1a2e; border: none; border-radius: 14px; padding: 10px; margin-top: 10px; box-shadow: 0 15px 50px rgba(0,0,0,0.4); min-width: 230px; backdrop-filter: blur(10px);">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-tachometer-alt" style="width: 22px; color: #667eea;"></i> Dashboard Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.karyawan.index') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-users" style="width: 22px; color: #667eea;"></i> Kelola Karyawan
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.absen') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-clipboard-check" style="width: 22px; color: #1cc88a;"></i> Data Absensi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.catatan-harian') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-clipboard-list" style="width: 22px; color: #38a169;"></i> Catatan Harian
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.gajian') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-money-bill-wave" style="width: 22px; color: #f6c23e;"></i> Data Gajian
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.proyek.index') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-project-diagram" style="width: 22px; color: #667eea;"></i> Manajemen Proyek
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.users') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-user-cog" style="width: 22px; color: #f6c23e;"></i> Manajemen User
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.06); margin: 6px 0;"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.settings') }}"
                                       style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-cog" style="width: 22px; color: #858796;"></i> Pengaturan
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    
                    <!-- ===== USER DROPDOWN ===== -->
                    <li class="nav-item dropdown" style="margin-left: 6px;">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           style="color: white; font-weight: 500; font-size: 14px; padding: 8px 16px 8px 10px; border-radius: 50px; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(5px);">
                            <span class="user-avatar" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 13px; border: 2px solid rgba(255,255,255,0.2);">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </span>
                            <span style="max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: #1a1a2e; border: none; border-radius: 14px; padding: 10px; margin-top: 10px; box-shadow: 0 15px 50px rgba(0,0,0,0.4); min-width: 230px; backdrop-filter: blur(10px);">
                            <!-- Profile -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}"
                                   style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                    <i class="fas fa-user-circle" style="width: 22px; color: #667eea;"></i> Profile
                                </a>
                            </li>
                            <!-- Ubah Password -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.change-password') }}"
                                   style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; display: flex; align-items: center; gap: 14px;">
                                    <i class="fas fa-key" style="width: 22px; color: #f6c23e;"></i> Ubah Password
                                </a>
                            </li>
                            <!-- ===== CATATAN HARIAN DIHAPUS ===== -->
                            <!-- ===== PROYEK DIHAPUS ===== -->
                            <!-- ===== GAJIAN DIHAPUS ===== -->
                            <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.06); margin: 6px 0;"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" 
                                            style="color: rgba(255,255,255,0.7); border-radius: 10px; padding: 12px 18px; transition: all 0.3s ease; background: none; border: none; width: 100%; text-align: left; display: flex; align-items: center; gap: 14px;">
                                        <i class="fas fa-sign-out-alt" style="width: 22px; color: #fc8181;"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    
                @else
                    <!-- ===== GUEST LINKS ===== -->
                    <li class="nav-item">
                        <a class="nav-link btn-login {{ request()->routeIs('login') ? 'active' : '' }}" 
                           href="{{ route('login') }}"
                           style="color: rgba(255,255,255,0.8); font-weight: 500; font-size: 14px; padding: 10px 28px; border-radius: 10px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.08);">
                            <i class="fas fa-sign-in-alt" style="font-size: 14px;"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-register {{ request()->routeIs('register') ? 'active' : '' }}" 
                           href="{{ route('register') }}"
                           style="color: white; font-weight: 600; font-size: 14px; padding: 10px 32px; border-radius: 10px; transition: all 0.3s ease; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 4px 20px rgba(102,126,234,0.3); display: flex; align-items: center; gap: 8px; position: relative; overflow: hidden;">
                            <i class="fas fa-user-plus" style="font-size: 14px;"></i> Register
                            <span style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%); opacity: 0; transition: opacity 0.5s ease; pointer-events: none;"></span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    /* ===== NAVBAR HOVER & ACTIVE ===== */
    .navbar-custom .nav-link:hover {
        color: white !important;
        background: rgba(255,255,255,0.06);
        transform: translateY(-2px);
    }
    .navbar-custom .nav-link.active {
        color: white !important;
        background: rgba(255,255,255,0.08);
    }
    .navbar-custom .nav-link.active .nav-indicator {
        opacity: 1 !important;
        width: 30px !important;
    }
    
    /* ===== DROPDOWN HOVER ===== */
    .navbar-custom .dropdown-item:hover {
        background: rgba(102,126,234,0.15) !important;
        color: white !important;
        transform: translateX(4px);
    }
    .navbar-custom .dropdown-item.active {
        background: rgba(102,126,234,0.2) !important;
        color: white !important;
    }
    
    /* ===== LOGOUT BUTTON ===== */
    .navbar-custom .nav-link[type="submit"]:hover {
        color: #fc8181 !important;
        background: rgba(252,129,129,0.1);
        border-color: rgba(252,129,129,0.2);
    }
    
    /* ===== NAVBAR TOGGLER ===== */
    .navbar-custom .navbar-toggler:hover {
        background: rgba(255,255,255,0.05);
    }
    
    /* ===== TOMBOL LOGIN ===== */
    .navbar-custom .btn-login:hover {
        color: white !important;
        background: rgba(255,255,255,0.08);
        transform: translateY(-2px);
        border-color: rgba(255,255,255,0.2);
        box-shadow: 0 4px 15px rgba(255,255,255,0.05);
    }
    .navbar-custom .btn-login.active {
        color: white !important;
        background: rgba(255,255,255,0.1);
    }
    
    /* ===== TOMBOL REGISTER ===== */
    .navbar-custom .btn-register:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 35px rgba(102,126,234,0.5);
        color: white !important;
    }
    .navbar-custom .btn-register:hover span {
        opacity: 1 !important;
    }
    .navbar-custom .btn-register.active {
        transform: scale(0.98);
        box-shadow: 0 2px 15px rgba(102,126,234,0.3);
    }
    
    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .navbar-custom .nav-link {
            padding: 12px 16px !important;
            border-radius: 10px !important;
        }
        .navbar-custom .dropdown-menu {
            background: rgba(255,255,255,0.05) !important;
            margin-top: 0 !important;
            backdrop-filter: none !important;
        }
        .navbar-custom .dropdown-item {
            padding: 12px 16px !important;
        }
        .navbar-custom .navbar-nav {
            gap: 2px !important;
        }
        .navbar-custom .btn-login {
            padding: 12px 16px !important;
            transform: none !important;
        }
        .navbar-custom .btn-login:hover {
            transform: none !important;
        }
        .navbar-custom .btn-register {
            padding: 12px 16px !important;
            background: rgba(102,126,234,0.2) !important;
            box-shadow: none !important;
        }
        .navbar-custom .btn-register:hover {
            transform: none !important;
            box-shadow: none !important;
            background: rgba(102,126,234,0.3) !important;
        }
        .navbar-custom .btn-register span {
            display: none !important;
        }
        .navbar-custom .nav-link .nav-indicator {
            display: none !important;
        }
    }
</style>
