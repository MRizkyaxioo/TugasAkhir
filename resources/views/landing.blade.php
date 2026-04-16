<!DOCTYPE html>
<html>
<head>
    <title>Magang Perpus</title>
</head>
<body style="font-family: Arial">

    <h2>Perpustakaan Politeknik Negeri Banjarmasin</h2>
    <h3>Penerimaan dan Pengelolaan Peserta Magang</h3>

    <hr>

    <h4>Informasi</h4>
    <p>
        Website ini digunakan untuk pendaftaran dan pengelolaan peserta magang.
    </p>

    <hr>

    <h4>Kuota Magang</h4>
    <p><b>Tersisa: {{ $kuota }} orang</b></p>

    <h4>Peserta Aktif</h4>
    <p><b>{{ $pesertaAktif }} orang</b></p>

    <br>

    @if($kuota > 0)
        <a href="/daftar">
            <button>Daftar Magang</button>
        </a>
    @else
        <button disabled>Pendaftaran Ditutup</button>
        <p style="color:red;">Pendaftaran ditutup</p>
    @endif

</body>
</html>
