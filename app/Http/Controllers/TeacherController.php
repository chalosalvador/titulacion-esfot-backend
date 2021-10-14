<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\TeacherPlan as TeacherPlanResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\TeacherCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return response()->json(new ProjectCollection($teacher->projects), 200);
    }

    public function store(Request $request)
    {
        $password = Hash::make('123456');
        $teacher = Teacher::create([
            'titular'=> "1",
            "career_id"=> $request->career_id,
            "schedule" => $request->schedule
        ]);
        $teacher->user()->create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $password,
            'role' => User::ROLE_TEACHER
        ]);
        return response()->json(new TeacherResource($teacher), 201);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->except(["email", "name", "last_name"]));
        $teacher->user()->update($request->except(['career_id','schedule']));

        return response()->json(new TeacherPlanResource($teacher), 200);
    }

    public function projects()
    {
        $user=Auth::user();
        $teacher = $user->userable;
        return response()->json(new ProjectCollection($teacher->projects), 200);
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
