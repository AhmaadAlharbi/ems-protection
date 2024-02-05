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
                    @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 mb-4 rounded">
                        <ul>
                            <li>Please enter either the civil ID or the employee file number.</li>
                            <li>يرجى إدخال الرقم المدني أو رقم الملف الخاص بالموظف.</li>
                        </ul>
                    </div>
                    @endif


                    <h1 class="text-center mt-4">{{$title}}</h1>


                    <form action="{{ route('takleef.search', $month) }}" method="POST"
                        class="w-full max-w-md mx-auto mt-5">
                        @csrf

                        <div class="bg-white rounded shadow-md p-6">
                            <div class="mb-4">
                                <label for="fileNo" class="block text-gray-700 font-bold mb-2">File No:</label>
                                <input id="fileNo"
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                                    type="text" name="fileNo" placeholder="Enter file no">
                                @if ($errors->has('fileNo'))
                                <span class="text-red-500 text-sm">{{ $errors->first('fileNo') }}</span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label for="civilId" class="block text-gray-700 font-bold mb-2">Civil ID:</label>
                                <input id="civilId"
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                                    type="text" name="civilId" placeholder="Enter civil id">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Select Year:</label>
                                <div class="flex items-center">
                                    <input type="radio" id="year2023" name="year" value="2023" class="mr-2">
                                    <label for="year2023">2023</label>

                                    <input type="radio" id="year2024" name="year" value="2024" class="ml-4 mr-2">
                                    <label for="year2024">2024</label>

                                </div>
                                @if ($errors->has('year'))
                                <span class="text-red-500 text-sm">{{ $errors->first('year') }}</span>
                                @endif
                            </div>

                            <div class="flex items-center">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none"
                                    type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>


                    <livewire:search-takleef :month="$month" />

                </div>
            </div>
        </div>
    </div>
</x-app-layout>