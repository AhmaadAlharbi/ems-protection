<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <table
                        class="w-full border-collapse border border-slate-400 text-center border-spacing-2 table-auto ">
                        <div class="text-center my-4">
                            <h1 class="text-lg text-blue-400">عدد إجمالي الأذونات لهذا الشهر هو: {{$permissionCount}}
                            </h1>
                            <h1 class="text-lg text-blue-600">Total counts of Permissions for this month is:
                                {{$permissionCount}}</h1>
                        </div>
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
                                        href="{{route('permission.show',$permission)}}">{{$permission->employee->name}}</a>
                                </td>
                                <td class="border border-slate-300 py-3">{{$permission->employee->fileNo}}</td>
                                <td class="border border-slate-300 py-3">{{$permission->date}}</td>
                                <td class="border border-slate-300 ...">{{$permission->time}}</td>
                                <td class="border border-slate-300 py-3">{{$permission->status}}</td>
                                <td class="border border-slate-300 py-3">{{$permission->created_at->format('Y-m-d') }}
                                </td>
                                <td class="border border-slate-300 py-3">
                                    <a href="{{route('permission.edit',$permission->id)}}"
                                        class="inline-block px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                    <button wire:click="confirmDelete('{{ $permission->id }}')"
                                        class="inline-block px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $permissions->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>