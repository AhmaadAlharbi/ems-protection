<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto">
        <form method="POST" action="{{ route('login') }}" class="bg-white rounded-2xl shadow-md overflow-hidden">
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

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Email') }}
                    </label>
                    <div class="relative group">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username"
                            class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border rounded-lg 
                                      focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                                      transition-all duration-300 outline-none
                                      @error('email') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror">
                    </div>
                    @error('email')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Password') }}
                    </label>
                    <div class="relative group">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border rounded-lg 
                                      focus:ring-2 focus:ring-cyan-500 focus:border-transparent 
                                      transition-all duration-300 outline-none
                                      @error('password') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror">
                    </div>
                    @error('password')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-200 text-cyan-500 shadow-sm 
                                      focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-cyan-600 hover:text-cyan-700 
                                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 
                                  transition-colors duration-300">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <button type="submit" class="inline-flex items-center px-8 py-3 rounded-lg text-base font-medium
                                   text-white bg-gradient-to-r from-cyan-500 to-blue-600 
                                   hover:from-cyan-600 hover:to-blue-700 
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 
                                   transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Log in') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>