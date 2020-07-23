<?php

namespace App\Http\Controllers;

use App\Teachers;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherCollection;

class TeacherController extends Controller
{
    public function index()
    {
        return new TeacherCollection(Teachers::all());
    }

    public function show (Teachers $teacher)
    {
        return $teacher;
    }

    public function store (Request $request)
    {
        $teacher = Teachers::create($request->all());
        return response()->json($teacher, 201);
    }

    public function update (Request $request, Teachers $teacher)
    {
        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function delete (Teachers $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }
}
