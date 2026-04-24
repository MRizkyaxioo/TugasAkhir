<h1>Dashboard Pembimbing 👨‍🏫</h1>

<p>Login sebagai: {{ auth()->guard('pembimbing')->user()->nama }}</p>

<form method="GET">
    <input type="text" name="nama" placeholder="Cari Nama">
    <input type="text" name="jurusan" placeholder="Cari Jurusan">
    <input type="text" name="sekolah" placeholder="Cari Sekolah">
    <input type="text" name="nisn" placeholder="Cari NISN">
    <button type="submit">🔍 Filter</button>
</form>

<br>

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Sekolah</th>
    <th>Jurusan</th>
    <th>Status</th>
    <th>NISN</th>
    <th>Aksi</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->nama }}</td>
    <td>{{ $d->sekolah }}</td>
    <td>{{ $d->bidang_jurusan }}</td>
    <td>{{ $d->nisn }}</td>

    {{-- 🔥 STATUS --}}
    <td>
        @if($d->hasilPendaftaran)
            @if($d->hasilPendaftaran->status == 'diterima')
                <span style="color:green">DITERIMA</span>
            @elseif($d->hasilPendaftaran->status == 'selesai')
                <span style="color:blue">SELESAI</span>
            @endif
        @else
            -
        @endif
    </td>

    <td>
        <a href="{{ route('pembimbing.detail', $d->id_peserta) }}">
            🔍 Detail
        </a>
        <br>

    <a href="{{ route('pembimbing.penilaian', $d->id_peserta) }}">
        📝 Nilai
    </a>
    </td>
</tr>
@endforeach
</table>

<br>

<form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit">🚪 Logout</button>
</form>
