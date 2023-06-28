<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $types = Type::all(['id', 'name', 'slug']);

        return response()->json($types);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(['name' => 'required|unique:types']);
        $type = Type::create($validatedData);
        return $this->sendResponse($type, 'Type created succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $equipment_type)
    {
        return response()->json($equipment_type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $equipment_type)
    {
        $validatedData = $request->validate(['name' => 'required|unique:types,name,' . $equipment_typetype->id]);
        $equipment_type->update($validatedData);
        return response()->json($equipment_type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $equipment_type)
    {
        $equipment_type->delete();
        return response()->json($equipment_type);
    }
}
