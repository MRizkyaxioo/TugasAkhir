<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logbook Magang</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background: #eee;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        img {
            width: 80px;
        }
    </style>
</head>
<body>

<h2>LOGBOOK KEGIATAN MAGANG</h2>

<div class="info">
    <p><strong>Nama:</strong> {{ $peserta->nama }}</p>
    <p><strong>Sekolah:</strong> {{ $peserta->sekolah }}</p>
    <p><strong>Periode:</strong> {{ $peserta->awal_magang }} s/d {{ $peserta->akhir_magang }}</p>
</div>

<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kegiatan</th>
        <th>Bukti Foto</th>
    </tr>

    @foreach($data as $index => $d)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $d->tanggal }}</td>
        <td>{{ $d->kegiatan }}</td>
        <td>
            @if($d->bukti_foto)
                <img src="{{ public_path('storage/'.$d->bukti_foto) }}">
            @else
                -
            @endif
        </td>
    </tr>
    @endforeach
</table>

<br><br>

<p style="text-align:right;">
    Banjarmasin, {{ date('d-m-Y') }}<br><br><br>
    _______________________
</p>

</body>
</html>
