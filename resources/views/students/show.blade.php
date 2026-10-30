
@extends('layout')

@section('title', 'Student Details')

@section('content')
    <h2>Student Details</h2>

    <p><strong>Roll Number:</strong> {{ $student->roll_no }}</p>
    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Department:</strong> {{ $student->department }}</p>
    <p><strong>Semester:</strong> {{ $student->semester }}</p>
    <p><strong>CGPA:</strong> {{ $student->cgpa }}</p>

    <a href="{{ route('students.index') }}">Back to Students List</a>
@endsection
