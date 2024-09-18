<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Takleef;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Exports\TakleefTable;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class TakleefController extends Controller
{
    public $currentYear;
    public function __construct()
    {
        // $this->currentYear = Carbon::now()->year;
        $this->currentYear = Carbon::createFromDate(2023, 1, 1)->year;
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

    public function search(Request $request, $month, $year)
    {
        // $data = $request->validate(
        //     [
        //         // 'fileNo' => 'required_without:civilid|exists:employees,fileNo',
        //         'civilId' => 'required_without:fileNo|exists:employees,civilId',
        //         'year' => 'required|in:2023,2024', // Validate year as either 2023 or 2024
        //     ],
        //     [
        //         'fileNo.required_without' => 'يرجى ادخال رقم الملف الخاص بالموظف أو رقم الهوية المدنية',
        //         'civilid.required_without' => 'يرجى ادخال رقم الهوية المدنية الخاص بالموظف أو رقم الملف',
        //         'fileNo.exists' => 'رقم الملف غير موجود',
        //         'civilid.exists' => 'رقم الهوية المدنية غير موجود',
        //         'year.required' => 'يرجى اختيار السنة',
        //         'year.in' => 'يرجى اختيار السنة الصحيحة (2023 أو 2024)',
        //     ]
        // );
        $fileNo = $request->fileNo;
        $civilId = $request->civilId;
        $selectedYear = $request->year;
        $employee_info =  Employee::where('fileNo', $fileNo)->orWhere('civilId', $civilId)->first();


        // Retrieve fileNo, civilId, and year from request
        $fileNo = $request->input('fileNo');
        $civilId = $request->input('civilId');
        $selectedYear = $request->input('year');

        // Query the employee by fileNo or civilId
        $employee_info = Employee::where('fileNo', $fileNo)
            ->orWhere('civilId', $civilId)
            ->first();

        if (!$employee_info) {
            return redirect()->back()->withErrors(['error' => 'الموظف غير موجود']);
        }

        // Further processing...

        if ($employee_info) {
            $currentMonth = $month;
            $currentYear = $selectedYear;
            $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in month
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
                $dates[] = $date->format('Y-m-d');
            }
            $attendance = array();
            foreach ($dates as $date) {
                $attendance[$date] = Takleef::where('employee_id', $employee_info->id)
                    ->whereDate('date', $date)
                    ->whereYear('date', $currentYear)
                    ->first();
            }
            $employee_takleef = Takleef::where('employee_id', $employee_info->id)
                ->where(function ($query) {
                    $query->whereNotNull('employee_in')
                        ->orWhereNotNull('employee_out')
                        ->orWhereNotNull('in_confirmation');
                })
                ->whereMonth('date', $month)
                ->whereYear('date', $currentYear)
                ->orderBy('date')
                ->get();

            return view('Takleef.dates_table', compact('selectedYear', 'dates', 'employee_info', 'attendance', 'fileNo', 'month', 'employee_takleef', 'year'));
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
            'fileNo' => 'sometimes|required|exists:employees,fileNo',
            'civilid' => 'sometimes|required|exists:employees,civilId',
        ]);
        //check if there is changes in employee data
        $employee_id = $request->input('employee_id');
        $name = $request->input('name');
        $civilId = $request->input('civilId');
        $fileNo = $request->input('fileNo');
        $shift_group = $request->input('shift_group');
        $employee_info = Employee::where('id', $employee_id)->first();
        if ($employee_info) {
            $employee_info->fill([
                'name' => $name,
                'civilId' => $civilId,
                'fileNo' => $fileNo,
                'shift_group' => $shift_group,
            ]);

            $employee_info->save();
        }
        $currentMonth = $request->month;
        $currentYear = $request->year;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in current momth
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = Takleef::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        //retrive dates of employee takleef and comare it with the input
        $takleef_db = Takleef::where('employee_id', $employee_info->id)
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->get();
        $employee_in = $request->input('employee_in');
        $employee_out = $request->input('employee_out');
        $in_confirmation = $request->input('in_confirmation');
        if (empty($employee_in) && empty($employee_out) && empty($in_confirmation)) {
            Takleef::where('employee_id', $employee_info->id)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $request->year)
                ->update(['employee_in' => null, 'employee_out' => null]);
            Takleef::where('employee_id', $employee_info->id)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $request->year)
                ->whereNull('employee_in')
                ->whereNull('employee_out')
                ->delete();
            session()->flash('success', 'No data to show | لا يوجد بيانات لعرضها ');
            return redirect()->route('takleef.index');
        }
        // check if employee_in array is not empty
        if (!empty($employee_in) || !empty($employee_out) || !empty($in_confirmation)) {
            $employee_in = $employee_in ?: array();
            $employee_out = $employee_out ?: array();
            $in_confirmation = $in_confirmation ?: array();
            $dates = array_merge($employee_in, $employee_out, $in_confirmation);
            Takleef::where('employee_id', $employee_info->id)
                ->whereMonth('date', $request->month)
                ->whereYear('date', $request->year)
                ->update(['employee_in' => null, 'employee_out' => null, 'in_confirmation' => null]);
            foreach ($dates as $date) {
                $attend = Takleef::where('employee_id', $employee_info->id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = Takleef::create([
                        'employee_id' => $employee_info->id,
                        'date' => $date,
                        'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                        'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null,
                        'in_confirmation' => in_array($date, $in_confirmation) ? 'حضور' : null,
                        'user_id' => Auth::user()->id
                    ]);
                } else {
                    $attend->update([
                        'employee_id' => $employee_info->id,
                        'date' => $date,
                        'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                        'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null,
                        'in_confirmation' => in_array($date, $in_confirmation) ? 'حضور' : null,
                        'user_id' => Auth::user()->id

                    ]);
                }
            }
            //delete when both of employee in and out are null
            Takleef::where('employee_id', $employee_info->id)
                ->whereNull('employee_in')
                ->whereNull('employee_out')
                ->whereNull('in_confirmation')
                ->delete();
        }

        return redirect('/takleef/show' . '/' . $employee_info->id . '/' . $request->month . '/' . $request->year)->withInput()->with('success', 'تم التعديل بنجاح')->with(compact('dates', 'employee_info', 'attendance'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Takleef $takleef, $id, $month, $year)
    {
        $employee_info =  Employee::where('id', $id)->first();
        $employee_takleef = Takleef::where('employee_id', $id)
            // ->where(function ($query) {
            //     $query->whereNotNull('employee_in')
            //         ->orWhereNotNull('employee_out');
            // })
            ->whereMonth('date', $month)
            ->whereYear('date', $year)

            ->orderBy('date')
            ->get();
        if ($employee_takleef->isEmpty()) {
            abort(404, 'Employee takleef not found');
        }
        $currentMonth = $month; //September
        $daysInMonth = Carbon::createFromDate($year, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($year, $currentMonth, $i);
        }
        $firstValue = reset($dates)->format('Y-m-d');;
        $lastValue  =  end($dates)->format('Y-m-d');;
        $employee_info = Takleef::where('employee_id', $employee_info->id)->first();
        return view('Takleef.show', compact('year', 'employee_takleef', 'employee_info', 'firstValue', 'lastValue', 'month'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($month, $id, $year)
    {
        $employee_info =  Employee::where('id', $id)->first();
        $currentMonth = $month;
        $daysInMonth = Carbon::createFromDate($year, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($year, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();

        foreach ($dates as $date) {
            $attendance[$date] = Takleef::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        // dd($attendance);
        return view('Takleef.edit', compact('year', 'dates', 'employee_info', 'attendance', 'month'));
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
    public function singleTakleef($id, $month, $year)
    {
        $employee_info = Employee::findOrFail($id);
        $currentMonth = $month;
        $currentYear = $year;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in month
        $dates = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }

        return view('takleef.singleTakleef', [
            'employee_info' => $employee_info,
            'month' => $month,
            'year' => $year,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'dates' => $dates
        ]);
    }
    public function storeSingleTakleef(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $name = $request->input('name');
        $civilId = $request->input('civilId');
        $fileNo = $request->input('fileNo');
        $shift_group = $request->input('shift_group');
        $employee_info = Employee::where('id', $employee_id)->first();
        $employee_in = $request->input('employee_in');
        $employee_out = $request->input('employee_out');
        if (!empty($employee_in) || !empty($employee_out)) {
            $employee_in = $employee_in ?: array();
            $employee_out = $employee_out ?: array();
            $dates = array_merge($employee_in, $employee_out);
            foreach ($dates as $date) {
                $attend = Takleef::create([
                    'employee_id' => $employee_info->id,
                    'date' => $date,
                    'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                    'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null,
                    'user_id' => Auth::user()->id
                ]);
            }
        }
        $attendance = array();

        foreach ($dates as $date) {
            $attendance[$date] = Takleef::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }

        return redirect('/takleef/show' . '/' . $employee_info->id . '/' . $request->month . '/' . $request->year)->withInput()->with('success', 'تم التعديل بنجاح')->with(compact('dates', 'employee_info', 'attendance'));
    }

    public function exportToExcel($month)
    {
        // Get the start and end date of the month
        // $startDate = date('Y-m-01', strtotime($month));
        // $endDate = date('Y-m-t', strtotime($month));

        // Get the records within the specified month
        $currentYear = date('Y');

        $records = Takleef::whereYear('date', 2023)
            ->orderByDesc('created_at')
            ->orderByDesc('date')

            ->get();

        $export = new TakleefTable($records);
        $fileName = 'table_data.xlsx';

        return Excel::download($export, $fileName);
    }
    public function generatePDF($id, $month, $year)
    {
        // Retrieve employee information
        $employee_info = Employee::findOrFail($id);

        // Retrieve employee takleef for the specified month and year
        $employee_takleef = Takleef::where('employee_id', $id)
            ->where(function ($query) {
                $query->whereNotNull('employee_in')
                    ->orWhereNotNull('employee_out')
                    ->orWhereNotNull('in_confirmation');
            })
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date')
            ->get();

        // If no takleef records found, return 404
        if ($employee_takleef->isEmpty()) {
            abort(404, 'Employee takleef not found');
        }

        // Calculate first and last dates of the month
        $currentMonth = $month;
        $daysInMonth = Carbon::createFromDate($year, $currentMonth, 1)->daysInMonth;
        $dates = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($year, $currentMonth, $i)->format('Y-m-d');
        }
        $firstValue = reset($dates);
        $lastValue = end($dates);

        // Path to employee image
        $header_image_path = public_path('images/header-new.png');
        $footer_image_path = public_path('images/footer-new.png');
        $header2_image_path = public_path('images/header2.png');

        // Prepare data to pass to the Blade view
        $data = [
            'employee_info' => $employee_info,
            'employee_takleef' => $employee_takleef,
            'firstValue' => $firstValue,
            'lastValue' => $lastValue,
            'month' => $month,
            'year' => $year,
            'header_image_path' => $header_image_path,
            'footer_image_path' => $footer_image_path,
            'header2_image_path' => $header2_image_path,
        ];

        // Create MPDF instance
        $mpdf = new Mpdf([
            'default_font' => 'Cairo',
            'mode' => 'utf-8',
            'format' => 'A4', // Portrait format

        ]);

        // Render the Blade view into HTML
        $html = view('invoice', $data)->render();
        // Determine PDF filename based on employee's name
        $pdfFileName = $employee_info->name . '_report_' . $year . '_' . $month . '.pdf';
        // Write HTML content to PDF
        $mpdf->WriteHTML($html);

        // Output PDF as download
        // $mpdf->Output('invoice.pdf', 'D');
        $mpdf->Output($pdfFileName, 'D');
    }

    // public function generatePDF($id, $month, $year)
    // {
    //     // Retrieve employee information
    //     $employee_info = Employee::findOrFail($id);

    //     // Retrieve employee takleef for the specified month and year
    //     $employee_takleef = Takleef::where('employee_id', $id)
    //         ->where(function ($query) {
    //             $query->whereNotNull('employee_in')
    //                 ->orWhereNotNull('employee_out');
    //         })
    //         ->whereMonth('date', $month)
    //         ->whereYear('date', $year)
    //         ->orderBy('date')
    //         ->get();

    //     // If no takleef records found, return 404
    //     if ($employee_takleef->isEmpty()) {
    //         abort(404, 'Employee takleef not found');
    //     }

    //     // Calculate first and last dates of the month
    //     $currentMonth = $month;
    //     $daysInMonth = Carbon::createFromDate($year, $currentMonth, 1)->daysInMonth;
    //     $dates = [];
    //     for ($i = 1; $i <= $daysInMonth; $i++) {
    //         $dates[] = Carbon::createFromDate($year, $currentMonth, $i)->format('Y-m-d');
    //     }
    //     $firstValue = reset($dates);
    //     $lastValue = end($dates);

    //     // Prepare data to pass to the Blade view
    //     $data = [
    //         'employee_info' => $employee_info,
    //         'employee_takleef' => $employee_takleef,
    //         'firstValue' => $firstValue,
    //         'lastValue' => $lastValue,
    //         'month' => $month,
    //         'year' => $year,
    //     ];

    //     // Create MPDF instance
    //     $mpdf = new Mpdf([
    //         'default_font' => 'Cairo',
    //         'mode' => 'utf-8',
    //         'format' => 'A4-L' // Landscape format
    //     ]);

    //     // Render the Blade view into HTML
    //     $html = view('invoice', $data)->render();

    //     // Write HTML content to PDF
    //     $mpdf->WriteHTML($html);

    //     // Output PDF as download
    //     $mpdf->Output('invoice.pdf', 'D');
    // }
}
