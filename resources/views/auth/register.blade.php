<h1>Register</h1>

<form method="POST" action="{{ url('/register') }}">
    @csrf

    <label>Name</label>
    <input type="text" name="name" value="{{ old('name') }}">
    <br><br>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}">
    <br><br>

    <label>Password</label>
    <input type="password" name="password">
    <br><br>

    <label>Confirm Password</label>
    <input type="password" name="password_confirmation">
    <br><br>

    <button type="submit">Register</button>
</form>

@foreach ($errors->all() as $error)
    <p style="color: red">{{ $error }}</p>
@endforeach