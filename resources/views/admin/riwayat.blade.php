<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Peserta</title>
</head>
<body>

<h2>Riwayat Peserta Magang</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NISN</th>
        <th>Sekolah</th>
        <th>Jurusan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $i => $d)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->nisn }}</td>
        <td>{{ $d->sekolah }}</td>
        <td>{{ $d->bidang_jurusan }}</td>
        <td>{{ $d->hasilPendaftaran->status }}</td>
        <td>
            <a href="{{ route('admin.detail.riwayat', $d->id_peserta) }}">
                <button>Detail</button>
            </a>
        </td>
    </tr>
    @endforeach
</table>
<td>
        <a href="{{ route('admin.dashboard') }}">Kembali</a>
    </td>

</body>
</html>
