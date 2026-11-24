<x-layout title="Create Student">
    <h1>Create Student</h1>

    <form action="/students" method="POST">
        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        @csrf()
        <label>Name:</label>
        <input name="name" value="{{ old('name') }}" />
        <br />
        <label>Email:</label>
        <input name="email" value="{{ old('email') }}" />
        <br />
        <label>Phone:</label>
        <input name="phone" value="{{ old('phone') }}" />
        <br />
        <label>Address:</label>
        <textarea name="address">{{ old('address') }}</textarea>
        <br />
        <label>Date of Age:</label>
        <input name="date_of_birth" type="date" value="{{ old('date_of_birth') }}" />
        <br />
        <button>Submit</button>
    </form>
</x-layout>