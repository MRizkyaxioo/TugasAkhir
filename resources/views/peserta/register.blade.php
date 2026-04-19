<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peserta Magang</title>
</head>
<body>

<h2>Form Pendaftaran Magang</h2>

{{-- Error --}}
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('peserta.register') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama</label><br>
    <input type="text" name="nama"><br><br>

    <label>NISN</label><br>
    <input type="text" name="nisn"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <label>Sekolah</label><br>
    <input type="text" name="sekolah"><br><br>

    <label>Jurusan</label><br>
    <input type="text" name="bidang_jurusan"><br><br>

    <label>Semester</label><br>
    <input type="number" name="semester"><br><br>

    <label>No Telp</label><br>
    <input type="text" name="no_telp"><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"></textarea><br><br>

    <label>Kelas</label><br>
    <input type="text" name="kelas"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Jenis Kelamin</label><br>
    <select name="jenis_kelamin">
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select><br><br>

    <label>Awal Magang</label><br>
<input type="date" name="awal_magang"><br><br>

<label>Akhir Magang</label><br>
<input type="date" name="akhir_magang"><br><br>

    <label>Upload Berkas</label><br>
    <input type="file" name="file_berkas"><br><br>

    <button type="submit">Daftar</button>
</form>

</body>
</html>
