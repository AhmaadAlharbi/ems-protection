<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main Container -->
    <div class="min-h-screen bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with Modern Design -->
            <div class="relative mb-20">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-16 w-16 bg-cyan-100 rounded-full blur-2xl opacity-60"></div>
                    <div class="h-24 w-24 bg-blue-100 rounded-full blur-3xl opacity-40 -ml-8"></div>
                </div>

            </div>

            <!-- Innovative Months Layout -->
            <div class="relative">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 pointer-events-none">
                    <div class="blur-[106px] h-56 bg-gradient-to-br from-cyan-100 to-purple-100"></div>
                    <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-100 to-sky-100"></div>
                </div>

                <!-- Months Container -->
                <div class="relative grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    @for ($i = 1; $i <= 12; $i++) <a href="/search/{{$i}}" class="group">
                        <div
                            class="relative bg-white p-6 rounded-2xl shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                            <!-- Decorative Corner -->
                            <div
                                class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-cyan-50 to-sky-50 rounded-tr-2xl rounded-bl-full -z-10">
                            </div>

                            <!-- Month Content -->
                            <div class="flex items-center gap-4">
                                <!-- Month Number -->
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-gradient-to-br from-cyan-500 to-blue-600 text-white rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-2xl font-bold">{{$i}}</span>
                                </div>

                                <!-- Month Details -->
                                <div class="flex flex-col">
                                    <span class="text-xl font-semibold text-gray-800">
                                        {{ Carbon\Carbon::parse("2023-$i")->translatedFormat('F') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Hover Indicator -->
                            <div
                                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                            </div>
                        </div>
                        </a>
                        @endfor
                </div>
            </div>

            <!-- Success Toast -->
            @if (session()->has('success'))
            <div id="toast-success"
                class="fixed bottom-5 right-5 flex items-center p-4 bg-white rounded-xl shadow-lg border-l-4 border-green-500 transform transition-all duration-300">
                <div
                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-green-100 text-green-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="mr-3 text-sm font-medium text-gray-800">{{ session('success') }}</div>
                <button onclick="this.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </div>

    <script>
        const toast = document.getElementById('toast-success');
    if (toast) {
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
    </script>
</x-app-layout>