<div class="card-body">
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Avatar -->
            <div class="col-md-3 text-center mb-4">
                <div class="position-relative d-inline-block">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                             class="rounded-circle" 
                             width="120" height="120" 
                             style="object-fit: cover; border: 3px solid #667eea;">
                    @else
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                             style="width: 120px; height: 120px; font-size: 48px; font-weight: bold; margin: 0 auto;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                    @endif
                    <label for="avatar" class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle" 
                           style="border: 2px solid #e2e8f0; cursor: pointer;">
                        <i class="fas fa-camera"></i>
                    </label>
                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                </div>
                <small class="text-muted d-block mt-2">Klik icon camera untuk upload foto</small>
                @error('avatar')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Form -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Nama -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name', Auth::user()->name) }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-envelope me-1 text-primary"></i>Email
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email', Auth::user()->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-phone me-1 text-primary"></i>Telepon
                        </label>
                        <input type="text" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               name="phone" 
                               value="{{ old('phone', Auth::user()->phone) }}" 
                               placeholder="08123456789">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role (Read Only) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-user-tag me-1 text-primary"></i>Role
                        </label>
                        <input type="text" 
                               class="form-control" 
                               value="{{ ucfirst(Auth::user()->role) }}" 
                               disabled>
                    </div>

                    <!-- Alamat -->
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-home me-1 text-primary"></i>Alamat
                        </label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  name="address" 
                                  rows="2" 
                                  placeholder="Masukkan alamat lengkap">{{ old('address', Auth::user()->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Info Tambahan -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-plus me-1 text-primary"></i>Bergabung
                        </label>
                        <input type="text" 
                               class="form-control" 
                               value="{{ Auth::user()->created_at->format('d F Y') }}" 
                               disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-clock me-1 text-primary"></i>Terakhir Login
                        </label>
                        <input type="text" 
                               class="form-control" 
                               value="{{ Auth::user()->last_login_at ? Auth::user()->last_login_at->diffForHumans() : 'Pertama kali' }}" 
                               disabled>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.change-password') }}" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Preview avatar sebelum upload
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.querySelector('.rounded-circle');
                if (img) {
                    img.src = e.target.result;
                } else {
                    const div = document.querySelector('.rounded-circle.bg-primary');
                    if (div) {
                        div.innerHTML = `<img src="${e.target.result}" class="rounded-circle" width="120" height="120" style="object-fit: cover;">`;
                    }
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush