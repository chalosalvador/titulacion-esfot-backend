<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPlanController;
use App\Http\Controllers\UserController;
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
    Route::get('project/getPDF/{project}', [ProjectController::class,'getProjectPDF']);
    Route::post('students/projects', [ProjectController::class, 'store']);
    Route::post('projects/{project}', [ProjectController::class, 'update']);
    Route::post('projects/{project}/pdf', [ProjectController::class, 'updatePdf']);
    Route::delete('projects/{project}', [ProjectController::class, 'delete']);


//student
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/project', [StudentController::class, 'show']);
    Route::put('students/{student}', [StudentController::class, 'update']);
    Route::delete('students/{student}', [StudentController::class, 'delete']);

    Route::get('students/view-projects', [StudentController::class, 'project']);

//project cronogram

//teacher
    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('teacher-projects', [TeacherController::class, 'show']);
    Route::put('teachers/{teacher}', [TeacherController::class, 'update']);
    Route::delete('teachers/{teacher}', [TeacherController::class, 'delete']);
    Route::get('teachers/projects', [TeacherController::class, 'projects']);
    Route::get('teachers/{teacher}/projects/{project}', [TeacherController::class, 'project']);


});
//});
