<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook - {{ $peserta->nama }} | Pembimbing</title>
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
        }

        .logo-wrap img { width: 52px; height: 52px; object-fit: contain; }

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

        /* MAIN */
        main {
            flex: 1;
            padding: 32px 48px 48px;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 24px 28px;
            margin-top: 20px;
        }

        .card-label {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #F5E6D0;
        }

        /* INFO PESERTA */
        .info-row {
            display: flex;
            align-items: baseline;
            padding: 5px 0;
            border-bottom: 1px solid #F5E6D0;
            gap: 10px;
        }
        .info-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            width: 100px;
        }
        .info-label::after { content: ' :'; }
        .info-value { font-size: 0.85rem; color: var(--dark); }

        /* TABLE */
        .table-wrap { overflow-x: auto; margin-top: 16px; }

        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }

        thead tr { background: var(--cream); }
        thead th {
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--muted);
            border-bottom: 2px solid #E8D5B5;
        }

        tbody tr { border-bottom: 1px solid #F5E6D0; transition: background 0.15s; }
        tbody tr:hover { background: #FFFDF9; }
        tbody td { padding: 10px 14px; color: var(--dark); vertical-align: middle; }

        .bukti-img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 6px;
            object-fit: cover;
        }

        .bukti-link {
            color: var(--gold);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .bukti-link:hover { text-decoration: underline; }

        .empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 28px;
        }

        /* BUTTON BACK */
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
            margin-top: 20px;
        }

        .btn-back:hover { background: var(--gold-light); }

        @media (max-width: 768px) {
            header, main { padding-left: 20px; padding-right: 20px; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo-wrap">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>
        <div class="header-title">Logbook {{ $peserta->nama }}</div>
        <div></div> <!-- spacer -->
    </header>

    <!-- MAIN -->
    <main>
        <!-- Info singkat -->
        <div class="card">
            <div class="card-label">Informasi Peserta</div>
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
        </div>

        <!-- Tabel Logbook -->
        <div class="card">
            <div class="card-label">Logbook Harian</div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Bukti Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $d->kegiatan }}</td>
                            <td>
                                @if($d->bukti_foto)
                                    @php $ext = pathinfo($d->bukti_foto, PATHINFO_EXTENSION); @endphp
                                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                        <img src="{{ asset('storage/'.$d->bukti_foto) }}" class="bukti-img" alt="Bukti">
                                    @else
                                        <a href="{{ asset('storage/'.$d->bukti_foto) }}" target="_blank" class="bukti-link">Lihat Bukti (PDF)</a>
                                    @endif
                                @else
                                    <span style="color:var(--muted); font-size:0.8rem;">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="4">Belum ada data logbook</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <a href="{{ route('pembimbing.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali ke Dashboard
        </a>
    </main>

</body>
</html>
