<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\TeacherPlan as TeacherPlanResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\TeacherCollection;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        return new TeacherCollection(Teacher::all());
    }

    public function show()
    {
        $user=Auth::user();
        $teacher = $user->userable;
        return response()->json(ProjectResource::collection($teacher->projects), 200);
    }

    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());
        return response()->json(new TeacherResource($teacher), 201);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function projects()
    {
        $user=Auth::user();
        $teacher = $user->userable;
        return response()->json($teacher->projects, 200);
    }

    public function project(Teacher $teacher, Project $project)
    {
        $projects = $teacher->projects()->where('id',$project->id)->firstOrFail();
        return response()->json(new ProjectResource($projects),200);
    }


    public function delete(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }
}
