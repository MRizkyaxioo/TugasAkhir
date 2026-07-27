<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah/Kampus - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/sekolah.css') }}">
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebarAdmin">
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
            <a href="{{ route('admin.peserta') }}" class="nav-item">
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
            <a href="{{ route('admin.jurusan') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
                Data Jurusan
            </a>
            <a href="{{ route('admin.sekolah') }}" class="nav-item active">
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

    <!-- OVERLAY UNTUK MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN -->
    <div class="main-content">
        <div class="page-header">
            <button class="btn-hamburger" id="btnHamburger" aria-label="Buka menu" type="button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <div class="page-header-title">Data Sekolah/Kampus</div>
        </div>

        <div class="page-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="content-grid">

                <!-- KIRI: LIST -->
                <div class="card">
                    <div class="card-label">List Sekolah/Kampus</div>
                    <form method="GET" action="{{ route('admin.sekolah') }}" class="search-form">
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari sekolah/kampus..."
                        value="{{ request('search') }}"
                        class="search-input">

                    @if(request('search'))
                        <a href="{{ route('admin.sekolah') }}" class="btn-reset">
                            Reset
                        </a>
                    @endif
                    </form>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah/Kampus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $i => $d)
                                <tr>
                                    <td data-label="No">
    {{ $data->firstItem() + $i }}
</td>
                                    <td data-label="Nama Sekolah/Kampus">{{ $d->nama_sekolah_kampus }}</td>
                                    <td data-label="Aksi">
                                        <button class="btn-edit"
                                                onclick="openModal({{ $d->id_sekolah_kampus }}, '{{ addslashes($d->nama_sekolah_kampus) }}')">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="3">Belum ada data sekolah/kampus</td>
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

                <!-- KANAN: FORM TAMBAH -->
                <div class="card">
                    <div class="card-label">Tambah Sekolah/Kampus</div>
                    <form action="{{ route('admin.sekolah.store') }}" method="POST">
                        @csrf
                        <div class="form-fields">
                            <div class="field">
                                <label>Nama Sekolah/Kampus</label>
                                <input type="text" name="nama_sekolah_kampus" maxlength="75"
                                       placeholder="Contoh: SMK Negeri 1 Banjarmasin" value="{{ old('nama_sekolah_kampus') }}">
                                       @error('nama_sekolah_kampus')
    <small style="color:red">{{ $message }}</small>
@enderror
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn-submit">Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Edit Sekolah/Kampus</div>
                <button class="btn-close" onclick="closeModal()">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-fields">
                    <div class="field">
                        <label>Nama Sekolah/Kampus</label>
                        <input type="text" name="nama_sekolah_kampus" id="editNama" maxlength="75" value="{{ old('nama_sekolah_kampus') }}">
                        @error('nama_sekolah_kampus')
    <small style="color:red">{{ $message }}</small>
@enderror
                    </div>
                </div>
                <div class="form-footer" style="justify-content:space-between;">
                    <button type="button" id="btnHapusSekolah"
                            style="padding:10px 20px; background:#FEE2E2; border:1px solid #FECACA;
                                   border-radius:50px; color:#991B1B; font-family:'DM Sans',sans-serif;
                                   font-size:0.875rem; font-weight:500; cursor:pointer;">
                        Hapus
                    </button>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <form id="formHapusSekolah" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script src="{{ asset('js/admin/sidebar.js') }}"></script>
    <script src="{{ asset('js/admin/sekolah.js') }}"></script>

</body>
</html>
