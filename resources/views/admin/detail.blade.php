<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Calon Peserta - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/detail.css') }}">
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.calon') }}" class="nav-item active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                    <line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                    <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Daftar Calon Peserta
            </a>
            <a href="{{ route('admin.peserta') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Daftar Peserta Magang
            </a>
            <a href="{{ route('admin.riwayat') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
                Daftar Riwayat Peserta
            </a>
            <a href="{{ route('admin.presensi') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Presensi
            </a>
            <a href="{{ route('admin.pembimbing') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        <div class="page-header">
            <button type="button" class="btn-hamburger-admin" id="btnHamburger" aria-label="Buka menu">
                <span></span><span></span><span></span>
            </button>
            <div class="page-header-title">Daftar Calon Peserta Magang</div>
        </div>

        <div class="page-body">
            <div class="detail-grid">

                <!-- PROFIL -->
                <div class="card">
                    <div class="card-label">Profil Peserta Magang</div>

                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $peserta->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NIS/NIM</span>
                        <span class="info-value">{{ $peserta->nisn_nim }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Sekolah/Kampus</span>
                        <span class="info-value">{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jurusan</span>
                        <span class="info-value">{{ $peserta->jurusan->jurusan ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kelas</span>
                        <span class="info-value">{{ $peserta->kelas }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">No HP</span>
                        <span class="info-value">{{ $peserta->no_telp }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Semester</span>
                        <span class="info-value">{{ $peserta->semester }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $peserta->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            @php $status = $peserta->hasilPendaftaran->status ?? 'pending'; @endphp
                            <span class="badge badge-{{ $status }}">{{ ucfirst($status) }}</span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Awal Magang</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Akhir Magang</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y') }}</span>
                    </div>
                </div>

                <!-- BERKAS + AKSI -->
                <div style="display:flex; flex-direction:column; gap:16px;">

                    <div class="card">
                        <div class="card-label">Berkas Peserta Magang</div>
                        @foreach($peserta->hasilPendaftaran->berkas as $b)
                            <a href="{{ asset('storage/'.$b->file_berkas) }}"
                               target="_blank" class="berkas-link">
                                Lihat Berkas
                            </a>
                        @endforeach
                    </div>

                    <div class="aksi-group">

    <!-- TERIMA -->
    <form id="formTerima"
          action="{{ route('admin.terima', $peserta->id_peserta) }}"
          method="POST">
        @csrf
        <button type="submit" class="btn btn-success">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            Terima
        </button>
    </form>

    <!-- TOLAK -->
    <form id="formTolak"
          action="{{ route('admin.tolak', $peserta->id_peserta) }}"
          method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Tolak
        </button>
    </form>

</div>

                </div>
            </div>
        </div>

        <!-- KEMBALI -->
        <div class="page-footer">
            <a href="{{ route('admin.calon') }}" class="btn btn-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin/sidebar.js') }}"></script>
    <script src="{{ asset('js/admin/detail.js') }}"></script>
</body>
</html>
