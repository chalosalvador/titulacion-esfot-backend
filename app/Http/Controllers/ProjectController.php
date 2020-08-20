<?php

namespace App\Http\Controllers;

use App\Project;
use App\Students;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'title.unique' => 'El título ya existe, por favor agregue otro.',

    ];

    public function index()
    {
        return new ProjectCollection(Project::paginate());
    }

    public function show(Project $project)
    {
        return response()->json(new ProjectResource($project), 200);
    }

    public function store(Request $request, Students $students)
    {
        $request->validate([
            'title' => 'required|string|unique:projects|max:255',
            'general_objective' => 'required',
            'specifics_objectives' => 'required',
            'uploaded_at' => 'required',
            'teachers_id' => 'required',
            'cronogram' => 'required',
        ], self::$messages);

        $project = $students->projects()->save(new Project($request->all()));
        return response()->json(new ProjectResource($project), 201);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|unique:projects,title,' . $project->id . '|max:255',
            'general_objective' => 'required',
            'specifics_objectives' => 'required',

        ], self::$messages);
        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function delete(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}
