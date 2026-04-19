<h2>Login Peserta</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="{{ route('peserta.login') }}" method="POST">
    @csrf

    <label>NISN</label><br>
    <input type="text" name="nisn"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>
