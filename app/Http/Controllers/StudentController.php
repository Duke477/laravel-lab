<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'roll_no' => 'required|string|max:255|unique:students,roll_no',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
            'cgpa' => 'required|numeric|min:0|max:10',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('status', 'Student saved successfully!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'roll_no' => 'required|string|max:255|unique:students,roll_no,' . $student->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
            'cgpa' => 'required|numeric|min:0|max:10',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('status', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('status', 'Student deleted successfully!');
    }
}
