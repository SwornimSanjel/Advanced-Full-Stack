<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
</head>
<body>

<h1>Create Course</h1>

@if($errors->any())
    <div>
        <h3>Please fix the following errors:</h3>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/courses" method="POST">
    @csrf

    <div>
        <label for="name">Course Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
        >
    </div>

    <br>

    <div>
        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
        >{{ old('description') }}</textarea>
    </div>

    <br>

    <div>
        <label for="duration">Duration (weeks)</label>
        <input
            type="number"
            id="duration"
            name="duration"
            value="{{ old('duration') }}"
        >
    </div>

    <br>

    <div>
        <label for="fee">Fee</label>
        <input
            type="number"
            step="0.01"
            id="fee"
            name="fee"
            value="{{ old('fee') }}"
        >
    </div>

    <br>

    <div>
        <label for="difficulty">Difficulty</label>

        <select
            id="difficulty"
            name="difficulty"
        >
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
        </select>
    </div>

    <br>

    <div>
        <label>
            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active') ? 'checked' : '' }}
            >
            Active
        </label>
    </div>

    <br>

    <button type="submit">
        Create Course
    </button>
</form>

<br>

<a href="/courses">
    Back to Courses
</a>

</body>
</html>