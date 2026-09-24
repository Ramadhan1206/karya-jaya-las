<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Karyawan - Karya Jaya Las</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            color: #1a2b4a;
        }

        .header h1 span {
            color: #f39c12;
        }

        .header .sub {
            color: #6c757d;
            font-size: 14px;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #d1d9e6;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.2s;
            background: #fafcff;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #f39c12;
            box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.15);
            background: white;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            gap: 14px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: 0.25s;
            flex: 1;
            min-width: 130px;
        }

        .btn-primary {
            background: #1a2b4a;
            color: white;
        }

        .btn-primary:hover {
            background: #0f1d33;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(26, 43, 74, 0.25);
        }

        .btn-success {
            background: #f39c12;
            color: white;
        }

        .btn-success:hover {
            background: #d4880f;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(243, 156, 18, 0.35);
        }

        .btn-outline {
            background: transparent;
            color: #1a2b4a;
            border: 2px solid #d1d9e6;
        }

        .btn-outline:hover {
            background: #f1f4f9;
            border-color: #1a2b4a;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
            font-weight: 500;
        }

        .alert-success {
            background: #e6f9ed;
            color: #0e6b3e;
            border-left: 5px solid #2ecc71;
            display: block;
        }

        .alert-danger {
            background: #fde8e8;
            color: #a02c2c;
            border-left: 5px solid #e74c3c;
            display: block;
        }

        .preview-card {
            background: #f8faff;
            border-radius: 12px;
            padding: 16px 20px;
            border: 1px dashed #b0c4de;
            margin-top: 20px;
            display: none;
        }

        .preview-card.show {
            display: block;
        }

        .preview-card strong {
            color: #1a2b4a;
        }

        @media (max-width: 550px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .btn-group {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>👤 <span>Tambah</span> Karyawan</h1>
        <div class="sub">Karya Jaya Las Konstruksi · Admin Panel</div>
    </div>

    <!-- ALERT NOTIF -->
    <div id="alertBox" class="alert"></div>

    <!-- FORM -->
    <form id="formKaryawan">
        <div class="form-row">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" placeholder="Contoh: Ahmad Setiawan" required />
            </div>
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" placeholder="karyawan@karyajayalas.com" required />
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">Password Sementara</label>
                <input type="text" id="password" placeholder="Min. 6 karakter" required />
            </div>
            <div class="form-group">
                <label for="role">Role / Jabatan</label>
                <select id="role">
                    <option value="User">User (Karyawan)</option>
                    <option value="Admin">Admin</option>
                    <option value="Supervisor">Supervisor</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tglBergabung">Tanggal Bergabung</label>
            <input type="date" id="tglBergabung" required />
        </div>

        <!-- PREVIEW DATA -->
        <div id="previewCard" class="preview-card">
            <p><strong>📋 Pratinjau Data Karyawan</strong></p>
            <p id="previewText" style="margin-top:6px; color:#2d3748;"></p>
        </div>

        <!-- TOMBOL -->
        <div class="btn-group">
            <button type="button" class="btn btn-outline" onclick="resetForm()">↺ Reset</button>
            <button type="button" class="btn btn-primary" onclick="previewData()">📄 Pratinjau</button>
            <button type="submit" class="btn btn-success">➕ Tambah Karyawan</button>
        </div>
    </form>

    <!-- BACK LINK (mirip "Lihat Semua User") -->
    <div style="margin-top: 28px; text-align: right; border-top: 1px solid #e9ecef; padding-top: 18px;">
        <a href="#" style="color:#f39c12; font-weight:600; text-decoration:none; font-size:14px;">
            ← Kembali ke Daftar Semua Karyawan
        </a>
    </div>
</div>

<script>
    // Set default tanggal hari ini
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tglBergabung').value = today;

        // Sembunyikan alert awal
        const alert = document.getElementById('alertBox');
        alert.style.display = 'none';
        alert.className = 'alert';
    });

    // Fungsi preview data
    function previewData() {
        const nama = document.getElementById('nama').value.trim();
        const email = document.getElementById('email').value.trim();
        const role = document.getElementById('role').value;
        const tgl = document.getElementById('tglBergabung').value;

        if (!nama || !email || !tgl) {
            showAlert('Harap isi Nama, Email, dan Tanggal Bergabung terlebih dahulu.', 'danger');
            return;
        }

        const previewCard = document.getElementById('previewCard');
        const previewText = document.getElementById('previewText');

        previewText.innerHTML = `
            <strong>Nama:</strong> ${nama} <br />
            <strong>Email:</strong> ${email} <br />
            <strong>Role:</strong> ${role} <br />
            <strong>Bergabung:</strong> ${formatTanggal(tgl)}
        `;

        previewCard.classList.add('show');
        hideAlert();
    }

    // Format tanggal ke dd/mm/yyyy
    function formatTanggal(dateStr) {
        if (!dateStr) return '-';
        const parts = dateStr.split('-');
        return `${parts[2]}/${parts[1]}/${parts[0]}`;
    }

    // Alert helper
    function showAlert(message, type = 'success') {
        const alert = document.getElementById('alertBox');
        alert.textContent = message;
        alert.className = `alert alert-${type}`;
        alert.style.display = 'block';
    }

    function hideAlert() {
        const alert = document.getElementById('alertBox');
        alert.style.display = 'none';
        alert.className = 'alert';
    }

    // Reset form
    function resetForm() {
        document.getElementById('formKaryawan').reset();
        document.getElementById('previewCard').classList.remove('show');
        hideAlert();

        // Set tanggal lagi
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tglBergabung').value = today;
    }

    // SUBMIT — Simulasi tambah karyawan
    document.getElementById('formKaryawan').addEventListener('submit', function (e) {
        e.preventDefault();

        const nama = document.getElementById('nama').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const role = document.getElementById('role').value;
        const tgl = document.getElementById('tglBergabung').value;

        // Validasi
        if (!nama || !email || !password || !tgl) {
            showAlert('Semua field wajib diisi!', 'danger');
            return;
        }

        if (password.length < 6) {
            showAlert('Password minimal 6 karakter.', 'danger');
            return;
        }

        // Simulasi sukses tambah data
        // Di sini nanti akan dikirim ke backend (misal: fetch ke API)
        console.log('Data Karyawan Baru:', {
            nama,
            email,
            password,
            role,
            tglBergabung: tgl
        });

        // Tampilkan pesan sukses
        showAlert(`✅ Karyawan "${nama}" berhasil ditambahkan!`, 'success');

        // Reset form setelah sukses (opsional)
        // resetForm(); // kalau mau di-reset otomatis, uncomment

        // Tambahkan ke tabel (simulasi) — bisa juga redirect ke halaman daftar
        // Di implementasi nyata, Anda bisa lakukan window.location.href = "daftar-user.html"
    });

    // Validasi realtime sembunyikan alert saat user mengetik
    document.querySelectorAll('#formKaryawan input, #formKaryawan select').forEach(el => {
        el.addEventListener('input', hideAlert);
    });
</script>

</body>
</html>