<h2>Mohon Maaf {{ $peserta->nama }} 🙏</h2>

<p>
    Anda <b>DITOLAK</b> sebagai peserta magang.
</p>

<p>
    Sekolah/Kampus:
    {{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}
    <br>

    Jurusan:
    {{ $peserta->jurusan->jurusan ?? '-' }}
    <br>

    NISN/NIM:
    {{ $peserta->nisn_nim }}
</p>


<br>

<p>Terima kasih.</p>
