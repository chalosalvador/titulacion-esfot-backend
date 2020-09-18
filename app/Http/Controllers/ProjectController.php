<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use App\Mail\NewProjectStudent;
use App\Mail\NewProjectUploadTeacher;
use App\Project;
use App\Student;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use const Grpc\STATUS_OUT_OF_RANGE;

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
//        $this->authorize('view', $project);
        return response()->json(new ProjectResource($project), 200);
    }

    public function cronogram(Project $project)
    {
        return response()->download(public_path(Storage::url($project->schedule)), $project->title);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
        $request->validate([
            'title' => 'string|unique:projects|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'schedule' => 'image',
            'student_id_2' => 'nullable|exists:users,id'
        ], self::$messages);

        $project = new Project($request->except(['student_id_2']));
        $students[] = Auth::user();
        $project->save();
        if($request->student_id_2 !== null){
            $project->students()->sync([Auth::id(), $request->student_id_2]);
            $students[] = Student::find( $request->student_id_2)->user;
        }else {
            $project->students()->sync([Auth::id()]);
        }


        Mail::to($project->teacher->user)->send(new NewProjectUploadTeacher($project));
        Mail::to($students)->send(new NewProjectStudent($project));
        return response()->json(new ProjectResource($project), 201);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
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
