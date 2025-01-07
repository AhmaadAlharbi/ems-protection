<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Content Container -->
            <div class="space-y-8">
                <!-- Error Messages -->


                <!-- Title Section -->
                <div class="relative">
                    <div class="absolute inset-x-0 top-0 h-48 flex items-center justify-center">
                        <div class="h-24 w-24 bg-cyan-100/50 rounded-full blur-2xl"></div>
                        <div class="h-32 w-32 bg-blue-100/50 rounded-full blur-3xl -ml-12"></div>
                    </div>
                    <h1 class="relative text-4xl font-bold text-center text-gray-900">{{$title}}</h1>
                </div>

                <!-- Form Section -->

                <div class="max-w-md mx-auto">
                    <form action="{{ route('takleef.search', [$month, 'YEAR_PLACEHOLDER']) }}" method="POST"
                        id="searchForm" class="bg-white rounded-2xl shadow-md overflow-hidden">
                        @csrf

                        <!-- Form Content -->
                        <div class="p-8 relative">
                            <!-- Decorative Elements -->
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-cyan-50/50 to-blue-50/50 rounded-bl-full -z-10">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-40 h-40 bg-gradient-to-tr from-blue-50/30 to-cyan-50/30 rounded-tr-full -z-10">
                            </div>

                            <!-- File Number Input -->
                            <div class="mb-6">
                                <label for="fileNo" class="block text-sm font-medium text-gray-700 mb-2">
                                    File No <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <input id="fileNo" type="text" name="fileNo" placeholder="Enter file no"
                                        value="{{ old('fileNo') }}" class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border rounded-lg 
                      focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                      transition-all duration-300 outline-none
                      @error('fileNo') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror">
                                </div>
                                @error('fileNo')
                                <div class="mt-1 flex items-center text-sm text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Civil ID Input -->
                            <div class="mb-6">
                                <label for="civilId" class="block text-sm font-medium text-gray-700 mb-2">
                                    Civil ID <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <input id="civilId" type="text" name="civilId" placeholder="Enter civil id"
                                        value="{{ old('civilId') }}" class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border rounded-lg 
                      focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                      transition-all duration-300 outline-none
                      @error('civilId') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror">
                                </div>
                                @error('civilId')
                                <div class="mt-1 flex items-center text-sm text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Year Selection -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Select Year <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @php
                                    $currentYear = date('Y');
                                    $years = range(2024, $currentYear);
                                    @endphp
                                    @foreach ($years as $year)
                                    <div class="relative">
                                        <input type="radio" id="year{{ $year }}" name="year" value="{{ $year }}"
                                            class="peer hidden">
                                        <label for="year{{ $year }}" class="flex items-center justify-center min-w-[90px] py-2.5 px-4 
                          text-sm border rounded-lg cursor-pointer
                          transition-all duration-300 hover:bg-gray-50
                          peer-checked:bg-gradient-to-r peer-checked:from-cyan-500 peer-checked:to-blue-500 
                          peer-checked:text-white peer-checked:border-transparent
                          peer-checked:hover:from-cyan-600 peer-checked:hover:to-blue-600
                          peer-checked:shadow-md
                          @error('year') border-red-500 @else border-gray-200 @enderror">
                                            {{ $year }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('year')
                                <div class="mt-2 flex items-center text-sm text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-center">
                                <button type="submit" class="inline-flex items-center px-8 py-3 rounded-lg text-base font-medium
                                               text-white bg-gradient-to-r from-cyan-500 to-blue-600 
                                               hover:from-cyan-600 hover:to-blue-700 
                                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 
                                               transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="max-w-md mx-auto mt-8">
                    <a href="{{route('employees.create')}}" class="
                           w-full
                           flex
                           items-center
                           justify-center
                           px-8
                           py-3
                           rounded-lg
                           text-base
                           font-medium
                           text-white
                           bg-gradient-to-r
                           from-cyan-500
                           to-blue-600
                           hover:from-cyan-600
                           hover:to-blue-700
                           focus:outline-none
                           focus:ring-2
                           focus:ring-offset-2
                           focus:ring-cyan-500
                           transition-all
                           duration-300
                           transform
                           hover:-translate-y-0.5
                           shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="mr-1">Add new employee</span>
                        <span class="text-gray-100">- اضافة موظف</span>
                    </a>
                </div>
                <!-- Livewire Component -->
                <div class="mt-12">
                    <livewire:search-takleef :month="$month" />
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('searchForm');
            const yearInputs = document.querySelectorAll('input[name="year"]');
            
            yearInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const selectedYear = this.value;
                    const action = "{{ route('takleef.search', [$month, 'YEAR_PLACEHOLDER']) }}"
                        .replace('YEAR_PLACEHOLDER', selectedYear);
                    form.action = action;
                });
            });
        });
    </script>
</x-app-layout>