<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

    <h1>Selamat datang admin 👋</h1>

    <p>Login sebagai: {{ auth()->guard('admin')->user()->username }}</p>

    <br>

    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">🚪 Logout</button>
                    </form>

                    <form action="{{ route('admin.update.kuota') }}" method="POST">
    @csrf
    @method('PUT')

    <input type="number" name="kuota" required>
    <button type="submit">Update</button>
</form>

<h2>📊 Statistik Peserta Magang</h2>

<ul>
    <li>👥 Total Peserta Aktif: <b>{{ $total }}</b></li>
    <li>👦 Siswa (Laki-laki): <b>{{ $siswa }}</b></li>
    <li>👧 Siswi (Perempuan): <b>{{ $siswi }}</b></li>
</ul>

<hr>
</body>
</html>
