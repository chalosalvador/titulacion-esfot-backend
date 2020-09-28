<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Project;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',

    ];

    public function index()
    {
        return new StudentCollection(Student::paginate());
    }

    public function show()
    {
        $user=Auth::user();
        return response()->json(ProjectResource::collection($user->userable->projects), 200);
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

    public function project()
    {
        $user=Auth::user();
        return response()->json($user, 200);
    }

    public function delete(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
