<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta - Pembimbing</title>
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
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-wrap {
            width: 52px; height: 52px;
            display: flex; align-items: center; justify-content: center;
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 8px 28px;
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
            transition: background 0.2s;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
        }

        .btn-logout:hover { background: var(--gold-light); }

        /* MAIN */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 28px 32px;
            max-width: 480px;
            width: 100%;
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
            width: 110px;
            flex-shrink: 0;
        }

        .info-label::after { content: ' :'; }
        .info-value { font-size: 0.875rem; color: var(--dark); }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-diterima { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
        .badge-selesai  { background: #E0F2FE; color: #075985; border: 1px solid #BAE6FD; }

        /* FOOTER */
        footer {
            padding: 0 48px 40px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            background: var(--gold);
            border: none;
            border-radius: 50px;
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            box-shadow: 0 4px 12px rgba(200,135,58,0.3);
        }

        .btn-back:hover { background: var(--gold-light); }

        @media (max-width: 600px) {
            header { padding: 14px 20px; }
            footer { padding: 0 20px 32px; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
    <div class="logo-wrap">
        <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
    </div>

    <div class="header-title" style="position:absolute; left:50%; transform:translateX(-50%);">
        Detail Peserta Magang
    </div>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">
            Logout
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </button>
    </form>
</header>

    <!-- MAIN -->
    <main>
        <div class="card">
            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value">{{ $peserta->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nisn</span>
                <span class="info-value">{{ $peserta->nisn }}</span>
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
                <span class="info-label">Kelas</span>
                <span class="info-value">{{ $peserta->kelas }}</span>
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
                    @php $status = $peserta->hasilPendaftaran->status ?? '-'; @endphp
                    @if($status == 'diterima')
                        <span class="badge badge-diterima">Diterima</span>
                    @elseif($status == 'selesai')
                        <span class="badge badge-selesai">Selesai</span>
                    @else
                        {{ $status }}
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">No. Telpon</span>
                <span class="info-value">{{ $peserta->no_telp }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat</span>
                <span class="info-value">{{ $peserta->alamat }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Periode</span>
                <span class="info-value">
                    {{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y') }}
                    s/d
                    {{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y') }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Pembimbing</span>
                <span class="info-value">
                    {{ $peserta->pembimbing->first()->nama ?? 'Belum ditentukan' }}
                </span>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <a href="{{ route('pembimbing.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>
    </footer>

</body>
</html>