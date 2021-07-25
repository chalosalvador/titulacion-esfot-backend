<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;

class CommissionController extends Controller
{
    public function index()
    {
        return Commission::all();
    }

    public function show(Commission $commissions)
    {
        return $commissions;
    }
    public function store(Request $request)
    {
        $commissions= Commission::create($request->all());
        return response()->json($commissions, 201);
    }
    public function update(Request $request, Commission $commissions)
    {
        $commissions->update($request->all());
        return response()->json($commissions, 200);
    }
}
