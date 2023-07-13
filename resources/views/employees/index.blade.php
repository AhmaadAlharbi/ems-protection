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
                    <a href="{{route('employees.create')}}"
                        class="my-5 px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded-full focus:outline-none focus:shadow-outline">
                        <i class="fas fa-plus mr-2"></i>
                        Add new employee - اضافة موظف
                    </a>
                    @livewire('search-employees')


                </div>
            </div>
        </div>
    </div>
</x-app-layout>