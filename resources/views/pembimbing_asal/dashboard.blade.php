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

        /* ── HEADER ── */
        header {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 16px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 2px 12px rgba(26,18,8,0.05);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .logo-wrap {
            width: 48px; height: 48px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .header-center {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 8px 28px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
            white-space: nowrap;
        }

        .header-sub {
            font-size: 0.78rem;
            color: var(--muted);
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
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-logout:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── MAIN ── */
        main { flex: 1; padding: 28px 48px 48px; }

        /* ── CARD — lebar penuh ── */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 24px 28px;
            width: 100%;
        }

        /* ── FILTER — 1 baris ── */
        .filter-bar {
            display: flex;
            flex-wrap: nowrap;
            gap: 12px;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
            min-width: 0;
        }

        .filter-group label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--muted);
            white-space: nowrap;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-group input:focus,
        .filter-group select:focus { border-color: var(--gold); }

        .filter-actions {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            flex-shrink: 0;
        }

        /* ── BUTTONS ── */
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

        /* ── TABLE ── */
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
            white-space: nowrap;
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
            white-space: nowrap;
        }

        .badge-diterima { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
        .badge-selesai  { background: #E0F2FE; color: #075985; border: 1px solid #BAE6FD; }

        .aksi-cell { display: flex; gap: 6px; align-items: center; flex-wrap: wrap; }

        .empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 28px;
        }

        /* ── PAGINATION ── */
        .pagination-wrapper {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border-radius: 10px;
            border: 1.5px solid #E8D5B5;
            background: var(--warm-white);
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination .page-link:hover {
            background: rgba(200,135,58,0.12);
            border-color: var(--gold);
            color: var(--gold);
        }

        .pagination .page-item.active .page-link {
            background: var(--gold);
            border-color: var(--gold);
            color: #fff;
            box-shadow: 0 4px 14px rgba(200,135,58,0.25);
        }

        .pagination .page-item.disabled .page-link {
            background: #F9F5EE;
            color: #B8ADA1;
            border-color: #EFE3D1;
            cursor: not-allowed;
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — TABLET (≤900px)
        ══════════════════════════════════════════ */
        @media (max-width: 900px) {
            main { padding: 20px 20px 40px; }

            .filter-bar { flex-wrap: wrap; }

            .filter-group {
                flex: 1 1 calc(50% - 6px);
                min-width: 140px;
            }

            .filter-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — MOBILE (≤700px)
        ══════════════════════════════════════════ */
        @media (max-width: 700px) {
            header { padding: 12px 16px; gap: 10px; }

            .logo-wrap { width: 36px; height: 36px; }

            .header-title {
                font-size: 0.88rem;
                padding: 7px 14px;
                border-radius: 10px;
                white-space: normal;
                text-align: center;
            }

            .header-sub { font-size: 0.7rem; }

            .btn-logout .logout-text { display: none; }
            .btn-logout { padding: 8px 12px; }

            main { padding: 16px 12px 32px; }

            .card { padding: 18px 14px; }

            .filter-bar { flex-wrap: wrap; }

            .filter-group { flex: 1 1 100%; }

            .filter-actions {
                width: 100%;
                flex-direction: column;
            }

            .filter-actions .btn {
                width: 100%;
                justify-content: center;
            }

            thead th,
            tbody td {
                padding: 8px 10px;
                font-size: 0.78rem;
            }

            .btn-sm { padding: 4px 10px; font-size: 0.72rem; }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤400px)
        ══════════════════════════════════════════ */
        @media (max-width: 400px) {
            .header-title { font-size: 0.8rem; padding: 6px 12px; }
            .header-sub { display: none; }
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
        </div>

        <div class="header-center">
            <div class="header-title">Dashboard Pembimbing</div>
            <div class="header-sub">
                Login sebagai : {{ auth()->guard('pembimbing_asal')->user()->nama }}
            </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <span class="logout-text">Logout</span>
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
        <div class="card">

            <!-- FILTER -->
            <form method="GET" action="{{ route('pembimbing_asal.dashboard') }}">
                <div class="filter-bar">

                    <div class="filter-group">
                        <label>Nama Peserta</label>
                        <input type="text" name="nama"
                               placeholder="Nama Peserta" value="{{ request('nama') }}">
                    </div>

                    <div class="filter-group">
                        <label>Jurusan</label>
                        <select name="jurusan">
                            <option value="">Semua Jurusan</option>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}"
                                    {{ request('jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Sekolah/Kampus</label>
                        <select name="sekolah_kampus">
                            <option value="">Semua Sekolah/Kampus</option>
                            @foreach($sekolah as $s)
                                <option value="{{ $s->id_sekolah_kampus }}"
                                    {{ request('sekolah_kampus') == $s->id_sekolah_kampus ? 'selected' : '' }}>
                                    {{ $s->nama_sekolah_kampus }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="">Semua Status</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="selesai"  {{ request('status') == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
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
                            <th>NIM/NISN</th>
                            <th>Sekolah/Kampus</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i => $d)
                        <tr>
                            <td>{{ $data->firstItem() + $i }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->nisn_nim }}</td>
                            <td>{{ $d->sekolahKampus->nama_sekolah_kampus ?? '-' }}</td>
                            <td>{{ $d->jurusan->jurusan ?? '-' }}</td>
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
                                    <a href="{{ route('pembimbing_asal.detail', $d->id_peserta) }}"
                                       class="btn btn-outline btn-sm">Detail</a>
                                    <a href="{{ route('pembimbing_asal.logbook', $d->id_peserta) }}"
                                       class="btn btn-outline btn-sm">Lihat Logbook</a>
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

            <!-- PAGINATION -->
            @if ($data->hasPages())
                <div class="pagination-wrapper">
                    <ul class="pagination">
                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </main>

</body>
</html>