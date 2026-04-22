<h2>📄 Rekap Surat Izin / Sakit</h2>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Status</th>
    <th>Tanggal</th>
    <th>Surat</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->peserta->nama }}</td>
    <td>{{ $d->status_kehadiran }}</td>
    <td>{{ $d->tanggal_presensi }}</td>
    <td>
        <a href="{{ asset('storage/'.$d->surat_pendukung_izin) }}" target="_blank">
            Lihat Surat
        </a>
    </td>
</tr>
@endforeach
</table>

<a href="{{ route('admin.presensi') }}">⬅ Kembali</a>
