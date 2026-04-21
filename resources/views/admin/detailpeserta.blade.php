<!DOCTYPE html>
<html>
<head>
    <title>Detail Peserta</title>
</head>
<body>

<h2>Detail Peserta Magang</h2>

<p><b>Nama:</b> {{ $peserta->nama }}</p>
<p><b>NISN:</b> {{ $peserta->nisn }}</p>
<p><b>Sekolah:</b> {{ $peserta->sekolah }}</p>
<p><b>Jurusan:</b> {{ $peserta->bidang_jurusan }}</p>
<p><b>Semester:</b> {{ $peserta->semester }}</p>
<p><b>Periode:</b> {{ $peserta->awal_magang }} s/d {{ $peserta->akhir_magang }}</p>
<p><b>Status:</b> {{ $peserta->hasilPendaftaran->status }}</p>

<br>

<h3>Berkas Magang</h3>

@if($peserta->hasilPendaftaran->berkas)
    <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->berkas->file_berkas) }}" target="_blank">
        Lihat Berkas
    </a>
@else
    <p>Tidak ada berkas</p>
@endif

<br><br>

<td>
        <a href="{{ route('admin.peserta') }}">Kembali</a>
    </td>

</body>
</html>
