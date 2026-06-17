<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta Selesai Magang - Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5E6D0;
            --warm-white: #FDF4E7;
            --gold: #C8873A;
            --gold-light: #E8A85A;
            --dark: #1A1208;
            --muted: #7A6E62;
            --card-bg: #FFFFFF;
            --shadow: 0 4px 24px rgba(26,18,8,0.08);
            --radius: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── HEADER ── */
        header {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 16px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 2px 12px rgba(26,18,8,0.05);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .logo-wrap {
            width: 48px; height: 48px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        /* Judul di tengah — flex item dengan margin auto */
        .header-center {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 10px 28px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
            white-space: nowrap;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-logout:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── MAIN ── */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            max-width: 760px;
            width: 100%;
            align-items: start;
        }

        /* ── CARD ── */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 24px 28px;
        }

        .card-label {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #F5E6D0;
        }

        /* ── INFO ROWS ── */
        .info-row {
            display: flex;
            align-items: baseline;
            padding: 9px 0;
            border-bottom: 1px solid #F5E6D0;
            gap: 10px;
        }

        .info-row:last-child { border-bottom: none; }

        .info-label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
            width: 100px;
            flex-shrink: 0;
        }

        .info-label::after { content: ' :'; }

        .info-value {
            font-size: 0.875rem;
            color: var(--dark);
        }

        .badge-selesai {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            background: #E0F2FE;
            color: #075985;
            border: 1px solid #BAE6FD;
        }

        /* ── MENU LINKS ── */
        .menu-card {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .menu-link {
            display: block;
            text-align: center;
            padding: 14px;
            background: var(--cream);
            border-radius: 10px;
            color: var(--gold);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border: 1.5px solid rgba(200,135,58,0.15);
            transition: background 0.2s, transform 0.15s;
        }

        .menu-link:hover {
            background: rgba(200,135,58,0.1);
            transform: translateY(-1px);
        }

        .menu-divider {
            height: 1px;
            background: #F5E6D0;
            margin: 4px 0;
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — TABLET (≤700px)
        ══════════════════════════════════════════ */
        @media (max-width: 700px) {
            header {
                padding: 12px 16px;
                gap: 10px;
            }

            .logo-wrap {
                width: 36px;
                height: 36px;
            }

            /* Judul tidak lagi di tengah — ikut flow normal */
            .header-center {
                justify-content: flex-start;
            }

            .header-title {
                font-size: 0.88rem;
                padding: 8px 16px;
                border-radius: 10px;
                white-space: normal;
                text-align: center;
            }

            /* Sembunyikan teks Logout, sisakan ikon saja */
            .btn-logout .logout-text {
                display: none;
            }

            .btn-logout {
                padding: 8px 12px;
            }

            /* Content grid: 1 kolom */
            .content-grid {
                grid-template-columns: 1fr;
            }

            main {
                padding: 24px 12px 40px;
                align-items: flex-start;
            }

            .card {
                padding: 20px 18px;
            }

            /* Info row: stack label di atas, value di bawah */
            .info-row {
                flex-direction: column;
                gap: 2px;
                padding: 10px 0;
            }

            .info-label {
                width: auto;
                font-size: 0.75rem;
            }

            .info-value {
                font-size: 0.875rem;
            }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤400px)
        ══════════════════════════════════════════ */
        @media (max-width: 400px) {
            .header-title {
                font-size: 0.8rem;
                padding: 7px 12px;
            }

            .info-label {
                width: 80px;
            }
        }
    </style>
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