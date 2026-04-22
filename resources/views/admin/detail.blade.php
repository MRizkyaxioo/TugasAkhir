<h2>Detail Calon Peserta</h2>

<p>Nama: {{ $peserta->nama }}</p>
<p>NISN: {{ $peserta->nisn }}</p>
<p>Sekolah: {{ $peserta->sekolah }}</p>
<p>Jurusan: {{ $peserta->bidang_jurusan }}</p>
<p>Kelas: {{ $peserta->kelas }}</p>
<p>Semester: {{ $peserta->semester }}</p>
<p>Email: {{ $peserta->email }}</p>
<p>Status: {{ $peserta->hasilPendaftaran->status }}</p>
<p>Awal Magang: {{ $peserta->awal_magang }}</p>
<p>Akhir Magang: {{ $peserta->akhir_magang }}</p>

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

<td>
        <a href="{{ route('admin.calon') }}">Kembali</a>
    </td>
