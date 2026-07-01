<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook - {{ $peserta->nama }} | Pembimbing</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pembimbingasal/logbook.css') }}">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo-wrap">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>
        <div class="header-title">Logbook {{ $peserta->nama }}</div>
        <div></div> <!-- spacer -->
    </header>

    <!-- MAIN -->
    <main>
        <!-- Info singkat -->
        <div class="card">
            <div class="card-label">Informasi Peserta</div>
            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value">{{ $peserta->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sekolah/Kampus</span>
                <span class="info-value">{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jurusan</span>
                <span class="info-value">{{ $peserta->jurusan->jurusan ?? '-' }}</span>
            </div>
        </div>

        <!-- Tabel Logbook -->
        <div class="card">
            <div class="card-label">Logbook Harian</div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Bukti Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $d->kegiatan }}</td>
                            <td>
                                @if($d->bukti_foto)
                                    @php $ext = pathinfo($d->bukti_foto, PATHINFO_EXTENSION); @endphp
                                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                        <img src="{{ asset('storage/'.$d->bukti_foto) }}" class="bukti-img" alt="Bukti">
                                    @else
                                        <a href="{{ asset('storage/'.$d->bukti_foto) }}" target="_blank" class="bukti-link">Lihat Bukti (PDF)</a>
                                    @endif
                                @else
                                    <span style="color:var(--muted); font-size:0.8rem;">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="4">Belum ada data logbook</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <a href="{{ route('pembimbing_asal.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali ke Dashboard
        </a>
    </main>

</body>
</html>
