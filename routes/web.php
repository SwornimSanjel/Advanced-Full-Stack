<?php

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;


// ============================================================
// HOME
// ============================================================

Route::get('/', function () {
    return view('welcome');
});


// ============================================================
// STUDENT ROUTES
// ============================================================


// =========================
// STUDENT LIST
// =========================

Route::get('/students', function () {

    $students = Student::all();

    return view('student.list', [
        'students' => $students
    ]);
});


// =========================
// CREATE STUDENT FORM
// =========================

Route::get('/students/create', function () {
    return view('student.create');
});


// =========================
// STORE STUDENT
// =========================

Route::post('/students', function (Request $request) {

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student = Student::create($validated);

    return redirect('/students')
        ->with(
            'success',
            "Student {$student->name} created successfully!"
        );
});


// =========================
// STUDENT DETAIL
// =========================

Route::get('/students/{id}', function ($id) {

    $student = Student::findOrFail($id);

    return view('student.detail', [
        'student' => $student
    ]);
});


// =========================
// EDIT STUDENT FORM
// =========================

Route::get('/students/{id}/edit', function ($id) {

    $student = Student::findOrFail($id);

    return view('student.edit', [
        'student' => $student
    ]);
});


// =========================
// UPDATE STUDENT
// =========================

Route::put('/students/{id}', function (Request $request, $id) {

    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',

        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('students')->ignore($student->id),
        ],

        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect('/students/' . $student->id)
        ->with(
            'success',
            'Student updated successfully!'
        );
});


// =========================
// DELETE STUDENT
// =========================

Route::delete('/students/{id}', function ($id) {

    $student = Student::findOrFail($id);

    $student->delete();

    return redirect('/students')
        ->with(
            'success',
            'Student deleted successfully!'
        );
});


// ============================================================
// COURSE ROUTES
// ============================================================


// =========================
// COURSE LIST
// =========================

Route::get('/courses', function () {

    $courses = Course::all();

    return view('course.list', [
        'courses' => $courses
    ]);
});


// =========================
// CREATE COURSE FORM
// =========================

Route::get('/courses/create', function () {
    return view('course.create');
});


// =========================
// STORE COURSE
// =========================

Route::post('/courses', function (Request $request) {

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|in:Easy,Medium,Hard',
        'is_active' => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $course = Course::create($validated);

    return redirect('/courses')
        ->with(
            'success',
            "Course {$course->name} created successfully!"
        );
});


// =========================
// COURSE DETAIL
// =========================

Route::get('/courses/{id}', function ($id) {

    $course = Course::findOrFail($id);

    return view('course.detail', [
        'course' => $course
    ]);
});


// =========================
// EDIT COURSE FORM
// =========================

Route::get('/courses/{id}/edit', function ($id) {

    $course = Course::findOrFail($id);

    return view('course.edit', [
        'course' => $course
    ]);
});


// =========================
// UPDATE COURSE
// =========================

Route::put('/courses/{id}', function (Request $request, $id) {

    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|in:Easy,Medium,Hard',
        'is_active' => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $course->update($validated);

    return redirect('/courses/' . $course->id)
        ->with(
            'success',
            'Course updated successfully!'
        );
});


// =========================
// DELETE COURSE
// =========================

Route::delete('/courses/{id}', function ($id) {

    $course = Course::findOrFail($id);

    $course->delete();

    return redirect('/courses')
        ->with(
            'success',
            'Course deleted successfully!'
        );
});