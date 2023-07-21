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
        $request->validate([
            'fileNo' => 'required|exists:employees,fileNo',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:in,out',
        ]);

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

        if ($permission_count === 0) {
            $permission_count++;
        }
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
            return view('permission.showPdf', compact('permission', 'dayInArabic', 'permission_count'));
            // return redirect()->route('permission.showPdf', ['id' => $permission->id, 'permission_count' => $permission_count]);

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
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $employee = Employee::findOrfail($permission->employee_id);
        $permissionCount = Permission::where('employee_id', $employee->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();
        $permissions = Permission::where('employee_id', $employee->id)
            ->orderByDesc('date')
            ->paginate(10);
        return view('permission.show', compact('permissions', 'permissionCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $permissionId)
    {
        $request->validate([
            'fileNo' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:in,out',
        ]);

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
        if ($permission_count === 0) {
            $permission_count++;
        }

        $permission = Permission::findOrFail($permissionId);
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
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
    public function showPermissionPdf($id)
    {
        $permission = Permission::findOrFail($id);
        $day = Carbon::parse($permission->date)->format('l');
        $month = Carbon::parse($permission->date)->format('n');
        // return  $permission_count = Permission::where('employee_id', $permission->employee_id)
        //     ->whereMonth('date', $month)
        //     ->get();
        $permission_count = null;

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
        return view('permission.showPdf', compact('permission', 'dayInArabic', 'permission_count'));
    }
}
