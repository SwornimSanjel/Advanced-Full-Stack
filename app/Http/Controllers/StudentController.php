<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get every row from the students table
        $students = Student::all();

        return view("student.index", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("student.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required|max:100",
            "email" => "required|max:256|email",
            "phone" => "nullable|max:20",
            "address" => "nullable",
            "date_of_birth" => "required|date"
        ]);

        Student::create($validation);

        return redirect()
            ->route("students.index")
            ->with("success", "Student created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view("student.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view("student.edit", compact("student"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validation = $request->validate([
            "name" => "required|max:100",
            "email" => "required|max:256|email",
            "phone" => "nullable|max:20",
            "address" => "nullable",
            "date_of_birth" => "required|date"
        ]);

        $student->update($validation);

        return redirect()
            ->route("students.index")
            ->with("success", "Student Edited Successfully");
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route("students.index")
            ->with("success", "Student Deleted Successfully");
    }
}