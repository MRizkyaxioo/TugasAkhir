<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Calon Peserta - Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/calon.css') }}">
</head>
<body>

    <header>
        <div class="header-left">
            <div class="logo-wrap">
                <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
            </div>
            <div class="brand-text">
                <h1>Selamat Datang Calon Peserta</h1>
                <p>Perpustakaan Politeknik Negeri Banjarmasin</p>
            </div>
        </div>

        <form action="{{ route('peserta.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <span class="logout-text">Logout</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </button>
        </form>
    </header>

    <main>
        <div class="dashboard-wrap">

            {{-- INFO CARD --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="avatar">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="avatar-info">
                        <h3>{{ $peserta->nama }}</h3>
                        <p>{{ $peserta->nisn_nim }}</p>
                    </div>
                </div>

                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $peserta->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NISN</span>
                        <span class="info-value">{{ $peserta->nisn_nim }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Sekolah/Kampus</span>
                        <span class="info-value">{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jurusan</span>
                        <span class="info-value">{{ $peserta->jurusan->jurusan ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            @php $status = $peserta->hasilPendaftaran->status ?? 'pending'; @endphp
                            @if($status == 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($status == 'diterima')
                                <span class="badge badge-diterima">Diterima</span>
                            @elseif($status == 'ditolak')
                                <span class="badge badge-ditolak">Ditolak</span>
                            @else
                                <span class="badge badge-pending">{{ ucfirst($status) }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- NOTICE --}}
            <div class="notice-card">
                Tunggu kabar dari admin ya, jika ada yang ingin ditanyakan bisa hubungi
                <strong>08123123123</strong> atau melalui email
                <strong>adminperpustakaan@gmail.com</strong>
            </div>

        </div>
    </main>

</body>
</html>
