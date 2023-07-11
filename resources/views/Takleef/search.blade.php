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
                    <h1 class="text-center mt-4">{{$title}}</h1>

                    <form action="{{ route('takleef.search', $month) }}" method="POST" class="w-full">

                        @csrf
                        <div class="flex justify-around items-center   py-2">
                            <input
                                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-2 px-2 leading-tight focus:outline-none"
                                type="text" name="fileNo" placeholder="Enter file no">
                            <input
                                class="appearance-none bg-gray-100  border-none w-full text-gray-700 mr-3 py-2 px-2 leading-tight focus:outline-none"
                                type="text" name="civilid" placeholder="Enter civil id">
                            <button
                                class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded"
                                type="submit">
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>