<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5E6D0;
            --cream-dark: #EDD9BC;
            --warm-white: #FFFDF9;
            --gold: #C8873A;
            --gold-light: #E8A85A;
            --gold-pale: rgba(200,135,58,0.12);
            --dark: #1A1208;
            --muted: #7A6E62;
            --card-bg: #FFFFFF;
            --shadow: 0 4px 24px rgba(26,18,8,0.08);
            --shadow-lg: 0 12px 48px rgba(26,18,8,0.14);
            --radius: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
        }

        /* ── NAVBAR ── */
        nav {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 14px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 200;
            box-shadow: 0 2px 12px rgba(26,18,8,0.06);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0; /* allow text to shrink */
        }

        .nav-logo {
            width: 44px; height: 44px;
            flex-shrink: 0;
        }

        .nav-logo img { width: 100%; height: 100%; object-fit: contain; }

        .nav-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-brand-text span {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.7rem;
            font-weight: 300;
            color: var(--muted);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -3px; left: 0;
            width: 0; height: 2px;
            background: var(--gold);
            border-radius: 2px;
            transition: width 0.25s;
        }

        .nav-links a:hover { color: var(--gold); }
        .nav-links a:hover::after { width: 100%; }

        .btn-nav-login {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--gold);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 12px rgba(200,135,58,0.3);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-nav-login:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            position: relative;
            height: 520px;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-img {
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            filter: brightness(0.45);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                rgba(26,18,8,0.7) 0%,
                rgba(200,135,58,0.25) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 720px;
            margin: 0 auto;
            padding: 0 48px;
            text-align: center;
            width: 100%;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(200,135,58,0.25);
            border: 1px solid rgba(200,135,58,0.5);
            color: #E8A85A;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 5px 16px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .hero-title em {
            font-style: italic;
            color: var(--gold-light);
        }

        .hero-sub {
            font-size: 1rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            margin-bottom: 32px;
            font-weight: 300;
        }

        /* ── SECTIONS ── */
        section { padding: 72px 48px; }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 8px;
        }

        .section-divider {
            width: 48px; height: 3px;
            background: linear-gradient(to right, var(--gold), transparent);
            border-radius: 3px;
            margin: 0 auto 48px;
        }

        /* ── INFO WEBSITE ── */
        .info-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 24px;
            max-width: 900px;
            margin: 0 auto;
            align-items: start;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
        }

        .card-icon {
            width: 40px; height: 40px;
            background: var(--gold-pale);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
            color: var(--gold);
        }

        .card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .card p {
            font-size: 0.875rem;
            line-height: 1.75;
            color: var(--muted);
            font-weight: 300;
        }

        .stat-cards {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Di mobile, stat-cards berjajar horizontal */
        .stat-cards-row {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 20px 24px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            text-align: center;
        }

        .stat-card h4 {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .badge-kuota {
            display: inline-block;
            margin-top: 6px;
            background: #DCFCE7;
            color: #166534;
            border: 1px solid #BBF7D0;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 50px;
        }

        .badge-aktif {
            display: inline-block;
            margin-top: 6px;
            background: #E0F2FE;
            color: #075985;
            border: 1px solid #BAE6FD;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 50px;
        }

        /* ── ALUR PENDAFTARAN ── */
        .alur-section {
            background: var(--warm-white);
            border-top: 1px solid rgba(200,135,58,0.1);
            border-bottom: 1px solid rgba(200,135,58,0.1);
        }

        .alur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 860px;
            margin: 0 auto;
            position: relative;
        }

        .alur-grid::before {
            content: '';
            position: absolute;
            top: 40px; left: calc(16.6% + 12px); right: calc(16.6% + 12px);
            height: 2px;
            background: linear-gradient(to right, var(--gold), var(--gold-light), var(--gold));
            opacity: 0.3;
            z-index: 0;
        }

        .alur-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 28px 24px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            text-align: center;
            position: relative;
            z-index: 1;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .alur-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .alur-num {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            color: #fff;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
        }

        .alur-num svg { color: #fff; }

        .alur-card h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .alur-card p {
            font-size: 0.82rem;
            color: var(--muted);
            line-height: 1.65;
            font-weight: 300;
        }

        /* ── INFORMASI ── */
        .info-section { background: var(--cream); }

        .info-cards {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-main-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
        }

        .info-main-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .info-dot {
            width: 10px; height: 10px;
            background: var(--gold);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .info-main-card ol {
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .info-main-card ol li {
            font-size: 0.875rem;
            color: var(--muted);
            line-height: 1.65;
        }

        .info-main-card ol li ul {
            padding-left: 20px;
            margin-top: 4px;
        }

        .info-main-card ol li ul li {
            list-style: lower-alpha;
        }

        .info-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .jam-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #F5E6D0;
            font-size: 0.85rem;
        }

        .jam-row:last-child { border-bottom: none; }
        .jam-day { color: var(--muted); font-weight: 400; }
        .jam-time { color: var(--dark); font-weight: 500; }

        /* ── KONTAK ── */
        .kontak-section {
            background: var(--warm-white);
            border-top: 1px solid rgba(200,135,58,0.1);
        }

        .kontak-grid {
            display: flex;
            gap: 16px;
            max-width: 600px;
            margin: 0 auto;
            justify-content: center;
        }

        .kontak-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--card-bg);
            border-radius: 12px;
            padding: 14px 20px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            text-decoration: none;
            color: var(--dark);
            font-size: 0.85rem;
            font-weight: 500;
            transition: transform 0.2s, box-shadow 0.2s;
            flex: 1;
        }

        .kontak-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .kontak-icon {
            width: 36px; height: 36px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .kontak-icon.instagram { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .kontak-icon.facebook  { background: #1877F2; }

        .kontak-icon svg { color: #fff; }

        .kontak-text small {
            display: block;
            font-size: 0.7rem;
            color: var(--muted);
            font-weight: 300;
        }

        /* ── HAMBURGER ── */
        .btn-hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 38px;
            height: 38px;
            background: transparent;
            border: 1px solid rgba(200,135,58,0.25);
            border-radius: 8px;
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .btn-hamburger:hover {
            background: var(--gold-pale);
        }

        .btn-hamburger span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--dark);
            border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s;
            transform-origin: center;
        }

        /* Animasi X saat menu terbuka */
        .btn-hamburger.is-open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .btn-hamburger.is-open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .btn-hamburger.is-open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* ── MOBILE MENU DRAWER ── */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 199;
        }

        /* Overlay gelap di belakang drawer */
        .mobile-menu-overlay {
            position: absolute;
            inset: 0;
            background: rgba(26,18,8,0.45);
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Panel drawer dari kanan */
        .mobile-menu-panel {
            position: absolute;
            top: 0; right: 0;
            width: 260px;
            height: 100%;
            background: var(--warm-white);
            box-shadow: -8px 0 32px rgba(26,18,8,0.15);
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            padding: 24px 0 0;
            overflow-y: auto;
            z-index: 1;
        }

        .mobile-menu.is-open {
            display: block;
        }

        .mobile-menu.is-open .mobile-menu-overlay {
            opacity: 1;
        }

        .mobile-menu.is-open .mobile-menu-panel {
            transform: translateX(0);
        }

        .mobile-menu-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(200,135,58,0.15);
            margin-bottom: 8px;
        }

        .mobile-menu-header .nav-brand-text {
            font-size: 0.85rem;
        }

        .btn-close-menu {
            width: 32px;
            height: 32px;
            background: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }

        .btn-close-menu:hover {
            background: var(--gold-pale);
            color: var(--gold);
        }

        .mobile-nav-links {
            list-style: none;
            padding: 0 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
        }

        .mobile-nav-links a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 12px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.2s, color 0.2s;
        }

        .mobile-nav-links a:hover {
            background: var(--gold-pale);
            color: var(--gold);
        }

        .mobile-nav-links a svg {
            color: var(--gold);
            flex-shrink: 0;
        }

        .mobile-menu-footer {
            padding: 16px 20px 24px;
            border-top: 1px solid rgba(200,135,58,0.15);
            margin-top: auto;
        }

        .mobile-menu-footer .btn-nav-login {
            width: 100%;
            justify-content: center;
            padding: 10px 20px;
            font-size: 0.85rem;
            display: inline-flex !important;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--dark);
            color: rgba(255,255,255,0.7);
            padding: 24px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.78rem;
            gap: 16px;
        }

        .footer-address {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-address svg { color: var(--gold); flex-shrink: 0; }
        .footer-copy { color: rgba(255,255,255,0.45); }

        /* ══════════════════════════════════════════
           RESPONSIVE — TABLET (≤900px)
        ══════════════════════════════════════════ */
        @media (max-width: 900px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            /* Di tablet stat-cards bisa berjajar 2 kolom */
            .stat-cards {
                flex-direction: row;
            }

            .stat-card {
                flex: 1;
            }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — MOBILE (≤768px)
        ══════════════════════════════════════════ */
        @media (max-width: 768px) {

            /* Navbar */
            nav {
                padding: 12px 16px;
                gap: 10px;
            }

            .nav-brand-text {
                font-size: 0.8rem;
            }

            .nav-brand-text span {
                font-size: 0.65rem;
            }

            .nav-logo {
                width: 36px;
                height: 36px;
            }

            .nav-links {
                display: none;
            }

            .btn-hamburger {
                display: flex;
            }

            /* Tombol login di navbar disembunyikan — pindah ke dalam drawer */
            .btn-nav-login {
                display: none;
            }

            /* Hero */
            .hero {
                height: auto;
                min-height: 420px;
                padding: 60px 0;
            }

            .hero-content {
                padding: 0 20px;
            }

            .hero-badge {
                font-size: 0.65rem;
                padding: 4px 12px;
                margin-bottom: 14px;
            }

            .hero-title {
                font-size: 1.6rem;
                margin-bottom: 12px;
            }

            .hero-sub {
                font-size: 0.88rem;
                margin-bottom: 24px;
            }

            /* Sections */
            section {
                padding: 48px 16px;
            }

            .section-title {
                font-size: 1.45rem;
            }

            .section-divider {
                margin-bottom: 32px;
            }

            /* Info Website */
            .info-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 24px 20px;
            }

            /* Stat cards — horizontal di mobile */
            .stat-cards {
                flex-direction: row;
                gap: 12px;
            }

            .stat-card {
                flex: 1;
                padding: 16px 12px;
            }

            .stat-num {
                font-size: 1.6rem;
            }

            /* Alur Pendaftaran */
            .alur-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .alur-grid::before {
                display: none;
            }

            .alur-card {
                padding: 24px 20px;
                /* layout horizontal untuk mobile: ikon kiri, teks kanan */
                display: flex;
                align-items: flex-start;
                text-align: left;
                gap: 16px;
            }

            .alur-num {
                margin: 0;
                flex-shrink: 0;
                width: 48px;
                height: 48px;
            }

            .alur-card-body {
                flex: 1;
            }

            /* Info Section */
            .info-main-card {
                padding: 24px 20px;
            }

            .info-2col {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .jam-row {
                font-size: 0.82rem;
            }

            /* Kontak */
            .kontak-grid {
                flex-direction: column;
                max-width: 100%;
                gap: 12px;
            }

            .kontak-item {
                flex: none;
                width: 100%;
            }

            /* Footer */
            footer {
                flex-direction: column;
                text-align: center;
                padding: 20px 16px;
                gap: 8px;
            }

            .footer-address {
                justify-content: center;
                flex-wrap: wrap;
                text-align: center;
            }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤400px)
        ══════════════════════════════════════════ */
        @media (max-width: 400px) {
            .hero-title {
                font-size: 1.35rem;
            }

            .nav-brand-text {
                /* Sembunyikan subtitle di layar sangat kecil */
                font-size: 0.75rem;
            }

            .nav-brand-text span {
                display: none;
            }

            .stat-cards {
                flex-direction: column;
            }

            .stat-card {
                flex: none;
                width: 100%;
            }

            .kontak-item {
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="nav-brand">
            <div class="nav-logo">
                <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
            </div>
            <div class="nav-brand-text">
                Perpustakaan Poliban
                <span>Penerimaan Peserta Magang</span>
            </div>
        </div>

        <ul class="nav-links">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#alur">Alur Magang</a></li>
            <li><a href="#informasi">Informasi</a></li>
            <li><a href="#kontak">Kontak Kami</a></li>
        </ul>

        <a href="{{ route('peserta.login') }}" class="btn-nav-login">
            Login
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>

        <!-- Tombol hamburger (hanya muncul di mobile) -->
        <button class="btn-hamburger" id="btnHamburger" aria-label="Buka menu navigasi">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- MOBILE MENU DRAWER -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-overlay" id="menuOverlay"></div>
        <div class="mobile-menu-panel">
            <div class="mobile-menu-header">
                <div class="nav-brand-text">
                    Perpustakaan Poliban
                    <span>Penerimaan Peserta Magang</span>
                </div>
                <button class="btn-close-menu" id="btnCloseMenu" aria-label="Tutup menu">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            <ul class="mobile-nav-links">
                <li>
                    <a href="#beranda" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#alur" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                        Alur Magang
                    </a>
                </li>
                <li>
                    <a href="#informasi" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        Informasi
                    </a>
                </li>
                <li>
                    <a href="#kontak" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.61 5.61l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        Kontak Kami
                    </a>
                </li>
            </ul>

            <div class="mobile-menu-footer">
                <a href="{{ route('peserta.login') }}" class="btn-nav-login">
                    Login
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- HERO -->
    <section id="beranda" style="padding:0;">
        <div class="hero">
            <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Perpustakaan Poliban" class="hero-img">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-badge">Politeknik Negeri Banjarmasin</div>
                <h1 class="hero-title">
                    Sistem Pengelolaan Peserta Magang<br>
                    <em>Perpustakaan Poliban</em>
                </h1>
                <p class="hero-sub">
                    Platform terpadu untuk pendaftaran, seleksi, dan pengelolaan kegiatan
                    magang di Perpustakaan Politeknik Negeri Banjarmasin.
                </p>
            </div>
        </div>
    </section>

    <!-- INFORMASI WEBSITE -->
    <section id="info-website">
        <div class="info-grid">
            <div class="card">
                <div class="card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </div>
                <h3>Informasi Website</h3>
                <p>
                    Website Penerimaan dan Pengelolaan Peserta Magang adalah platform
                    yang digunakan untuk memudahkan proses pendaftaran, seleksi, dan
                    pengelolaan data peserta magang secara terpusat. Website ini membantu
                    Admin dalam mengatur informasi peserta, memantau status magang, serta
                    meningkatkan efisiensi dan transparansi dalam pengelolaan program magang.
                </p>
            </div>

            <div class="stat-cards">
                <div class="stat-card">
                    <h4>Kuota Magang</h4>
                    <div class="stat-num">{{ $kuota }}</div>
                    <div class="stat-label">orang</div>
                    <div class="badge-kuota">Tersisa</div>
                </div>
                <div class="stat-card">
                    <h4>Peserta Aktif</h4>
                    <div class="stat-num">{{ $pesertaAktif }}</div>
                    <div class="stat-label">orang</div>
                    <div class="badge-aktif">Sedang berjalan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ALUR PENDAFTARAN -->
    <section id="alur" class="alur-section">
        <h2 class="section-title">Alur Pendaftaran Magang</h2>
        <div class="section-divider"></div>

        <div class="alur-grid">
            <div class="alur-card">
                <div class="alur-num">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </div>
                <div class="alur-card-body">
                    <h4>Pendaftaran Online</h4>
                    <p>Lengkapi formulir pendaftaran dengan data diri dan unggah berkas persyaratan yang diperlukan.</p>
                </div>
            </div>

            <div class="alur-card">
                <div class="alur-num">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div class="alur-card-body">
                    <h4>Seleksi Berkas</h4>
                    <p>Admin perpustakaan akan meninjau kelengkapan berkas dan menentukan kelulusan seleksi administrasi.</p>
                </div>
            </div>

            <div class="alur-card">
                <div class="alur-num">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div class="alur-card-body">
                    <h4>Konfirmasi Penerimaan</h4>
                    <p>Peserta yang diterima akan mendapatkan notifikasi dan surat balasan melalui sistem.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI -->
    <section id="informasi" class="info-section">
        <h2 class="section-title">Informasi</h2>
        <div class="section-divider"></div>

        <div class="info-cards">

            <!-- Visi Misi -->
            <div class="info-main-card">
                <h3>
                    <span class="info-dot"></span>
                    Visi dan Misi UPA Perpustakaan Politeknik Negeri Banjarmasin
                </h3>
                <ol>
                    <li>
                        <strong>Visi</strong><br>
                        Visi UPA Perpustakaan adalah menjadi perpustakaan yang kompeten dan berkualitas.
                    </li>
                    <li style="margin-top:10px;">
                        <strong>Misi UPA Perpustakaan yaitu:</strong>
                        <ul style="list-style:lower-alpha; padding-left:20px; margin-top:6px;">
                            <li>Mengembangkan perpustakaan yang multi akses.</li>
                            <li>Menghimpun dan mengelola sumber daya informasi terdiana bidang sains terapan.</li>
                            <li>Mengembangkan SDM yang relevan baik kuantitas dan kualitas di bidang perpustakaan.</li>
                            <li>Membangun jejaring dengan pengelola sumber-sumber informasi (networking).</li>
                            <li>Menjadi bagian Tri Dharma Perguruan Tinggi.</li>
                        </ul>
                    </li>
                </ol>
            </div>

            <div class="info-2col">
                <!-- Layanan -->
                <div class="info-main-card">
                    <h3>
                        <span class="info-dot"></span>
                        Layanan Perpustakaan
                    </h3>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <a href="https://perpustakaan.poliban.ac.id/" target="_blank"
                           style="display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--dark); font-size:0.85rem; padding:10px 14px; background:var(--cream); border-radius:10px; border:1px solid rgba(200,135,58,0.15); transition:background 0.2s;"
                           onmouseover="this.style.background='rgba(200,135,58,0.1)'"
                           onmouseout="this.style.background='var(--cream)'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#C8873A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>
                            perpustakaan.poliban.ac.id
                        </a>
                        <a href="https://web-polibandigitallibrary.moco.co.id/login" target="_blank"
                           style="display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--dark); font-size:0.85rem; padding:10px 14px; background:var(--cream); border-radius:10px; border:1px solid rgba(200,135,58,0.15); transition:background 0.2s;"
                           onmouseover="this.style.background='rgba(200,135,58,0.1)'"
                           onmouseout="this.style.background='var(--cream)'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#C8873A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                            Poliban Digital Library
                        </a>
                    </div>
                </div>

                <!-- Jam Layanan -->
                <div class="info-main-card">
                    <h3>
                        <span class="info-dot"></span>
                        Jam Layanan Perpustakaan
                    </h3>
                    <div class="jam-row">
                        <span class="jam-day">Senin – Kamis</span>
                        <span class="jam-time">08.00 – 16.00 Wita</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Jumat</span>
                        <span class="jam-time">08.00 – 16.30 Wita</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="kontak-section">
        <h2 class="section-title">Kontak Kami</h2>
        <div class="section-divider"></div>

        <div class="kontak-grid">
            <a href="https://www.instagram.com/perpustakaan_poliban/" target="_blank" class="kontak-item">
                <div class="kontak-icon instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </div>
                <div class="kontak-text">
                    perpustakaan_poliban
                    <small>Instagram</small>
                </div>
            </a>

            <a href="https://web.facebook.com/perpustakaan.banjarmasin.7?locale=id_ID" target="_blank" class="kontak-item">
                <div class="kontak-icon facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </div>
                <div class="kontak-text">
                    Perpustakaan Politeknik Negeri Banjarmasin
                    <small>Facebook</small>
                </div>
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-address">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>
            Jl. Brigjen H. Hasan Basri, Kayu Tangi, Banjarmasin 70123
        </div>
        <div class="footer-copy">
            &copy; {{ date('Y') }} Perpustakaan Politeknik Negeri Banjarmasin
        </div>
    </footer>

    <script>
        const btnHamburger = document.getElementById('btnHamburger');
        const btnCloseMenu = document.getElementById('btnCloseMenu');
        const menuOverlay  = document.getElementById('menuOverlay');
        const mobileMenu   = document.getElementById('mobileMenu');
        const menuLinks    = document.querySelectorAll('.menu-link');

        function openMenu() {
            mobileMenu.classList.add('is-open');
            btnHamburger.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            mobileMenu.classList.remove('is-open');
            btnHamburger.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        btnHamburger.addEventListener('click', openMenu);
        btnCloseMenu.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);

        // Tutup menu otomatis saat link diklik
        menuLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    </script>

</body>
</html>