<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Http\Resources\Commission as CommissionResource;
use App\Http\Resources\CommissionCollection;
use App\Models\Teacher;

class CommissionController extends Controller
{
    public function index()
    {
        return new CommissionCollection(Commission::all());
    }

    public function show(Commission $commissions)
    {
        return response()->json(new CommissionResource($commissions),200);
    }
    public function store(Request $request)
    {
        $commissions= new Commission($request->except(['members']));
        $commissions->save();
        foreach ($request->members as $member){
            $teacher_commission = Teacher::find($member);
            $teacher_commission->commission()->associate($commissions);
            $teacher_commission->save();
//            $commissions->teachers()->saveMany($request->members);
        }
        return response()->json(new CommissionResource($commissions), 201);
    }
    public function update(Request $request, Commission $commissions)
    {
        $commissions->update($request->all());
        return response()->json(new CommissionResource($commissions), 200);
    }
}
