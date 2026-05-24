<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembimbing Magang - Admin</title>
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
        .content-grid {
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
            padding: 24px 28px;
        }

        .card-label {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #F5E6D0;
        }

        /* ALERT */
        .alert-success {
            background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534;
            font-size: 0.85rem; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;
        }
        .alert-error {
            background: #FEF2F2; border: 1px solid #FECACA; color: #C0392B;
            font-size: 0.82rem; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;
        }
        .alert-error ul { padding-left: 16px; }
        .alert-error li { margin-bottom: 2px; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }

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
        tbody td { padding: 10px 14px; color: var(--dark); vertical-align: middle; font-size: 0.875rem; }

        .empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 28px;
            font-size: 0.875rem;
        }

        /* FORM */
        .form-fields {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .field { display: flex; flex-direction: column; gap: 5px; }

        .field label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
        }

        .field input,
        .field select {
            padding: 9px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
        }

        .field input:focus { border-color: var(--gold); }

        .field select:focus {
    border-color: var(--gold);
}

        .form-footer {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 28px;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 12px rgba(200,135,58,0.3);
        }

        .btn-submit:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* KEMBALI */
        .page-footer { padding: 0 36px 40px; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            background: #f9f4ed;
            border: 1.5px solid #E8D5B5;
            border-radius: 50px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-back:hover { background: #E8D5B5; color: var(--dark); }

        /* BUTTON EDIT */
.btn-edit{
    padding: 7px 16px;
    border: none;
    border-radius: 50px;
    background: var(--gold);
    color: white;
    cursor: pointer;
    font-size: 0.8rem;
    transition: 0.2s;
}

.btn-edit:hover{
    background: var(--gold-light);
}

/* MODAL */
.modal{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

.modal-content{
    width: 100%;
    max-width: 500px;
    background: white;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    animation: popup .2s ease;
}

@keyframes popup{
    from{
        transform: scale(.95);
        opacity: 0;
    }
    to{
        transform: scale(1);
        opacity: 1;
    }
}

.modal-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal-title{
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    font-weight: 700;
}

.btn-close{
    border: none;
    background: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--muted);
}

.password-wrapper{
    position: relative;
    display: flex;
    align-items: center;
}

.password-wrapper input{
    width: 100%;
    padding-right: 45px;
}

.toggle-password{
    position: absolute;
    right: 14px;
    cursor: pointer;
    color: var(--muted);
    display: flex;
    align-items: center;
}

.toggle-password svg{
    width: 18px;
    height: 18px;
}

        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
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
<div style="display:flex; flex-direction:column; gap:20px;">

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
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->no_telp }}</td>
                        <td>{{ $d->nip_nidn }}</td>
                        <td>{{ $d->username }}</td>

                        <td>
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

                        <td>{{ $i + 1 }}</td>

                        <td>{{ $d->nama }}</td>

                        <td>
                            {{ $d->sekolahKampus->nama_sekolah_kampus ?? '-' }}
                        </td>

                        <td>{{ $d->no_telp }}</td>

                        <td>{{ $d->username }}</td>

                        <td>

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
                <div style="display:flex; flex-direction:column; gap:20px;">

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
                    </form>
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
<script>

    // =========================
    // MODAL PEMBIMBING LAPANGAN
    // =========================

    function openEditModal(id, nama, no_telp, nip_nidn, username)
    {
        document.getElementById('editModal').style.display = 'flex';

        document.getElementById('editNama').value = nama;
        document.getElementById('editNoTelp').value = no_telp;
        document.getElementById('editNip').value = nip_nidn;
        document.getElementById('editUsername').value = username;

        document.getElementById('editForm').action =
            `/admin/pembimbing/update/${id}`;
    }

    function closeModal()
    {
        document.getElementById('editModal').style.display = 'none';
    }


    // =========================
    // MODAL PEMBIMBING ASAL
    // =========================

    function openEditModalAsal(
        id,
        nama,
        no_telp,
        username,
        id_sekolah_kampus
    )
    {
        document.getElementById('editModalAsal').style.display = 'flex';

        document.getElementById('editNamaAsal').value = nama;
        document.getElementById('editNoTelpAsal').value = no_telp;
        document.getElementById('editUsernameAsal').value = username;
        document.getElementById('editSekolahAsal').value = id_sekolah_kampus;

        document.getElementById('editFormAsal').action =
            `/admin/pembimbing-asal/update/${id}`;
    }

    function closeModalAsal()
    {
        document.getElementById('editModalAsal').style.display = 'none';
    }


    // =========================
    // CLOSE MODAL SAAT KLIK LUAR
    // =========================

    window.onclick = function(e)
    {
        let modal1 = document.getElementById('editModal');
        let modal2 = document.getElementById('editModalAsal');

        if(e.target == modal1){
            closeModal();
        }

        if(e.target == modal2){
            closeModalAsal();
        }
    }


    // =========================
    // TOGGLE PASSWORD
    // =========================

    function togglePassword(id)
    {
        let input = document.getElementById(id);

        if(input.type === 'password'){
            input.type = 'text';
        }else{
            input.type = 'password';
        }
    }

</script>
</body>
</html>
