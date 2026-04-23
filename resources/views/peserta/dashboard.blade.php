<h1>Selamat! Anda diterima 🎉</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<p>Nama: {{ $peserta->nama }}</p>
<p>Status: DITERIMA</p>

<hr>

<h3>📄 Surat Balasan Magang</h3>

@if($peserta->hasilPendaftaran && $peserta->hasilPendaftaran->file_berkas_balasan)
    <a href="{{ asset('storage/'.$peserta->hasilPendaftaran->file_berkas_balasan) }}" target="_blank">
        Lihat Surat Balasan
    </a>
@else
    <p>Surat balasan belum tersedia</p>
@endif

<hr>

<a href="{{ route('peserta.logbook') }}">Logbook</a><br>

<form action="{{ route('peserta.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

@if($presensi)

<hr>
<h3>Presensi Magang</h3>

{{-- 🔥 SUDAH PRESENSI --}}
@if($sudahPresensi)
    <p style="color:green"><b>✔ Kamu sudah presensi hari ini</b></p>

{{-- 🔥 BELUM PRESENSI --}}
@else

    {{-- ✅ HADIR (langsung kirim) --}}
    <form action="{{ route('peserta.presensi') }}" method="POST" style="display:inline;">
        @csrf
        <input type="hidden" name="id_presensi" value="{{ $presensi->id_presensi }}">
        <input type="hidden" name="status" value="hadir">

        <button type="submit">✅ Hadir</button>
    </form>

    <br><br>

    {{-- ✅ IZIN / SAKIT --}}
    <form action="{{ route('peserta.presensi') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_presensi" value="{{ $presensi->id_presensi }}">

        <label>Tidak Hadir:</label>
        <select name="status" required>
            <option value="">-- Pilih --</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
        </select>

        <br><br>

        <label>Upload Surat:</label>
        <input type="file" name="surat" accept="application/pdf" required>

        <br><br>

        <button type="submit">📤 Kirim Surat Izin</button>
    </form>

@endif

@endif
