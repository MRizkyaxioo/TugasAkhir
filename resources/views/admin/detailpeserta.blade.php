<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta Magang - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin/peserta-detail.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
</head>
<body>

    <!-- OVERLAY (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

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
            <button type="button" class="btn-hamburger-admin" id="btnHamburger" aria-label="Buka menu">
                <span></span><span></span><span></span>
            </button>
            <div class="page-header-title">Daftar Peserta Magang</div>
        </div>

        <div class="page-body">
            <div class="detail-grid">

                <!-- KOLOM KIRI: PROFIL -->
                <div class="card">
                    <div class="card-label">Detail Peserta Magang</div>

                    <!-- NAMA -->
                    <div class="info-row info-row-editable">
                        <span class="info-label">Nama</span>
                        <div class="info-edit-wrapper">
                            <div class="info-display" id="view-nama" style="{{ $errors->has('nama') ? 'display:none;' : '' }}">
                                <span class="info-value">{{ $peserta->nama }}</span>
                                <button type="button" class="btn-edit-icon" data-field="nama" aria-label="Edit Nama" style="{{ $errors->has('nama') ? 'display:none;' : '' }}">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                    </svg>
                                </button>
                            </div>

                            <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
                                  method="POST" class="edit-form {{ $errors->has('nama') ? 'is-visible' : '' }}" id="edit-nama">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
                                <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
                                <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
                                <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
                                <input type="hidden" name="semester" value="{{ $peserta->semester }}">
                                <input type="text" name="nama" id="input-nama" class="edit-input"
                                       value="{{ old('nama', $peserta->nama) }}" data-original="{{ $peserta->nama }}"
                                       maxlength="100" required>
                                @error('nama')
                                    <span class="edit-error">{{ $message }}</span>
                                @enderror
                                <div class="edit-actions">
                                    <button type="submit" class="btn-save-icon" aria-label="Simpan">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    </button>
                                    <button type="button" class="btn-cancel-icon" data-field="nama" aria-label="Batal">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- NISN/NIM -->
<div class="info-row info-row-editable">
    <span class="info-label">NIS/NIM</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-nisn" style="{{ $errors->has('nisn_nim') ? 'display:none;' : '' }}">
            <span class="info-value">{{ $peserta->nisn_nim }}</span>
            <button type="button" class="btn-edit-icon" data-field="nisn" aria-label="Edit NISN/NIM" style="{{ $errors->has('nisn_nim') ? 'display:none;' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form {{ $errors->has('nisn_nim') ? 'is-visible' : '' }}" id="edit-nisn">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
            <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
            <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
            <input type="hidden" name="semester" value="{{ $peserta->semester }}">
            <input type="text" name="nisn_nim" id="input-nisn" class="edit-input"
                   value="{{ old('nisn_nim', $peserta->nisn_nim) }}" data-original="{{ $peserta->nisn_nim }}"
                   maxlength="30" required>
            @error('nisn_nim')
                <span class="edit-error">{{ $message }}</span>
            @enderror
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="nisn" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SEKOLAH/KAMPUS -->
<div class="info-row info-row-editable">
    <span class="info-label">Sekolah/Kampus</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-sekolah">
            <span class="info-value">{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</span>
            <button type="button" class="btn-edit-icon" data-field="sekolah" aria-label="Edit Sekolah/Kampus">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form" id="edit-sekolah">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
            <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
            <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
            <input type="hidden" name="semester" value="{{ $peserta->semester }}">
            <select name="id_sekolah_kampus" id="editSekolah" class="edit-select"
                    data-original="{{ $peserta->id_sekolah_kampus }}">
                <option value="">Pilih Sekolah/Kampus</option>
                @foreach($sekolah as $s)
                    <option value="{{ $s->id_sekolah_kampus }}"
                        {{ $peserta->id_sekolah_kampus == $s->id_sekolah_kampus ? 'selected' : '' }}>
                        {{ $s->nama_sekolah_kampus }}
                    </option>
                @endforeach
            </select>
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="sekolah" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JURUSAN -->
<div class="info-row info-row-editable">
    <span class="info-label">Jurusan</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-jurusan">
            <span class="info-value">{{ $peserta->jurusan->jurusan ?? '-' }}</span>
            <button type="button" class="btn-edit-icon" data-field="jurusan" aria-label="Edit Jurusan">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form" id="edit-jurusan">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
            <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
            <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
            <input type="hidden" name="semester" value="{{ $peserta->semester }}">
            <select name="id_jurusan" id="editJurusan" class="edit-select"
                    data-original="{{ $peserta->id_jurusan }}">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->id_jurusan }}"
                        {{ $peserta->id_jurusan == $j->id_jurusan ? 'selected' : '' }}>
                        {{ $j->jurusan }}
                    </option>
                @endforeach
            </select>
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="jurusan" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>
                    <!-- KELAS -->
<div class="info-row info-row-editable">
    <span class="info-label">Kelas</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-kelas" style="{{ $errors->has('kelas') ? 'display:none;' : '' }}">
            <span class="info-value">{{ $peserta->kelas }}</span>
            <button type="button" class="btn-edit-icon" data-field="kelas" aria-label="Edit Kelas" style="{{ $errors->has('kelas') ? 'display:none;' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form {{ $errors->has('kelas') ? 'is-visible' : '' }}" id="edit-kelas">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
            <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
            <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
            <input type="hidden" name="semester" value="{{ $peserta->semester }}">
            <input type="text" name="kelas" id="input-kelas" class="edit-input"
                   value="{{ old('kelas', $peserta->kelas) }}" data-original="{{ $peserta->kelas }}"
                   maxlength="2">
            @error('kelas')
                <span class="edit-error">{{ $message }}</span>
            @enderror
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="kelas" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SEMESTER -->
<div class="info-row info-row-editable">
    <span class="info-label">Semester</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-semester" style="{{ $errors->has('semester') ? 'display:none;' : '' }}">
            <span class="info-value">{{ $peserta->semester }}</span>
            <button type="button" class="btn-edit-icon" data-field="semester" aria-label="Edit Semester" style="{{ $errors->has('semester') ? 'display:none;' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form {{ $errors->has('semester') ? 'is-visible' : '' }}" id="edit-semester">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
            <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
            <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
            <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
            <input type="number" name="semester" id="input-semester" class="edit-input"
                   value="{{ old('semester', $peserta->semester) }}" data-original="{{ $peserta->semester }}"
                   min="1" max="14" required>
            @error('semester')
                <span class="edit-error">{{ $message }}</span>
            @enderror
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="semester" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
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
                    <!-- AWAL MAGANG -->
<div class="info-row info-row-editable">
    <span class="info-label">Awal Magang</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-awal" style="{{ $errors->has('awal_magang') ? 'display:none;' : '' }}">
            <span class="info-value">{{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y') }}</span>
            <button type="button" class="btn-edit-icon" data-field="awal" aria-label="Edit Awal Magang" style="{{ $errors->has('awal_magang') ? 'display:none;' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form {{ $errors->has('awal_magang') ? 'is-visible' : '' }}" id="edit-awal">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
            <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
            <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
            <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
            <input type="hidden" name="semester" value="{{ $peserta->semester }}">
            <input type="hidden" name="akhir_magang" value="{{ $peserta->akhir_magang }}">
            <input type="date" name="awal_magang" id="input-awal" class="edit-input"
                   value="{{ old('awal_magang', \Carbon\Carbon::parse($peserta->awal_magang)->format('Y-m-d')) }}"
                   data-original="{{ \Carbon\Carbon::parse($peserta->awal_magang)->format('Y-m-d') }}"
                   required>
            @error('awal_magang')
                <span class="edit-error">{{ $message }}</span>
            @enderror
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="awal" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- AKHIR MAGANG -->
<div class="info-row info-row-editable">
    <span class="info-label">Akhir Magang</span>
    <div class="info-edit-wrapper">
        <div class="info-display" id="view-akhir" style="{{ $errors->has('akhir_magang') ? 'display:none;' : '' }}">
            <span class="info-value">{{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y') }}</span>
            <button type="button" class="btn-edit-icon" data-field="akhir" aria-label="Edit Akhir Magang" style="{{ $errors->has('akhir_magang') ? 'display:none;' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.peserta.updateData', $peserta->id_peserta) }}"
              method="POST" class="edit-form {{ $errors->has('akhir_magang') ? 'is-visible' : '' }}" id="edit-akhir">
            @csrf
            @method('PUT')
            <input type="hidden" name="nama" value="{{ $peserta->nama }}">
            <input type="hidden" name="nisn_nim" value="{{ $peserta->nisn_nim }}">
            <input type="hidden" name="id_jurusan" value="{{ $peserta->id_jurusan }}">
            <input type="hidden" name="id_sekolah_kampus" value="{{ $peserta->id_sekolah_kampus }}">
            <input type="hidden" name="kelas" value="{{ $peserta->kelas }}">
            <input type="hidden" name="semester" value="{{ $peserta->semester }}">
            <input type="hidden" name="awal_magang" value="{{ $peserta->awal_magang }}">
            <input type="date" name="akhir_magang" id="input-akhir" class="edit-input"
                   value="{{ old('akhir_magang', \Carbon\Carbon::parse($peserta->akhir_magang)->format('Y-m-d')) }}"
                   data-original="{{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('Y-m-d') }}"
                   required>
            @error('akhir_magang')
                <span class="edit-error">{{ $message }}</span>
            @enderror
            <div class="edit-actions">
                <button type="submit" class="btn-save-icon" aria-label="Simpan">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="btn-cancel-icon" data-field="akhir" aria-label="Batal">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </form>
    </div>
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

                        <div class="card">
    <div class="card-label">Pembimbing Sekolah/Kampus</div>

    <form method="POST"
          action="{{ route('admin.assign.pembimbing.asal', $peserta->id_peserta) }}">
        @csrf

        <select name="id_pembimbing_asal" class="styled-select">
            <option value="">Pilih Pembimbing Asal</option>

            @foreach($pembimbingAsal as $p)
                <option value="{{ $p->id_pembimbing_asal }}"
                    {{ $peserta->pembimbingAsal->first()?->id_pembimbing_asal == $p->id_pembimbing_asal ? 'selected' : '' }}>

                    {{ $p->nama }}
                </option>
            @endforeach
        </select>

        @if($peserta->pembimbingAsal->count())
            <p class="pembimbing-info">
                Pembimbing Saat ini :
                <strong>
                    {{ $peserta->pembimbingAsal->first()->nama }}
                </strong>
            </p>
        @endif

        <button type="submit" class="btn btn-primary">
            Pilih
        </button>
    </form>
</div>

                        <div class="card" style="display:flex; flex-direction:column; justify-content:space-between;">
                            <div class="card-label">Akhiri Sesi Magang</div>
                            <form id="formSelesai"
      action="{{ route('admin.selesai', $peserta->id_peserta) }}"
      method="POST">
    @csrf

    <button type="submit" class="btn btn-success">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.5"
             stroke-linecap="round" stroke-linejoin="round">
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="{{ asset('js/admin/sidebar.js') }}"></script>
    <script src="{{ asset('js/admin/peserta-detail.js') }}"></script>

</body>
</html>
