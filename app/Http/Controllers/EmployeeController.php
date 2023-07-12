<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('fileNo')->paginate(15);
        return view('Employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        if (!$employee) {
            abort(404);
        }
        return view('employees.show', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        if (!$employee) {
            abort(404);
        }
        // Update the employee attributes with the new values from the request
        $employee->name = $request->input('name');
        $employee->civilId = $request->input('civilId');
        $employee->fileNo = $request->input('fileNo');
        $employee->shift_group = $request->input('shiftGroup');
        // Save the updated employee record
        $employee->save();
        session()->flash('success', 'Employee updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
