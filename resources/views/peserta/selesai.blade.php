<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Peserta Selesai</title>
</head>
<body>

<h2>🎓 Peserta Selesai Magang</h2>

<p><b>Nama:</b> {{ $peserta->nama }}</p>
<p><b>Sekolah:</b> {{ $peserta->sekolah }}</p>
<p><b>Jurusan:</b> {{ $peserta->bidang_jurusan }}</p>
<p><b>Status:</b> {{ $peserta->hasilPendaftaran->status }}</p>

<hr>

<h3>📄 Menu</h3>


<a href="{{ route('peserta.logbook.export.pdf') }}" target="_blank">
    📄 Cetak Logbook
</a>

<br><br>

<a href="{{ route('peserta.nilai.pdf', auth()->guard('peserta')->user()->id_peserta) }}" target="_blank">
    📄 Cetak Nilai
</a>

<br><br>

<form action="{{ route('peserta.logout') }}" method="POST">
    @csrf
    <button type="submit" style="
        background-color:red;
        color:white;
        border:none;
        padding:8px 12px;
        cursor:pointer;
    ">
        🚪 Logout
    </button>
</form>

</body>
</html>
