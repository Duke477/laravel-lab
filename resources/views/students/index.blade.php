
@extends('layout')

@section('title', 'Students List')

@section('content')
    <h2>Students List</h2>

    @if (session('status'))
        <p role="status" style="color: green;">{{ session('status') }}</p>
    @elseif (session('success'))
        <p role="status" style="color: green;">{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('students.create') }}">Add New Student</a></p>

    @if ($students->isEmpty())
        <p>No students found.</p>
    @else
        @foreach ($students as $student)
            <div>
                <strong>{{ $student->name }}</strong>
                — Roll No: {{ $student->roll_no }}
                — CGPA: {{ $student->cgpa }}
                <a href="{{ route('students.show', $student->id) }}">View</a>
            </div>
        @endforeach
    @endif
@endsection
