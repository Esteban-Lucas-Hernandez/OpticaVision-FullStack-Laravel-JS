<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel' }} — {{ config('app.name', 'Óptica Vision') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans bg-brand-light min-h-screen" x-data="{ sidebarOpen: false }">

    {{-- Overlay móvil --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
         x-cloak></div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-brand-light shadow-card transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 h-16 border-b border-brand-light shrink-0">
            <div class="w-9 h-9 rounded-lg bg-brand flex items-center justify-center text-white">
                <i class="fas fa-glasses text-sm"></i>
            </div>
            <div>
                <p class="font-display font-bold text-gray-900 leading-tight">Óptica Vision</p>
                <p class="text-xs text-gray-500">
                    @if(Auth::user()->rol === 'admin')
                        Administrador
                    @else
                        Vendedor
                    @endif
                </p>
            </div>
        </div>

        {{-- Nav links --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
            <a href="/"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-brand-light hover:text-brand-dark transition-colors">
                <i class="fas fa-store w-5 text-center"></i>
                Vista pública
            </a>

            @if(Auth::user()->rol === 'admin')
                <a href="{{ route('admin.usuarios') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.usuarios') ? 'bg-brand text-white shadow-sm' : 'text-gray-600 hover:bg-brand-light hover:text-brand-dark' }}">
                    <i class="fas fa-users w-5 text-center"></i>
                    Gestionar usuarios
                </a>
                <a href="{{ route('admin.purchases.history') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.purchases.*') ? 'bg-brand text-white shadow-sm' : 'text-gray-600 hover:bg-brand-light hover:text-brand-dark' }}">
                    <i class="fas fa-history w-5 text-center"></i>
                    Historial de compras
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand text-white shadow-sm' : 'text-gray-600 hover:bg-brand-light hover:text-brand-dark' }}">
                    <i class="fas fa-plus-circle w-5 text-center"></i>
                    Crear producto
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-brand text-white shadow-sm' : 'text-gray-600 hover:bg-brand-light hover:text-brand-dark' }}">
                    <i class="fas fa-box w-5 text-center"></i>
                    Gestionar productos
                </a>
                <a href="{{ route('seller.purchases') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('seller.*') ? 'bg-brand text-white shadow-sm' : 'text-gray-600 hover:bg-brand-light hover:text-brand-dark' }}">
                    <i class="fas fa-shopping-cart w-5 text-center"></i>
                    Historial de compras
                </a>
            @endif

            <div class="pt-4 mt-4 border-t border-gray-100">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-brand-light hover:text-brand-dark transition-colors">
                    <i class="fas fa-user-cog w-5 text-center"></i>
                    Mi perfil
                </a>
            </div>
        </nav>

        {{-- User footer --}}
        <div class="px-4 py-4 border-t border-brand-light shrink-0">
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-brand-light flex items-center justify-center text-brand">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="lg:pl-72 min-h-screen flex flex-col">

        {{-- Top bar móvil --}}
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-brand-light lg:hidden">
            <div class="flex items-center justify-between px-4 h-14">
                <button @click="sidebarOpen = true" class="p-2 rounded-lg text-gray-600 hover:bg-brand-light transition-colors" aria-label="Abrir menú">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <p class="font-display font-semibold text-gray-900 text-sm">{{ $title ?? 'Panel' }}</p>
                <div class="w-10"></div>
            </div>
        </header>

        {{-- Page header --}}
        @isset($header)
        <header class="hidden lg:block bg-white border-b border-brand-light">
            <div class="max-w-7xl mx-auto px-6 py-5">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
    <style>[x-cloak] { display: none !important; }</style>
</body>
</html>
