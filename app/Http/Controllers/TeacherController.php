<?php

namespace App\Http\Controllers;

use App\Teachers;
use App\Project;
use App\TeachersPlans;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\TeacherPlan as TeacherPlanResource;
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

    public function projects(Teachers $teacher)
    {
        return response()->json(ProjectResource::collection($teacher->projects), 200);
    }

    public function project(Teachers $teacher, Project $project)
    {
        $projects = $teacher->projects()->where('id',$project->id)->firstOrFail();
        return response()->json(new ProjectResource($projects),200);
    }


    public function delete(Teachers $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }
}
