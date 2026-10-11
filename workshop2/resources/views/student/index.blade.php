<x-layout title="Student List">
    <h1>Students</h1>

    @if (session('success'))
    <div>{{ session('success') }}</div>
    @endif
    <a href="/students/create">Create New Student</a>

    @if ($students->isNotEmpty())
    <table>
        <th>
        <td>Id</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Address</td>
        <td>Age</td>
        <td>Action</td>
        </th>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->age }}</td>
            <td>
                <form action="students/{{ $student->id }}" method="POST">
                    @method("DELETE")
                    @csrf()
                    <button>Delete</button>
                </form>
                <a role="button" href="students/{{ $student->id }}/edit">
                    Edit
                </a>
                <a role="button" href="students/{{ $student->id }}">
                    Details
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <h2>No student record available</h2>
    @endif
</x-layout>