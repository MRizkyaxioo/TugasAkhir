<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Magang Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function setVhVariable() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }
        setVhVariable();
        window.addEventListener('resize', setVhVariable);
        window.addEventListener('orientationchange', setVhVariable);
    </script>
</head>
<body>

    <!-- OVERLAY (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebarAdmin">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.calon') }}"
               class="nav-item {{ request()->routeIs('admin.calon') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                    <line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                    <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Daftar Calon Peserta
            </a>

            <a href="{{ route('admin.peserta') }}"
               class="nav-item {{ request()->routeIs('admin.peserta') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Daftar Peserta Magang
            </a>

            <a href="{{ route('admin.riwayat') }}"
               class="nav-item {{ request()->routeIs('admin.riwayat') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
                Daftar Riwayat Peserta
            </a>

            <a href="{{ route('admin.presensi') }}"
               class="nav-item {{ request()->routeIs('admin.presensi') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Presensi
            </a>

            <a href="{{ route('admin.pembimbing') }}"
               class="nav-item {{ request()->routeIs('admin.pembimbing') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Data Pembimbing
            </a>

            <a href="{{ route('admin.jurusan') }}"
               class="nav-item {{ request()->routeIs('admin.jurusan') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
                Data Jurusan
            </a>

            <a href="{{ route('admin.sekolah') }}"
               class="nav-item {{ request()->routeIs('admin.sekolah') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Data Sekolah/Kampus
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-content">

        <!-- TOP BAR -->
        <div class="topbar">
            <button type="button" class="btn-hamburger-admin" id="btnHamburger" aria-label="Buka menu">
                <span></span><span></span><span></span>
            </button>

            <div style="text-align: center;">
                <div class="topbar-title">Selamat Datang Admin</div>
                <div class="topbar-sub">
                    Login sebagai : {{ auth()->guard('admin')->user()->username ?? auth()->guard('pembimbing')->user()->username ?? '-' }}
                </div>
            </div>

            <button type="button" class="btn-profile-admin" id="btnProfileAdmin" aria-label="Profil Admin">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </button>
        </div>

        <!-- BODY -->
        <div class="page-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-title">Statistik Peserta Magang</div>

                <div class="stat-grid">
                    <div class="stat-block">
                        <h4>Mahasiswa/Siswa Aktif</h4>
                        <div class="stat-num">{{ $siswa }}</div>
                    </div>
                    <div class="stat-block">
                        <h4>Mahasiswi/Siswi Aktif</h4>
                        <div class="stat-num">{{ $siswi }}</div>
                    </div>
                    <div class="stat-block">
                        <h4>Total Peserta Aktif</h4>
                        <div class="stat-num">{{ $total }}</div>
                    </div>
                </div>

                <div class="kuota-section">
                    <h3>Atur Kuota Magang</h3>
                    <form action="{{ route('admin.update.kuota') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="kuota-form">
                            <input type="number" name="kuota" min="0"
                                   placeholder="Atur disini" required>
                            <button type="submit" class="btn-tambah">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- POPUP PROFIL ADMIN -->
    <div class="modal-overlay" id="profileModalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Profil Admin</h3>
                <button type="button" class="modal-close" id="btnCloseProfileModal" aria-label="Tutup">&times;</button>
            </div>

            <form id="formProfileAdmin">
                @csrf
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" id="inputUsername" name="username">
                </div>

                <div class="form-group">
                    <label for="inputPassword">Password Baru</label>
                    <div class="password-field-wrapper">
                        <input type="password" id="inputPassword" name="password"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        <button type="button" class="btn-toggle-password" id="btnTogglePassword" aria-label="Tampilkan password" tabindex="-1">
                            <svg id="iconEyeOpen" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="iconEyeClosed" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.9 18.9 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    <small class="form-hint">
                        Untuk keamanan, password lama tidak bisa ditampilkan. Isi kolom ini hanya jika ingin menggantinya (minimal 5 karakter).
                    </small>
                </div>

                <button type="submit" class="btn-tambah" style="width:100%;">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/admin/sidebar.js') }}"></script>
    <script>
        (function () {
            const btnProfile = document.getElementById('btnProfileAdmin');
            const overlay = document.getElementById('profileModalOverlay');
            const btnClose = document.getElementById('btnCloseProfileModal');
            const form = document.getElementById('formProfileAdmin');
            const inputUsername = document.getElementById('inputUsername');
            const inputPassword = document.getElementById('inputPassword');
            const btnTogglePassword = document.getElementById('btnTogglePassword');
            const iconEyeOpen = document.getElementById('iconEyeOpen');
            const iconEyeClosed = document.getElementById('iconEyeClosed');

            btnTogglePassword.addEventListener('click', function () {
                const isHidden = inputPassword.type === 'password';
                inputPassword.type = isHidden ? 'text' : 'password';
                iconEyeOpen.style.display = isHidden ? 'none' : 'block';
                iconEyeClosed.style.display = isHidden ? 'block' : 'none';
                btnTogglePassword.setAttribute(
                    'aria-label',
                    isHidden ? 'Sembunyikan password' : 'Tampilkan password'
                );
            });

            function openModal() {
                overlay.classList.add('is-open');

                fetch("{{ route('admin.profile') }}", {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(res => res.json())
                    .then(data => {
                        inputUsername.value = data.username ?? '';
                        inputPassword.value = '';
                        inputPassword.type = 'password';
                        iconEyeOpen.style.display = 'block';
                        iconEyeClosed.style.display = 'none';
                    })
                    .catch(() => {
                        Swal.fire('Gagal', 'Tidak bisa memuat data profil.', 'error');
                    });
            }

            function closeModal() {
                overlay.classList.remove('is-open');
            }

            btnProfile.addEventListener('click', openModal);
            btnClose.addEventListener('click', closeModal);
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) closeModal();
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch("{{ route('admin.profile.update') }}", {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(res => res.json().then(data => ({ status: res.status, body: data })))
                    .then(({ status, body }) => {
                        if (status >= 200 && status < 300 && body.success) {
                            closeModal();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: body.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            const firstError = body.errors
                                ? Object.values(body.errors)[0][0]
                                : (body.message || 'Terjadi kesalahan.');
                            Swal.fire('Gagal', firstError, 'warning');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data.', 'error');
                    });
            });
        })();
    </script>

</body>
</html>
