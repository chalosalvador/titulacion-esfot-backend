<?php

namespace App\Http\Controllers;

use App\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Students::all();
    }

    public function show (Students $student)
    {
        return $student;
    }

    public function store (Request $request)
    {
        $student = Students::create($request->all());
        return response()->json($student, 201);
    }

    public function update (Request $request, Students $student)
    {
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function delete (Students $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
