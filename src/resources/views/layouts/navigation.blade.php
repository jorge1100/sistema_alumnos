{{-- ====================================================================
    VISTA: Navegación Principal (navigation.blade.php)
    Incluida en: layouts/app.blade.php via @include
    Descripción: Barra de navegación superior con logo, links de
                 navegación, dropdown de usuario y menú responsive.
                 Los links cambian según el rol (admin vs alumno).
======================================================================== --}}

<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm">
    {{-- ================================================================
        BARRA DE NAVEGACIÓN PRINCIPAL (Desktop)
    ================================================================= --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- ========================================================
                SECCIÓN IZQUIERDA: Logo + Links de navegación
            ============================================================== --}}
            <div class="flex items-center">

                {{-- Logo de la aplicación --}}
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                        <div class="w-9 h-9 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md group-hover:shadow-lg transition-all">
                            DA
                        </div>
                        <span class="hidden sm:block text-lg font-bold text-slate-800 tracking-tight">DocentesAlumnos</span>
                    </a>
                </div>

                {{-- Links de navegación (desktop) --}}
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex items-center">

                    {{-- Link: Dashboard (visible para todos los usuarios) --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg px-3 py-2">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        {{ __('Panel') }}
                    </x-nav-link>

                    {{-- Links según el rol del usuario --}}
                    @auth
                        @if (auth()->user()->isAdmin())
                            {{-- Link: Alumnos (solo docentes) --}}
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="rounded-lg px-3 py-2">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                {{ __('Alumnos') }}
                            </x-nav-link>

                            {{-- Link: Docentes (solo docentes) --}}
                            <x-nav-link :href="route('admin.admins.index')" :active="request()->routeIs('admin.admins.*')" class="rounded-lg px-3 py-2">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                {{ __('Docentes') }}
                            </x-nav-link>
                        @else
                            {{-- Link: Mi Perfil (solo alumnos) --}}
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" class="rounded-lg px-3 py-2">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ __('Mi Perfil') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- ========================================================
                SECCIÓN DERECHA: Badge de rol + Dropdown del usuario
            ============================================================== --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="flex items-center gap-3">

                        {{-- Badge que indica el rol del usuario --}}
                        @if (auth()->user()->isAdmin())
                            <span class="hidden md:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Docente
                            </span>
                        @else
                            <span class="hidden md:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 01.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"/></svg>
                                Alumno
                            </span>
                        @endif

                        {{-- Dropdown del usuario --}}
                        <x-dropdown align="right" width="56">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center gap-2 px-3 py-2 border border-slate-200 text-sm leading-4 font-medium rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 focus:outline-none transition-all shadow-sm">
                                    <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="" class="w-7 h-7 rounded-full object-cover border border-slate-200">
                                    <div class="flex flex-col items-start">
                                        <span class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                                        <span class="text-xs text-slate-500">{{ Auth::user()->email }}</span>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                {{-- Encabezado del dropdown --}}
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-xs text-slate-500">Conectado como</p>
                                    <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                                </div>

                                {{-- Link: Mi perfil --}}
                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    {{ __('Mi Perfil') }}
                                </x-dropdown-link>

                                {{-- Links exclusivos para admin --}}
                                @if (auth()->user()->isAdmin())
                                    <x-dropdown-link :href="route('admin.users.index')" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        {{ __('Ver Alumnos') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('admin.admins.index')" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        {{ __('Gestionar Docentes') }}
                                    </x-dropdown-link>
                                @endif

                                {{-- Botón: Cerrar sesión --}}
                                <div class="border-t border-slate-100 mt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 text-red-600 hover:text-red-700 hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            {{ __('Cerrar sesión') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    {{-- Links para usuarios no logueados --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm transition">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition shadow-sm">Registrarse</a>
                    </div>
                @endauth
            </div>

            {{-- ========================================================
                BOTÓN HAMBURGUESA (Mobile)
                Alterna la visualización del menú responsive.
            ============================================================== --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ================================================================
        MENÚ RESPONSIVE (Mobile)
        Se muestra/oculta al hacer clic en la hamburguesa.
    ================================================================= --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-100">

        {{-- Links de navegación móvil --}}
        <div class="pt-2 pb-3 space-y-1">
            {{-- Dashboard --}}
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                {{ __('Panel') }}
            </x-responsive-nav-link>

            @auth
                @if (auth()->user()->isAdmin())
                    {{-- Alumnos (solo admin) --}}
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        {{ __('Alumnos') }}
                    </x-responsive-nav-link>

                    {{-- Docentes (solo admin) --}}
                    <x-responsive-nav-link :href="route('admin.admins.index')" :active="request()->routeIs('admin.admins.*')" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        {{ __('Docentes') }}
                    </x-responsive-nav-link>
                @else
                    {{-- Mi Perfil (solo alumnos) --}}
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ __('Mi Perfil') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        {{-- Perfil del usuario + cerrar sesión (móvil) --}}
        @auth
            <div class="pt-4 pb-1 border-t border-slate-100">
                {{-- Info del usuario --}}
                <div class="px-4 flex items-center gap-3">
                    <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                    <div>
                        <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                {{-- Acciones del usuario --}}
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ __('Mi Perfil') }}
                    </x-responsive-nav-link>

                    @if (auth()->user()->isAdmin())
                        <x-responsive-nav-link :href="route('admin.users.index')" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            {{ __('Ver Alumnos') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link :href="route('admin.admins.index')" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            {{ __('Gestionar Docentes') }}
                        </x-responsive-nav-link>
                    @endif

                    {{-- Cerrar sesión --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
