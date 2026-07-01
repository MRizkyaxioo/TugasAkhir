<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Magang - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/peserta.css') }}">
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
            <a href="{{ route('admin.jurusan') }}"
   class="nav-item {{ request()->routeIs('admin.jurusan') ? 'active' : '' }}">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
    </svg>
    Data Jurusan
</a>

<a href="{{ route('admin.sekolah') }}"
   class="nav-item {{ request()->routeIs('admin.sekolah') ? 'active' : '' }}">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    Data Sekolah/Kampus
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

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <div class="card">
                <!-- FILTER -->
                <form method="GET" action="{{ route('admin.peserta') }}">
                    <div class="filter-bar">
                        <div class="filter-group">
                            <label>Nama Peserta</label>
                            <input type="text" name="nama" placeholder="Nama Peserta" value="{{ request('nama') }}">
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
                                <th>NISN/NIM</th>
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
                                <td><span class="badge badge-diterima">Diterima</span></td>
                                <td>
                                    <div class="aksi-cell">
                                        <a href="{{ route('admin.detail.peserta', $d->id_peserta) }}"
                                           class="btn btn-outline btn-sm">Detail</a>
                                           <a href="{{ route('admin.logbook', $d->id_peserta) }}"
   class="btn btn-outline btn-sm">Logbook</a>
                                        <button type="button"
                                                class="btn btn-primary btn-sm"
                                                onclick="openModal('modal-{{ $d->id_peserta }}')">
                                            Surat Balasan
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="empty-row">
                                <td colspan="7">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($data->hasPages())
    <div class="pagination-wrapper">
        <ul class="pagination">

            @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
@endif
                </div>
            </div>
        </div>
    </div>

    <!-- MODALS SURAT BALASAN -->
    @foreach($data as $d)
    <div class="modal-overlay" id="modal-{{ $d->id_peserta }}">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-{{ $d->id_peserta }}')">✕</button>
            <div class="modal-title">Surat Balasan</div>
            <form action="{{ route('admin.upload.balasan', $d->id_peserta) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="file-upload-wrap">
                    <input type="file" name="file_balasan" accept="application/pdf" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
                    Kirim
                </button>
            </form>
        </div>
    </div>
    @endforeach

    <script src="{{ asset('js/admin/peserta.js') }}"></script>
</body>
</html>
