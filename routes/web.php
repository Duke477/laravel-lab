<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Models\Student;
/*
|--------------------------------------------------------------------------
| ROUTES  — the front door of a Laravel app
|--------------------------------------------------------------------------
| Every request (URL + HTTP verb) is matched against this list.
| The first route that matches decides who handles it:
|   - a closure (small function written right here), or
|   - a controller method   [SomeController::class, 'method']
|
| See every route:   php artisan route:list
*/

// Lesson 1: the home page. A closure that returns a view (resources/views/home.blade.php).
Route::get('/', function () {
    return view('home');
});

// Lessons 2-6: you will add your routes below this line.

use App\Http\Controllers\PageController;

Route::get('/hello/{your_name}', function ($your_name) {
    return 'Hello, ' . htmlspecialchars($your_name, ENT_QUOTES, 'UTF-8');
});

Route::get('/about', [PageController::class, 'about']);
Route::resource('students', StudentController::class);
Route::get('/roll/{your_roll}', function (Student $student) {
    return view('students.show', ['student' => $student]);
});
Route::get('/api/students', function () {
    return response()->json(Student::all());
});
