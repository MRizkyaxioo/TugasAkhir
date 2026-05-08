<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Magang Poliban</title>
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
            --sidebar-w: 220px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--warm-white);
            border-right: 1px solid rgba(200,135,58,0.15);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 200;
            box-shadow: 2px 0 12px rgba(26,18,8,0.06);
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(200,135,58,0.12);
        }

        .sidebar-logo img {
            width: 64px; height: 64px;
            object-fit: contain;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            display: flex;
            flex-direction: column;
            gap: 2px;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--muted);
            text-decoration: none;
            border-radius: 0;
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .nav-item:hover {
            background: rgba(200,135,58,0.08);
            color: var(--dark);
        }

        .nav-item.active {
            background: rgba(200,135,58,0.12);
            color: var(--gold);
            font-weight: 500;
        }

        .nav-item svg {
            flex-shrink: 0;
            opacity: 0.7;
        }

        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(200,135,58,0.12);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 16px;
            background: rgba(200,135,58,0.1);
            border: 1px solid rgba(200,135,58,0.2);
            border-radius: 50px;
            color: var(--gold);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .btn-logout:hover {
            background: var(--gold);
            color: #fff;
        }

        /* ── MAIN ── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* TOP BAR */
        .topbar {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 18px 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(26,18,8,0.04);
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .topbar-sub {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 2px;
        }

        /* PAGE CONTENT */
        .page-body {
            padding: 32px 36px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* ALERT */
        .alert-success {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #166534;
            font-size: 0.85rem;
            padding: 12px 16px;
            border-radius: 10px;
        }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 28px 32px;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
            text-align: center;
        }

        /* STATISTIK */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .stat-block {
            background: var(--cream);
            border-radius: 12px;
            padding: 20px 16px;
            text-align: center;
        }

        .stat-block h4 {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .stat-block .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* KUOTA FORM */
        .kuota-section {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #F5E6D0;
        }

        .kuota-section h3 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 14px;
        }

        .kuota-form {
            display: flex;
            gap: 12px;
            align-items: center;
            max-width: 360px;
        }

        .kuota-form input {
            flex: 1;
            padding: 10px 16px;
            border: 1.5px solid #E8D5B5;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
        }

        .kuota-form input::placeholder { color: #BBA98A; }
        .kuota-form input:focus { border-color: var(--gold); }

        .btn-tambah {
            padding: 10px 24px;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 12px rgba(200,135,58,0.3);
            white-space: nowrap;
        }

        .btn-tambah:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .stat-grid { grid-template-columns: 1fr; }
            .page-body { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
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
                <div style="text-align: center;">
            <div div class="topbar-title">Selamat Datang Admin</div>
            <div class="topbar-sub">
            Login sebagai : {{ auth()->guard('admin')->user()->username ?? auth()->guard('pembimbing')->user()->username ?? '-' }}
                 </div>
            </div>
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
                        <h4>Siswa PKL</h4>
                        <div class="stat-num">{{ $siswa }}</div>
                    </div>
                    <div class="stat-block">
                        <h4>Siswi PKL</h4>
                        <div class="stat-num">{{ $siswi }}</div>
                    </div>
                    <div class="stat-block">
                        <h4>Total Peserta Aktif</h4>
                        <div class="stat-num">{{ $total }}</div>
                    </div>
                </div>

                <div class="kuota-section">
                    <h3>Tambah Kuota Magang</h3>
                    <form action="{{ route('admin.update.kuota') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="kuota-form">
                            <input type="number" name="kuota" min="0"
                                   placeholder="Tambah disini" required>
                            <button type="submit" class="btn-tambah">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>
</html>