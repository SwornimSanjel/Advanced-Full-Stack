<x-layout title="Edit Student">
    <h1>Edit Student</h1>

    <form action="/students/{{ $student->id }}" method="POST">
        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        @csrf()
        @method("PUT")
        <label>Name:</label>
        <input name="name" value="{{ $student->name }}" />
        <br />
        <label>Email:</label>
        <input name="email" value="{{ $student->email }}" />
        <br />
        <label>Phone:</label>
        <input name="phone" value="{{ $student->phone }}" />
        <br />
        <label>Address:</label>
        <textarea name="address">{{ $student->address }}</textarea>
        <br />
        <label>Date of Age:</label>
        <input name="date_of_birth" type="date" value="{{ $student->date_of_birth->format('Y-m-d') }}" />
        <br />
        <button>Edit</button>
    </form>
</x-layout>