<?php

namespace App\Http\Controllers;

use App\Project;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;

class StudentController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',

    ];

    public function index()
    {
        return new StudentCollection(Student::paginate());
    }

    public function show(Student $student)
    {
        return response()->json(new StudentResource($student), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'apto' => 'required'
        ], self::$messages);

        $student = Student::create($validatedData);
        return response()->json(new StudentResource($student), 201);
    }

    public function update(Request $request, Student $student)
    {
        $this->authorize('update', $student);
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function projects(Student $student)
    {
        $this->authorize('view', $student);
        $projects = $student->projects;
        return response()->json(ProjectResource::collection($projects), 200);

    }

    public function project(Student $student, Project $project)
    {
        $this->authorize('view', $student);
        $projects = $student->projects()->where('id', $project->id)->firstOrFail();
        return response()->json($projects, 200);
    }

    public function delete(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
