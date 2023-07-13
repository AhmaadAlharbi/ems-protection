<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
            <script>
                Swal.fire('Success', '{{ session('success') }}', 'success');
            </script>
            @endif
            @if ($errors->any())

            <div class="p-4 text-white bg-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="my-1">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('employees.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="name">Name:</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" name="name" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="civilId">Civil ID:</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="civilId" name="civilId" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="fileNo">File No:</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="fileNo" name="fileNo" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="shiftGroup">Shift Group:</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="shiftGroup" name="shiftGroup" type="text">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-full focus:outline-none focus:shadow-outline">
                                <i class="fas fa-check-circle mr-2"></i>
                                Submit
                            </button>
                            <a href="{{ route('employees.index') }}"
                                class="flex items-center justify-center px-4 py-2 ml-3 bg-white border border-blue-400 text-black font-bold rounded-full focus:outline-none focus:shadow-outline">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back
                            </a>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>