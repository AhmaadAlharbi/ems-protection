<div class="mt-10">
    <!-- Display the success message if it exists in the session -->
    @if (session()->has('success'))
    <script>
        Swal.fire('Success', '{{ session('success') }}', 'success');
    </script>
    @endif

    <div class="flex flex-col justify-center items-center bg-cyan-700">
        <label for="search" class="block text-white mt-4">ابحث بكتابة رقم الملف الخاص بالموظف</label>
        <input type="text" wire:model="search" wire:keydown.enter="updatedSearch"
            placeholder="Search by employee file No"
            class="px-4 w-1/2 py-2 my-4 text rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    <!-- Display the success message if it exists in the session -->
    @if (session()->has('success'))
    <script>
        Swal.fire('Success', '{{ session('success') }}', 'success');
    </script>
    @endif
    <table class="w-full border-collapse border border-slate-400 text-center border-spacing-2 table-auto">
        <thead>
            <tr>
                <th class="border border-slate-300 py-5">#</th>
                <th class="border border-slate-300 py-5">Employee</th>
                <th class="border border-slate-300 py-5">Civil ID</th>
                <th class="border border-slate-300 py-5">File No</th>
                <th class="border border-slate-300 py-5">Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td class="border border-slate-300 py-3">{{ $loop->iteration }}</td>
                <td class="border border-slate-300 py-3">{{ $employee->name }}</td>
                <td class="border border-slate-300 py-3">{{ $employee->civilId }}</td>
                <td class="border border-slate-300 py-3">{{ $employee->fileNo }}</td>
                <td class="border border-slate-300 py-3">
                    <a href="#" class="inline-block px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <button wire:click="confirmDelete('{{ $employee->id }}')"
                        class="inline-block px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                        <i class="fas fa-trash-alt mr-2"></i>Delete
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $employees->links() }}
</div>
<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('showDeleteConfirmation', event => {
            const employeeId = event.detail.employeeId; // Retrieve the employeeId from the event detail
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteEmployee', employeeId);
                }
            });
        });
    });
</script>






{{-- <script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('showDeleteConfirmation', event => {
    alert('Name updated to: ' + event.detail.employeeId);
})
        Livewire.on('showDeleteConfirmation', function (employeeId) {
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteEmployee', employeeId);
                }
            });
        });
    });
</script> --}}