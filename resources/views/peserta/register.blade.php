<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peserta Magang</title>
</head>
<body style="font-family: Arial">

<h2>Form Pendaftaran Magang</h2>

{{-- ERROR GLOBAL --}}
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

    {{-- NAMA --}}
    <label>Nama</label><br>
    <input type="text" name="nama" value="{{ old('nama') }}"><br>
    @error('nama')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- NISN --}}
    <label>NISN</label><br>
    <input type="text" name="nisn" value="{{ old('nisn') }}"><br>
    @error('nisn')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- PASSWORD --}}
    <label>Password</label><br>
    <input type="password" name="password"><br>
    @error('password')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- SEKOLAH --}}
    <label>Sekolah</label><br>
    <input type="text" name="sekolah" value="{{ old('sekolah') }}"><br>
    @error('sekolah')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- JURUSAN --}}
    <label>Jurusan</label><br>
    <input type="text" name="bidang_jurusan" value="{{ old('bidang_jurusan') }}"><br>
    @error('bidang_jurusan')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- SEMESTER --}}
    <label>Semester</label><br>
    <input type="number" name="semester" value="{{ old('semester') }}"><br>
    @error('semester')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- NO TELP --}}
    <label>No Telp</label><br>
    <input type="text" name="no_telp" value="{{ old('no_telp') }}"><br>
    @error('no_telp')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- ALAMAT --}}
    <label>Alamat</label><br>
    <textarea name="alamat">{{ old('alamat') }}</textarea><br>
    @error('alamat')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- KELAS --}}
    <label>Kelas</label><br>
    <input type="text" name="kelas" value="{{ old('kelas') }}"><br>
    @error('kelas')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- EMAIL --}}
    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}"><br>
    @error('email')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- JENIS KELAMIN --}}
    <label>Jenis Kelamin</label><br>
    <select name="jenis_kelamin">
        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select><br>
    @error('jenis_kelamin')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- AWAL MAGANG --}}
    <label>Awal Magang</label><br>
    <input type="date" name="awal_magang" value="{{ old('awal_magang') }}"><br>
    @error('awal_magang')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- AKHIR MAGANG --}}
    <label>Akhir Magang</label><br>
    <input type="date" name="akhir_magang" value="{{ old('akhir_magang') }}"><br>
    @error('akhir_magang')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    {{-- FILE --}}
    <label>Upload Berkas (PDF max 5MB)</label><br>
    <input type="file" name="file_berkas" accept="application/pdf"><br>
    @error('file_berkas')
        <small style="color:red">{{ $message }}</small><br>
    @enderror
    <br>

    <button type="submit">Daftar</button>

</form>

</body>
</html>
