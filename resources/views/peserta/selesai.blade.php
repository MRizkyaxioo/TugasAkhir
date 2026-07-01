<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta Selesai Magang - Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/selesai.css') }}">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-left">
            <div class="logo-wrap">
                <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
            </div>
        </div>

        <div class="header-center">
            <div class="header-title">Peserta Selesai Magang</div>
        </div>

        <form action="{{ route('peserta.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <span class="logout-text">Logout</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </button>
        </form>
    </header>

    <!-- MAIN -->
    <main>
        <div class="content-grid">

            <!-- KIRI: DETAIL -->
            <div class="card">
                <div class="card-label">Detail Peserta Magang</div>
                <div class="info-row">
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $peserta->nama }}</span>
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
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="badge-selesai">Selesai</span>
                    </span>
                </div>
            </div>

            <!-- KANAN: MENU -->
            <div class="card">
                <div class="card-label">Menu</div>
                <div class="menu-card">
                    <a href="{{ route('peserta.logbook.export.pdf') }}"
                       target="_blank" class="menu-link">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             style="display:inline; vertical-align:middle; margin-right:6px;">
                            <polyline points="6 9 6 2 18 2 18 9"/>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                            <rect x="6" y="14" width="12" height="8"/>
                        </svg>
                        Cetak Logbook
                    </a>
                    <div class="menu-divider"></div>
                    <a href="{{ route('peserta.nilai.pdf', auth()->guard('peserta')->user()->id_peserta) }}"
                       target="_blank" class="menu-link">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             style="display:inline; vertical-align:middle; margin-right:6px;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                        Cetak Nilai
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
