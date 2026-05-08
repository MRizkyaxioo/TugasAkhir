<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembimbing - Magang Poliban</title>
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
            position: relative;
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

        .header-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

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

        .header-sub {
            font-size: 0.78rem;
            color: var(--muted);
            text-align: center;
            margin-top: 4px;
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
        main { flex: 1; padding: 32px 48px 48px; }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 24px 28px;
            max-width: 800px;
            margin: 0 auto; 
        }

        /* FILTER */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .filter-group { display: flex; flex-direction: column; gap: 4px; }

        .filter-group label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--muted);
        }

        .filter-group input {
            padding: 8px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            min-width: 140px;
            transition: border-color 0.2s;
        }

        .filter-group input:focus { border-color: var(--gold); }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background 0.2s, transform 0.15s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary { background: var(--gold); color: #fff; box-shadow: 0 3px 10px rgba(200,135,58,0.3); }
        .btn-primary:hover { background: var(--gold-light); transform: translateY(-1px); }
        .btn-outline { background: transparent; border: 1.5px solid var(--gold); color: var(--gold); }
        .btn-outline:hover { background: var(--gold); color: #fff; }
        .btn-sm { padding: 5px 14px; font-size: 0.78rem; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }

        thead tr { background: var(--cream); }
        thead th {
            padding: 11px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--muted);
            border-bottom: 2px solid #E8D5B5;
        }

        tbody tr { border-bottom: 1px solid #F5E6D0; transition: background 0.15s; }
        tbody tr:hover { background: #FFFDF9; }
        tbody td { padding: 11px 14px; color: var(--dark); vertical-align: middle; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-diterima { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
        .badge-selesai  { background: #E0F2FE; color: #075985; border: 1px solid #BAE6FD; }

        .aksi-cell { display: flex; gap: 8px; align-items: center; }

        .empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 28px;
        }

        @media (max-width: 768px) {
            header { padding: 14px 20px; }
            main { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
    <div class="logo-wrap">
        <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
    </div>

    <div style="position:absolute; left:50%; transform:translateX(-50%); text-align:center;">
        <div class="header-title">Dashboard Pembimbing</div>
        <div class="header-sub">
            Login sebagai : {{ auth()->guard('pembimbing')->user()->nama }}
        </div>
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

            <!-- FILTER -->
            <form method="GET" action="{{ route('pembimbing.dashboard') }}">
                <div class="filter-bar">
                    <div class="filter-group">
                        <label>Nama Peserta</label>
                        <input type="text" name="nama" placeholder="Nama Peserta" value="{{ request('nama') }}">
                    </div>
                    <div class="filter-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" placeholder="Jurusan" value="{{ request('jurusan') }}">
                    </div>
                    <div class="filter-group">
                        <label>Sekolah</label>
                        <input type="text" name="sekolah" placeholder="Sekolah" value="{{ request('sekolah') }}">
                    </div>
                    <div style="display:flex; align-items:flex-end;">
                        <button type="submit" class="btn btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            <!-- TABLE -->
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nisn</th>
                            <th>Sekolah</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->nisn }}</td>
                            <td>{{ $d->sekolah }}</td>
                            <td>{{ $d->bidang_jurusan }}</td>
                            <td>
                                @php $status = $d->hasilPendaftaran->status ?? '-'; @endphp
                                @if($status == 'diterima')
                                    <span class="badge badge-diterima">Diterima</span>
                                @elseif($status == 'selesai')
                                    <span class="badge badge-selesai">Selesai</span>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                <div class="aksi-cell">
                                    <a href="{{ route('pembimbing.detail', $d->id_peserta) }}"
                                       class="btn btn-outline btn-sm">Detail</a>
                                    <a href="{{ route('pembimbing.penilaian', $d->id_peserta) }}"
                                       class="btn btn-primary btn-sm">Kasih Nilai</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="7">Tidak ada data peserta</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>