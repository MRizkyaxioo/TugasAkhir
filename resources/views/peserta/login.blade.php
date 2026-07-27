<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peserta - Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/login.css') }}">
    <script src="{{ asset('js/peserta/login.js') }}"></script>
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
        <div class="login-card">

            {{-- FOTO KIRI / ATAS --}}
            <div class="card-photo">
                <img src="{{ asset('images/perpustakaan.jpg') }}"
                     alt="Perpustakaan Poliban"
                     onerror="this.parentElement.innerHTML='<div class=\'card-photo-fallback\'><span>Perpustakaan<br>Politeknik Negeri<br>Banjarmasin</span></div>'">
            </div>

            {{-- FORM KANAN / BAWAH --}}
            <div class="card-form">

                <div class="login-tabs">
                    <a href="{{ route('peserta.login') }}" class="login-tab active">Peserta Magang</a>
                    <a href="{{ route('admin.login') }}" class="login-tab">Admin / Pembimbing</a>
                </div>

                <h2>Login</h2>

                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('peserta.login') }}" method="POST"
                      style="display:flex; flex-direction:column; gap:16px;">
                    @csrf

                    <div class="field">
                        <label>NIS/NIM</label>
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