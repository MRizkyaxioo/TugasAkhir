<h2>Daftar Calon Peserta</h2>


<form method="GET" action="{{ route('admin.calon') }}">
    <input type="text" name="nama" placeholder="Nama Peserta"
        value="{{ request('nama') }}">

    <input type="text" name="jurusan" placeholder="Jurusan"
        value="{{ request('jurusan') }}">

    <input type="text" name="sekolah" placeholder="Sekolah"
        value="{{ request('sekolah') }}">

    <button type="submit">🔍 Cari</button>
</form>

<a href="{{ route('admin.calon') }}">Reset</a>
<br>


<table border="1" cellpadding="5">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NISN</th>
    <th>Sekolah</th>
    <th>Jurusan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@forelse($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->nama }}</td>
    <td>{{ $d->nisn }}</td>
    <td>{{ $d->sekolah }}</td>
    <td>{{ $d->bidang_jurusan }}</td>
    <td>{{ $d->hasilPendaftaran->status }}</td>
    <td>
        <a href="{{ route('admin.detail', $d->id_peserta) }}">
            <button>Detail</button>
        </a>
    </td>
</tr>
@empty
<tr>
    <td colspan="7">Data tidak ditemukan 😢</td>
</tr>
@endforelse
</table>

<td>
        <a href="{{ route('admin.dashboard') }}">Kembali</a>
    </td>
