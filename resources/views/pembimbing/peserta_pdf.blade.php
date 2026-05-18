<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peserta Bimbingan</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 4px;
        }

        .sub {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
        }

        table th {
            background: #f2f2f2;
            text-align: center;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>
<body>

    <h2>Data Peserta Bimbingan Magang</h2>

    <div class="sub">
        Pembimbing : {{ $pembimbing->nama }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN/NIM</th>
                <th>Sekolah/Kampus</th>
                <th>Jurusan</th>
                <th>Periode Magang</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $i => $d)
            <tr>
                <td style="text-align:center">
                    {{ $i + 1 }}
                </td>

                <td>
                    {{ $d->nama }}
                </td>

                <td>
                    {{ $d->nisn_nim }}
                </td>

                <td>
                    {{ $d->sekolahKampus->nama_sekolah_kampus ?? '-' }}
                </td>

                <td>
                    {{ $d->jurusan->jurusan ?? '-' }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($d->hasilPendaftaran->tanggal_mulai)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($d->hasilPendaftaran->tanggal_selesai)->format('d M Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center">
                    Tidak ada data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
