<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //HTTP methods
    //index, store, show, update, destroy
    //controller
    //index - GET /employees
    //store - POST /employees
    //show - GET /employees/{id}
    //update - PUT/PATCH /employees/{id}
    //destroy - DELETE /employees/{id}

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $employees = Employee::all();
            //select * from employees
            return response()->json($employees);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching employees', 
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
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|unique:employees',
                'gender' => 'nullable|string|max:10',
                'birthdate' => 'nullable|date',
                'date_hired' => 'required|date',
                'salary' => 'nullable|numeric',
            ]);
            $employee = Employee::create($validatedData);
            //insert into employees (first_name, last_name, email, gender, birthdate, date_hired, salary) values (...)  
            return response()->json($employee, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while saving employees', 
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          try {
            $employee = Employee::FindOrFail($id);
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching employees', 
                'employee' => $id,
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          try {
            $employee = Employee::findOrFail($id);
            
            //validation
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|unique:employees',
                'gender' => 'nullable|string|max:10',
                'birthdate' => 'nullable|date',
                'date_hired' => 'required|date',
                'salary' => 'nullable|numeric',
            ]);

            $employee->update($validatedData);

            return response()->json($employee, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the employee', 
                'employee' => $id,
                'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json([
                'message' => 'Employee deleted successfully',
                'employee_id' => $id], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the employee',
                'employee' => $id,
                'error' => $e->getMessage()], 500);
        }
    }
}
