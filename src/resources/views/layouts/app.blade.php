{{-- ====================================================================
    VISTA: Layout Principal (app.blade.php)
    Descripción: Estructura HTML base para todas las páginas autenticadas.
                 Incluye el nav, el encabezado de página y el contenido.
                 Se usa con el componente <x-app-layout>.
======================================================================== --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Título de la página (se puede cambiar desde cada vista) --}}
        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- Fuentes de Google (Figtree) --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Archivos CSS y JS compilados por Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            {{-- Barra de navegación principal --}}
            @include('layouts.navigation')

            {{-- Encabezado de la página (opcional, se define desde cada vista) --}}
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Contenido principal de la página --}}
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
