<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    @if (auth()->user()->isAdmin())
                        Panel del Docente
                    @else
                        Mi Dashboard
                    @endif
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    @if (auth()->user()->isAdmin())
                        Gestión completa de alumnos registrados
                    @else
                        Bienvenido, {{ auth()->user()->name }}
                    @endif
                </p>
            </div>
            <div class="hidden sm:block">
                @if (auth()->user()->isAdmin())
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700 border border-indigo-200">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Administrador
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 01.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
                        Alumno
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (auth()->user()->isAdmin())
                <!-- ========== PANEL DEL DOCENTE ========== -->

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Total usuarios -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 hover:shadow-md transition">
                        <div class="p-6 flex items-center">
                            <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total usuarios</p>
                                <p class="text-3xl font-bold text-slate-800">{{ App\Models\User::count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alumnos -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 hover:shadow-md transition">
                        <div class="p-6 flex items-center">
                            <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Alumnos</p>
                                <p class="text-3xl font-bold text-slate-800">{{ App\Models\User::where('is_admin', false)->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Docentes -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 hover:shadow-md transition">
                        <div class="p-6 flex items-center">
                            <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Docentes</p>
                                <p class="text-3xl font-bold text-slate-800">{{ App\Models\User::where('is_admin', true)->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acceso rápido + Últimos usuarios -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Acceso rápido -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                Acceso rápido
                            </h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition group">
                                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white mr-3 group-hover:scale-110 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800">Ver listado de usuarios</p>
                                        <p class="text-xs text-slate-500">Accedé al panel completo</p>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 ml-auto group-hover:text-indigo-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-slate-50 hover:bg-slate-100 rounded-xl transition group">
                                    <div class="w-10 h-10 bg-slate-600 rounded-lg flex items-center justify-center text-white mr-3 group-hover:scale-110 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800">Mi perfil</p>
                                        <p class="text-xs text-slate-500">Editar mis datos</p>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 ml-auto group-hover:text-slate-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Últimos usuarios registrados -->
                    <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Últimos usuarios registrados
                            </h3>
                            <div class="space-y-3">
                                @php
                                    $ultimos = App\Models\User::where('is_admin', false)->latest()->take(5)->get();
                                @endphp

                                @forelse ($ultimos as $u)
                                    <div class="flex items-center p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition">
                                        <img src="{{ $u->profilePhotoUrl() }}" alt="" class="w-10 h-10 rounded-full object-cover border border-slate-200 mr-3">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-slate-800 truncate">{{ $u->name }}</p>
                                            <p class="text-xs text-slate-500 truncate">{{ $u->email }}</p>
                                        </div>
                                        @if ($u->phone)
                                            <a href="https://wa.me/{{ $u->phoneWithPrefix() }}" target="_blank" class="text-green-600 hover:text-green-700 p-2 rounded-lg hover:bg-green-50 transition mr-1" title="WhatsApp">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.users.show', $u) }}" class="text-indigo-600 hover:text-indigo-700 p-2 rounded-lg hover:bg-indigo-50 transition" title="Ver detalle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-slate-400">
                                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        <p class="text-sm">No hay alumnos registrados aún</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- ========== PANEL DEL ALUMNO ========== -->

                <!-- Tarjeta de bienvenida -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-8 flex items-center gap-6">
                        <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="Foto de perfil" class="w-24 h-24 rounded-full object-cover border-4 border-white/30 shadow-xl">
                        <div class="text-white">
                            <h3 class="text-2xl font-bold">¡Hola, {{ auth()->user()->name }}!</h3>
                            <p class="text-emerald-100 mt-1">Este es tu panel personal. Desde acá podés ver y editar tu información.</p>
                        </div>
                    </div>
                </div>

                <!-- Info rápida + Acciones -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Mis datos -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                Mis datos
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase font-semibold">Email</p>
                                        <p class="text-sm text-slate-800">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase font-semibold">Teléfono</p>
                                        @if (auth()->user()->phone)
                                            <a href="https://wa.me/{{ auth()->user()->phoneWithPrefix() }}" target="_blank" class="text-sm text-emerald-600 hover:text-emerald-700 hover:underline">
                                                {{ auth()->user()->phone }}
                                            </a>
                                        @else
                                            <p class="text-sm text-slate-400">No especificado</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase font-semibold">Red profesional</p>
                                        @if (auth()->user()->professional_url)
                                            <a href="{{ auth()->user()->professional_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-700 hover:underline break-all">
                                                {{ auth()->user()->professional_url }}
                                            </a>
                                        @else
                                            <p class="text-sm text-slate-400">No especificado</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase font-semibold">Registrado el</p>
                                        <p class="text-sm text-slate-800">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Editar perfil -->
                        <a href="{{ route('profile.edit') }}" class="block bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 hover:shadow-md transition group">
                            <div class="p-6 flex items-center">
                                <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mr-4 group-hover:bg-indigo-200 transition">
                                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-slate-800">Editar mi perfil</h4>
                                    <p class="text-sm text-slate-500">Actualizá tu foto, teléfono, red profesional y contraseña.</p>
                                </div>
                                <svg class="w-6 h-6 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>

                        <!-- Cambiar contraseña -->
                        <a href="{{ route('profile.edit') }}#password" class="block bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 hover:shadow-md transition group">
                            <div class="p-6 flex items-center">
                                <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mr-4 group-hover:bg-amber-200 transition">
                                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-slate-800">Cambiar contraseña</h4>
                                    <p class="text-sm text-slate-500">Mantené tu cuenta segura con una contraseña fuerte.</p>
                                </div>
                                <svg class="w-6 h-6 text-slate-400 group-hover:text-amber-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>

                        <!-- Info del sistema -->
                        <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6">
                            <h4 class="text-sm font-bold text-slate-700 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Información del sistema
                            </h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-500">Framework:</span>
                                    <span class="text-slate-800 font-medium ml-1">Laravel 13</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Base de datos:</span>
                                    <span class="text-slate-800 font-medium ml-1">MySQL</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Frontend:</span>
                                    <span class="text-slate-800 font-medium ml-1">Blade + Tailwind</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Autenticación:</span>
                                    <span class="text-slate-800 font-medium ml-1">Breeze</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>