<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //HTTP methods
    //index, store, show, update, destroy
    //controller
    //index - GET /departments  
    //store - POST /departments
    //show - GET /departments/{id}
    //update - PUT/PATCH /departments/{id}
    //destroy - DELETE /departments/{id}

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $departments = Department::all();
            //select * from departments
            return response()->json($departments);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching departments', 
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
            //validate the request data
            $validatedData = $request->validate([
                'code' => 'required|string|max:100',
                'name' => 'required|string|max:100',
                'description' => 'nullable|string|max:255',
            ]);
            $department = Department::create($validatedData);
            //insert into departments (code, name, description) values (...)  
            return response()->json($department, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while saving departments', 
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          try {
            $department = Department::FindOrFail($id);
            return response()->json($department, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching departments', 
                'department' => $id,
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          try {
            $department = Department::findOrFail($id);
            
            //validation
            $validatedData = $request->validate([
                'code' => 'required|string|max:100',
                'name' => 'required|string|max:100',
                'description' => 'nullable|string|max:255',
            ]);

            $department->update($validatedData);

            return response()->json($department, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the department', 
                'department' => $id,
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();
            return response()->json([
                'message' => 'Department deleted successfully',
                'department_id' => $id], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the department',
                'department' => $id,
                'error' => $e->getMessage()], 500);
        }
    }
}
