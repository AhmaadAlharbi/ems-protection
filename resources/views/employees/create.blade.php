<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session()->has('success'))
            <script>
                Swal.fire('Success', '{{ session('success') }}', 'success');
            </script>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-6">
                <div class="bg-white border-l-4 border-red-500 rounded-lg shadow-lg p-5">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="text-red-800 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="relative px-8 py-6 border-b border-gray-100">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="h-16 w-16 bg-cyan-100 rounded-full blur-2xl opacity-60"></div>
                        <div class="h-24 w-24 bg-blue-100 rounded-full blur-3xl opacity-40 -ml-8"></div>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 relative text-center">Add New Employee</h2>
                </div>

                <!-- Form Content -->
                <div class="p-8 relative">
                    <!-- Decorative Elements -->
                    <div
                        class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-cyan-50/50 to-blue-50/50 rounded-bl-full -z-10">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-40 h-40 bg-gradient-to-tr from-blue-50/30 to-cyan-50/30 rounded-tr-full -z-10">
                    </div>

                    <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                        @method('POST')
                        @csrf

                        <!-- Name Input -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name:</label>
                            <div class="relative group">
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border border-gray-200 rounded-lg 
                                              focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                                              transition-all duration-300 outline-none"
                                    placeholder="Enter employee name">
                                <div
                                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 
                                            transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                                </div>
                            </div>
                        </div>

                        <!-- Civil ID Input -->
                        <div>
                            <label for="civilId" class="block text-sm font-medium text-gray-700 mb-2">Civil ID:</label>
                            <div class="relative group">
                                <input type="text" id="civilId" name="civilId" class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border border-gray-200 rounded-lg 
                                              focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                                              transition-all duration-300 outline-none" placeholder="Enter civil ID">
                                <div
                                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 
                                            transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                                </div>
                            </div>
                        </div>

                        <!-- File No Input -->
                        <div>
                            <label for="fileNo" class="block text-sm font-medium text-gray-700 mb-2">File No:</label>
                            <div class="relative group">
                                <input type="text" id="fileNo" name="fileNo" class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border border-gray-200 rounded-lg 
                                              focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                                              transition-all duration-300 outline-none"
                                    placeholder="Enter file number">
                                <div
                                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 
                                            transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                                </div>
                            </div>
                        </div>

                        <!-- Shift Group Input -->
                        <div>
                            <label for="shiftGroup" class="block text-sm font-medium text-gray-700 mb-2">Shift
                                Group:</label>
                            <div class="relative group">
                                <input type="text" id="shiftGroup" name="shiftGroup" class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border border-gray-200 rounded-lg 
                                              focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                                              transition-all duration-300 outline-none"
                                    placeholder="Enter shift group">
                                <div
                                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 
                                            transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-center space-x-4 pt-6">
                            <button type="submit" class="inline-flex items-center px-6 py-3 rounded-lg text-base font-medium
                                           text-white bg-gradient-to-r from-cyan-500 to-blue-600 
                                           hover:from-cyan-600 hover:to-blue-700 
                                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 
                                           transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Submit
                            </button>

                            <a href="{{ route('employees.index') }}" class="inline-flex items-center px-6 py-3 rounded-lg text-base font-medium
                                      text-gray-700 bg-white border border-gray-300
                                      hover:bg-gray-50 hover:text-gray-900
                                      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 
                                      transition-all duration-300 transform hover:-translate-y-0.5 shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>