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
                    @if (session()->has('success'))
                    <script>
                        Swal.fire('success', '{{ session('success') }}', 'success');
                    </script>
                    @endif
                    <a href="{{ route('export') }}">Export to Excel</a>

                    <h1 class="text-3xl text-center my-6">تكاليف عمل قسم الوقاية</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @for ($i = 1; $i <= 12; $i++) <a href="/search/{{$i}}"
                            class="text-white bg-cyan-600 hover:bg-cyan-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            {{ Carbon\Carbon::parse("2023-$i")->translatedFormat('F') }}
                            </a>
                            @endfor

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>