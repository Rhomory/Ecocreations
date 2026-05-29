<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'ECOCREATIONS'))</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,700&family=Inter+Tight:wght@400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap"
        rel="stylesheet">

    {{-- Vite: SCSS y JS --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>

    {{-- Navbar (se oculta si la pantalla define $hideNav = true) --}}
    @unless ($hideNav ?? false)
        @include('partials.navbar')
    @endunless

    {{-- Contenido --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer (se oculta si la pantalla define $hideFooter = true) --}}
    @unless ($hideFooter ?? false)
        @include('partials.footer')
    @endunless

    {{-- Modal de auth eliminado (ahora usa vista de login separada) --}}

    {{-- Loader de transición entre páginas --}}
    <x-page-loader />

    @stack('scripts')
</body>

</html>
