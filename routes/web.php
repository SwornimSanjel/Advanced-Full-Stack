<?php

use Illuminate\Support\Facades\Route;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("students", StudentController::class);

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
