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

        /* HEADER */
        header {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 18px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(26,18,8,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-wrap {
            width: 52px; height: 52px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 10px 32px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
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
        }

        .btn-logout:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* MAIN */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 20px;
            max-width: 760px;
            width: 100%;
            align-items: start;
        }

        /* CARD */
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

        /* INFO ROWS */
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
            width: 80px;
            flex-shrink: 0;
        }

        .info-label::after { content: ' :'; }
        .info-value { font-size: 0.875rem; color: var(--dark); }

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

        /* MENU LINKS */
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

        @media (max-width: 640px) {
            header { padding: 14px 20px; }
            .content-grid { grid-template-columns: 1fr; }
            main { padding: 28px 16px; }
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
            <div class="header-title">Peserta Selesai Magang</div>
        </div>

        <form action="{{ route('peserta.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                Logout
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
                    <span class="info-label">Sekolah</span>
                    <span class="info-value">{{ $peserta->sekolah }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jurusan</span>
                    <span class="info-value">{{ $peserta->bidang_jurusan }}</span>
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
                        Cetak Logbook
                    </a>
                    <div class="menu-divider"></div>
                    <a href="{{ route('peserta.nilai.pdf', auth()->guard('peserta')->user()->id_peserta) }}"
                       target="_blank" class="menu-link">
                        Cetak Nilai
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>