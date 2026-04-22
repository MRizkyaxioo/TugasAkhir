<h2>📊 Rekap Presensi</h2>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Hadir</th>
    <th>Izin</th>
    <th>Sakit</th>
    <th>Alpha</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->peserta->nama }}</td>
    <td>{{ $d->hadir }}</td>
    <td>{{ $d->izin }}</td>
    <td>{{ $d->sakit }}</td>
    <td>{{ $d->alpha }}</td>
</tr>
@endforeach
</table>

<a href="{{ route('admin.presensi') }}">⬅ Kembali</a>
