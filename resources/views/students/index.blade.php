
@extends('layout')

@section('title', 'Students List')

@section('content')
    <h2>Students List</h2>

    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    <p><a href="{{ route('students.create') }}">Add New Student</a></p>

    @forelse ($students as $student)
        <div>
            <strong>{{ $student->name }}</strong>
            — Roll No: {{ $student->roll_no }}
            — CGPA: {{ $student->cgpa }}
            <a href="{{ route('students.show', $student->id) }}">View</a>
        </div>
    @empty
        <p>No students found.</p>
    @endforelse
@endsection
