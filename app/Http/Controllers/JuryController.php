<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\Jury as JuryResource;
use App\Http\Resources\JuryCollection;
use App\Models\Teacher;

class JuryController extends Controller
{
    public function index()
    {
        return new JuryCollection(Jury::all());
    }

    public function show(Jury $juries)
    {
        return response()->json(new JuryResource($juries));
    }

    public function store(Request $request)
    {
        $juries = new Jury($request->except(['members']));
        $juries->save();
        $juries->teachers()->sync($request->members);
        return response()->json($juries, 201);
    }

    public function update(Request $request, Jury $juries)
    {
        $juries->update($request->all());
        return response()->json($juries, 200);
    }

    public function changeTribunalSchedule(Request $request)
    {
        $juries = Jury::all();
        foreach (
            $juries as $jury
        ) {
            if ($jury->project_id === $request->project_id) {
                $jury->update(["tribunalSchedule" => $request->tribunalSchedule]);
                $jury->save();
            }
        }
        return response()->json(["message" => "schedule saved"]);
    }
}
