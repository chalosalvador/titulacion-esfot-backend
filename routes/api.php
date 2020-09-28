<?php

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


Route::group(['middleware'=>['cors']],function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::get('projects/{project}/cronogram', 'ProjectController@cronogram');
    Route::get('teachers-ideas', 'TeacherPlanController@index');

    Route::group(['middleware' => ['jwt.verify']], function () {
        //users
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::post('logout', 'UserController@logout');
        //teachers plans
        Route::get('teachers-ideas', 'TeacherPlanController@index');
        Route::get('teachers-ideas/{teacherplan}', 'TeacherPlanController@show');
        Route::post('teacher/teachers-ideas', 'TeacherPlanController@store');
        Route::put('teachers-ideas/{teacherplan}', 'TeacherPlanController@update');
        Route::delete('teachers-ideas/{teacherplan}', 'TeacherPlanController@delete');
        Route::get('teacher/{teacher}/ideas', 'TeacherPlanController@ideas');
        Route::get('teacher/{teacher}/ideas/{idea}', 'TeacherPlanController@idea');


//project
        Route::get('projects', 'ProjectController@index');
        Route::get('projects/{project}', 'ProjectController@show');
        Route::post('students/projects', 'ProjectController@store');
        Route::post('projects/{project}', 'ProjectController@update');
        Route::delete('projects/{project}', 'ProjectController@delete');


//student
        Route::get('students', 'StudentController@index');
        Route::get('students/project', 'StudentController@show');
        Route::put('students/{student}', 'StudentController@update');
        Route::delete('students/{student}', 'StudentController@delete');

        Route::get('students/view-projects', 'StudentController@project');

//project cronogram

//teacher
        Route::get('teachers', 'TeacherController@index');
        Route::get('teacher-projects', 'TeacherController@show');
        Route::put('teachers/{teacher}', 'TeacherController@update');
        Route::delete('teachers/{teacher}', 'TeacherController@delete');
        Route::get('teachers/projects', 'TeacherController@projects');
        Route::get('teachers/{teacher}/projects/{project}', 'TeacherController@project');


    });
});
