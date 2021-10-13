<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Http\Resources\Career as CareerResource;
use App\Http\Resources\CareerCollection;


class CareerController extends Controller
{
    public function index()
    {
        return new CareerCollection(Career::all());
    }

    public function show (Career $careers)
    {
        return response()->json(new CareerResource($careers));
    }
    public function store(Request $request)
    {
        $careers= Career::create($request->all());
        return response()->json(new CareerResource($careers), 201);
    }
    public function update(Request $request, Career $careers)
    {
        $careers->update($request->all());
        return response()->json(new CareerResource($careers), 200);
    }
}
