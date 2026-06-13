<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gradient-to-br from-[#f0fdf4] to-[#86efac]">


    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#f0fdf4] to-[#86efac] p-4 sm:p-8">
        <div class="w-full max-w-5xl flex rounded-[2rem] shadow-2xl overflow-hidden bg-white transform transition-all duration-500 hover:shadow-[0_25px_50px_-12px_rgba(5,150,105,0.25)]">
            
            <!-- Left Side: Branding -->
            <div class="hidden lg:flex lg:w-5/12 bg-gradient-to-br from-[#059669] to-[#047857] p-12 flex-col justify-center relative overflow-hidden text-white">
                <!-- decorative background shapes -->
                <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-white opacity-10 rounded-full translate-x-1/3 translate-y-1/3"></div>
                <div class="absolute top-1/2 right-0 w-32 h-32 bg-[#f0fdf4] opacity-10 rounded-full translate-x-1/2 -translate-y-1/2 blur-2xl"></div>
                
                <div class="relative z-10 text-center flex flex-col items-center">
                    <!-- glasses logo -->
                    <div class="bg-white/20 p-5 rounded-full backdrop-blur-sm mb-8 shadow-lg">
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="6" cy="15" r="4"></circle>
                            <circle cx="18" cy="15" r="4"></circle>
                            <path d="M14 15a2 2 0 0 0-4 0"></path>
                            <path d="M2.5 13L5 7c.7-1.3 1.4-2 3-2"></path>
                            <path d="M21.5 13L19 7c-.7-1.3-1.5-2-3-2"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-4xl font-extrabold mb-4 tracking-tight">Óptica Vision Perfecta</h2>
                    <p class="text-lg text-green-100 font-medium leading-relaxed max-w-xs mx-auto">
                        Especialistas en salud visual. Ofrecemos soluciones ópticas personalizadas con la más alta tecnología.
                    </p>
                    
                    <!-- Decorative dots -->
                    <div class="flex space-x-2 mt-12">
                        <div class="w-3 h-3 bg-white rounded-full opacity-100"></div>
                        <div class="w-3 h-3 bg-white rounded-full opacity-50"></div>
                        <div class="w-3 h-3 bg-white rounded-full opacity-50"></div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="w-full lg:w-7/12 p-10 sm:p-14 md:p-16 flex flex-col justify-center bg-white relative">
                
                <!-- Mobile Logo (shows only on small screens) -->
                <div class="lg:hidden flex justify-center mb-8">
                    <div class="bg-[#059669]/10 p-4 rounded-full text-[#059669]">
                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="6" cy="15" r="4"></circle>
                            <circle cx="18" cy="15" r="4"></circle>
                            <path d="M14 15a2 2 0 0 0-4 0"></path>
                            <path d="M2.5 13L5 7c.7-1.3 1.4-2 3-2"></path>
                            <path d="M21.5 13L19 7c-.7-1.3-1.5-2-3-2"></path>
                        </svg>
                    </div>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#14532d] mb-3">Bienvenido de nuevo</h1>
                    <p class="text-gray-500 text-lg">Ingresa a tu cuenta para continuar</p>
                </div>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-[#14532d] mb-2 uppercase tracking-wide">Correo Electrónico</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#059669] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email" 
                                          class="block w-full pl-12 pr-4 py-4 border-2 border-gray-100 rounded-xl focus:ring-0 focus:border-[#059669] transition-all bg-gray-50 text-gray-800 text-lg shadow-sm hover:border-gray-200" 
                                          type="email" 
                                          name="email" 
                                          :value="old('email')" 
                                          required 
                                          autofocus 
                                          autocomplete="username" 
                                          placeholder="tu@correo.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-[#14532d] mb-2 uppercase tracking-wide">Contraseña</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#059669] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password" 
                                          class="block w-full pl-12 pr-4 py-4 border-2 border-gray-100 rounded-xl focus:ring-0 focus:border-[#059669] transition-all bg-gray-50 text-gray-800 text-lg shadow-sm hover:border-gray-200" 
                                          type="password" 
                                          name="password" 
                                          required 
                                          autocomplete="current-password" 
                                          placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" class="h-5 w-5 text-[#059669] focus:ring-[#059669] border-gray-300 rounded cursor-pointer transition-colors" name="remember">
                            <label for="remember_me" class="ml-2 block text-sm font-medium text-gray-600 cursor-pointer">
                                Recordarme
                            </label>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <a class="text-sm font-bold text-[#059669] hover:text-[#047857] transition-colors" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>
                    
                    <!-- Login Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-xl shadow-[0_10px_20px_rgba(5,150,105,0.3)] text-white bg-[#059669] hover:bg-[#047857] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#059669] transition-all transform hover:-translate-y-1 text-lg font-bold tracking-wide">
                            Ingresar
                            <svg class="ml-2 -mr-1 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>
                
                <!-- Registration Link -->
                <div class="mt-12 text-center border-t border-gray-100 pt-8">
                    <p class="text-base text-gray-600">
                        ¿No tienes una cuenta?
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-bold text-[#059669] hover:text-[#047857] transition-colors ml-1">
                                Regístrate aquí
                            </a>
                        @endif
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>