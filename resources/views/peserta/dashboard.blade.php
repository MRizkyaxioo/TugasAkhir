<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - Magang Poliban</title>
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
            --sidebar-w: 200px;
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

        /* TOP BAR */
        .topbar {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 20px 36px;
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
            border: 2px solid rgba(200,135,58,0.25);
            padding: 10px 32px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
        }

        .page-body {
            padding: 28px 36px 40px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 20px;
            align-items: start;
        }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 22px 24px;
        }

        .card-label {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #F5E6D0;
        }

        /* ALERT */
        .alert-success {
            background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534;
            font-size: 0.82rem; padding: 10px 14px; border-radius: 8px; margin-bottom: 14px;
        }

        .alert-error {
            background: #FEF2F2; border: 1px solid #FECACA; color: #C0392B;
            font-size: 0.82rem; padding: 10px 14px; border-radius: 8px; margin-bottom: 14px;
        }

        /* PRESENSI BUTTONS */
        .presensi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .presensi-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .presensi-col h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dark);
        }

        .btn-presensi {
            width: 100%;
            padding: 9px 0;
            border-radius: 50px;
            border: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            color: #fff;
            background: var(--gold);
            box-shadow: 0 3px 10px rgba(200,135,58,0.3);
        }

        .btn-presensi:hover { opacity: 0.88; transform: translateY(-1px); }

        .presensi-notice {
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .sudah-presensi {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #166534;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 10px 14px;
            border-radius: 8px;
            text-align: center;
        }

        /* FILE UPLOAD */
        .upload-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 10px;
        }

        .file-input {
            flex: 1;
            padding: 8px 12px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            background: var(--warm-white);
            outline: none;
        }

        .file-input::file-selector-button {
            background: var(--cream);
            border: 1px solid #E8D5B5;
            border-radius: 6px;
            padding: 3px 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            color: var(--dark);
            cursor: pointer;
            margin-right: 8px;
        }

        .btn-kirim {
            padding: 9px 20px;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            box-shadow: 0 3px 10px rgba(200,135,58,0.3);
            white-space: nowrap;
        }

        .btn-kirim:hover { background: var(--gold-light); }

        /* SURAT BALASAN */
        .berkas-link {
            display: block;
            text-align: center;
            padding: 11px;
            background: var(--cream);
            border-radius: 10px;
            color: var(--gold);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border: 1.5px solid rgba(200,135,58,0.2);
            transition: background 0.2s;
        }

        .berkas-link:hover { background: rgba(200,135,58,0.1); }

        .no-surat {
            text-align: center;
            color: var(--muted);
            font-size: 0.82rem;
            padding: 8px 0;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .page-body { grid-template-columns: 1fr; padding: 16px; }
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
                Logbook Kegiatan
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

        <div class="topbar">
            <div class="topbar-title">Selamat Datang {{ $peserta->nama }}</div>
        </div>

        <div class="page-body">

            <!-- KIRI: PRESENSI -->
            <div class="card">
                <div class="card-label">Presentasi</div>

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
                                        onclick="document.getElementById('form-tidak-hadir').style.display='block'; document.querySelector('[name=status_tidak_hadir]').value='izin'">
                                    Izin
                                </button>
                            </div>
                            <div class="presensi-col">
                                <h4>Sakit</h4>
                                <button type="button" class="btn-presensi"
                                        onclick="document.getElementById('form-tidak-hadir').style.display='block'; document.querySelector('[name=status_tidak_hadir]').value='sakit'">
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

    <script>
        // Sinkron nilai status ke input hidden
        document.querySelectorAll('.presensi-col button[type=button]').forEach(btn => {
            btn.addEventListener('click', function() {
                const status = this.closest('.presensi-col').querySelector('h4').textContent.toLowerCase();
                document.getElementById('input-status-tidak-hadir').value = status;
            });
        });
    </script>

</body>
</html>