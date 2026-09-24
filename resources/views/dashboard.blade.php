@extends('layouts.app')

@section('title', 'Dashboard - Karya Jaya Las')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-gradient-primary text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0">
                                <i class="fas fa-building me-2"></i>Karya Jaya Las
                            </h2>
                            <p class="mb-0 mt-2">
                                <i class="fas fa-user me-1"></i> Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
                            </p>
                            <small>
                                <i class="fas fa-calendar-alt me-1"></i> 
                                {{ now()->format('l, d F Y') }}
                            </small>
                        </div>
                        <div class="text-center">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     class="rounded-circle border border-white" 
                                     width="80" height="80" alt="Avatar">
                            @else
                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                     style="width: 80px; height: 80px; font-size: 32px; color: #667eea;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <i class="fas fa-users me-1"></i> Total Karyawan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\User::where('email', 'like', '%@karyajayalas.com%')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <i class="fas fa-user-check me-1"></i> Admin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\User::where('role', 'admin')->where('email', 'like', '%@karyajayalas.com%')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <i class="fas fa-calendar-plus me-1"></i> Bergabung
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ Auth::user()->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <i class="fas fa-clock me-1"></i> Terakhir Login
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->diffForHumans() : 'Pertama kali' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-history fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Karyawan -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-users me-2"></i>Daftar Karyawan Karya Jaya Las
                    </h6>
                    <span class="badge bg-primary">
                        Total: {{ \App\Models\User::where('email', 'like', '%@karyajayalas.com%')->count() }} orang
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $karyawan = \App\Models\User::where('email', 'like', '%@karyajayalas.com%')->get();
                                @endphp
                                @forelse($karyawan as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                            @if($user->id == Auth::id())
                                                <span class="badge bg-success ms-1">Anda</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-info' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada karyawan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Profil Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-circle me-2"></i>Profil Saya
                    </h6>
                </div>
                <div class="card-body text-center">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                             class="rounded-circle mb-3" width="100" height="100" alt="Avatar">
                    @else
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                             style="width: 100px; height: 100px; font-size: 40px;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                    @endif
                    <h5>{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <span class="badge {{ Auth::user()->role === 'admin' ? 'bg-danger' : 'bg-info' }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                    <hr>
                    <div class="text-start">
                        <p><i class="fas fa-phone me-2"></i> {{ Auth::user()->phone ?? 'Belum diisi' }}</p>
                        <p><i class="fas fa-home me-2"></i> {{ Auth::user()->address ?? 'Belum diisi' }}</p>
                        <p><i class="fas fa-calendar me-2"></i> Bergabung: {{ Auth::user()->created_at->format('d F Y') }}</p>
                    </div>
                    <a href="{{ route('profile') }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-2"></i>Edit Profil
                    </a>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Menu Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i>Lihat Profil
                        </a>
                        <a href="{{ route('profile.change-password') }}" class="btn btn-outline-warning">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger">
                                <i class="fas fa-shield-alt me-2"></i>Admin Panel
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 4px solid #4e73df !important;
    }
    .border-left-success {
        border-left: 4px solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 4px solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 4px solid #f6c23e !important;
    }
    .text-xs {
        font-size: 0.7rem;
    }
    .text-gray-300 {
        color: #dddfeb !important;
    }
    .text-gray-800 {
        color: #5a5c69 !important;
    }
</style>
@endsection