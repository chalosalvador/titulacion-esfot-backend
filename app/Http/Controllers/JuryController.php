<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherCollection;
use App\Mail\NewDateAssignedJury;
use App\Mail\NewJuryAssigned;
use App\Mail\NewProjectUploadTeacher;
use App\Mail\ProjectGradedJury;
use App\Models\Jury;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\Jury as JuryResource;
use App\Http\Resources\JuryCollection;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JuryController extends Controller
{
    public function index()
    {
        return new JuryCollection(Jury::all());
    }

    public function show(Jury $juries)
    {
        return response()->json(new JuryResource($juries));
    }

    public function store(Request $request)
    {
        $juries = new Jury($request->except(['members']));
        $juries->save();
        $juries->teachers()->sync($request->members);
        $teachers=[];
        foreach ($request->members as $teacherId){
            $teachers[] = Teacher::find($teacherId)->user;
        }
        Mail::to($teachers)->send(new NewJuryAssigned($juries));

        return response()->json($juries, 201);

    }

    public function update(Request $request, Jury $juries)
    {
        $juries->update($request->all());
        return response()->json($juries, 200);
    }

    public function changeTribunalSchedule(Request $request)
    {
        $jury = Jury::where("project_id",$request->project_id)->first();
        $teachers=[];
        $jury->update(["tribunalSchedule" => $request->tribunalSchedule]);
        $jury->save();
        foreach ($jury->teachers as $teacher)
        {
            $teachers[]=Teacher::find($teacher->id)->user;
        }
        Mail::to($teachers)->send(new NewDateAssignedJury($jury));
        return response()->json(["message" => "schedule saved"]);
    }

    public function juriesTeachers(Project $project)
    {
        $jury = Jury::where("project_id",$project->id)->first();
        return new TeacherCollection($jury->teachers);
    }

}
