<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileNo = $request->input('fileNo');
        $date = $request->input('date');
        $time = $request->input('time');
        $status = $request->input('status');
        $reason = $request->input('reason');
        $employee = Employee::where('fileNo', $fileNo)->first();
        $currentMonth = Carbon::now()->month;

        $permission_count = Permission::where('employee_id', $employee->id)
            ->whereMonth('date', $currentMonth)
            ->count();
        if ($employee) {
            $permission = new Permission();
            $permission->employee_id = $employee->id;
            $permission->date = $date;
            $day = Carbon::parse($date)->format('l');
            $dayInArabic = '';
            switch ($day) {
                case 'Sunday':
                    $dayInArabic = 'الأحد';
                    break;
                case 'Monday':
                    $dayInArabic = 'الاثنين';
                    break;
                case 'Tuesday':
                    $dayInArabic = 'الثلاثاء';
                    break;
                case 'Wednesday':
                    $dayInArabic = 'الأربعاء';
                    break;
                case 'Thursday':
                    $dayInArabic = 'الخميس';
                    break;
                case 'Friday':
                    $dayInArabic = 'الجمعة';
                    break;
                case 'Saturday':
                    $dayInArabic = 'السبت';
                    break;
                default:
                    $dayInArabic = 'Invalid day';
                    break;
            }
            $permission->time = $time;
            $permission->status = $status;
            $permission->reason = $reason;
            $permission->save();
            return view('permission.show', compact('permission', 'dayInArabic', 'permission_count'));
            // return redirect()->route('permission.index')->with('success', 'Permission created successfully');
        } else {
            return redirect()->route('permission.index')->with('error', 'Employee not found');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}