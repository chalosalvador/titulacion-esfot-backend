<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use App\Mail\NewCommentCommentCommission;
use App\Mail\NewCommentTeacher;
use App\Mail\NewCorrectionOnPdfStudent;
use App\Mail\NewCorrectionStudent;
use App\Mail\NewPdfUpload;
use App\Mail\NewPlanUploadCommission;
use App\Mail\NewProjectStudent;
use App\Mail\NewProjectUploadTeacher;
use App\Mail\PdfApprovedByDirector;
use App\Mail\PlanApprovedByDirector;
use App\Models\Project;
use App\Models\Student;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use DateTime;
use Dompdf\Exception;
use http\Env\Response;
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
        if ($this->changeStatus($project->id, $mail, $students, "plan_sent", "plan_saved")) {
            //Mail::to($project->teacher->user)->send(new NewProjectUploadTeacher($project));
            return response()->json(["message" => "status_changed"], 200);
        }

        return response()->json(["error" => "incorrect_status"], 500);

    }

    public function planReviewTeacher(Project $project)
    {
        $mail = new NewCommentTeacher($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "plan_review_teacher", "plan_sent")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);

    }

    public function planCorrectionsDone(Project $project)
    {
        $mail = new NewCorrectionStudent($project);

        if ($this->changeStatus($project->id, $mail, $project->teacher->user, "plan_corrections_done", "plan_review_teacher")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function planApprovedDirector(Project $project)
    {
        $mail = new PlanApprovedByDirector($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "plan_approved_director", "plan_corrections_done")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function sanCurriculum1(Project $project)
    {
        $mail = new NewPlanUploadCommission($project);
        if ($this->changeStatus($project->id, $mail, $project->teacher->user, "san_curriculum_1", "plan_approved_director")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function planReviewCommission(Project $project)
    {
        $mail = new NewCommentCommentCommission($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }

        if ($this->changeStatus($project->id, $mail, $students, "plan_review_commission", "san_curriculum_1")) {
            return response()->json(["message" => "status_changed"], 200);
        }


        return response()->json(["error" => "incorrect_status"], 500);

    }

    public function planCorrectionsDone2(Project $project)
    {
        $mail = new NewCorrectionStudent($project); // TODO cambiar la estructura del correo
        if ($this->changeStatus($project->id, $mail, $project->teacher->user, "plan_corrections_done2", "plan_review_commission")) {
            return response()->json(["message" => "status_changed"], 200);
        }

        return response()->json(["error" => "incorrect_status"], 500);

    }

    public function planApprovedCommission(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "plan_approved_commission", "plan_corrections_done2")) {
            return response()->json(["message" => "status_changed"], 200);
        }

        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function projectUploaded(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        if ($this->changeStatus($project->id, $mail, $project->teacher->user, "project_uploaded", "plan_approved_commission")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function projectReviewTeacher(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "project_review_teacher", "project_uploaded")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function projectCorrectionsDone(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        if ($this->changeStatus($project->id, $mail, $project->teacher->user, "project_corrections_done", "project_review_teacher")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function projectApprovedDirector(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "project_approved_director", "project_corrections_done")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function sanCurriculum2(Project $project)
    {
        $mail = new NewPlanUploadCommission($project); // TODO cambiar la estructura del correo
        if ($this->changeStatus($project->id, $mail, $project->teacher->user, "san_curriculum_2", "project_approved_director")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function testDefenseApt(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "test_defense_apt", "san_curriculum_2")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function tribunalAssigned(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "tribunal_assigned", "test_defense_apt")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function dateDefenseAssigned(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "date_defense_assigned", "tribunal_assigned")) {
            return response()->json(["message" => "status_changed"], 200);

        }
        return response()->json(["error" => "incorrect_status"], 500);
    }

    public function projectGraded(Project $project)
    {
        $mail = new NewCorrectionStudent($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($this->changeStatus($project->id, $mail, $students, "project_approved_director", "project_corrections_done")) {
            return response()->json(["message" => "status_changed"], 200);
        }
        return response()->json(["error" => "incorrect_status"], 500);
    }


    public function updatePdf(Request $request, Project $project)
    {
        $user = Auth::user();
        $date = new DateTime();
        $student_id = $user->userable->id;
        $fileNameToStore = "project.pdf";
        $pathPdf = $request->report_pdf->storeAs("public/reports/{$student_id}", $fileNameToStore);
        $project->report_pdf = $pathPdf;
        $project->update(["report_pdf" => $pathPdf, "status" => "project_uploaded", "report_uploaded_at" => $date->getTimestamp()]);

        Mail::to($project->teacher->user)->send(new NewPdfUpload($project));

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
            return true;
        }
        return false;
    }
}
