<!DOCTYPE html>
<html>
<head>
    <title>Data Pembimbing</title>
</head>
<body>

<h2>Data Pembimbing</h2>

{{-- Notifikasi --}}
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

<hr>

<h3>Tambah Pembimbing</h3>

<form action="{{ route('admin.pembimbing.store') }}" method="POST">
    @csrf

    <label>Nama</label><br>
    <input type="text" name="nama"><br><br>

    <label>NIP/NIDN</label><br>
    <input type="text" name="nip_nidn"><br><br>

    <label>Username</label><br>
    <input type="text" name="username"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Tambah</button>
</form>

<hr>

<h3>List Pembimbing</h3>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIP/NIDN</th>
    <th>Username</th>
</tr>

@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->nama }}</td>
    <td>{{ $d->nip_nidn }}</td>
    <td>{{ $d->username }}</td>
</tr>
@endforeach
</table>

<br>

<a href="{{ route('admin.dashboard') }}">Kembali</a>

</body>
</html>
