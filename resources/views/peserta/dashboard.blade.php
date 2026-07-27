<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/dashboard.css') }}?v={{ time() }}">
</head>
<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>
        <nav class="sidebar-nav">
            <a href="/dashboard-peserta" class="nav-item active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('peserta.logbook') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                Logbook Harian
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('peserta.logout') }}" method="POST">
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

        @php $pembimbing = $peserta->pembimbing->first(); @endphp

        <div class="topbar">
            <!-- Hamburger (mobile only) -->
            <button class="btn-hamburger-sidebar" id="btnOpenSidebar" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="topbar-center">
                <div class="topbar-title">
                    Selamat Datang {{ $peserta->nama }}
                    @if($pembimbing)
                        <div class="pembimbing-info">
                            Pembimbing Lapangan: <strong>{{ $pembimbing->nama }}</strong>
                            | NO HP Pembimbing: {{ $pembimbing->no_telp }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="topbar-profile">
    <button type="button" id="btnEditProfile" class="profile-btn">
        <svg width="22" height="22" viewBox="0 0 24 24"
            fill="none" stroke="currentColor"
            stroke-width="2">
            <path d="M20 21a8 8 0 0 0-16 0"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
    </button>
</div>
        </div>

        <div class="page-body">

            <!-- KIRI: PRESENSI -->
            <div class="card">
                <div class="card-label">Presensi</div>

                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                @if($presensi)
                    @if($sudahPresensi)
                        <div class="sudah-presensi">
                            ✔ Kamu sudah presensi hari ini
                        </div>
                    @else
                        {{-- COUNTDOWN --}}
                        <div style="text-align:center; margin-bottom:12px; font-size:0.85rem; color: var(--muted);">
                            Sisa waktu presensi:
                            <span id="countdown" style="font-weight:600; color: var(--gold);"></span>
                        </div>

                        {{-- TOMBOL HADIR / IZIN / SAKIT --}}
                        <div class="presensi-grid">
                            <div class="presensi-col">
                                <h4>Hadir</h4>
                                <form action="{{ route('peserta.presensi') }}" method="POST" style="width:100%;">
                                    @csrf
                                    <input type="hidden" name="id_presensi" value="{{ $presensi->id_presensi }}">
                                    <input type="hidden" name="status" value="hadir">
                                    <button type="submit" class="btn-presensi">Hadir</button>
                                </form>
                            </div>
                            <div class="presensi-col">
                                <h4>Izin</h4>
                                <button type="button" class="btn-presensi"
                                        onclick="document.getElementById('form-tidak-hadir').style.display='block'; document.getElementById('input-status-tidak-hadir').value='izin'">
                                    Izin
                                </button>
                            </div>
                            <div class="presensi-col">
                                <h4>Sakit</h4>
                                <button type="button" class="btn-presensi"
                                        onclick="document.getElementById('form-tidak-hadir').style.display='block'; document.getElementById('input-status-tidak-hadir').value='sakit'">
                                    Sakit
                                </button>
                            </div>
                        </div>

                        <p class="presensi-notice">
                            Untuk yang tidak bisa hadir maka wajib mengirim surat sebagai bukti tidak hadir.
                        </p>

                        {{-- FORM IZIN/SAKIT --}}
                        <form id="form-tidak-hadir" action="{{ route('peserta.presensi') }}" method="POST"
                              enctype="multipart/form-data" style="display:none;">
                            @csrf
                            <input type="hidden" name="id_presensi" value="{{ $presensi->id_presensi }}">
                            <input type="hidden" name="status" value="" id="input-status-tidak-hadir">
                            <div class="upload-row">
                                <input type="file" name="surat" accept="application/pdf"
                                       class="file-input" required>
                                <button type="submit" class="btn-kirim">Kirim</button>
                            </div>
                        </form>
                    @endif
                @else
                    <p style="text-align:center; color:var(--muted); font-size:0.85rem; padding:12px 0;">
                        Presensi belum dibuka oleh admin
                    </p>
                @endif
            </div>

            <!-- KANAN: SURAT BALASAN -->
            <div class="card">
                <div class="card-label">Surat Balasan Magang</div>
                @if($peserta->hasilPendaftaran && $peserta->hasilPendaftaran->file_berkas_balasan)
                    <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->file_berkas_balasan) }}"
                       target="_blank" class="berkas-link">Lihat Berkas</a>
                @else
                    <p class="no-surat">Surat balasan belum tersedia</p>
                @endif
            </div>

        </div>
    </div>
    
    <div class="modal-profile" id="profileModal">

    <div class="modal-content-profile">

        <div class="modal-header-profile">

            <h3>Edit Profil</h3>

            <button type="button"
                class="close-profile"
                id="closeProfile">
                &times;
            </button>

        </div>
        
        
        @if ($errors->any())
    <div class="alert-error" style="margin-bottom:15px;">
        <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('peserta.updateProfil') }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>

                <input
                    type="text"
                    name="nama"
                    value="{{ $peserta->nama }}"
                    required>
            </div>

            <div class="form-group">
                <label>No Telepon</label>

                <input
                    type="text"
                    name="no_telp"
                    value="{{ $peserta->no_telp }}"
                    required>
            </div>

            <div class="form-group">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ $peserta->email }}"
                    required>
            </div>

            <div class="form-group">
                <label>Alamat</label>

                <textarea
                    name="alamat"
                    rows="3"
                    required>{{ $peserta->alamat }}</textarea>
            </div>

            <button
                class="btn-kirim"
                type="submit">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

    <script>
        
        const profileModal = document.getElementById("profileModal");

const btnEditProfile = document.getElementById("btnEditProfile");

const closeProfile = document.getElementById("closeProfile");

btnEditProfile.addEventListener("click", function () {
    profileModal.classList.add("show");
});

closeProfile.addEventListener("click", function () {
    profileModal.classList.remove("show");
});

profileModal.addEventListener("click", function(e){

    if(e.target === profileModal){
        profileModal.classList.remove("show");
    }

});
@if ($errors->any())
    profileModal.classList.add("show");
@endif
        
        
        // ── Fix 100vh di mobile (address bar bikin 100vh > tinggi layar terlihat) ──
        // Browser modern sudah punya 100dvh (sudah di-set lewat CSS), tapi ini fallback
        // untuk browser lama yang belum support dvh, supaya sidebar & tombol logout
        // tetap pas dengan tinggi layar yang BENAR-BENAR terlihat.
        function setVhVariable() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }
        setVhVariable();
        window.addEventListener('resize', setVhVariable);
        window.addEventListener('orientationchange', setVhVariable);

        // ── Sidebar drawer (mobile) ──
        const sidebar        = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const btnOpen        = document.getElementById('btnOpenSidebar');

        function openSidebar() {
            sidebar.classList.add('is-open');
            sidebarOverlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('is-open');
            sidebarOverlay.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        btnOpen.addEventListener('click', openSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Tutup sidebar saat link nav diklik di mobile
        document.querySelectorAll('.nav-item').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });

        // ── Presensi status sync ──
        document.querySelectorAll('.presensi-col button[type=button]').forEach(btn => {
            btn.addEventListener('click', function() {
                const status = this.closest('.presensi-col').querySelector('h4').textContent.toLowerCase();
                document.getElementById('input-status-tidak-hadir').value = status;
            });
        });

        // ── Countdown ──
        @if(isset($closeTime) && $closeTime)
            const closeTime = "{{ $closeTime }}";
            const [hours, minutes] = closeTime.split(':').map(Number);

            function updateCountdown() {
                const now    = new Date();
                const target = new Date();
                target.setHours(hours, minutes, 0, 0);
                const diff = target - now;
                if (diff <= 0) {
                    document.getElementById('countdown').textContent = 'Presensi telah ditutup';
                    return;
                }
                const h = Math.floor(diff / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);
                document.getElementById('countdown').textContent = `${h}j ${m}m ${s}d`;
            }
            updateCountdown();
            setInterval(updateCountdown, 1000);
        @endif
        
        
    </script>

</body>
</html>
