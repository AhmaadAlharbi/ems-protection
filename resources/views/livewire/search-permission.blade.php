<div class="mt-10">
    <div class="flex flex-col justify-center items-center bg-cyan-700 ">
        <label for="search " class="block text-white mt-4">ابحث بكتابة رقم الملف الخاص بالموظف</label>
        <input type="text" wire:model="search" wire:bounce="updatedSearch" placeholder="Search by employee file No"
            class="px-4 w-1/2 py-2 my-4 text rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

    </div>
    <!-- Display the success message if it exists in the session -->
    @if (session()->has('success'))
    <script>
        Swal.fire('Success', '{{ session('success') }}', 'success');
    </script>
    @endif
    <div class="flex items-center space-x-5">


        @php
        $currentMonth = date('n'); // Get the current month (without leading zeros)
        @endphp

        <select wire:model="selectedMonth" name="month" id="month"
            class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 my-4">
            <option value="{{ $currentMonth }}">Current Month : {{ $currentMonth == 7 ? 'July' : $currentMonth }}
            </option>
            @foreach (range(1, 12) as $monthNumber)
            <option value="{{ $monthNumber }}" {{ $monthNumber==$currentMonth ? 'selected' : '' }}>
                {{ $monthNumber == 7 ? 'July' : date('F', mktime(0, 0, 0, $monthNumber, 1)) }}
            </option>
            @endforeach
        </select>




        {{-- <select name="year" id="year"
            class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
            @php
            $currentYear = date('Y');
            $previousYear = $currentYear - 1;
            @endphp

            <option value="{{ $currentYear }}">{{ $currentYear }}</option>
            <option value="{{ $previousYear }}">{{ $previousYear }}</option>
        </select> --}}

    </div>


    <table class="w-full border-collapse border border-slate-400 text-center border-spacing-2 table-auto ">
        <thead>
            <tr>
                <th class="border border-slate-300 py-5">id</th>
                <th class="border border-slate-300 py-5">employee</th>
                <th class="border border-slate-300 py-5">File No</th>
                <th class="border border-slate-300 py-5">date</th>
                <th class="border border-slate-300 py-5">time</th>
                <th class="border border-slate-300 py-5">status</th>
                <th class="border border-slate-300 py-5">created at</th>
                <th class="border border-slate-300 py-5">Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td class="border border-slate-300 py-3">{{$loop->iteration}}</td>
                <td class="border border-slate-300 py-3"><a class="text-blue-400 text-sm font-bold"
                        href="{{route('permission.show',$permission)}}">{{$permission->employee->name}}</a></td>
                <td class="border border-slate-300 py-3">{{$permission->employee->fileNo}}</td>
                <td class="border border-slate-300 py-3">{{$permission->date}}</td>
                <td class="border border-slate-300 ...">{{$permission->time}}</td>
                <td class="border border-slate-300 py-3">{{$permission->status}}</td>
                <td class="border border-slate-300 py-3">{{$permission->created_at->format('Y-m-d') }}</td>
                <td class="border border-slate-300 py-3 text-center">
                    <a href="{{ route('showPermissionPdf', $permission->id) }}"
                        class="inline-block px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                        <i class="fas fa-file-pdf text-white mr-2"></i>
                    </a>

                    <a href="{{route('permission.edit',$permission->id)}}"
                        class="inline-block px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        <i class="fas fa-edit mr-2"></i>
                    </a>


                    <button wire:click="confirmDelete('{{ $permission->id }}')"
                        class="inline-block px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                        <i class="fas fa-trash-alt mr-2"></i>
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $permissions->links() }}

</div>
<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('showDeleteConfirmation', event => {
            const permission_id = event.detail.permission_id; // Retrieve the employeeId from the event detail
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
                    Livewire.emit('deletePermission', permission_id);
                }
            });
        });
    });
</script>