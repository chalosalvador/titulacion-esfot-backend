<?php

namespace App\Http\Controllers;

use App\Teachers;
use App\Project;
use App\TeachersPlans;
use Illuminate\Http\Request;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\TeacherCollection;

class TeacherController extends Controller
{
    public function index()
    {
        return new TeacherCollection(Teachers::paginate());
    }

    public function show(Teachers $teacher)
    {
        return response()->json(new TeacherResource($teacher), 200);
    }

    public function store(Request $request)
    {
        $teacher = Teachers::create($request->all());
        return response()->json(new TeacherResource($teacher), 201);
    }

    public function update(Request $request, Teachers $teacher)
    {
        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function projects(Teachers $teachers)
    {
        return response()->json(TeacherResource::collection($teachers->projects), 200);
    }

    public function project(Teachers $teachers, Project $projects)
    {
        $project = $teachers->projects()->where('id',$projects->id)->findOrFail();
        return response()->json($project,200);
    }

    public function ideas(Teachers $teachers)
    {
        return response()->json(TeacherResource::collection($teachers->ideas),200);
    }

    public function idea(Teachers $teacher, TeachersPlans $ideas)
    {
        $idea = $teacher->ideas()->where('id',$ideas->id)->findOrFail();
        return response()->json($idea,200);
    }

    public function delete(Teachers $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }
}
