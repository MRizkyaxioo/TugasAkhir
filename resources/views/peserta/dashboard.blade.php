<h1>Selamat! Anda diterima 🎉</h1>

<p>Nama: {{ $peserta->nama }}</p>
<p>Status: DITERIMA</p>

<hr>

<h3>📄 Surat Balasan Magang</h3>

@if($peserta->hasilPendaftaran && $peserta->hasilPendaftaran->file_berkas_balasan)
    <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->file_berkas_balasan) }}" target="_blank">
        Lihat / Download Surat Balasan
    </a>
@else
    <p>Surat balasan belum tersedia</p>
@endif

<hr>

<a href="/logbook">Isi Logbook</a><br>
<a href="/presensi">Presensi</a><br><br>

<form action="{{ route('peserta.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
