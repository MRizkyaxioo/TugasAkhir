<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembimbing Magang - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/pembimbing.css') }}">
</head>
<body>

    <!-- HAMBURGER TOGGLE (mobile) -->
    <button class="sidebar-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open'); document.querySelector('.sidebar-overlay').classList.toggle('active');">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>
    <div class="sidebar-overlay" onclick="document.querySelector('.sidebar').classList.remove('open'); this.classList.remove('active');"></div>

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
            <a href="{{ route('admin.pembimbing') }}" class="nav-item active">
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
            <div class="page-header-title">Data Pembimbing Magang</div>
        </div>

        <div class="page-body">

        <!-- KEPALA UPA PERPUSTAKAAN -->
    <div class="card kepala-card">
        <div class="kepala-info">
            <div class="kepala-label">Kepala UPA Perpustakaan</div>
            <div class="kepala-name-row">
                <span class="kepala-nama">
                    {{ $kepala->nama ?? 'Belum diatur' }}
                </span>

                <button
                    type="button"
                    class="btn-edit-avatar"
                    title="Edit Nama Kepala Perpustakaan"
                    onclick="openEditModalKepala('{{ $kepala->nama ?? '' }}')"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content-grid">

                <!-- KIRI -->
<div class="col-stack">

    <!-- LIST PEMBIMBING LAPANGAN -->
    <div class="card">
        <div class="card-label">
            List Pembimbing Lapangan
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>NIP/NIDN</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($data as $i => $d)

                    <tr>
                        <td data-label="No">{{ $i + 1 }}</td>
                        <td data-label="Nama">{{ $d->nama }}</td>
                        <td data-label="No HP">{{ $d->no_telp }}</td>
                        <td data-label="NIP/NIDN">{{ $d->nip_nidn }}</td>
                        <td data-label="Username">{{ $d->username }}</td>

                        <td data-label="Aksi">
                            <button
                                class="btn-edit"

                                onclick="openEditModal(
                                    '{{ $d->id_pembimbing }}',
                                    '{{ $d->nama }}',
                                    '{{ $d->no_telp }}',
                                    '{{ $d->nip_nidn }}',
                                    '{{ $d->username }}'
                                )"
                            >
                                Edit
                            </button>
                        </td>
                    </tr>

                @empty

                    <tr class="empty-row">
                        <td colspan="6">
                            Tidak ada data pembimbing lapangan
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <!-- LIST PEMBIMBING ASAL -->
    <div class="card">

        <div class="card-label">
            List Pembimbing Sekolah/Kampus
        </div>

        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah/Kampus</th>
                        <th>No HP</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($pembimbingAsal as $i => $d)

                    <tr>

                        <td data-label="No">{{ $i + 1 }}</td>

                        <td data-label="Nama">{{ $d->nama }}</td>

                        <td data-label="Sekolah/Kampus">
                            {{ $d->sekolahKampus->nama_sekolah_kampus ?? '-' }}
                        </td>

                        <td data-label="No HP">{{ $d->no_telp }}</td>

                        <td data-label="Username">{{ $d->username }}</td>

                        <td data-label="Aksi">

                            <button
                                class="btn-edit"

                                onclick="openEditModalAsal(
                                    '{{ $d->id_pembimbing_asal }}',
                                    '{{ $d->nama }}',
                                    '{{ $d->no_telp }}',
                                    '{{ $d->username }}',
                                    '{{ $d->id_sekolah_kampus }}'
                                )"
                            >
                                Edit
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr class="empty-row">
                        <td colspan="6">
                            Tidak ada data pembimbing sekolah/kampus
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

                <!-- KANAN: FORM TAMBAH -->
                <div class="col-stack">

    <!-- FORM PEMBIMBING LAPANGAN -->
    <div class="card">
        <div class="card-label">
            Tambah Pembimbing Magang
        </div>

        <form action="{{ route('admin.pembimbing.store') }}"
              method="POST">

            @csrf

            <div class="form-fields">

                <div class="field">
                    <label>Nama</label>
                    <input type="text"
                           name="nama"
                           value="{{ old('nama') }}">
                </div>

                <div class="field">
                    <label>No hp</label>
                    <input type="text"
                           name="no_telp"
                           value="{{ old('no_telp') }}">
                </div>

                <div class="field">
                    <label>NIP/NIDN</label>
                    <input type="text"
                           name="nip_nidn"
                           value="{{ old('nip_nidn') }}">
                </div>

                <div class="field">
                    <label>Username</label>
                    <input type="text"
                           name="username"
                           value="{{ old('username') }}">
                </div>

                <div class="field">
                    <label>Password</label>

                    <div class="password-wrapper">

                        <input type="password"
                               name="password"
                               id="passwordTambah">

                        <span class="toggle-password"
                              onclick="togglePassword('passwordTambah', this)">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>

                                <circle cx="12"
                                        cy="12"
                                        r="3"/>

                            </svg>

                        </span>

                    </div>
                </div>

            </div>

            <div class="form-footer">
                <button type="submit"
                        class="btn-submit">
                    Tambah
                </button>
            </div>

        </form>
    </div>

    <!-- FORM PEMBIMBING ASAL -->
    <div class="card">

        <div class="card-label">
            Tambah Pembimbing Sekolah/Kampus
        </div>

        <form action="{{ route('admin.pembimbing-asal.store') }}"
              method="POST">

            @csrf

            <div class="form-fields">

                <div class="field">
                    <label>Nama</label>
                    <input type="text" name="nama">
                </div>

                <div class="field">
    <label>Asal Sekolah/Kampus</label>

    <select name="id_sekolah_kampus">
        <option value="">-- Pilih Sekolah/Kampus --</option>

        @foreach($sekolah as $s)
            <option value="{{ $s->id_sekolah_kampus }}">
                {{ $s->nama_sekolah_kampus }}
            </option>
        @endforeach
    </select>
</div>

                <div class="field">
                    <label>No HP</label>
                    <input type="text"
                           name="no_telp">
                </div>

                <div class="field">
                    <label>Username</label>
                    <input type="text"
                           name="username">
                </div>

                <div class="field">

    <label>Password</label>

    <div class="password-wrapper">

        <input type="password"
               name="password"
               id="passwordTambahAsal">

        <span class="toggle-password"
              onclick="togglePassword('passwordTambahAsal')">

            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>

                <circle cx="12"
                        cy="12"
                        r="3"/>

            </svg>

        </span>

    </div>

</div>

            </div>

            <div class="form-footer">
                <button type="submit"
                        class="btn-submit">
                    Tambah
                </button>
            </div>

        </form>
    </div>

</div>

            </div>
        </div>
    </div>

<!-- MODAL EDIT PEMBIMBING LAPANGAN -->
<div class="modal" id="editModal">

    <div class="modal-content">

        <div class="modal-header">

            <div class="modal-title">
                Edit Pembimbing
            </div>

            <button class="btn-close"
                    onclick="closeModal()">
                &times;
            </button>

        </div>

        <form id="editForm" method="POST">

            @csrf
            @method('PUT')

            <div class="form-fields">

                <div class="field">
                    <label>Nama</label>

                    <input type="text"
                           name="nama"
                           id="editNama">
                </div>

                <div class="field">
                    <label>No hp</label>

                    <input type="text"
                           name="no_telp"
                           id="editNoTelp">
                </div>

                <div class="field">
                    <label>NIP/NIDN (Opsional)</label>

                    <input type="text"
                           name="nip_nidn"
                           id="editNip">
                </div>

                <div class="field">
                    <label>Username</label>

                    <input type="text"
                           name="username"
                           id="editUsername">
                </div>

                <div class="field">

                    <label>Password Baru</label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            name="password"
                            id="passwordEdit"
                            placeholder="Kosongkan jika tidak ingin diubah"
                        >

                        <span class="toggle-password"
                              onclick="togglePassword('passwordEdit')">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>

                                <circle cx="12"
                                        cy="12"
                                        r="3"/>

                            </svg>

                        </span>

                    </div>

                </div>

            </div>

            <div class="form-footer">

                <button type="submit"
                        class="btn-submit">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>


<!-- MODAL EDIT PEMBIMBING ASAL -->
<div class="modal" id="editModalAsal">

    <div class="modal-content">

        <div class="modal-header">

            <div class="modal-title">
                Edit Pembimbing Sekolah/Kampus
            </div>

            <button class="btn-close"
                    onclick="closeModalAsal()">
                &times;
            </button>

        </div>

        <form id="editFormAsal"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-fields">

                <div class="field">
                    <label>Nama</label>

                    <input type="text"
                           name="nama"
                           id="editNamaAsal">
                </div>

                <div class="field">

                    <label>Asal Sekolah/Kampus</label>

                    <select name="id_sekolah_kampus"
                            id="editSekolahAsal">

                        @foreach($sekolah as $s)

                            <option value="{{ $s->id_sekolah_kampus }}">
                                {{ $s->nama_sekolah_kampus }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="field">
                    <label>No HP</label>

                    <input type="text"
                           name="no_telp"
                           id="editNoTelpAsal">
                </div>

                <div class="field">
                    <label>Username</label>

                    <input type="text"
                           name="username"
                           id="editUsernameAsal">
                </div>

                <div class="field">

                    <label>Password Baru</label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            name="password"
                            id="passwordEditAsal"
                            placeholder="Kosongkan jika tidak ingin diubah"
                        >

                        <span class="toggle-password"
                              onclick="togglePassword('passwordEditAsal')">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>

                                <circle cx="12"
                                        cy="12"
                                        r="3"/>

                            </svg>

                        </span>

                    </div>

                </div>

            </div>

            <div class="form-footer">

                <button type="submit"
                        class="btn-submit">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL EDIT KEPALA PERPUSTAKAAN -->
<div class="modal" id="editModalKepala">

    <div class="modal-content">

        <div class="modal-header">
            <div class="modal-title">Edit Nama Kepala Perpustakaan</div>
            <button class="btn-close" onclick="closeModalKepala()">&times;</button>
        </div>

        <form id="editFormKepala" method="POST" action="{{ route('admin.kepala.update') }}">
            @csrf
            @method('PUT')

            <div class="form-fields">
                <div class="field">
                    <label>Nama Kepala Perpustakaan</label>
                    <input type="text" name="nama" id="editNamaKepala">
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>

    </div>

</div>

<script src="{{ asset('js/admin/pembimbing.js') }}"></script>
</body>
</html>