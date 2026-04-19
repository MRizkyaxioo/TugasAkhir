<h1>Welcome Calon Peserta Magang</h1>

<p>Nama: {{ $peserta->nama }}</p>
<p>NISN: {{ $peserta->nisn }}</p>
<p>Sekolah: {{ $peserta->sekolah }}</p>
<p>Jurusan: {{ $peserta->bidang_jurusan }}</p>
<p>Status: {{ $peserta->hasilPendaftaran->status }}</p>

<form action="{{ route('peserta.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
