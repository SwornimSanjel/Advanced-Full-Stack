<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});


// =========================
// GUEST ROUTES
// =========================

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister']);

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login']);

});


// =========================
// PROTECTED ROUTES
// =========================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);


    // =========================
    // STUDENT ROUTES
    // =========================

    Route::resource("students", StudentController::class);


    // =========================
    // COURSE ROUTES
    // =========================

    Route::get('/courses', [CourseController::class, 'index']);

    Route::get('/courses/create', [CourseController::class, 'create']);

    Route::post('/courses', [CourseController::class, 'store']);

    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/courses/{id}/edit', [CourseController::class, 'edit']);

    Route::put('/courses/{id}', [CourseController::class, 'update']);

    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

});
