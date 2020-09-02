<?php

namespace App\Http\Controllers;

use App\Teachers;
use App\TeachersPlans;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherPlanCollection;
use App\Http\Resources\TeacherPlan as TeacherPlanResource;

class TeacherPlanController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'title.unique' => 'El título ya existe, por favor agregue otro.',

    ];

    public function index()
    {
        return new TeacherPlanCollection(TeachersPlans::paginate());
    }

    public function show(TeachersPlans $teacherplan)
    {
        return response()->json(new TeacherPlanResource($teacherplan), 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create',TeachersPlans::class);
        $validateData = $request->validate([
            'title' => 'required|string|unique:teachers_plans|max:255',
            'problem' => 'required',
            'solution' => 'required'
        ], self::$messages);


        $idea = TeachersPlans::create($validateData);

        return response()->json(new TeacherPlanResource($idea), 201);
    }

    public function update(Request $request, TeachersPlans $teacherplan)
    {
        $this->authorize('update',$teacherplan);
        $request->validate([
            'title' => 'required|string|unique:teachers_plans,title,' . $teacherplan->id . '|max:255',
            'problem' => 'required',
            'solution' => 'required'
        ], self::$messages);

        $teacherplan->update($request->all());
        return response()->json($teacherplan, 200);
    }

    public function ideas(Teachers $teacher)
    {
        return response()->json(TeacherPlanResource::collection($teacher->ideas),200);
    }

    public function idea(Teachers $teacher, TeachersPlans $idea)
    {
        $this->authorize('view',$idea);
        $ideas = $teacher->ideas()->where('id',$idea->id)->firstOrFail();
        return response()->json(new TeacherPlanResource($ideas),200);
    }

    public function delete(TeachersPlans $teacherplan)
    {
        $teacherplan->delete();
        return response()->json(null, 204);
    }
}
