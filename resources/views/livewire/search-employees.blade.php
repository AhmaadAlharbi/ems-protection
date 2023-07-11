<div class="mt-10">
    <div class="flex flex-col justify-center items-center bg-cyan-700 ">
        <label for="search " class="block text-white mt-4">ابحث بكتابة رقم الملف الخاص بالموظف</label>
        <input type="text" wire:model="search" placeholder="Search by employee file No"
            class="px-4 w-1/2 py-2 my-4 text rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <table class="w-full border-collapse border border-slate-400 text-center border-spacing-2 table-auto ">
        <thead>
            <tr>
                <th class="border border-slate-300 py-5">id</th>
                <th class="border border-slate-300 py-5">employee</th>
                <th class="border border-slate-300 py-5">File No</th>
                <th class="border border-slate-300 py-5">date</th>
                <th class="border border-slate-300 py-5">in</th>
                <th class="border border-slate-300 py-5">out</th>
                <th class="border border-slate-300 py-5">added by</th>
                <th class="border border-slate-300 py-5">created at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($takleefs as $takleef)
            <tr>
                <td class="border border-slate-300 py-3">{{$loop->iteration}}</td>
                <td class="border border-slate-300 py-3">{{$takleef->employee->name}}</td>
                <td class="border border-slate-300 py-3">{{$takleef->employee->fileNo}}</td>
                <td class="border border-slate-300 py-3">{{$takleef->date}}</td>
                <td class="border border-slate-300 py-3">{{$takleef->employee_in}}</td>
                <td class="border border-slate-300 ...">{{$takleef->employee_out}}</td>
                <td class="border border-slate-300 py-3">{{$takleef->user->name}}</td>
                <td class="border border-slate-300 py-3">{{$takleef->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $takleefs->links() }}

</div>