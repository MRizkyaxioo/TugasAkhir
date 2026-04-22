<h2>Daftar Peserta Magang</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="GET">
    <input type="text" name="nama" placeholder="Nama Peserta">
    <input type="text" name="jurusan" placeholder="Jurusan">
    <input type="text" name="sekolah" placeholder="Sekolah">
    <input type="text" name="nisn" placeholder="NISN">
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
    <a href="{{ route('admin.detail.peserta', $d->id_peserta) }}">
        <button>Detail</button>
    </a>

    <br><br>

    <form action="{{ route('admin.upload.balasan', $d->id_peserta) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_balasan" accept="application/pdf" required>
        <button type="submit">Upload Surat Balasan</button>
    </form>

    @if($d->hasilPendaftaran->file_berkas_balasan)
        <br>
        <a href="{{ asset('storage/'.$d->hasilPendaftaran->file_berkas_balasan) }}" target="_blank">
            Lihat Surat
        </a>
    @endif
</td>
</tr>
@endforeach
</table>

<td>
        <a href="{{ route('admin.dashboard') }}">Kembali</a>
    </td>
