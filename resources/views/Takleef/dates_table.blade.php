<x-app-layout>
    <div class="py-12 ">
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path fill-rule="evenodd"
                        d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- <form method="POST" action="{{route('update',['id'=>$employee_info->id, 'month' => $month])}}">
                        --}}
                        <form action="{{route('takleef.store')}}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 place-content-center">
                                <div>
                                    <label class="block">الاسم</label>
                                    <input type="hidden" name="month" value="{{$month}}">
                                    <input type="hidden" name="employee_id" value="{{$employee_info->id}}">
                                    <input name="name" type="text"
                                        class="border border-gray-300 bg-gray-300 cursor-not-allowed rounded-md p-2 my-2 w-full"
                                        value="{{$employee_info->name}}" readonly>
                                    <label class="block">الرقم المدني</label>
                                    <input name="civilId" type="text" value=" {{$employee_info->civilId}}"
                                        class="border border-gray-300 rounded-md p-2 my-2 w-full bg-gray-300 cursor-not-allowed"
                                        readonly>
                                    <label class="block">رقم الملف</label>
                                    <input name="fileNo" type="text"
                                        class="border border-gray-300 rounded-md p-2 my-2 w-full bg-gray-300 cursor-not-allowed"
                                        value="{{$employee_info->fileNo}}" readonly>
                                    <label class="block">Shift</label>
                                    <input name="shift_group" type="text"
                                        class="border border-gray-300 rounded-md p-2 my-2 w-full"
                                        value="{{$employee_info->shift_group}}">


                                    <div class="flex flex-col justify-evenly space-y-4 text-center">
                                        <a href="{{route('employees.edit', $employee_info->id)}}"
                                            class="block px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                            <i class="fas fa-edit mr-2"></i>
                                            Edit Employee
                                        </a>
                                        <button type="submit"
                                            class="bg-gray-800 hover:bg-gray-900 text-white font-medium py-2 px-4 rounded-lg mt-2">
                                            <i class="fas fa-save mr-2"></i>
                                            Save Dates
                                        </button>
                                        <a href="{{ $employee_takleef->isEmpty() ? '#' : '/takleef/show/' . $employee_info->id . '/' . $month .'/'.$selectedYear}}"
                                            class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg mt-2
                                            {{ $employee_takleef->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $employee_takleef->isEmpty() ? 'disabled' : '' }}>
                                            <i class="fas fa-file-pdf mr-2"></i>
                                            PDF
                                        </a>

                                        <a href="{{route('employees.edit', $employee_info->id)}}"
                                            class="block px-4 py-2 text-white bg-amber-500 rounded-md hover:bg-amber-600">
                                            <i class="fas fa-edit mr-2"></i>
                                            إضافة أيام جديدة إلى التكاليف
                                        </a>


                                    </div>


                                </div>
                                <div class="overflow-x-auto col-span-2  " dir="rtl">
                                    <div class="flex flex-col ">
                                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-5 ">
                                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-20 bg-gray-200">
                                                <div class="overflow-hidden">
                                                    <input type="text" name="year" value="{{$selectedYear}}">

                                                    <table
                                                        class="w-full text-sm text-center  text-gray-500  table-auto border-collapse border border-slate-400">
                                                        <thead
                                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                            <tr>
                                                                <th class=" py-3 border-b border-gray-300 bg-gray-50">
                                                                    #
                                                                </th>
                                                                <th>
                                                                    اليوم
                                                                </th>
                                                                <th class=" py-3 border-b border-gray-300 bg-gray-50">
                                                                    التاريخ
                                                                </th>
                                                                <th class=" py-3 border-b border-gray-300 bg-gray-50 ">
                                                                    حضور
                                                                </th>
                                                                <th class=" py-3 border-b border-gray-300 bg-gray-50">
                                                                    انصراف
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $i = 0; @endphp
                                                            @foreach($dates as $date)
                                                            <tr
                                                                class="hover:bg-gray-100 transition-colors duration-200 {{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">

                                                                @php $i++; @endphp
                                                                <td class="py-2 border-b border-gray-300">{{ $i }}</td>
                                                                @switch(\Carbon\Carbon::parse($date)->englishDayOfWeek)
                                                                @case('Sunday')
                                                                <td class="py-2 border-b border-gray-300">الأحد</td>
                                                                @break
                                                                @case('Monday')
                                                                <td class="py-2 border-b border-gray-300">الاثنين</td>
                                                                @break
                                                                @case('Tuesday')
                                                                <td class="py-2 border-b border-gray-300">الثلاثاء</td>
                                                                @break
                                                                @case('Wednesday')
                                                                <td class="py-2 border-b border-gray-300">الأربعاء</td>
                                                                @break
                                                                @case('Thursday')
                                                                <td class="py-2 border-b border-gray-300">الخميس</td>
                                                                @break
                                                                @case('Friday')
                                                                <td class="py-2 border-b border-gray-300">الجمعة</td>
                                                                @break
                                                                @case('Saturday')
                                                                <td class="py-2 border-b border-gray-300">السبت</td>
                                                                @break
                                                                @endswitch
                                                                <td class="py-2 border-b border-gray-300">{{ $date }}
                                                                </td>
                                                                <td class="py-2 border-b border-gray-300">
                                                                    @if(is_array($attendance) && array_key_exists($date,
                                                                    $attendance) && $attendance[$date] &&
                                                                    $attendance[$date]->employee_in === 'بداية الدوام')
                                                                    <input type="checkbox" name="employee_in[]"
                                                                        value="{{ $date }}" checked
                                                                        class="form-checkbox h-4 w-4 text-green-600 transition duration-150 ease-in-out">
                                                                    @else
                                                                    <input type="checkbox" name="employee_in[]"
                                                                        value="{{ $date }}"
                                                                        class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                                                                    @endif
                                                                </td>

                                                                <td class="py-2 border-b border-gray-300">
                                                                    @if(is_array($attendance) && in_array($date,
                                                                    array_column($attendance, 'date')))
                                                                    @if($attendance[$date] &&
                                                                    $attendance[$date]->employee_out === 'نهاية الدوام')
                                                                    <input type="checkbox" name="employee_out[]"
                                                                        value="{{ $date }}"
                                                                        class="form-checkbox h-4 w-4 text-lime-500 transition duration-150 ease-in-out"
                                                                        checked>
                                                                    @else
                                                                    <input type="checkbox" name="employee_out[]"
                                                                        value="{{ $date }}"
                                                                        class="form-checkbox h-4 w-4 text-teal-300 transition duration-150 ease-in-out">
                                                                    @endif
                                                                    @else
                                                                    <input type="checkbox" name="employee_out[]"
                                                                        value="{{ $date }}"
                                                                        class="form-checkbox h-4 w-4 text-amber-400 transition duration-150 ease-in-out">


                                                                    @endif
                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>