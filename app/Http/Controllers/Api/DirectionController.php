<?php

namespace App\Http\Controllers\Api;

use App\Models\Direction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DirectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $directions = Direction::all(['id', 'name', 'slug']);

        return response()->json($directions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(['name' => 'required|unique:directions']);
        $direction = Direction::create($validatedData);
        return $this->sendResponse($direction, 'Direction created succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        return response()->json($direction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Direction $direction)
    {
        $validatedData = $request->validate(['name' => 'required|unique:directions,name,' . $direction->id]);
        $direction->update($validatedData);
        return response()->json($direction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction)
    {
        $direction->delete();
        return response()->json();
    }
}
