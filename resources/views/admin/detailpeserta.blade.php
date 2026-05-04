<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta Magang - Admin</title>
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

        /* SIDEBAR */
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

        .sidebar-logo img { width: 64px; height: 64px; object-fit: contain; }

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
            transition: background 0.15s, color 0.15s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .nav-item:hover { background: rgba(200,135,58,0.08); color: var(--dark); }
        .nav-item.active { background: rgba(200,135,58,0.12); color: var(--gold); font-weight: 500; }
        .nav-item svg { flex-shrink: 0; opacity: 0.7; }
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

        .btn-logout:hover { background: var(--gold); color: #fff; }

        /* MAIN */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-header {
            padding: 28px 36px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 12px 40px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
        }

        .page-body { padding: 24px 36px; }

        /* GRID 2 KOLOM */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        /* KOLOM KANAN - 2 baris */
        .right-col {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* BARIS KANAN ATAS: berkas + surat balasan */
        .right-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* BARIS KANAN BAWAH: pembimbing + akhiri sesi */
        .right-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 20px 22px;
        }

        .card-label {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid #F5E6D0;
        }

        /* INFO ROWS */
        .info-row {
            display: flex;
            align-items: baseline;
            padding: 7px 0;
            border-bottom: 1px solid #F5E6D0;
            gap: 10px;
        }

        .info-row:last-child { border-bottom: none; }

        .info-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            width: 100px;
            flex-shrink: 0;
        }

        .info-label::after { content: ' :'; }
        .info-value { font-size: 0.85rem; color: var(--dark); }

        /* BADGE */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-diterima { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background 0.2s, transform 0.15s;
            text-decoration: none;
            white-space: nowrap;
            width: 100%;
        }

        .btn-primary { background: var(--gold); color: #fff; box-shadow: 0 3px 10px rgba(200,135,58,0.3); }
        .btn-primary:hover { background: var(--gold-light); transform: translateY(-1px); }

        .btn-success {
            background: #DCFCE7;
            border: 1.5px solid #BBF7D0;
            color: #166534;
        }
        .btn-success:hover { background: #166534; color: #fff; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            background: var(--cream);
            border: 1.5px solid #E8D5B5;
            border-radius: 50px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            width: auto;
        }

        .btn-back:hover { background: #E8D5B5; color: var(--dark); }

        /* LINK */
        .berkas-link {
            display: block;
            text-align: center;
            padding: 10px;
            background: var(--cream);
            border-radius: 10px;
            color: var(--gold);
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            border: 1.5px solid rgba(200,135,58,0.2);
            transition: background 0.2s;
        }

        .berkas-link:hover { background: rgba(200,135,58,0.1); }

        /* SELECT */
        .styled-select {
            width: 100%;
            padding: 9px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237A6E62' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
            margin-bottom: 10px;
            transition: border-color 0.2s;
        }

        .styled-select:focus { border-color: var(--gold); }

        .pembimbing-info {
            font-size: 0.8rem;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .pembimbing-info strong { color: var(--dark); }

        .page-footer { padding: 0 36px 40px; }

        @media (max-width: 900px) {
            .detail-grid { grid-template-columns: 1fr; }
            .right-top, .right-bottom { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .page-body { padding: 16px; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.calon') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                    <line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                    <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Daftar Calon Peserta
            </a>
            <a href="{{ route('admin.peserta') }}" class="nav-item active">
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
            <div class="page-header-title">Daftar Peserta Magang</div>
        </div>

        <div class="page-body">
            <div class="detail-grid">

                <!-- KOLOM KIRI: PROFIL -->
                <div class="card">
                    <div class="card-label">Detail Peserta Magang</div>
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
                            <span class="badge badge-diterima">Diterima</span>
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
                        <span class="info-label">Awal Magang</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Akhir Magang</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y') }}</span>
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="right-col">

                    <!-- BARIS ATAS: Berkas + Surat Balasan -->
                    <div class="right-top">
                        <div class="card">
                            <div class="card-label">Berkas Peserta Magang</div>
                            @foreach($peserta->hasilPendaftaran->berkas as $b)
                                <a href="{{ asset('storage/'.$b->file_berkas) }}"
                                   target="_blank" class="berkas-link">Lihat Berkas</a>
                            @endforeach
                        </div>

                        <div class="card">
                            <div class="card-label">Surat Balasan</div>
                            @if($peserta->hasilPendaftaran->file_berkas_balasan)
                                <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->file_berkas_balasan) }}"
                                   target="_blank" class="berkas-link">Lihat Surat Balasan</a>
                            @else
                                <p style="text-align:center; font-size:0.8rem; color:var(--muted);">
                                    Belum ada surat balasan
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- BARIS BAWAH: Pembimbing + Akhiri Sesi -->
                    <div class="right-bottom">
                        <div class="card">
                            <div class="card-label">Pembimbing Magang</div>
                            <form method="POST" action="{{ route('admin.assign.pembimbing', $peserta->id_peserta) }}">
                                @csrf
                                <select name="id_pembimbing" class="styled-select">
                                    <option value="">Pilih Pembimbing Magang</option>
                                    @foreach($pembimbing as $p)
                                        <option value="{{ $p->id_pembimbing }}"
                                            {{ $peserta->pembimbing->first()?->id_pembimbing == $p->id_pembimbing ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($peserta->pembimbing->count())
                                    <p class="pembimbing-info">
                                        Pembimbing Saat ini : <strong>{{ $peserta->pembimbing->first()->nama }}</strong>
                                    </p>
                                @endif
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </form>
                        </div>

                        <div class="card" style="display:flex; flex-direction:column; justify-content:space-between;">
                            <div class="card-label">Akhiri Sesi Magang</div>
                            <form action="{{ route('admin.selesai', $peserta->id_peserta) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Tandai Selesai
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- KEMBALI -->
        <div class="page-footer">
            <a href="{{ route('admin.peserta') }}" class="btn-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

</body>
</html>