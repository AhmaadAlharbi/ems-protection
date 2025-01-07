<div class="mt-10">
    <!-- Search Section with Gradient Background -->
    <div class="bg-gradient-to-r from-cyan-600 to-cyan-800 rounded-xl shadow-lg mb-8">
        <div class="flex flex-col justify-center items-center p-8">
            <label for="search" class="block text-white text-lg mb-4">ابحث بكتابة رقم الملف الخاص بالموظف</label>
            <div class="relative w-full max-w-xl group">
                <input type="text" wire:model="search" wire:bounce="updatedSearch"
                    placeholder="Search by employee file No"
                    class="w-full px-5 py-3 rounded-lg border-0 bg-white/90 backdrop-blur-sm focus:bg-white text-gray-800 focus:ring-2 focus:ring-cyan-300 transition-all duration-300 shadow-md">
                <div
                    class="absolute inset-x-0 bottom-0 h-0.5 bg-cyan-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                </div>
            </div>
        </div>
    </div>

    <!-- Export Button -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('export', ['month' => $month]) }}"
            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export to Excel
        </a>
    </div>

    <!-- Table Container with Shadow and Rounded Corners -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">id</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">employee</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">File No</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">date</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">دخول</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">بصمة التواجد</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">خروج</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">added by</th>
                        <th class="px-6 py-4 text-gray-700 font-medium border-b">created at</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($takleefs as $takleef)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$loop->iteration}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->employee->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->employee->fileNo}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->date}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->employee_in}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->in_confirmation}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->employee_out}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->user->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{$takleef->created_at->format('Y-m-d')}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Links with Modern Styling -->
    <div class="mt-6">
        {{ $takleefs->links() }}
    </div>

</div>