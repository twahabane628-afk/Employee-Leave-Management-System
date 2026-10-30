<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

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

        Employee::create($validated);

        return redirect()
            ->route('conference.employees.index')
            ->with('success', 'Employee registered successfully!');
    }
}
