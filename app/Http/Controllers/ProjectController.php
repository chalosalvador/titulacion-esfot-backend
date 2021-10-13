<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use App\Mail\CurriculumSan2;
use App\Mail\NewCommentCommentCommission;
use App\Mail\NewCommentTeacher;
use App\Mail\NewCorrectionDone2;
use App\Mail\NewCorrectionOnPdfStudent;
use App\Mail\NewCorrectionStudent;
use App\Mail\NewCorrectionStudentPdf;
use App\Mail\NewDateAssigned;
use App\Mail\NewPdfUpload;
use App\Mail\NewPlanUploadCommission;
use App\Mail\NewProjectStudent;
use App\Mail\NewProjectUploadTeacher;
use App\Mail\PdfApprovedByDirector;
use App\Mail\PlanApprovedByComission;
use App\Mail\PlanApprovedByDirector;
use App\Mail\PlanSentToSecretary;
use App\Mail\ProjectApprovedSend;
use App\Mail\ProjectRejected;
use App\Mail\TestDefenseApt;
use App\Mail\TribunalAssigned;
use App\Mail\TribunalAssignedTeacher;
use App\Models\Project;
use App\Models\Student;
use App\Models\Career;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\TeacherCollection;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\PDF;
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
        return response()->file(public_path($project->schedule));
    }

    public function getProjectPDFFile(Project $project)
    {
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
        $path_image = $request->schedule->store('public/schedules');
        $project->schedule = $path_image;
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

        if ($request->schedule) {
            $this->updateSchedule($request, $project);
        }

        return response()->json($project, 200);
    }

    public function updateSchedule($request, $project)
    {
        $user = Auth::user();
        $student_id = $user->userable->id;
        $fileNameToStore = "schedule.jpg";
        $request->schedule->storeAs("public/schedule/{$student_id}", $fileNameToStore);
        $project->schedule = "storage/schedule/{$student_id}/{$fileNameToStore}";
        $project->save();
    }

    public function planSent(Project $project)
    {
        $mail = new NewProjectStudent($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        $secondMail = new NewProjectUploadTeacher($project);
        return $this->changeStatus($project->id, $mail, $students, "plan_sent", "plan_saved", $secondMail, $project->teacher->user);
    }

    public function planReviewTeacher(Project $project)
    {
        $mail = new NewCommentTeacher($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_review_teacher", ["plan_sent", "plan_corrections_done"]);
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
        set_time_limit(300);
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        Mail::to($students)->send(new PlanSentToSecretary($project));
        return $this->changeStatus($project->id, $mail, $students, "plan_approved_director", ["plan_corrections_done","plan_sent"]);
    }

    public function sanCurriculum1(Project $project, Request $request)
    {
        $mail = new NewPlanUploadCommission($project);
        $career = Career::find($project->teacher->career_id);
        $commission = $career->commission;
        $commissionMembers = new TeacherCollection($commission->teachers);
        $teachers = [];
        foreach ($commissionMembers as $teacher) {
            $teachers[] = $teacher->user;
        }

        return $this->changeStatus($project->id, $mail, $teachers, "san_curriculum_1", "plan_approved_director");
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
        $mail = new NewCorrectionDone2($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "plan_corrections_done2", "plan_review_commission");
    }

    public function planApprovedCommission(Project $project)
    {
        $mail = new PlanApprovedByComission($project);
        $students[] = Auth::user();
        $count = $project->plan_approved_commission;
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        if ($project->plan_approved_commission < 2) {
            $project->plan_approved_commission = $count + 1;
            $project->save();
            return response()->json(["message" => "plan_approved_by_" . $project->plan_approved_commission . "_members"]);
        } else {
            return $this->changeStatus($project->id, $mail, $students, "plan_approved_commission", ["plan_corrections_done2", "san_curriculum_1"]);
        }
    }

    public function planRejected(Project $project)
    {
        $mail = new ProjectRejected($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "plan_rejected", "plan_corrections_done2");
    }

    public function projectUploaded(Project $project)
    {
        $mail = new NewPdfUpload($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "project_uploaded", "plan_approved_commission");
    }

    public function projectReviewTeacher(Project $project)
    {
        $mail = new NewCorrectionOnPdfStudent($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_review_teacher", ["project_uploaded", "project_corrections_done"]);
    }

    public function projectCorrectionsDone(Project $project)
    {
        $mail = new NewCorrectionStudentPdf($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "project_corrections_done", "project_review_teacher");
    }

    public function projectApprovedDirector(Project $project)
    {
        $mail = new PdfApprovedByDirector($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_approved_director", ["project_corrections_done", "project_uploaded"]);
    }

    public function sanCurriculum2(Project $project)
    {
        $mail = new CurriculumSan2($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "san_curriculum_2", "project_approved_director");
    }

    public function tribunalAssigned(Project $project)
    {
        $mail = new TribunalAssigned($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        $secondMail = new TribunalAssignedTeacher($project);
        return $this->changeStatus($project->id, $mail, $students, "tribunal_assigned", "san_curriculum_2", $secondMail, $project->teacher->user);
    }

    public function projectGraded(Project $project)
    {
        $mail = new TribunalAssigned($project); //TODO cambiar a correo de projecto calificado
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_graded", "tribunal_assigned");
    }

    public function projectCorrectionsDone2(Project $project)
    {
        $mail = new NewCorrectionStudentPdf($project);
        return $this->changeStatus($project->id, $mail, $project->teacher->user, "project_corrections_done_2", "project_graded");
    }

    public function projectApprovedSend(Project $project)
    {
        $mail = new ProjectApprovedSend($project);;
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "project_approved_send", "project_corrections_done_2");
    }

    public function testDefenseApt(Project $project)
    {
        $mail = new TestDefenseApt($project);
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "test_defense_apt", "project_approved_send");
    }


    public function dateDefenseAssigned(Project $project)
    {
        $mail = new NewDateAssigned($project); //TODO cambiar la estructura del correo
        $students[] = Auth::user();
        if ($project->student_id_2 !== null) {
            $students[] = Student::find($project->student_id_2)->user;
        }
        return $this->changeStatus($project->id, $mail, $students, "date_defense_assigned", "test_defense_apt");
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

    private function changeStatus($project_id, $mail, $mailTo, $newStatus, $prevStatus, $secondMail = null, $secondMailTo = null)
    {
        $project = Project::find($project_id);
        if (is_array($prevStatus)) {
            $canUpdate = in_array($project->status, $prevStatus);
        } else {
            $canUpdate = $project->status === $prevStatus;
        }

        if ($canUpdate) {
//            $project->update(["status"=>$newStatus]);
            $project->status = $newStatus;
            $project->save();
            Mail::to($mailTo)->send($mail);
            if ($secondMail && $secondMailTo !== null) {
                Mail::to($secondMailTo)->send($secondMail);
            }
            return response()->json(["message" => "status_changed"], 200);

        }

        return response()->json(["error" => "incorrect_status"], 500);
    }
}
