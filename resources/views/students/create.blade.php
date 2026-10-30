
@extends('layout')

@section('title', 'Add Student')

@section('content')
    <h2>Add New Student</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <p>
            <label>Roll Number:</label>
            <input type="text" name="roll_no" value="{{ old('roll_no') }}" required>
        </p>

        <p>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </p>

        <p>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </p>

        <p>
            <label>Department:</label>
            <input type="text" name="department" value="{{ old('department', 'CSE') }}" required>
        </p>

        <p>
            <label>Semester:</label>
            <input type="number" name="semester" min="1" max="8" value="{{ old('semester', 7) }}" required>
        </p>

        <p>
            <label>CGPA:</label>
            <input type="number" name="cgpa" min="0" max="10" step="0.01" value="{{ old('cgpa') }}" required>
        </p>

        <button type="submit">Save Student</button>
    </form>

    <p><a href="{{ route('students.index') }}">Back to Students List</a></p>
@endsection
