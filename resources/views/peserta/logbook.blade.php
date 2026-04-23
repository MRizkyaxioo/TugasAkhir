<h2>Logbook Harian</h2>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('peserta.logbook.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Tanggal:</label><br>
    <input type="date" name="tanggal" required><br><br>

    <label>Kegiatan:</label><br>
    <textarea name="kegiatan" required></textarea><br><br>

    <label>Bukti Foto:</label><br>
    <input type="file" name="bukti_foto"><br><br>

    <button type="submit">Simpan</button>
</form>

<hr>

<h3>Riwayat Logbook</h3>

<table border="1">
<tr>
    <th>Tanggal</th>
    <th>Kegiatan</th>
    <th>Bukti</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->tanggal }}</td>
    <td>{{ $d->kegiatan }}</td>
    <td>
        @if($d->bukti_foto)
            <a href="{{ asset('storage/'.$d->bukti_foto) }}" target="_blank">Lihat</a>
        @endif
    </td>
</tr>
@endforeach
</table>
<br>

<a href="{{ route('peserta.logbook.export.pdf') }}">
    📄 Export PDF
</a>

<a href="/dashboard-peserta">Kembali</a><br>

