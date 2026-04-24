<h2>Detail Peserta</h2>

<p><b>Nama:</b> {{ $peserta->nama }}</p>
<p><b>Sekolah:</b> {{ $peserta->sekolah }}</p>
<p><b>Jurusan:</b> {{ $peserta->bidang_jurusan }}</p>
<p><b>NISN:</b> {{ $peserta->nisn }}</p>

<p><b>Status:</b>
    @if($peserta->hasilPendaftaran)
        @if($peserta->hasilPendaftaran->status == 'diterima')
            <span style="color: green;">DITERIMA</span>
        @elseif($peserta->hasilPendaftaran->status == 'selesai')
            <span style="color: blue;">SELESAI</span>
        @else
            <span>{{ $peserta->hasilPendaftaran->status }}</span>
        @endif
    @else
        <span>-</span>
    @endif
</p>

<a href="{{ route('pembimbing.dashboard') }}">⬅ Kembali</a>
