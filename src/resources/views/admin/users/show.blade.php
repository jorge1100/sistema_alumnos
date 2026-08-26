{{-- ====================================================================
    VISTA: Detalle de Usuario
    Ruta: GET /admin/users/{user}
    Controlador: UserController@show
    Descripción: Muestra la información completa de un usuario específico
                 (alumno o docente). Incluye foto, nombre, email, rol,
                 teléfono, URL profesional y fechas.
======================================================================== --}}

<x-app-layout>
    {{-- ================================================================
        ENCABEZADO DE LA PÁGINA
    ================================================================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Detalle de Usuario') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Información completa del usuario
                </p>
            </div>

            {{-- Botón volver --}}
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center justify-center text-indigo-600 hover:text-indigo-800 font-medium text-sm gap-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al listado
            </a>
        </div>
    </x-slot>

    {{-- ================================================================
        CONTENIDO PRINCIPAL
    ================================================================= --}}
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-8">

                    {{-- ========================================================
                        INFORMACIÓN PRINCIPAL DEL USUARIO
                        Foto de perfil grande, nombre, email y badge de rol.
                    ============================================================== --}}
                    <div class="flex flex-col sm:flex-row items-center sm:items-start mb-8 gap-6">
                        {{-- Foto de perfil --}}
                        <img src="{{ $user->profilePhotoUrl() }}"
                             alt="{{ $user->name }}"
                             class="w-28 h-28 rounded-full object-cover border-4 border-slate-200 shadow-lg">

                        {{-- Nombre, email y rol --}}
                        <div class="text-center sm:text-left">
                            <h3 class="text-2xl font-bold text-slate-800">{{ $user->name }}</h3>
                            <p class="text-slate-500 mt-1">{{ $user->email }}</p>

                            {{-- Badge de rol --}}
                            @if ($user->isAdmin())
                                <span class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    Docente / Administrador
                                </span>
                            @else
                                <span class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/></svg>
                                    Alumno
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- ========================================================
                        INFORMACIÓN DETALLADA
                        Grid con teléfono, URL profesional y fechas.
                    ============================================================== --}}
                    <div class="border-t border-slate-200 pt-8">
                        <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">

                            {{-- Teléfono --}}
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-semibold text-slate-500 uppercase">Teléfono</dt>
                                <dd class="mt-2 text-sm text-slate-900">
                                    @if ($user->phone)
                                        <a href="https://wa.me/{{ $user->phoneWithPrefix() }}" target="_blank" class="inline-flex items-center text-green-600 hover:text-green-800 hover:underline">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            {{ $user->phone }}
                                        </a>
                                    @else
                                        <span class="text-slate-400">No especificado</span>
                                    @endif
                                </dd>
                            </div>

                            {{-- Red profesional --}}
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-semibold text-slate-500 uppercase">Red profesional</dt>
                                <dd class="mt-2 text-sm text-slate-900">
                                    @if ($user->professional_url)
                                        <a href="{{ $user->professional_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            {{ $user->professional_url }}
                                        </a>
                                    @else
                                        <span class="text-slate-400">No especificado</span>
                                    @endif
                                </dd>
                            </div>

                            {{-- Fecha de registro --}}
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-semibold text-slate-500 uppercase">Fecha de registro</dt>
                                <dd class="mt-2 text-sm text-slate-900">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                            </div>

                            {{-- Última actualización --}}
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-semibold text-slate-500 uppercase">Última actualización</dt>
                                <dd class="mt-2 text-sm text-slate-900">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>

                        </dl>
                    </div>

                    {{-- ========================================================
                        BOTÓN VOLVER
                    ============================================================== --}}
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al listado
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
