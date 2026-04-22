<!DOCTYPE html>
<html>
<head>
    <title>Presensi Peserta</title>
</head>
<body>

<h2>Presensi Peserta</h2>

{{-- 🔹 NOTIFIKASI --}}
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

{{-- 🔹 TOMBOL BUKA / TUTUP --}}
<form method="POST" action="/admin/presensi/buka" style="display:inline;">
    @csrf
    <button type="submit">🟢 Buka Presensi</button>
</form>

<br><br>

{{-- 🔹 FORM EDIT PRESENSI --}}
<form method="POST" action="{{ route('admin.simpan.presensi') }}">
@csrf

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Status</th>
    <th>Surat</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->peserta->nama }}</td>

    {{-- 🔹 EDIT STATUS --}}
    <td>
        <select name="status[{{ $d->id_presensi_peserta }}]">
            <option value="hadir" {{ $d->status_kehadiran == 'hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="izin" {{ $d->status_kehadiran == 'izin' ? 'selected' : '' }}>Izin</option>
            <option value="sakit" {{ $d->status_kehadiran == 'sakit' ? 'selected' : '' }}>Sakit</option>
            <option value="alpha" {{ $d->status_kehadiran == 'alpha' ? 'selected' : '' }}>Alpha</option>
        </select>
    </td>

    {{-- 🔹 LIHAT SURAT --}}
    <td>
        @if($d->surat_pendukung_izin)
            <a href="{{ asset('storage/'.$d->surat_pendukung_izin) }}" target="_blank">
                📄 Lihat Surat
            </a>
        @else
            -
        @endif
    </td>
</tr>
@endforeach

</table>

<br>

<button type="submit">💾 Simpan Presensi</button>

</form>

<br>

<a href="{{ route('admin.dashboard') }}">⬅ Kembali</a>
<a href="{{ route('admin.rekap.presensi') }}">Rekap Presensi</a><br>
<a href="{{ route('admin.rekap.surat') }}">Rekap Surat</a><br>
</body>
</html>
