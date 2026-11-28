<h1>Login</h1>

<form method="POST" action="{{ url('/login') }}">
    @csrf

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}">
    <br><br>

    <label>Password</label>
    <input type="password" name="password">
    <br><br>

    <button type="submit">Login</button>
</form>

@foreach ($errors->all() as $error)
    <p style="color: red">{{ $error }}</p>
@endforeach

<a href="{{ url('/register') }}">Create an account</a>