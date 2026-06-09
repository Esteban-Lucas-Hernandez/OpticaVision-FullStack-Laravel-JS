<x-guest-layout>
    {{-- ===== BANNER DE DEMO ===== --}}
    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; text-align: center; padding: 14px 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(217,119,6,0.3);">
        <p style="font-size: 1rem; font-weight: 600; margin-bottom: 6px;">
            🚧 ¡Esta es solo una Demo del Proyecto!
        </p>
        <p style="font-size: 0.875rem; opacity: 0.95; margin-bottom: 10px;">
            Para explorar el sistema completo con todas sus funciones, puedes clonar el repositorio.
        </p>
        <a href="https://github.com/Esteban-Lucas-Hernandez/OpticaVision-FullStack-Laravel-JS"
           target="_blank"
           style="display: inline-block; background: white; color: #92400e; font-weight: 700; font-size: 0.85rem; padding: 6px 18px; border-radius: 8px; text-decoration: none; transition: all 0.2s;"
           onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <svg style="display: inline; width: 16px; height: 16px; vertical-align: middle; margin-right: 5px;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.385-1.335-1.755-1.335-1.755-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 21.795 24 17.295 24 12c0-6.63-5.37-12-12-12z"/></svg>
            Clonar desde GitHub
        </a>
    </div>
    {{-- ===== FIN BANNER DEMO ===== --}}

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center relative">
                    <div class="absolute inset-0 bg-black opacity-0 hover:opacity-5 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="mx-auto bg-white/20 backdrop-blur-sm rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-white">Welcome Back</h1>
                        <p class="text-blue-200 mt-2">Sign in to continue to your account</p>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium mb-2" />
                                <div class="mt-1 relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="email" 
                                                class="block w-full pl-10 pr-3 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" 
                                                type="email" 
                                                name="email" 
                                                :value="old('email')" 
                                                required 
                                                autofocus 
                                                autocomplete="username" 
                                                placeholder="your@email.com" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium mb-2" />
                                <div class="mt-1 relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-text-input id="password" 
                                                class="block w-full pl-10 pr-3 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" 
                                                type="password" 
                                                name="password" 
                                                required 
                                                autocomplete="current-password" 
                                                placeholder="••••••••" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            
                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200 cursor-pointer" name="remember">
                                    <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                    <a class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            
                            <!-- Login Button -->
                            <div>
                                <x-primary-button class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5">
                                    {{ __('Sign In') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Registration Link -->
                    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    {{ __('Sign up') }}
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>