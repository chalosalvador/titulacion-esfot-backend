<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Http\Resources\Commission as CommissionResource;
use App\Http\Resources\CommissionCollection;
use App\Models\Teacher;

class CommissionController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'career_id.unique' => 'La comisión para esta carrera ya existe.',
    ];

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
        $request->validate([
            'career_id' => 'required|unique:careers,id',
//            'members' => 'required|exists:teachers,id',
        ], self::$messages);
        $commissions= new Commission($request->except(['members']));
        $commissions->save();
        foreach ($request->members as $member){
            $teacher_commission = Teacher::find($member);
            $teacher_commission->commission()->associate($commissions);
            $teacher_commission->save();
        }
        return response()->json(new CommissionResource($commissions), 201);
    }
    public function update(Commission $commissions,Request $request)
    {
        $commissions->update($request->except(["members", "career_id"]));
        $commissions->teachers()->update($request->members);
        $commissions->career()->update($request->career_id);
        $commissions->save();
        return response()->json(new CommissionResource($commissions), 200);
    }
}
