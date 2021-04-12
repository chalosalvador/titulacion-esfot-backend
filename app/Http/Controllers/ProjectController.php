<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use App\Mail\NewCommentCommentCommission;
use App\Mail\NewCommentTeacher;
use App\Mail\NewCorrectionStudent;
use App\Mail\NewPdfUpload;
use App\Mail\NewPlanUploadCommission;
use App\Mail\NewProjectStudent;
use App\Mail\NewProjectUploadTeacher;
use App\Mail\PlanApprovedByDirector;
use App\Models\Project;
use App\Models\Student;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
            'schedule' => 'nullable',
            'student_id_2' => 'nullable|exists:users,id'
        ], self::$messages);

        $project = new Project($request->except(['student_id_2']));

        $user = Auth::user();
        $students[] = Auth::user();
        $project->save();
        if ($request->student_id_2 !== null) {
            $project->students()->sync([$user->userable->id, $request->student_id_2]);
            $students[] = Student::find($request->student_id_2)->user;
        } else {
            $project->students()->sync([$user->userable->id]);
        }

        if ($request->status === 'plan_sent') {
            Mail::to($project->teacher->user)->send(new NewProjectUploadTeacher($project));
            Mail::to($students)->send(new NewProjectStudent($project));
        }


        return response()->json(new ProjectResource($project), 201);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        $request->validate([
            'title' => 'string|unique:projects,title,' . $project->id . '|max:255',
        ], self::$messages);

        $students[] = Auth::user();
        $project->update($request->all());

        if ($request->student_id_2 !== null) {
            $students[] = Student::find($request->student_id_2)->user;
        }
        if ($request->status === 'plan_sent') {
            Mail::to($project->teacher->user)->send(new NewProjectUploadTeacher($project));
            Mail::to($students)->send(new NewProjectStudent($project));
        }

        if ($request->status === 'plan_approved_director') {
            Mail::to($students)->send(new PlanApprovedByDirector($project));
        }

        if ($request->status === 'plan_review_teacher') {
            Mail::to($students)->send(new NewCommentTeacher($project));
        }

        if ($request->status === 'plan_corrections_done') {
            Mail::to($project->teacher->user)->send(new NewCorrectionStudent($project));
        }

        if ($request->status === 'plan_review_commission') {
            Mail::to($students)->send(new NewCommentCommentCommission($project));
        }

        if ($request->status === 'san_curriculum_1') {
            if ($project->teacher->committee === 1) {
                Mail::to($project->teacher->user)->send(new NewPlanUploadCommission($project));
            }
        }

        if ($request->status === 'project_uploaded') {
            Mail::to($project->teacher->user)->send(new NewPdfUpload($project));
        }

        return response()->json($project, 200);

    }

    public function updatePdf(Request $request, Project $project){
        $user = Auth::user();
        $date = new DateTime();
        $student_id = $user->userable->id;
        $fileNameToStore = "project.pdf";
        $pathPdf = $request->report_pdf->storeAs("public/reports/{$student_id}", $fileNameToStore);
        $project->report_pdf = $pathPdf;
        $project->update(["report_pdf"=>$pathPdf, "status"=>"project_uploaded", "report_uploaded_at"=> $date->getTimestamp()]);

        return response()->json($project, 200);
    }

    public function delete(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}
