<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Takleef;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakleefController extends Controller
{
    public $currentYear;
    public function __construct()
    {
        $this->currentYear = Carbon::now()->year;
    }
    public function index()
    {

        return view('Takleef.index');
    }
    public function takleefList($number)
    {
        $month = 0;
        switch ($number) {
            case '1':
                $title = "شهر يناير";
                $month = 1;
                break;
            case '2':
                $title = "شهر فبراير";
                $month = 2;
                break;
            case '3':
                $title = "شهر مارس";
                $month = 3;
                break;
            case '4':
                $title = "شهر ابريل";
                $month = 4;
                break;
            case '5':
                $title = "شهر مايو";
                $month = 5;
                break;
            case '6':
                $title = "شهر يونيو";
                $month = 6;
                break;
            case '7':
                $title = "شهر يوليو";
                $month = 7;
                break;
            case '8':
                $title = "شهر اغسطس";
                $month = 8;
                break;
            case '9':
                $title = "شهر سبتمبر";
                $month = 9;
                break;
            case '10':
                $title = "شهر اكتوبر";
                $month = 10;
                break;
            case '11':
                $title = "شهر نوفمبر";
                $month = 11;
                break;
            case '12':
                $title = "شهر ديسمبر";
                $month = 12;
                break;
            default:
                abort(404);
        }

        return view('Takleef.search', compact('title', 'month'));
    }

    public function search(Request $request, $month)
    {
        // $data = $request->validate(
        //     [
        //         'fileNo' => 'required',

        //     ],
        //     [

        //         'fileNo' => 'يرجى ادخال رقم الملف الخاص بالموظف'
        //     ]
        // );
        $fileNo = $request->fileNo;
        $civilId = $request->civilid;
        $employee_info =  Employee::where('fileNo', $fileNo)->orWhere('civilid', $civilId)->first();
        if ($employee_info) {
            $currentMonth = $month;
            $currentYear = 2023;
            $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in month
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
                $dates[] = $date->format('Y-m-d');
            }
            $attendance = array();
            foreach ($dates as $date) {
                $attendance[$date] = Takleef::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
            }
            return view('Takleef.dates_table', compact('dates', 'employee_info', 'attendance', 'fileNo', 'month'));
        } else {
            session()->flash('error', '   رقم الملف غير موجود ');
            return redirect()->back();
        }
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
        $request->validate([
            'name' => 'required',
            'civilId' => 'required',
            'fileNo' => 'required'
        ], [
            'name.required' => 'يرجى ادخال اسم الموظف',
            'civilId.required' => 'يرجى ادخال الرقم المدني للموظف',
            'fileNo.required' => 'يرجى ادخال رقم الملف للموظف'
        ]);

        $name = $request->input('name');
        $civilId = $request->input('civilId');
        $fileNo = $request->input('fileNo');
        $shift_group = $request->input('shift_group');
        $employee_info = Employee::where('fileNo', $fileNo)->first();
        if ($shift_group === '') {
            $employee_info->shift_group = null;
        } else {
            $employee_info->shift_group = $shift_group;
        }
        $employee_info->save();

        $currentMonth = $request->month;
        $daysInMonth = Carbon::createFromDate($this->currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in current momth
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($this->currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = Takleef::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        //check if there is update on employee data
        $updatedData = [];
        if ($employee_info->name !== $name) {
            $updatedData['name'] = $name;
        }
        if ($employee_info->civilId !== $civilId) {
            $updatedData['civilId'] = $civilId;
        }
        if ($employee_info->fileNo !== $fileNo) {
            $updatedData['fileNo'] = $fileNo;
        }
        if ($employee_info->shift !== $shift_group) {

            $updatedData['shift_group'] = $shift_group;
        }
        if (!empty($updatedData)) {
            $employee_info->update($updatedData);
        }
        //retrive dates of employee takleef and comare it with the input
        $takleef_db = Takleef::where('employee_id', $employee_info->id)->get();
        $employee_in = $request->input('employee_in');
        $employee_out = $request->input('employee_out');
        if (empty($employee_in) && empty($employee_out)) {
            Takleef::where('employee_id', $employee_info->id)->update(['employee_in' => null, 'employee_out' => null]);
            Takleef::where('employee_id', $employee_info->id)->whereNull('employee_in')->whereNull('employee_out')->delete();
        }

        // check if employee_in array is not empty
        if (!empty($employee_in) || !empty($employee_out)) {
            $employee_in = $employee_in ?: array();
            $employee_out = $employee_out ?: array();
            $dates = array_merge($employee_in, $employee_out);
            Takleef::where('employee_id', $employee_info->id)->whereMonth('date', $request->month)->update(['employee_in' => null, 'employee_out' => null]);

            foreach ($dates as $date) {
                $attend = Takleef::where('employee_id', $employee_info->id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = Takleef::create([
                        'employee_id' => $employee_info->id,
                        'date' => $date,
                        'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                        'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null,
                        'user_id' => Auth::user()->id
                    ]);
                } else {
                    $attend->update([
                        'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                        'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null,
                        'user_id' => Auth::user()->id

                    ]);
                }
            }
        }
        return redirect('/takleef/show' . '/' . $employee_info->id . '/' . $request->month)->withInput()->with('success', 'تم التعديل بنجاح')->with(compact('dates', 'employee_info', 'attendance'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Takleef $takleef, $id, $month)
    {
        $employee_info =  Employee::where('id', $id)->first();
        $employee_takleef = Takleef::where('employee_id', $id)
            ->where(function ($query) {
                $query->whereNotNull('employee_in')
                    ->orWhereNotNull('employee_out');
            })
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->get();
        $currentMonth = $month; //September
        $daysInMonth = Carbon::createFromDate($this->currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($this->currentYear, $currentMonth, $i);
        }
        $firstValue = reset($dates)->format('Y-m-d');;
        $lastValue  =  end($dates)->format('Y-m-d');;
        $employee_info = Takleef::where('employee_id', $employee_info->id)->first();
        return view('Takleef.show', compact('employee_takleef', 'employee_info', 'firstValue', 'lastValue', 'month'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($month, $id)
    {
        $employee_info =  Employee::where('id', $id)->first();
        $currentMonth = $month;
        $daysInMonth = Carbon::createFromDate($this->currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($this->currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = Takleef::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        return view('Takleef.edit', compact('dates', 'employee_info', 'attendance', 'month'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Takleef $takleef)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Takleef $takleef)
    {
        //
    }
}