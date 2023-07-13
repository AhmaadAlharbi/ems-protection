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
    public function create(Request $request)
    {

        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'civilId' => 'required|unique:employees',
            'fileNo' => 'required|unique:employees',
            'shiftGroup' => 'nullable',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->civilId = $request->civilId;
        $employee->fileNo = $request->fileNo;
        $employee->shift_group = $request->shiftGroup;

        $employee->save();
        session()->flash('success', 'Employee saved successfully.');

        return redirect()->route('employees.index');
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
