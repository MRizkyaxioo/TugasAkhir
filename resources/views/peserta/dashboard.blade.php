<h1>Selamat! Anda diterima 🎉</h1>

<p>Nama: {{ $peserta->nama }}</p>
<p>Status: DITERIMA</p>

<a href="/logbook">Isi Logbook</a>
<a href="/presensi">Presensi</a>

<form action="{{ route('peserta.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
