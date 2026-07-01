<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Magang - Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/register.css') }}">
</head>
<body>

    <header>
        <div class="logo-wrap">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>
        <div class="brand-text">
            <h1>Perpustakaan Politeknik Negeri Banjarmasin</h1>
            <p>Penerimaan dan Pengelolaan Peserta Magang</p>
        </div>
    </header>

    <main>
        <div class="register-card">
            <h2>Pendaftaran Peserta Magang Perpustakaan POLIBAN</h2>
            <div class="divider"></div>

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formRegister" action="{{ route('peserta.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">

                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}">
                        @error('nama')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Nisn/Nim</label>
                        <input type="text" name="nisn_nim" value="{{ old('nisn_nim') }}">
                        @error('nisn_nim')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Jurusan</label>
                        <select name="id_jurusan">
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jurusan')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Kelas (Contoh 10, 11, 12. Untuk mahasiswa abaikan bagian ini)</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}">
                        @error('kelas')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Semester</label>
                        <input type="number" name="semester" value="{{ old('semester') }}">
                        @error('semester')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Sekolah/Kampus</label>
                        <select name="id_sekolah_kampus">
                            <option value="">Pilih Sekolah/Kampus</option>
                            @foreach($sekolah as $s)
                                <option value="{{ $s->id_sekolah_kampus }}" {{ old('id_sekolah_kampus') == $s->id_sekolah_kampus ? 'selected' : '' }}>
                                    {{ $s->nama_sekolah_kampus }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_sekolah_kampus')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>No. Telpon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}">
                        @error('no_telp')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Email Aktif</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin">
                            <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}">
                        @error('alamat')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Awal Magang</label>
                        <input type="date" id="awal_magang" name="awal_magang" value="{{ old('awal_magang') }}">
                        @error('awal_magang')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Akhir Magang</label>
                        <input
    type="date"
    id="akhir_magang"
    name="akhir_magang"
    value="{{ old('akhir_magang') }}"
    disabled>
                        @error('akhir_magang')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field full">
                        <label>Upload Berkas Magang (PDF max 5MB)</label>
                        <div class="file-wrap">
                            <input type="file" name="file_berkas" accept="application/pdf">
                        </div>
                        @error('file_berkas')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field full">
                        <label>Password (minimal 6 karakter)</label>
                        <div class="password-wrap">
                            <input type="password" name="password" id="passwordRegister">
                            <svg id="eyeRegister"
                                 onclick="togglePassword('passwordRegister', 'eyeRegister')"
                                 width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </div>
                        @error('password')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        Daftar
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript Custom -->
    <script src="{{ asset('js/peserta/register.js') }}"></script>
</body>
</html>
