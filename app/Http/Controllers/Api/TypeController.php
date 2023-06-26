<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $types = QueryBuilder::for(Type::class)
            ->allowedFilters(['name'])
            ->allowedSorts('name')
            ->paginate($request->get('perPage', 15));

        return $this->sendResponse($types, 'Equipments types retrieved succesfully!');
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
    public function show(Type $type)
    {
        return response()->json($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $validatedData = $request->validate(['name' => 'required|unique:types,name,' . $type->id]);
        $type->update($validatedData);
        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return response()->json([]);
    }
}
