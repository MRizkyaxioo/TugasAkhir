<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peserta - Magang Poliban</title>
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

        /* ── HEADER ── */
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
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .brand-text {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
            white-space: nowrap;
        }

        .brand-text p {
            font-size: 1rem;
            color: var(--muted);
            font-weight: 300;
        }

        /* ── MAIN ── */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        /* ── LOGIN CARD ── */
        .login-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            max-width: 700px;
            width: 100%;
        }

        /* FOTO KIRI */
        .card-photo {
            position: relative;
            min-height: 340px;
            overflow: hidden;
        }

        .card-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-photo-fallback {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #E8D5B5 0%, #C8A87A 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-photo-fallback span {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #7B4F2E;
            text-align: center;
            padding: 20px;
            line-height: 1.6;
        }

        /* FORM KANAN */
        .card-form {
            padding: 40px 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 20px;
        }

        .card-form h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
        }

        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: var(--error);
            font-size: 0.8rem;
            padding: 10px 14px;
            border-radius: 8px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            padding: 10px 38px 10px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
        }

        .input-wrap input:focus {
            border-color: var(--gold);
        }

        .input-wrap svg {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        /* BUTTONS */
        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 4px;
        }

        .btn-register {
            padding: 10px;
            border: 1.5px solid var(--gold);
            border-radius: 50px;
            background: transparent;
            color: var(--gold);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            display: block;
        }

        .btn-register:hover {
            background: var(--gold);
            color: #fff;
        }

        .btn-login {
            padding: 10px;
            border: none;
            border-radius: 50px;
            background: var(--gold);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
        }

        .btn-login:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
        }

        .btn-register.disabled {
            display: none;
        }

        .btn-login-full {
            grid-column: 1 / -1;
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — TABLET (≤700px)
        ══════════════════════════════════════════ */
        @media (max-width: 700px) {
            /* Header: logo + teks berjejer, teks tidak absolut lagi */
            header {
                padding: 14px 16px;
                gap: 12px;
            }

            .brand-text {
                position: static;
                transform: none;
                text-align: left;
            }

            .brand-text h1 {
                font-size: 0.95rem;
                white-space: normal;
                line-height: 1.3;
            }

            .brand-text p {
                font-size: 0.75rem;
            }

            .logo-wrap {
                width: 38px;
                height: 38px;
            }

            /* Main: kurangi padding vertikal */
            main {
                padding: 24px 16px;
                align-items: flex-start;
            }

            /* Card: 1 kolom */
            .login-card {
                grid-template-columns: 1fr;
                max-width: 420px;
            }

            /* Foto: lebih pendek di mobile, tampil di atas */
            .card-photo {
                min-height: 160px;
                max-height: 200px;
            }

            /* Form: padding lebih rapat */
            .card-form {
                padding: 28px 24px 32px;
                gap: 16px;
            }

            .card-form h2 {
                font-size: 1.3rem;
            }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤400px)
        ══════════════════════════════════════════ */
        @media (max-width: 400px) {
            .brand-text h1 {
                font-size: 0.85rem;
            }

            .brand-text p {
                font-size: 0.7rem;
            }

            .card-form {
                padding: 24px 18px 28px;
            }

            /* Tombol Register & Login full width masing-masing */
            .btn-group {
                grid-template-columns: 1fr;
            }

            .btn-login-full {
                grid-column: auto;
            }
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
        <div class="brand-text">
            <h1>Perpustakaan Politeknik Negeri Banjarmasin</h1>
            <p>Penerimaan dan Pengelolaan Peserta Magang</p>
        </div>
    </header>

    <main>
        <div class="login-card">

            {{-- FOTO KIRI / ATAS --}}
            <div class="card-photo">
                <img src="{{ asset('images/perpustakaan.jpg') }}"
                     alt="Perpustakaan Poliban"
                     onerror="this.parentElement.innerHTML='<div class=\'card-photo-fallback\'><span>Perpustakaan<br>Politeknik Negeri<br>Banjarmasin</span></div>'">
            </div>

            {{-- FORM KANAN / BAWAH --}}
            <div class="card-form">
                <h2>Login</h2>

                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                <form action="{{ route('peserta.login') }}" method="POST"
                      style="display:flex; flex-direction:column; gap:16px;">
                    @csrf

                    <div class="field">
                        <label>NISN/NIM</label>
                        <div class="input-wrap">
                            <input type="text" name="nisn_nim"
                                   value="{{ old('nisn_nim') }}" autocomplete="off">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                    </div>

                    <div class="field">
                        <label>Password</label>
                        <div class="input-wrap">
                            <input type="password" name="password" id="passwordLogin">
                            <svg id="eyeLogin"
                                 onclick="togglePassword('passwordLogin', 'eyeLogin')"
                                 width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 style="cursor:pointer; pointer-events:all;">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </div>
                        <div style="text-align:right; margin-top:4px;">
                            <a href="{{ route('password.request') }}"
                               style="font-size:0.75rem; color:#C8873A; text-decoration:none;">
                               Lupa password?
                            </a>
                        </div>
                    </div>

                    <div class="btn-group">
                        @php $kuota = \App\Models\KuotaMagang::find(1); @endphp
                        @if($kuota && $kuota->kuota_peserta > 0)
                            <a href="{{ route('peserta.register') }}" class="btn-register">Register</a>
                        @endif
                        <button type="submit"
                            class="btn-login {{ (!$kuota || $kuota->kuota_peserta <= 0) ? 'btn-login-full' : '' }}">
                            Login
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

</body>
</html>