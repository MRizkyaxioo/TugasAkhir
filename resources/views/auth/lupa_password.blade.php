<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Magang Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/lupa-password.css') }}">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo-wrap">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>

        <div class="brand-text" style="position:absolute; left:50%; transform:translateX(-50%); text-align:center;">
            <h1>Perpustakaan Politeknik Negeri Banjarmasin</h1>
            <p>Penerimaan dan Pengelolaan Peserta Magang</p>
        </div>
    </header>

    <!-- MAIN -->
    <main>
        <div class="login-card">

            <!-- FOTO KIRI -->
            <div class="card-photo">
                <img src="{{ asset('images/perpustakaan.jpg') }}"
                     alt="Perpustakaan Poliban"
                     onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:linear-gradient(135deg,#E8D5B5,#C8A87A);display:flex;align-items:center;justify-content:center;\'><span style=\'font-family:serif;color:#7B4F2E;text-align:center;padding:20px;line-height:1.6\'>Perpustakaan<br>Politeknik Negeri<br>Banjarmasin</span></div>'">
            </div>

            <!-- FORM KANAN -->
            <div class="card-form">
                <h2>Lupa Password</h2>
                <p>Masukkan email yang terdaftar, kami akan mengirimkan link untuk mereset password kamu.</p>

                @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-error">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

                <form method="POST" action="{{ route('password.email') }}"
                      style="display:flex; flex-direction:column; gap:16px;">
                    @csrf

                    <div class="field">
                        <label>Email</label>
                        <div class="input-wrap">
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="email@contoh.com"
                                   autocomplete="off" required>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                    </div>

                    <button type="submit" class="btn-kirim">Kirim Link Reset</button>

                </form>

                <div class="back-link">
                    Ingat password? <a href="{{ route('peserta.login') }}">Kembali ke Login</a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
