<div class="card-body">
    <form method="POST" action="{{ route('profile.update-password') }}">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Password Saat Ini -->
            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-lock me-1 text-warning"></i>Password Saat Ini
                </label>
                <div class="position-relative">
                    <input type="password" 
                           class="form-control @error('current_password') is-invalid @enderror" 
                           name="current_password" 
                           id="current_password" 
                           placeholder="Masukkan password saat ini" 
                           required>
                    <button type="button" class="btn btn-link position-absolute end-0 top-0 text-muted" 
                            style="padding: 10px 15px;" 
                            onclick="togglePassword('current_password')">
                        <i class="fas fa-eye" id="current_password_icon"></i>
                    </button>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password Baru -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-key me-1 text-success"></i>Password Baru
                </label>
                <div class="position-relative">
                    <input type="password" 
                           class="form-control @error('new_password') is-invalid @enderror" 
                           name="new_password" 
                           id="new_password" 
                           placeholder="Minimal 8 karakter" 
                           required>
                    <button type="button" class="btn btn-link position-absolute end-0 top-0 text-muted" 
                            style="padding: 10px 15px;" 
                            onclick="togglePassword('new_password')">
                        <i class="fas fa-eye" id="new_password_icon"></i>
                    </button>
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Password minimal 8 karakter, mengandung huruf dan angka.
                </small>
            </div>

            <!-- Konfirmasi Password Baru -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-check-circle me-1 text-success"></i>Konfirmasi Password Baru
                </label>
                <div class="position-relative">
                    <input type="password" 
                           class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                           name="new_password_confirmation" 
                           id="new_password_confirmation" 
                           placeholder="Ulangi password baru" 
                           required>
                    <button type="button" class="btn btn-link position-absolute end-0 top-0 text-muted" 
                            style="padding: 10px 15px;" 
                            onclick="togglePassword('new_password_confirmation')">
                        <i class="fas fa-eye" id="new_password_confirmation_icon"></i>
                    </button>
                    @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="password_match_message" class="small mt-1"></div>
            </div>

            <!-- Tips Keamanan -->
            <div class="col-12 mb-3">
                <div class="alert alert-info">
                    <h6 class="mb-2"><i class="fas fa-shield-alt me-2"></i>Tips Keamanan Password:</h6>
                    <ul class="mb-0">
                        <li>Gunakan minimal 8 karakter</li>
                        <li>Kombinasikan huruf besar, huruf kecil, dan angka</li>
                        <li>Jangan gunakan password yang sama dengan akun lain</li>
                        <li>Jangan berikan password kepada siapapun</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Update Password
            </button>
            <a href="{{ route('profile') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Profile
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Toggle Password Visibility
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '_icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    // Password Match Validation (Real-time)
    document.addEventListener('DOMContentLoaded', function() {
        const password = document.getElementById('new_password');
        const confirm = document.getElementById('new_password_confirmation');
        const message = document.getElementById('password_match_message');

        function checkMatch() {
            if (confirm.value.length === 0) {
                message.innerHTML = '';
                return;
            }
            
            if (password.value === confirm.value) {
                message.innerHTML = '<i class="fas fa-check-circle text-success"></i> Password cocok!';
                message.className = 'text-success small mt-1';
                confirm.style.borderColor = '#48bb78';
            } else {
                message.innerHTML = '<i class="fas fa-times-circle text-danger"></i> Password tidak cocok!';
                message.className = 'text-danger small mt-1';
                confirm.style.borderColor = '#ef4444';
            }
        }

        password.addEventListener('input', checkMatch);
        confirm.addEventListener('input', checkMatch);

        // Password strength indicator (optional)
        password.addEventListener('input', function() {
            const val = this.value;
            const strength = document.getElementById('password_strength');
            
            if (val.length === 0) return;
            
            let score = 0;
            if (val.length >= 8) score++;
            if (val.match(/[a-z]/) && val.match(/[A-Z]/)) score++;
            if (val.match(/[0-9]/)) score++;
            if (val.match(/[^a-zA-Z0-9]/)) score++;
            
            let color = '#ef4444';
            let text = 'Lemah';
            if (score >= 4) { color = '#48bb78'; text = 'Kuat'; }
            else if (score >= 3) { color = '#f6c23e'; text = 'Sedang'; }
            
            // Bisa ditambahkan indikator strength jika diperlukan
        });
    });
</script>
@endpush