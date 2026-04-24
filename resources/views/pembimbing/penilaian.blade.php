<!DOCTYPE html>
<html>
<head>
    <title>Penilaian Peserta</title>
</head>
<body>

<h2>📝 Penilaian Peserta</h2>

{{-- 🔹 INFO PESERTA --}}
<p><b>Nama:</b> {{ $peserta->nama }}</p>
<p><b>Sekolah:</b> {{ $peserta->sekolah }}</p>
<p><b>Jurusan:</b> {{ $peserta->bidang_jurusan }}</p>

<hr>

{{-- 🔹 NOTIFIKASI --}}
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif

{{-- 🔹 CEK STATUS --}}
@if(!in_array($peserta->hasilPendaftaran->status ?? '', ['diterima','selesai']))
    <p style="color:red">Peserta belum bisa dinilai</p>
@endif

<hr>

{{-- 🔹 DATA NILAI LAMA --}}
@php
    $nilaiLama = $peserta->penilaian->keyBy('id_kriteria_nilai');
@endphp

{{-- ===================================================== --}}
{{-- 🔥 PILIH KRITERIA DULU --}}
{{-- ===================================================== --}}
<h3>📌 Pilih Kriteria Penilaian</h3>

<form method="GET">
    <select name="kriteria_id">
        <option value="">-- Pilih Kriteria --</option>
        @foreach($kriteria as $k)
            <option value="{{ $k->id_kriteria_nilai }}"
                {{ request('kriteria_id') == $k->id_kriteria_nilai ? 'selected' : '' }}>
                {{ $k->kriteria_nilai }}
            </option>
        @endforeach
    </select>

    <button type="submit">Pilih</button>
</form>

<hr>

{{-- ===================================================== --}}
{{-- 🔥 FORM INPUT NILAI (MUNCUL SETELAH DIPILIH) --}}
{{-- ===================================================== --}}
@if(request('kriteria_id'))

    @php
        $selected = $kriteria->firstWhere('id_kriteria_nilai', request('kriteria_id'));
    @endphp

    @if($selected)

        <h3>✏️ Input Nilai: {{ $selected->kriteria_nilai }}</h3>

        <form method="POST" action="{{ route('pembimbing.penilaian.simpan', $peserta->id_peserta) }}">
            @csrf

            <input type="hidden" name="kriteria_id" value="{{ $selected->id_kriteria_nilai }}">

            <input
                type="number"
                name="nilai"
                min="1"
                max="100"
                value="{{ $nilaiLama[$selected->id_kriteria_nilai]->nilai ?? '' }}"
                required
            >

            <br><br>

            <button type="submit">💾 Simpan Nilai</button>
        </form>

    @endif

@endif

<hr>

{{-- ===================================================== --}}
{{-- 🔥 TAMBAH KRITERIA --}}
{{-- ===================================================== --}}
<h3>➕ Tambah Kriteria</h3>

<form action="{{ route('pembimbing.kriteria.store') }}" method="POST">
    @csrf
    <input type="text" name="kriteria" placeholder="Nama Kriteria" required>
    <button type="submit">Tambah</button>
</form>

<hr>

{{-- ===================================================== --}}
{{-- 🔥 LIST KRITERIA --}}
{{-- ===================================================== --}}
<h3>📋 Daftar Kriteria</h3>

@forelse($kriteria as $k)
    <p>
        {{ $k->kriteria_nilai }}

        <form action="{{ route('pembimbing.kriteria.delete', $k->id_kriteria_nilai) }}"
              method="POST"
              style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">❌ Hapus</button>
        </form>
    </p>
@empty
    <p>Tidak ada kriteria</p>
@endforelse

<hr>

<hr>

<h3>📊 Nilai yang Sudah Diberikan</h3>

@forelse($peserta->penilaian as $n)
    <p>
        <b>{{ $n->kriteria->kriteria_nilai }}</b> :
        <span style="color:blue">{{ $n->nilai }}</span>
    </p>
@empty
    <p>Belum ada nilai</p>
@endforelse

{{-- 🔹 KEMBALI --}}
<a href="{{ route('pembimbing.dashboard') }}">⬅ Kembali</a>

</body>
</html>
