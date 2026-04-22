<h2>Detail Peserta Magang</h2>

<p><b>Nama:</b> {{ $peserta->nama }}</p>
<p><b>NISN:</b> {{ $peserta->nisn }}</p>
<p><b>Sekolah:</b> {{ $peserta->sekolah }}</p>
<p><b>Kelas:</b> {{ $peserta->kelas }}</p>
<p><b>Semester:</b> {{ $peserta->semester }}</p>
<p><b>Jurusan:</b> {{ $peserta->bidang_jurusan }}</p>
<p><b>No. Telepon:</b> {{ $peserta->no_telp }}</p>
<p><b>Alamat:</b> {{ $peserta->alamat }}</p>
<p><b>Awal Magang:</b> {{ $peserta->awal_magang }}</p>
<p><b>Akhir Magang:</b> {{ $peserta->akhir_magang }}</p>
<p><b>Status:</b> {{ $peserta->hasilPendaftaran->status }}</p>

<hr>

<h3>Berkas</h3>
@if($peserta->hasilPendaftaran->berkas)
    <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->berkas->file_berkas) }}" target="_blank">
        Lihat PDF
    </a>
@endif

<hr>

<h3>Surat Balasan Magang</h3>

@if($peserta->hasilPendaftaran->file_berkas_balasan)
    <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->file_berkas_balasan) }}" target="_blank">
        Lihat Surat Balasan
    </a>
@else
    <p>Belum ada surat balasan</p>
@endif

<hr>

<h3>Assign Pembimbing</h3>

<form method="POST" action="{{ route('admin.assign.pembimbing', $peserta->id_peserta) }}">
    @csrf

    <select name="id_pembimbing">
        <option value="">-- Pilih Pembimbing --</option>
        @foreach($pembimbing as $p)
            <option value="{{ $p->id_pembimbing }}">
                {{ $p->nama }}
            </option>
        @endforeach
    </select>

    <button type="submit">Simpan</button>
</form>

@if($peserta->pembimbing->count())
    <p><b>Pembimbing Saat Ini:</b> {{ $peserta->pembimbing->first()->nama }}</p>
@endif

<hr>

<h3>Aksi</h3>

<form action="{{ route('admin.selesai', $peserta->id_peserta) }}" method="POST">
    @csrf
    <button type="submit">✔ Tandai Selesai</button>
</form>

<br>

<a href="{{ route('admin.peserta') }}">Kembali</a>
