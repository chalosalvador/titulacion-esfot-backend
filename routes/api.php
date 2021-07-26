<?php

use App\Http\Controllers\JuryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CareerController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::group(['middleware' => ['cors']], function () {
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);
Route::get('projects/{project}/cronogram', [ProjectController::class, 'cronogram']);
Route::get('teachers-ideas', [TeacherPlanController::class, 'index']);

Route::group(['middleware' => ['jwt.verify']], function () {
    //users
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    Route::post('logout', [UserController::class, 'logout']);
    //teachers plans
    Route::get('teachers-ideas', [TeacherPlanController::class, 'index']);
    Route::get('teachers-ideas/{teacherplan}', [TeacherPlanController::class, 'show']);
    Route::post('teacher/teachers-ideas', [TeacherPlanController::class, 'store']);
    Route::put('teachers-ideas/{teacherplan}', [TeacherPlanController::class, 'update']);
    Route::delete('teachers-ideas/{teacherplan}', [TeacherPlanController::class, 'delete']);
    Route::get('teacher/ideas', [TeacherPlanController::class, 'ideas']);
    Route::get('teacher/{teacher}/ideas/{idea}', [TeacherPlanController::class, 'idea']);


//project
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/{project}', [ProjectController::class, 'show']);
    Route::get('project/getPDF/{project}', [ProjectController::class,'getProjectPDFFile']);
    Route::post('students/projects', [ProjectController::class, 'store']);
    Route::post('projects/{project}', [ProjectController::class, 'update']);
    Route::post('projects/{project}/plan-sent',[ProjectController::class, 'planSent']);
    Route::post('projects/{project}/pdf', [ProjectController::class, 'updatePdf']);
    Route::delete('projects/{project}', [ProjectController::class, 'delete']);
    Route::post('projects/{project}/plan-review-teacher',[ProjectController::class, 'planReviewTeacher']);
    Route::post('projects/{project}/plan-corrections-done',[ProjectController::class, 'planCorrectionsDone']);
    Route::post('projects/{project}/plan-approved-director',[ProjectController::class, 'planApprovedDirector']);
    Route::post('projects/{project}/san-curriculum-1',[ProjectController::class, 'sanCurriculum1']);
    Route::post('projects/{project}/plan-review-commission',[ProjectController::class, 'planReviewCommission']);
    Route::post('projects/{project}/plan-corrections-done-2',[ProjectController::class, 'planCorrectionsDone2']);
    Route::post('projects/{project}/plan-approved-commission',[ProjectController::class, 'planApprovedCommission']);
    Route::post('projects/{project}/plan-rejected',[ProjectController::class, 'planRejected']);
    Route::post('projects/{project}/project-uploaded',[ProjectController::class, 'projectUploaded']);
    Route::post('projects/{project}/project-review-teacher',[ProjectController::class, 'projectReviewTeacher']);
    Route::post('projects/{project}/project-corrections-done',[ProjectController::class, 'projectCorrectionsDone']);
    Route::post('projects/{project}/project-approved-director',[ProjectController::class, 'projectApprovedDirector']);
    Route::post('projects/{project}/san-curriculum-2',[ProjectController::class, 'sanCurriculum2']);
    Route::post('projects/{project}/test-defense-apt',[ProjectController::class, 'testDefenseApt']);
    Route::post('projects/{project}/tribunal-assigned',[ProjectController::class, 'tribunalAssigned']);
    Route::post('projects/{project}/date-defense-assigned',[ProjectController::class, 'dateDefenseAssigned']);
    Route::post('projects/{project}/project-graded',[ProjectController::class, 'projectGraded']);

//student
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/project', [StudentController::class, 'show']);
    Route::put('students/{student}', [StudentController::class, 'update']);
    Route::delete('students/{student}', [StudentController::class, 'delete']);

    Route::get('students/view-projects', [StudentController::class, 'project']);

//project cronogram
    Route::get('project/getSchedule/{project}', [ProjectController::class,'cronogram']);

//teacher
    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('teacher-projects', [TeacherController::class, 'show']);
    Route::post('teachers/', [TeacherController::class, 'store']);
    Route::put('teachers/{teacher}', [TeacherController::class, 'update']);
    Route::delete('teachers/{teacher}', [TeacherController::class, 'delete']);
    Route::get('teachers/projects', [TeacherController::class, 'projects']);
    Route::get('teachers/{teacher}/projects/{project}', [TeacherController::class, 'project']);

//commissions
    Route::get('commissions', [CommissionController::class, 'index']);
    Route::get('commissions/{commissions}', [CommissionController::class, 'show']);
    Route::post('commissions/commissions', [CommissionController::class, 'store']);
    Route::post('commissions/{commissions}', [CommissionController::class, 'update']);

//Jury
    Route::get('juries', [JuryController::class, 'index']);
    Route::get('juries/{juries}', [JuryController::class, 'show']);
    Route::post('juries/', [JuryController::class, 'store']);
    Route::post('juries/{juries}', [JuryController::class, 'update']);

//careers
    Route::get('careers', [CareerController::class, 'index']);
    Route::get('careers/{careers}', [CareerController::class, 'show']);
    Route::post('careers/careers', [CareerController::class, 'store']);
    Route::post('careers/{careers}', [CareerController::class, 'update']);
});
//});
