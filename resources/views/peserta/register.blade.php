<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Magang - Poliban</title>
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
            --error: #C0392B;
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
            gap: 16px;
            box-shadow: 0 2px 12px rgba(26,18,8,0.05);
            position: relative;
        }

        .logo-wrap {
            width: 48px; height: 48px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem; font-weight: 700;
            color: var(--dark); line-height: 1.2;
        }
        .brand-text p { font-size: 1rem; color: var(--muted); font-weight: 300; }

        /* MAIN */
        main {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 40px 24px 60px;
        }

        .register-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 40px 44px;
            max-width: 760px;
            width: 100%;
        }

        .register-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 8px;
        }

        .divider {
            width: 48px; height: 2px;
            background: linear-gradient(to right, var(--gold), transparent);
            border-radius: 2px;
            margin: 0 auto 28px;
        }

        /* ERRORS */
        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: var(--error);
            font-size: 0.8rem;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error ul { padding-left: 16px; }
        .alert-error li { margin-bottom: 2px; }

        /* GRID FORM */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
        }

        .form-grid .full {
            grid-column: 1 / -1;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .field label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
        }

        .field input,
        .field select,
        .field textarea {
            padding: 9px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--gold);
        }

        .field textarea {
            resize: vertical;
            min-height: 72px;
        }

        .field select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237A6E62' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        .field .field-error {
            font-size: 0.75rem;
            color: var(--error);
        }

        /* FILE INPUT */
        .file-wrap {
            position: relative;
        }

        .file-wrap input[type="file"] {
            padding: 7px 14px;
            cursor: pointer;
        }

        .file-wrap input[type="file"]::file-selector-button {
            background: var(--cream);
            border: 1px solid #E8D5B5;
            border-radius: 6px;
            padding: 4px 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            color: var(--dark);
            cursor: pointer;
            margin-right: 10px;
            transition: background 0.2s;
        }

        .file-wrap input[type="file"]::file-selector-button:hover {
            background: #E8D5B5;
        }

        /* SUBMIT */
        .form-footer {
            margin-top: 28px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 11px 36px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
        }

        .btn-submit:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
        }

        @media (max-width: 600px) {
            .register-card { padding: 28px 20px; }
            .form-grid { grid-template-columns: 1fr; }
            header { padding: 14px 20px; }
        }
    </style>
</head>
<script>
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);
        if (input.type === 'password') {
            input.type = 'text';
            eye.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
            `;
        } else {
            input.type = 'password';
            eye.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
            `;
        }
    }
</script>
<body>

    <header>
    <div class="logo-wrap">
        <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
    </div>

    <div class="brand-text" style="position:absolute; left:50%; transform:translateX(-50%); text-align:center;">
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

            <form action="{{ route('peserta.register') }}" method="POST" enctype="multipart/form-data">
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
            <option value="{{ $j->id_jurusan }}">
                {{ $j->jurusan }}
            </option>
        @endforeach
    </select>

    @error('id_jurusan')
        <span class="field-error">{{ $message }}</span>
    @enderror
</div>

                    <div class="field">
                        <label>Kelas</label>
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
            <option value="{{ $s->id_sekolah_kampus }}">
                {{ $s->nama_sekolah_kampus }}
            </option>
        @endforeach
    </select>

    @error('id_sekolah_kampus')
        <span class="field-error">{{ $message }}</span>
    @enderror
</div>

                    <div class="field">
                        <label>No. Telpon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}">
                        @error('no_telp')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Email</label>
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
                        <input type="date" name="awal_magang" value="{{ old('awal_magang') }}">
                        @error('awal_magang')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Akhir Magang</label>
                        <input type="date" name="akhir_magang" value="{{ old('akhir_magang') }}">
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
    <label>Password</label>
    <div style="position:relative;">
        <input type="password" name="password" id="passwordRegister"
               style="width:100%; padding:9px 38px 9px 14px; border:1.5px solid #E8D5B5;
                      border-radius:8px; font-family:'DM Sans',sans-serif; font-size:0.875rem;
                      color:#1A1208; background:#FDF4E7; outline:none;">
        <svg id="eyeRegister" onclick="togglePassword('passwordRegister', 'eyeRegister')"
             width="16" height="16" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                    color:#7A6E62; cursor:pointer;">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
    </div>
    @error('password')<span class="field-error">{{ $message }}</span>@enderror
</div>

                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">Daftar</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
