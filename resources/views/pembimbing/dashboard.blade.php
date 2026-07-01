<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembimbing - Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pembimbing/dashboard.css') }}">
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
                Login sebagai : {{ auth()->guard('pembimbing')->user()->nama }}
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
            <form method="GET" action="{{ route('pembimbing.dashboard') }}">
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
                        <a href="{{ route('pembimbing.peserta.pdf', request()->query()) }}"
                           class="btn btn-outline">
                            Cetak Data Bimbingan
                        </a>
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
                                    <a href="{{ route('pembimbing.detail', $d->id_peserta) }}"
                                       class="btn btn-outline btn-sm">Detail</a>
                                    <a href="{{ route('pembimbing.penilaian', $d->id_peserta) }}"
                                       class="btn btn-primary btn-sm">Kasih Nilai</a>
                                    <a href="{{ route('pembimbing.logbook', $d->id_peserta) }}"
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
