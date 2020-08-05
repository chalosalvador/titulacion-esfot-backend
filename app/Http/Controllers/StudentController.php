<?php

namespace App\Http\Controllers;

use App\Project;
use App\Students;
use Illuminate\Http\Request;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;

class StudentController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',

    ];

    public function index()
    {
        return new StudentCollection(Students::paginate());
    }

    public function show(Students $student)
    {
        return response()->json(new StudentResource($student), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'apto' => 'required'
        ], self::$messages);

        $student = Students::create($validatedData);
        return response()->json(new StudentResource($student), 201);
    }

    public function update(Request $request, Students $student)
    {
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function projects(Project $project)
    {
        $projects = $project->students;
        return response()->json(StudentResource::collection($projects), 200);
    }

    public function project(Students $student, Project $projects)
    {
        $project = $student->projects()->where('id', $projects->id)->findOrFail();
        return response()->json($project, 200);
    }

    public function delete(Students $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
