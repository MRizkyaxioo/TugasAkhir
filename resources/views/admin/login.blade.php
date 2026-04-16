<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>

    <h2>Login Admin</h2>

    {{-- Error --}}
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    {{-- Validation Error --}}
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <label>Username</label><br>
        <input type="text" name="username" value="{{ old('username') }}"><br><br>

        <label>Password</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
