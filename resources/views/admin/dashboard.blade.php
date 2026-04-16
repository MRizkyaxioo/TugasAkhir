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

</body>
</html>
