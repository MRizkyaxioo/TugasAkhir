<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pembimbing</title>
</head>
<body>

    <h1>Dashboard Pembimbing 👨‍🏫</h1>

    <strong>
    {{ auth()->guard('pembimbing')->user()->nama ?? auth()->guard('pembimbing')->user()->username }}
</strong>

<li>Username: {{ auth()->guard('pembimbing')->user()->username }}</li>

    <br>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">🚪 Logout</button>
    </form>

</body>
</html>
