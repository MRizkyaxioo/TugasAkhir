<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang Perpus - Politeknik Negeri Banjarmasin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5E6D0;
            --warm-white: #FFFDF9;
            --gold: #C8873A;
            --gold-light: #E8A85A;
            --dark: #1A1208;
            --muted: #7A6E62;
            --card-bg: #FFFFFF;
            --shadow: 0 4px 24px rgba(26,18,8,0.08);
            --radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            padding: 18px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(26,18,8,0.05);
            position: relative;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-wrap {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

        .logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-placeholder {
            width: 40px;
            height: 40px;
            /* fallback jika gambar tidak ada */
        }

        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .brand-text p {
            font-size: 1rem;
            color: var(--muted);
            font-weight: 300;
            margin-top: 2px;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 10px 24px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
            letter-spacing: 0.01em;
        }

        .btn-login:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(200,135,58,0.45);
        }

        .btn-login svg {
            transition: transform 0.2s;
        }

        .btn-login:hover svg {
            transform: translateX(3px);
        }

        /* ── MAIN ── */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 24px;
            max-width: 860px;
            width: 100%;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 36px 32px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
        }

        .card-info h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .card-info p {
            font-size: 0.9rem;
            line-height: 1.75;
            color: var(--muted);
            font-weight: 300;
        }

        .card-stats {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        .stat-block {
            text-align: center;
            padding: 20px;
            background: var(--cream);
            border-radius: 12px;
        }

        .stat-block h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .stat-block .stat-value {
            font-size: 1.5rem;
            font-weight: 500;
            color: #1A1208;
        }

        .stat-block .stat-label {
            font-size: 0.8rem;
            color: var(--muted);
        }

        /* ── DIVIDER ── */
        .divider {
            width: 40px;
            height: 2px;
            background: linear-gradient(to right, var(--gold), transparent);
            margin: 14px 0;
            border-radius: 2px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            header {
                padding: 14px 20px;
            }

            .brand-text h1 {
                font-size: 0.9rem;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 28px 22px;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
  <header>
    <div class="logo-wrap">
        <img src="{{ asset('images/logo-poliban.jpg') }}"
             alt="Logo Poliban"
             onerror="this.style.display='none'">
    </div>

    <div class="brand-text" style="position:absolute; left:50%; transform:translateX(-50%); text-align:center;">
        <h1>Perpustakaan Politeknik Negeri Banjarmasin</h1>
        <p>Penerimaan dan Pengelolaan Peserta Magang</p>
    </div>

    <a href="{{ route('peserta.login') }}" class="btn-login">
        Login
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 8 16 12 12 16"/>
            <line x1="8" y1="12" x2="16" y2="12"/>
        </svg>
    </a>
</header>

    <!-- MAIN -->
    <main>
        <div class="grid">

            <!-- Informasi Website -->
            <div class="card card-info">
                <h2>Informasi Website</h2>
                <div class="divider"></div>
                <p>
                    Website Penerimaan dan Pengelolaan Peserta Magang adalah platform
                    yang digunakan untuk memudahkan proses pendaftaran, seleksi, dan
                    pengelolaan data peserta magang secara terpusat. Website ini membantu
                    Admin dalam mengatur informasi peserta, memantau status magang, serta
                    meningkatkan efisiensi dan transparansi dalam pengelolaan program magang.
                </p>
            </div>

            <!-- Statistik -->
            <div class="card card-stats">
                <div class="stat-block">
                    <h3>Kuota Magang</h3>
                    <div class="stat-value">{{ $kuota }} orang</div>
                    <div class="stat-label">Tersisa</div>
                </div>
                <div class="stat-block">
                    <h3>Peserta Aktif</h3>
                    <div class="stat-value">{{ $pesertaAktif }} orang</div>
                    <div class="stat-label">Sedang berjalan</div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>