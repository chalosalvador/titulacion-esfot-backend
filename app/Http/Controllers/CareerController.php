<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Careers;

class CareerController extends Controller
{
    public function index()
    {
        return Careers::all();
    }

    public function show (Careers $careers)
    {
        return $careers;
    }
    public function store(Request $request)
    {
        $careers= Careers::create($request->all());
        return response()->json($careers, 201);
    }
    public function update(Request $request, Careers $careers)
    {
        $careers->update($request->all());
        return response()->json($careers, 200);
    }
}
