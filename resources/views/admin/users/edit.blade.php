@extends('layouts.app')

@section('title', 'Edit User - Karya Jaya Las Konstruksi')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f2f5;
    }
    .form-card .form-header {
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    .form-card .form-header h5 {
        font-weight: 700;
        color: #1e293b;
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #f5576c;
        box-shadow: 0 0 0 3px rgba(245,87,108,0.1);
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
    }
    .btn-back {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        transform: translateX(-3px);
    }
    .btn-submit {
        border-radius: 10px;
        padding: 10px 32px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
        border: none;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245,87,108,0.35);
        color: white;
    }
    .avatar-preview {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        color: white;
        margin: 0 auto 15px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-card">
                <div class="form-header">
                    <h5>
                        <i class="fas fa-user-edit me-2 text-primary"></i>
                        Edit User
                    </h5>
                    <p class="text-muted mb-0">Edit data user {{ $user->name }}</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Terjadi kesalahan:
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-4">
                        @php
                            $colors = ['purple' => 'linear-gradient(135deg, #667eea, #764ba2)', 
                                       'pink' => 'linear-gradient(135deg, #f093fb, #f5576c)',
                                       'green' => 'linear-gradient(135deg, #48bb78, #38a169)',
                                       'orange' => 'linear-gradient(135deg, #ed8936, #dd6b20)',
                                       'blue' => 'linear-gradient(135deg, #4299e1, #3182ce)'];
                            $color = $colors[array_rand($colors)];
                        @endphp
                        <div class="avatar-preview" style="background: {{ $color }};">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <h6>{{ $user->name }}</h6>
                        <span class="badge-role {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <div class="row">
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

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-tag me-1 text-primary"></i>Role
                            </label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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

                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-home me-1 text-primary"></i>Alamat
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" 
                                      rows="2">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-key me-1 text-primary"></i>Password (Kosongkan jika tidak diubah)
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-check-circle me-1 text-primary"></i>Konfirmasi Password
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   placeholder="Ulangi password">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-back">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection