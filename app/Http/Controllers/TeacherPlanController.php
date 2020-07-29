<?php

namespace App\Http\Controllers;

use App\TeachersPlans;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherPlanCollection;

class TeacherPlanController extends Controller
{
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
        ]);

        $teacherplan = TeachersPlans::create($validatedData);
        return response()->json(new TeachersPlansResource ($teacherplan), 201);
    }

    public function update (Request $request, TeachersPlans $teacherplan)
    {
        $teacherplan->update($request->all());
        return response()->json($teacherplan, 200);
    }

    public function delete (TeachersPlans $teacherplan)
    {
        $teacherplan->delete();
        return response()->json(null, 204);
    }
}
