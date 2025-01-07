<div class="mt-10 space-y-8">
    <!-- Success Message Script -->
    @if (session()->has('success'))
    <script>
        Swal.fire('Success', '{{ session('success') }}', 'success');
    </script>
    @endif

    <!-- Search Section -->
    <div class="bg-gradient-to-r from-cyan-600 to-cyan-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="relative p-8 flex flex-col items-center">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2">
                </div>
            </div>

            <label for="search" class="block text-white text-lg mb-4 relative">ابحث بكتابة رقم الملف الخاص
                بالموظف</label>
            <div class="relative w-full max-w-2xl group">
                <input type="text" wire:model="search" wire:keydown.enter="updatedSearch"
                    placeholder="Search by employee file No" class="w-full px-5 py-3 rounded-lg border-0 bg-white/90 backdrop-blur-sm 
                              text-gray-800 placeholder-gray-500
                              focus:ring-2 focus:ring-cyan-300 focus:bg-white
                              transition-all duration-300 shadow-md">
                <div
                    class="absolute inset-x-0 bottom-0 h-0.5 bg-cyan-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <th class="px-6 py-4 text-gray-700 font-medium">#</th>
                        <th class="px-6 py-4 text-gray-700 font-medium">Employee</th>
                        <th class="px-6 py-4 text-gray-700 font-medium">Civil ID</th>
                        <th class="px-6 py-4 text-gray-700 font-medium">File No</th>
                        <th class="px-6 py-4 text-gray-700 font-medium">Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($employees as $employee)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $employee->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $employee->civilId }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $employee->fileNo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <a href="{{route('employees.edit',$employee->id)}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white 
                                      bg-gradient-to-r from-blue-500 to-blue-600 
                                      rounded-lg shadow-sm hover:from-blue-600 hover:to-blue-700 
                                      transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <button wire:click="confirmDelete('{{ $employee->id }}')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white 
                                           bg-gradient-to-r from-red-500 to-red-600
                                           rounded-lg shadow-sm hover:from-red-600 hover:to-red-700
                                           transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50">
            {{ $employees->links() }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Script -->
<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('showDeleteConfirmation', event => {
            const employeeId = event.detail.employeeId;
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg',
                    cancelButton: 'px-4 py-2 text-white bg-gradient-to-r from-red-500 to-red-600 rounded-lg'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteEmployee', employeeId);
                }
            });
        });
    });
</script>