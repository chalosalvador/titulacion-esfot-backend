<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commissions;

class CommissionController extends Controller
{
    public function index()
    {
        return Commissions::all();
    }

    public function show(Commissions $commissions)
    {
        return $commissions;
    }
    public function store(Request $request)
    {
        $commissions= Commissions::create($request->all());
        return response()->json($commissions, 201);
    }
    public function update(Request $request, Commissions $commissions)
    {
        $commissions->update($request->all());
        return response()->json($commissions, 200);
    }
}
