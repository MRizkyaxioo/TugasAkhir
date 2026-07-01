<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta - Pembimbing</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pembimbingasal/detail.css') }}">
</head>
<body>

    <!-- HEADER -->
    <header>
    <div class="logo-wrap">
        <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
    </div>

    <div class="header-title" style="position:absolute; left:50%; transform:translateX(-50%);">
        Detail Peserta Magang
    </div>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">
            Logout
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </button>
    </form>
</header>

    <!-- MAIN -->
    <main style="align-items:flex-start;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:960px; width:100%; align-items:start;">

        {{-- CARD PROFIL --}}
        <div class="card">
            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value">{{ $peserta->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">NISN/NIM</span>
                <span class="info-value">{{ $peserta->nisn_nim }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sekolah</span>
                <span class="info-value">{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jurusan</span>
                <span class="info-value">{{ $peserta->jurusan->jurusan ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kelas</span>
                <span class="info-value">{{ $peserta->kelas }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Semester</span>
                <span class="info-value">{{ $peserta->semester }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $peserta->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="info-value">
                    @php $status = $peserta->hasilPendaftaran->status ?? '-'; @endphp
                    @if($status == 'diterima')
                        <span class="badge badge-diterima">Diterima</span>
                    @elseif($status == 'selesai')
                        <span class="badge badge-selesai">Selesai</span>
                    @else
                        {{ $status }}
                    @endif
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
            <div class="info-row">
                <span class="info-label">Periode</span>
                <span class="info-value">
                    {{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y') }}
                    s/d
                    {{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y') }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Pembimbing Lapangan</span>
                <span class="info-value">{{ $peserta->pembimbing->first()->nama ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">No. HP Pembimbing</span>
                <span class="info-value">{{ $peserta->pembimbing->first()->no_telp ?? '-' }}</span>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div style="display:flex; flex-direction:column; gap:16px;">

            {{-- CARD KEHADIRAN --}}
            <div class="card">
                <div class="card-label">Rekap Kehadiran</div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div style="background:#DCFCE7; border:1px solid #BBF7D0; border-radius:12px; padding:16px; text-align:center;">
                        <div style="font-size:0.75rem; color:#166534; font-weight:500; margin-bottom:6px;">Hadir</div>
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#166534;">{{ $hadir }}</div>
                        <div style="font-size:0.72rem; color:#166534;">Hari</div>
                    </div>
                    <div style="background:#E0F2FE; border:1px solid #BAE6FD; border-radius:12px; padding:16px; text-align:center;">
                        <div style="font-size:0.75rem; color:#075985; font-weight:500; margin-bottom:6px;">Izin</div>
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#075985;">{{ $izin }}</div>
                        <div style="font-size:0.72rem; color:#075985;">Hari</div>
                    </div>
                    <div style="background:#FEF9C3; border:1px solid #FDE68A; border-radius:12px; padding:16px; text-align:center;">
                        <div style="font-size:0.75rem; color:#92400E; font-weight:500; margin-bottom:6px;">Sakit</div>
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#92400E;">{{ $sakit }}</div>
                        <div style="font-size:0.72rem; color:#92400E;">Hari</div>
                    </div>
                    <div style="background:#FEE2E2; border:1px solid #FECACA; border-radius:12px; padding:16px; text-align:center;">
                        <div style="font-size:0.75rem; color:#991B1B; font-weight:500; margin-bottom:6px;">Alpa</div>
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#991B1B;">{{ $alpa }}</div>
                        <div style="font-size:0.72rem; color:#991B1B;">Hari</div>
                    </div>
                </div>
            </div>

            {{-- CARD NILAI --}}
            <div class="card">
                <div class="card-label">Nilai Peserta</div>
                @forelse($peserta->penilaian as $nilai)
                    <div class="info-row">
                        <span class="info-label">{{ $nilai->kriteria->kriteria_nilai }}</span>
                        <span class="info-value">{{ $nilai->nilai }}</span>
                    </div>
                @empty
                    <p style="text-align:center; color:var(--muted); font-size:0.82rem; padding:12px 0;">
                        Belum ada nilai
                    </p>
                @endforelse
            </div>

        </div>

    </div>
</main>

    <!-- FOOTER -->
    <footer>
        <a href="{{ route('pembimbing_asal.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>
    </footer>

</body>
</html>
