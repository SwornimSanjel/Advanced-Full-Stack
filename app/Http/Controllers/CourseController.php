<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = $request->user()->role === 'admin'
            ? Course::latest()->get()
            : $request->user()->courses()->latest()->get();

        return view('course.list', [
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $course = $request->user()->courses()->create($validated);

        return redirect('/courses')
            ->with(
                'success',
                "Course {$course->name} created successfully!"
            );
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        return view('course.detail', [
            'course' => $course
        ]);
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        return view('course.edit', [
            'course' => $course
        ]);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

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
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        $course->delete();

        return redirect('/courses')
            ->with(
                'success',
                'Course deleted successfully!'
            );
    }
}