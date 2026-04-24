<h2>Riwayat Peserta Magang</h2>

<form method="GET">
    <input type="text" name="nama" placeholder="Nama Peserta">
    <input type="text" name="jurusan" placeholder="Jurusan">
    <input type="text" name="sekolah" placeholder="Sekolah">
    <button type="submit">Cari</button>
</form>

<br>

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

    <br><br>

    <a href="{{ route('peserta.nilai.pdf', $d->id_peserta) }}" target="_blank">
        <button>📄 Cetak Nilai</button>
    </a>
</td>
</tr>
@endforeach
</table>

<br>

<a href="{{ route('admin.dashboard') }}">Kembali</a>
