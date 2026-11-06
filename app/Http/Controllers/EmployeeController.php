<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display the Employee Management page.
     */
    public function index()
    {
        return view('employees.index');
    }

    /**
     * Retrieve employee records through AJAX.
     */
    public function getData()
    {
        $employees = Employee::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $employees
        ]);
    }

    /**
     * Retrieve one employee for View or Edit.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $employee
        ]);
    }

    /**
     * Store a new employee through AJAX.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => 'required|string|max:50|unique:employees,employee_number',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:employees,email',
            'phone' => 'nullable|string|max:30',
            'gender' => 'nullable|in:Male,Female,Other',
            'department' => 'required|string|max:150',
            'position' => 'required|string|max:150',
            'employment_date' => 'nullable|date',
            'employment_status' => 'required|in:active,inactive',
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Employee registered successfully!',
            'data' => $employee
        ], 201);
    }

    /**
     * Update an existing employee through AJAX.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('employees', 'employee_number')->ignore($employee->id),
            ],
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'phone' => 'nullable|string|max:30',
            'gender' => 'nullable|in:Male,Female,Other',
            'department' => 'required|string|max:150',
            'position' => 'required|string|max:150',
            'employment_date' => 'nullable|date',
            'employment_status' => 'required|in:active,inactive',
        ]);

        $employee->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully!',
            'data' => $employee
        ]);
    }

    /**
     * Delete an employee through AJAX.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully!'
        ]);
    }
}
