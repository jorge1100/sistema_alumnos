<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DocentesAlumnos — UTN Programación IV</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Gradiente animado de fondo */
        .hero-bg {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
        }
        /* Card hover effect */
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="antialiased bg-slate-50">

    <!-- Navbar transparente -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                        DA
                    </div>
                    <span class="text-xl font-bold text-slate-800 tracking-tight">DocentesAlumnos</span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-medium transition">Panel</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-slate-600 hover:text-red-600 font-medium transition">Salir</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium transition">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-md hover:shadow-lg">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-bg relative overflow-hidden">
        <!-- Decoración de fondo -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full mix-blend-overlay filter blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-indigo-400 rounded-full mix-blend-overlay filter blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center lg:text-left lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-1.5 mb-6">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-indigo-100 text-sm font-medium">UTN — Programación IV</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                        Gestión de<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-200 to-white">Docentes y Alumnos</span>
                    </h1>

                    <p class="mt-6 text-lg text-indigo-100 max-w-2xl leading-relaxed">
                        Sistema web desarrollado con <strong>Laravel 13</strong> y <strong>MySQL</strong>.
                        Registrate como alumno con tu foto de perfil, o accedé como docente para gestionar
                        el listado completo de usuarios.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl hover:bg-indigo-50 transition shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                Registrarse como Alumno
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-indigo-500/30 backdrop-blur-sm border border-indigo-300/30 text-white font-semibold rounded-xl hover:bg-indigo-500/50 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                                Iniciar sesión
                            </a>
                        @endguest
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl hover:bg-indigo-50 transition shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Ir al Dashboard
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Ilustración / Card flotante -->
                <div class="hidden lg:block relative">
                    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-white font-bold text-lg">Panel de Docentes</p>
                                <p class="text-indigo-200 text-sm">Gestión completa de alumnos</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 bg-white/10 rounded-xl p-3">
                                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-indigo-100 text-sm">Listado de usuarios</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 rounded-xl p-3">
                                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-indigo-100 text-sm">Detalle con foto y contacto</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 rounded-xl p-3">
                                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-indigo-100 text-sm">WhatsApp integrado</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats bar -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-3xl font-bold text-indigo-600">Laravel 13</p>
                    <p class="text-sm text-slate-500 mt-1">Framework PHP</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-indigo-600">MySQL</p>
                    <p class="text-sm text-slate-500 mt-1">Base de datos</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-indigo-600">Blade</p>
                    <p class="text-sm text-slate-500 mt-1">Motor de vistas</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-indigo-600">Tailwind</p>
                    <p class="text-sm text-slate-500 mt-1">Estilos CSS</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm mb-2">Funcionalidades</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-slate-900">Todo lo que necesitás</p>
                <p class="mt-4 text-lg text-slate-600">Sistema completo de gestión con roles, perfiles y contacto directo.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="feature-card bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Autenticación</h3>
                    <p class="text-slate-500 leading-relaxed">Registro y login con validación de datos, recuperación de contraseña y verificación de email.</p>
                </div>

                <!-- Card 2 -->
                <div class="feature-card bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Foto de Perfil</h3>
                    <p class="text-slate-500 leading-relaxed">Subí tu foto al registrarte. Visible en tu perfil y en el listado del docente.</p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">WhatsApp</h3>
                    <p class="text-slate-500 leading-relaxed">Hacé clic en el teléfono de cualquier alumno para abrir WhatsApp directamente.</p>
                </div>

                <!-- Card 4 -->
                <div class="feature-card bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Red Profesional</h3>
                    <p class="text-slate-500 leading-relaxed">Agregá tu LinkedIn o GitHub. El docente puede acceder desde tu perfil.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Roles Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm mb-2">Roles del Sistema</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-slate-900">Dos perfiles, un objetivo</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Docente -->
                <div class="relative bg-gradient-to-br from-indigo-50 to-white rounded-3xl p-8 border border-indigo-100">
                    <div class="absolute -top-4 left-8 bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg">
                        DOCENTE
                    </div>
                    <div class="mt-4">
                        <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Panel de Administración</h3>
                        <ul class="space-y-3 text-slate-600">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Ver listado completo de alumnos registrados
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Acceder al detalle de cada usuario
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Contactar por WhatsApp con un clic
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Acceder a redes profesionales
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Alumno -->
                <div class="relative bg-gradient-to-br from-emerald-50 to-white rounded-3xl p-8 border border-emerald-100">
                    <div class="absolute -top-4 left-8 bg-emerald-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg">
                        ALUMNO
                    </div>
                    <div class="mt-4">
                        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Perfil Personal</h3>
                        <ul class="space-y-3 text-slate-600">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Registrarte con foto de perfil obligatoria
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Editar tu información personal
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Agregar teléfono y red profesional
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Solo vos podés ver y editar tu perfil
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-900 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¿Listo para empezar?</h2>
            <p class="text-indigo-200 text-lg mb-8">Registrate como alumno o iniciá sesión como docente para probar el sistema.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-900 font-bold rounded-xl hover:bg-indigo-50 transition shadow-xl">
                        Crear cuenta de Alumno
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-indigo-700 text-white font-semibold rounded-xl hover:bg-indigo-600 transition border border-indigo-500">
                        Iniciar sesión
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-900 font-bold rounded-xl hover:bg-indigo-50 transition shadow-xl">
                        Ir al Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white text-sm font-bold">DA</div>
                    <span class="text-slate-300 font-semibold">DocentesAlumnos</span>
                </div>
                <p class="text-slate-500 text-sm text-center">
                    UTN — Técnicatura Universitaria en Programación · Programación IV · 2026
                </p>
                <div class="flex items-center gap-2 text-slate-500 text-sm">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    Laravel 13 · MySQL · Tailwind CSS
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
