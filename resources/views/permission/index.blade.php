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
                    <a class=" bg-blue-500 text-white font-bold py-2 px-4 rounded-md"
                        href="{{route('permission.create')}}">add permission</a>

                    <a class=" bg-yellow-500 text-dark font-bold py-2 px-4 rounded-md"
                        href="{{route('permission.create')}}">check permission</a>
                    <livewire:search-permission />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>