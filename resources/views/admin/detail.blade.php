<h2>Detail Peserta</h2>

<p>Nama: {{ $peserta->nama }}</p>
<p>NISN: {{ $peserta->nisn }}</p>
<p>Sekolah: {{ $peserta->sekolah }}</p>
<p>Jurusan: {{ $peserta->bidang_jurusan }}</p>
<p>Status: {{ $peserta->hasilPendaftaran->status }}</p>

<h3>Berkas:</h3>
<a href="{{ asset('storage/'.$peserta->hasilPendaftaran->berkas->file_berkas) }}" target="_blank">
    Lihat Berkas
</a>

<br><br>

<form action="{{ route('admin.terima', $peserta->id_peserta) }}" method="POST">
    @csrf
    <button type="submit">✅ Terima</button>
</form>

<form action="{{ route('admin.tolak', $peserta->id_peserta) }}" method="POST">
    @csrf
    <button type="submit">❌ Tolak</button>
</form>
