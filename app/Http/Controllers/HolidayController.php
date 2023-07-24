<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('holidays.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fileNo' => 'required|exists:employees,fileNo',
            'starting_date' => 'required|date',
            'days_count' => 'required|integer|min:1',
            'ending_date' => 'required|date|after_or_equal:starting_date',
        ]);
        $fileNo = $request->input('fileNo');
        $starting_date = $request->input('starting_date');
        $ending_date = $request->input('ending_date');
        $days_count = $request->input('days_count');
        $employee = Employee::where('fileNo', $fileNo)->first();
        $holiday = new Holiday;
        $holiday->employee_id = $employee->id;
        $holiday->starting_date = $starting_date;
        $holiday->ending_date = $ending_date;
        $holiday->days_count = $days_count;
        $holiday->user_id = Auth::user()->id;
        $holiday->save();
        return redirect()->route('holidays.index')->with('success', 'Holiday added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holiday $holiday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        //
    }
}
