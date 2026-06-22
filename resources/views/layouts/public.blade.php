<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Óptica Vision' }}</title>
    <meta name="description" content="Óptica Vision - Especialistas en salud visual.">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    @stack('styles')
</head>
<body>
    @include('partials.public-nav')

    <div style="padding-top: var(--nav-height);">
        {{ $slot }}
    </div>

    @include('partials.public-footer')

    @stack('scripts')
</body>
</html>
