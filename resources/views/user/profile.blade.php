@extends('layouts.app')

@section('title', 'Profile - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .profile-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .profile-card .card-header-custom {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #667eea;
        background: #f0f2f5;
    }
    .profile-avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        font-weight: bold;
        margin: 0 auto;
        border: 4px solid rgba(102,126,234,0.3);
    }
    .profile-info-item {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }
    .profile-info-item .label {
        width: 130px;
        font-weight: 600;
        color: #64748b;
        font-size: 14px;
    }
    .profile-info-item .value {
        color: #1e293b;
        font-weight: 500;
        font-size: 14px;
    }
    .profile-info-item .value .badge-role {
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-role-admin { background: #fecaca; color: #991b1b; }
    .badge-role-user { background: #dbeafe; color: #1e40af; }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
    }
    .btn-action {
        padding: 10px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-card">
                <!-- Header -->
                <div class="card-header-custom">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-user-circle me-2"></i>Profile Saya
                    </h4>
                    <span class="badge-role {{ $user->role === 'admin' ? 'badge-role-admin' : 'badge-role-user' }}">
                        <i class="fas {{ $user->role === 'admin' ? 'fa-shield-alt' : 'fa-user' }} me-1"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Terjadi kesalahan:
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Avatar & Nama -->
                <div class="text-center mb-4">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                             alt="{{ $user->name }}" 
                             class="profile-avatar">
                    @else
                        <div class="profile-avatar-placeholder">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                    <h4 class="mt-3 fw-bold">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>

                <!-- Form Edit Profile -->
                <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Nama Lengkap -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-envelope me-1 text-primary"></i>Email
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-phone me-1 text-primary"></i>Telepon
                            </label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" 
                                   value="{{ old('phone', $user->phone) }}" 
                                   placeholder="08123456789">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Profile -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-image me-1 text-primary"></i>Foto Profile
                            </label>
                            <input type="file" 
                                   class="form-control @error('avatar') is-invalid @enderror" 
                                   name="avatar" 
                                   accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-home me-1 text-primary"></i>Alamat
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-action">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-action">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>

                <!-- Informasi Profile -->
                <hr class="my-4">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="fas fa-info-circle me-2"></i>Informasi Profile
                </h6>

                <div class="profile-info-item">
                    <span class="label">Nama</span>
                    <span class="value">{{ $user->name }}</span>
                </div>
                <div class="profile-info-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <div class="profile-info-item">
                    <span class="label">Role</span>
                    <span class="value">
                        <span class="badge-role {{ $user->role === 'admin' ? 'badge-role-admin' : 'badge-role-user' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </span>
                </div>
                <div class="profile-info-item">
                    <span class="label">Telepon</span>
                    <span class="value">{{ $user->phone ?? '-' }}</span>
                </div>
                <div class="profile-info-item">
                    <span class="label">Alamat</span>
                    <span class="value">{{ $user->address ?? '-' }}</span>
                </div>
                <div class="profile-info-item">
                    <span class="label">Bergabung</span>
                    <span class="value">{{ $user->created_at->format('d F Y') }}</span>
                </div>
                <div class="profile-info-item">
                    <span class="label">Terakhir Login</span>
                    <span class="value">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Pertama kali' }}</span>
                </div>

                <!-- Tombol Ubah Password di Bawah -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            <i class="fas fa-shield-alt me-1 text-warning"></i>
                            Keamanan Akun
                        </span>
                        <a href="{{ route('user.change-password') }}" class="btn btn-warning btn-action">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection