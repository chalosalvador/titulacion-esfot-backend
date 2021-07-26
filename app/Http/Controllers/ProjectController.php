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

    public function getProjectPDFFile(Project $project){
        return response()->file(public_path($project->report_pdf));
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

        $project->update($request->all());


        return response()->json($project, 200);

    }

    public function planSent(Project $project)
    {
        $mail = new NewProjectStudent($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        //Mail::to($project->teacher->user)->send(new NewProjectUploadTeacher($project));
        return $this->changeStatus($project->id, $mail, $students, "plan_sent", "plan_saved");
    }

    public function planReviewTeacher(Project $project)
    {
        $mail = new NewCommentTeacher($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_review_teacher", "plan_sent");
    }

    public function planCorrectionsDone(Project $project)
    {
        $mail = new NewCorrectionStudent($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "plan_corrections_done", "plan_review_teacher");
    }

    public function planApprovedDirector(Project $project)
    {
        $mail = new PlanApprovedByDirector($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_approved_director", "plan_corrections_done");
    }

    public function sanCurriculum1(Project $project)
    {
        $mail = new NewPlanUploadCommission($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "san_curriculum_1", "plan_approved_director");
    }

    public function planReviewCommission(Project $project)
    {
        $mail = new NewCommentCommentCommission($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_review_commission", "san_curriculum_1");
    }

    public function planCorrectionsDone2(Project $project)
    {
        $mail = new NewCorrectionStudent($project); // TODO cambiar la estructura del correo
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "plan_corrections_done2", "plan_review_commission");
    }

    public function planApprovedCommission(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_approved_commission", "plan_corrections_done2");
    }

    public function planRejected(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_rejected", "plan_corrections_done2");
    }

    public function projectUploaded(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "project_uploaded", "plan_approved_commission");
    }

    public function projectReviewTeacher(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_review_teacher", "project_uploaded");
    }

    public function projectCorrectionsDone(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "project_corrections_done", "project_review_teacher");
    }

    public function projectApprovedDirector(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_approved_director", "project_corrections_done");
    }

    public function sanCurriculum2(Project $project)
    {
        $mail = new NewPlanUploadCommission($project); // TODO cambiar la estructura del correo
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "san_curriculum_2", "project_approved_director");
    }

    public function tribunalAssigned(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "tribunal_assigned", "san_curriculum_2");
    }

    public function projectGraded(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_graded", "tribunal_assigned");
    }

    public function testDefenseApt(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "test_defense_apt", "project_graded");
    }


    public function dateDefenseAssigned(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "date_defense_assigned", "tribunal_assigned");
    }



    public function updatePdf(Request $request, Project $project)
    {
        $user = Auth::user();
        $date = new DateTime();
        $student_id = $user->userable->id;
        $fileNameToStore = "project.pdf";
        $request->report_pdf->storeAs("public/reports/{$student_id}", $fileNameToStore);
        $project->report_pdf = "storage/reports/{$student_id}/{$fileNameToStore}";
        $project->save();
        return response()->json($project, 200);
    }

    public function delete(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

    private function changeStatus($project_id, $mail, $mailTo, $newStatus, $prevStatus)
    {
        $project = Project::find($project_id);
        if ($project->status === $prevStatus) {
//            $project->update(["status"=>$newStatus]);
            $project->status = $newStatus;
            $project->save();
//            Mail::to($mailTo)->send($mail);
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }
}
