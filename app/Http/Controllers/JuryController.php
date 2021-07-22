<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use Illuminate\Http\Request;

class JuryController extends Controller
{
    public function index()
    {
        return Jury::all();
    }

    public function show(Jury $juries)
    {
        return $juries;
    }

    public function store ( Request $request)
    {
        $juries = Jury::create($request->all());
        return response()->json($juries, 201);
    }

    public function update ( Request $request, Jury $juries)
    {
        $juries-> update($request->all());
        return response()->json($juries, 200);
    }
}
