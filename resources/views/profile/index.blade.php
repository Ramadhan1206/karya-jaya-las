@extends('layouts.app')

@section('title', 'Profile Saya - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .profile-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
    }
    .profile-card .card-header-custom {
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    .profile-card .card-header-custom h4 {
        font-weight: 700;
        color: #1e293b;
    }
    .profile-avatar-container {
        position: relative;
        display: inline-block;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #667eea;
        box-shadow: 0 4px 15px rgba(102,126,234,0.2);
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
        font-weight: 700;
        border: 4px solid #667eea;
        box-shadow: 0 4px 15px rgba(102,126,234,0.2);
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.08);
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
    }
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102,126,234,0.35);
        color: white;
    }
    .btn-back {
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        transform: translateX(-3px);
    }
    .badge-role {
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-role-admin {
        background: #fecaca;
        color: #991b1b;
    }
    .badge-role-user {
        background: #dbeafe;
        color: #1e40af;
    }
    .avatar-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #667eea;
        margin-bottom: 10px;
    }
    .preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .preview-container img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #667eea;
    }
    .preview-container .placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        font-weight: 700;
    }
    @media (max-width: 768px) {
        .profile-card {
            padding: 20px;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
        }
        .profile-avatar-placeholder {
            width: 80px;
            height: 80px;
            font-size: 32px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card">
                <!-- Header -->
                <div class="card-header-custom">
                    <h4>
                        <i class="fas fa-user-circle me-2 text-primary"></i>
                        Profile Saya
                    </h4>
                </div>

                <!-- Alert -->
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

                <!-- Avatar / Foto Profile -->
                <div class="text-center mb-4">
                    <div class="preview-container">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                 alt="{{ $user->name }}" 
                                 class="avatar-preview">
                        @else
                            <div class="placeholder">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                        <h5 class="mt-2">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                        <span class="badge-role {{ $user->role === 'admin' ? 'badge-role-admin' : 'badge-role-user' }}">
                            <i class="fas {{ $user->role === 'admin' ? 'fa-shield-alt' : 'fa-user' }} me-1"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                <!-- Form Edit Profile -->
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Nama -->
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
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-home me-1 text-primary"></i>Alamat
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" 
                                      rows="3">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-back">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.querySelector('.avatar-preview');
        const placeholder = document.querySelector('.placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Jika ada preview, update
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    // Jika tidak ada preview, buat baru
                    const container = document.querySelector('.preview-container');
                    const img = document.createElement('img');
                    img.className = 'avatar-preview';
                    img.src = e.target.result;
                    img.alt = 'Preview Avatar';
                    
                    // Hapus placeholder jika ada
                    const placeholderEl = container.querySelector('.placeholder');
                    if (placeholderEl) {
                        placeholderEl.remove();
                    }
                    
                    // Tambahkan gambar
                    container.insertBefore(img, container.querySelector('h5'));
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection