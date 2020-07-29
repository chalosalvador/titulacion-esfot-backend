<?php

namespace App\Http\Controllers;

use App\TeachersPlans;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherPlanCollection;

class TeacherPlanController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'title.unique' => 'El títula ya existe, por favor agregue otro.',

    ];
    public function index()
    {
        return new TeacherPlanCollection(TeachersPlans::all());
    }

    public function show (TeachersPlans $teacherplan)
    {
        return $teacherplan;
    }

    public function store (Request $request)
    {
        $validatedData= $request->validate([
           'title' => 'required|string|unique:teachersplans|max:255',
           'problem' => 'require',
           'solution' => 'require'
        ],self::$messages);

        $teacherplan = TeachersPlans::create($validatedData);
        return response()->json(new TeachersPlansResource ($teacherplan), 201);
    }

    public function update (Request $request, TeachersPlans $teacherplan)
    {

        $request->validate([
            'title' => 'required|string|unique:teachersplans,title,'.$teacherplan->id.'|max:255',
            'problem' => 'require',
            'solution' => 'require'
        ],self::$messages);

        $teacherplan->update($request->all());
        return response()->json($teacherplan, 200);
    }

    public function delete (TeachersPlans $teacherplan)
    {
        $teacherplan->delete();
        return response()->json(null, 204);
    }
}
