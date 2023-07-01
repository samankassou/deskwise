<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('direction:id,name')->get(['id', 'name', 'slug', 'direction_id']);

        return response()->json($departments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(['name' => 'required|unique:departments', 'direction_id' => 'required']);
        $department = Department::create($validatedData);
        return $this->sendResponse($department, 'Department created succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load('direction');
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validatedData = $request->validate(['name' => 'required|unique:departments,name,' . $department->id, 'direction_id' => 'required']);
        $department->update($validatedData);
        return response()->json($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json();
    }
}
