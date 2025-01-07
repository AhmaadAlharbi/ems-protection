<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <!-- Error Alert -->
        @if(session('error'))
        <div class="max-w-7xl mx-auto mb-6 px-6 lg:px-8">
            <div class="bg-white border-l-4 border-red-500 rounded-lg shadow-lg p-5 flex justify-between items-start">
                <span class="text-red-800 text-sm">{{ session('error') }}</span>
                <button class="text-red-500 hover:text-red-700 transition-colors duration-200">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{route('takleef.store')}}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Employee Details Section -->
                            <div class="bg-white rounded-xl shadow-md p-6 relative">
                                <!-- Decorative Corner -->
                                <div
                                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-cyan-50/50 to-blue-50/50 rounded-bl-full -z-10">
                                </div>

                                <div class="space-y-4">
                                    <!-- Hidden Inputs -->
                                    <input type="hidden" name="month" value="{{$month}}">
                                    <input type="hidden" name="employee_id" value="{{$employee_info->id}}">
                                    <input type="hidden" name="year" value="{{$selectedYear}}">

                                    <!-- Employee Info Fields -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                                            <input name="name" type="text" value="{{$employee_info->name}}" readonly
                                                class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">الرقم
                                                المدني</label>
                                            <input name="civilId" type="text" value="{{$employee_info->civilId}}"
                                                readonly
                                                class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">رقم
                                                الملف</label>
                                            <input name="fileNo" type="text" value="{{$employee_info->fileNo}}" readonly
                                                class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Shift</label>
                                            <input name="shift_group" type="text"
                                                value="{{$employee_info->shift_group}}"
                                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="space-y-3 pt-4">
                                        <a href="{{route('employees.edit', $employee_info->id)}}" class="flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 
                                                  text-white rounded-lg hover:from-blue-600 hover:to-blue-700 
                                                  transition-all duration-200 transform hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit Employee
                                        </a>

                                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-gray-700 to-gray-800 
                                                       text-white rounded-lg hover:from-gray-800 hover:to-gray-900 
                                                       transition-all duration-200 transform hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                            </svg>
                                            Save Dates
                                        </button>

                                        <a href="{{ $employee_takleef->isEmpty() ? '#' : '/takleef/show/' . $employee_info->id . '/' . $month .'/'.$selectedYear}}"
                                            class="flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 
                                                  text-white rounded-lg hover:from-green-600 hover:to-green-700 
                                                  transition-all duration-200 transform hover:-translate-y-0.5
                                                  {{ $employee_takleef->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Show
                                        </a>

                                        <a href="{{ route('generate-pdf', ['id' => $employee_info->id, 'month' => $month, 'year' => $year]) }}"
                                            class="flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-amber-400 to-amber-500 
                                                  text-white rounded-lg hover:from-amber-500 hover:to-amber-600 
                                                  transition-all duration-200 transform hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                            </svg>
                                            Download PDF
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Dates Table Section -->
                            <div class="md:col-span-2">
                                <div class="bg-white rounded-xl shadow-md overflow-hidden" dir="rtl">
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm divide-y divide-gray-200">
                                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                                <tr>
                                                    <th class="px-4 py-3 text-right font-medium text-gray-700">#</th>
                                                    <th class="px-4 py-3 text-right font-medium text-gray-700">اليوم
                                                    </th>
                                                    <th class="px-4 py-3 text-right font-medium text-gray-700">التاريخ
                                                    </th>
                                                    <th class="px-4 py-3 text-center font-medium text-gray-700">حضور
                                                    </th>
                                                    <th class="px-4 py-3 text-center font-medium text-gray-700">بصمة
                                                        اثبات التواجد</th>
                                                    <th class="px-4 py-3 text-center font-medium text-gray-700">انصراف
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                @php $i = 0; @endphp
                                                @foreach($dates as $date)
                                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                    <td class="px-4 py-3 text-gray-700">{{ ++$i }}</td>
                                                    <td class="px-4 py-3 text-gray-700">
                                                        @switch(\Carbon\Carbon::parse($date)->englishDayOfWeek)
                                                        @case('Sunday') الأحد @break
                                                        @case('Monday') الاثنين @break
                                                        @case('Tuesday') الثلاثاء @break
                                                        @case('Wednesday') الأربعاء @break
                                                        @case('Thursday') الخميس @break
                                                        @case('Friday') الجمعة @break
                                                        @case('Saturday') السبت @break
                                                        @endswitch
                                                    </td>
                                                    <td class="px-4 py-3 text-gray-700">{{ $date }}</td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="checkbox" name="employee_in[]" value="{{ $date }}"
                                                            {{ (is_array($attendance) && array_key_exists($date,
                                                            $attendance) && $attendance[$date] &&
                                                            $attendance[$date]->employee_in === 'بداية الدوام') ?
                                                        'checked' : '' }}
                                                        class="w-4 h-4 text-cyan-600 border-gray-300 rounded
                                                        focus:ring-cyan-500">
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="checkbox" name="in_confirmation[]"
                                                            value="{{ $date }}" {{ (is_array($attendance) &&
                                                            array_key_exists($date, $attendance) && $attendance[$date]
                                                            && $attendance[$date]->in_confirmation === 'حضور') ?
                                                        'checked' : '' }}
                                                        class="w-4 h-4 text-cyan-600 border-gray-300 rounded
                                                        focus:ring-cyan-500">
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="checkbox" name="employee_out[]" value="{{ $date }}"
                                                            {{ (is_array($attendance) && array_key_exists($date,
                                                            $attendance) && $attendance[$date] &&
                                                            $attendance[$date]->employee_out === 'نهاية الدوام') ?
                                                        'checked' : '' }}
                                                        class="w-4 h-4 text-cyan-600 border-gray-300 rounded
                                                        focus:ring-cyan-500">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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