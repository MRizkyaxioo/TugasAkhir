<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Calon Peserta - Magang Poliban</title>
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
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-wrap {
            width: 48px; height: 48px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem; font-weight: 700;
            color: var(--dark); line-height: 1.2;
        }
        .brand-text p { font-size: 1rem; color: var(--muted); font-weight: 300; }

        /* HEADER TITLE CENTER */
        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* LOGOUT BTN */
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

        .btn-logout:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
        }

        /* MAIN */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        .dashboard-wrap {
            max-width: 620px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* INFO CARD */
        .info-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            overflow: hidden;
        }

        .info-card-header {
            background: linear-gradient(135deg, #E8D5B5 0%, #F5E6D0 100%);
            padding: 20px 28px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar {
            width: 48px; height: 48px;
            border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .avatar svg { color: #fff; }

        .avatar-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
        }

        .avatar-info p {
            font-size: 0,78rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .info-card-body {
            padding: 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .info-row {
            display: flex;
            align-items: baseline;
            padding: 12px 0;
            border-bottom: 1px solid #F5E6D0;
            gap: 16px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
            width: 130px;
            flex-shrink: 0;
        }

        .info-label::after {
            content: ' :';
        }

        .info-value {
            font-size: 0.9rem;
            color: var(--dark);
            font-weight: 400;
        }

        /* STATUS BADGE */
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 500;
        }

        .badge-pending {
            background: #FEF9C3;
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .badge-diterima {
            background: #DCFCE7;
            color: #166534;
            border: 1px solid #BBF7D0;
        }

        .badge-ditolak {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        /* NOTICE CARD */
        .notice-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 20px 28px;
            font-size: 0.875rem;
            color: var(--muted);
            line-height: 1.7;
            text-align: center;
        }

        .notice-card strong {
            color: var(--dark);
        }

        @media (max-width: 580px) {
            header { padding: 14px 20px; flex-wrap: wrap; gap: 10px; }
            .header-title { display: none; }
            .info-label { width: 100px; }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <div class="logo-wrap">
                <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
            </div>

            <div class="brand-text" style="position:absolute; left:50%; transform:translateX(-50%); text-align:center;">
                <h1>Selamat Datang Calon Peserta</h1>
                <p>Perpustakaan Politeknik Negeri Banjarmasin</p>
            </div>
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

    <main>
        <div class="dashboard-wrap">

            {{-- INFO CARD --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="avatar">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="avatar-info">
                        <h3>{{ $peserta->nama }}</h3>
                        <p>{{ $peserta->nisn_nim }}</p>
                    </div>
                </div>

                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $peserta->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NISN</span>
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
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            @php $status = $peserta->hasilPendaftaran->status ?? 'pending'; @endphp
                            @if($status == 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($status == 'diterima')
                                <span class="badge badge-diterima">Diterima</span>
                            @elseif($status == 'ditolak')
                                <span class="badge badge-ditolak">Ditolak</span>
                            @else
                                <span class="badge badge-pending">{{ ucfirst($status) }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- NOTICE --}}
            <div class="notice-card">
                Tunggu kabar dari admin ya, jika ada yang ingin ditanyakan bisa hubungi
                <strong>08123123123</strong> atau melalui email
                <strong>adminperpustakaan@gmail.com</strong>
            </div>

        </div>
    </main>

</body>
</html>
