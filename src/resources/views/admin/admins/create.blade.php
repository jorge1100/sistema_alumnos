{{-- ====================================================================
    VISTA: Formulario para crear un nuevo Administrador / Docente
    Ruta: GET /admin/admins/create → vista
          POST /admin/admins/store → AdminController@store
    Controlador: AdminController@create / AdminController@store
    Descripción: Formulario completo para registrar un nuevo docente
                 con nombre, email, contraseña y teléfono opcional.
======================================================================== --}}

<x-app-layout>
    {{-- ================================================================
        ENCABEZADO DE LA PÁGINA
        Título, subtítulo y botón para volver al listado.
    ================================================================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            {{-- Título y descripción --}}
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Nuevo Docente') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Crear un nuevo administrador en el sistema
                </p>
            </div>

            {{-- Botón para volver al listado --}}
            <a href="{{ route('admin.admins.index') }}"
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
        Formulario centrado con ancho máximo de 2xl.
    ================================================================= --}}
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 p-8">

                {{-- ============================================================
                    MENSAJE DE ÉXITO
                    Se muestra después de crear el docente exitosamente.
                ============================================================== --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ============================================================
                    FORMULARIO DE CREACIÓN
                    Envía los datos por POST con encriptación de archivos
                    para permitir subir foto de perfil (futuro).
                ============================================================== --}}
                <form method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- ========================================================
                        CAMPO: NOMBRE COMPLETO
                        Requerido. Máximo 255 caracteres. Autofocus al cargar.
                    ============================================================== --}}
                    <div class="mb-5">
                        <x-input-label for="name" :value="__('Nombre completo')" class="text-slate-700 font-semibold text-sm mb-1" />
                        <x-text-input id="name"
                                      class="block w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl"
                                      type="text"
                                      name="name"
                                      :value="old('name')"
                                      required
                                      autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- ========================================================
                        CAMPO: EMAIL
                        Requerido. Debe ser único en la tabla users.
                    ============================================================== --}}
                    <div class="mb-5">
                        <x-input-label for="email" :value="__('Correo electrónico')" class="text-slate-700 font-semibold text-sm mb-1" />
                        <x-text-input id="email"
                                      class="block w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl"
                                      type="email"
                                      name="email"
                                      :value="old('email')"
                                      required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- ========================================================
                        CAMPO: CONTRASEÑA
                        Requerido. Mínimo 8 caracteres (regla de Laravel Password).
                    ============================================================== --}}
                    <div class="mb-5">
                        <x-input-label for="password" :value="__('Contraseña')" class="text-slate-700 font-semibold text-sm mb-1" />
                        <x-text-input id="password"
                                      class="block w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl"
                                      type="password"
                                      name="password"
                                      required />
                        <p class="mt-1 text-xs text-slate-500">Mínimo 8 caracteres.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- ========================================================
                        CAMPO: TELÉFONO (OPCIONAL)
                        Se guarda con formato de WhatsApp (+54 9 ...).
                    ============================================================== --}}
                    <div class="mb-6">
                        <x-input-label for="phone" :value="__('Teléfono (opcional)')" class="text-slate-700 font-semibold text-sm mb-1" />
                        <x-text-input id="phone"
                                      class="block w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl"
                                      type="text"
                                      name="phone"
                                      :value="old('phone')"
                                      placeholder="+54 9 351 1234567" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    {{-- ========================================================
                        BOTONES DE ACCIÓN
                        - Submit: crea el docente con gradiente indigo→violeta
                        - Cancelar: vuelve al listado
                    ============================================================== --}}
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Crear docente
                        </button>
                        <a href="{{ route('admin.admins.index') }}"
                           class="w-full sm:w-auto text-center text-slate-500 hover:text-slate-700 font-medium transition py-3">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
