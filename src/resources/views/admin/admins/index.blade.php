{{-- ====================================================================
    VISTA: Listado de Administradores / Docentes
    Ruta: GET /admin/admins
    Controlador: AdminController@index
    Descripción: Muestra una tabla con todos los usuarios que tienen
                 rol de administrador (is_admin = true). Permite navegar
                 al formulario de creación de un nuevo docente.
======================================================================== --}}

<x-app-layout>
    {{-- ================================================================
        ENCABEZADO DE LA PÁGINA
        Título, subtítulo y botón para crear un nuevo docente.
    ================================================================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            {{-- Título y descripción --}}
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Gestionar Docentes') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Administradores registrados en el sistema
                </p>
            </div>

            {{-- Botón para crear nuevo docente --}}
            <a href="{{ route('admin.admins.create') }}"
               class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nuevo docente
            </a>
        </div>
    </x-slot>

    {{-- ================================================================
        CONTENIDO PRINCIPAL
    ================================================================= --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ============================================================
                MENSAJE DE ÉXITO
                Se muestra después de crear un docente exitosamente.
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
                TARJETAS DE ESTADÍSTICAS
                Muestra el total de docentes registrados.
            ============================================================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                {{-- Card: Total de docentes --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 hover:shadow-md transition">
                    <div class="p-5 flex items-center">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total docentes</p>
                            <p class="text-2xl font-bold text-slate-800">{{ $admins->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============================================================
                TABLA DE DOCENTES
                Lista todos los administradores con su información.
            ============================================================== --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Listado de docentes</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Encabezados de la tabla --}}
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>

                            {{-- Filas de la tabla --}}
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($admins as $admin)
                                    <tr class="hover:bg-slate-50 transition">
                                        {{-- Foto de perfil del admin --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ $admin->profilePhotoUrl() }}"
                                                 alt="{{ $admin->name }}"
                                                 class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                        </td>

                                        {{-- Nombre --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                            {{ $admin->name }}
                                        </td>

                                        {{-- Email --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $admin->email }}
                                        </td>

                                        {{-- Badge de rol (siempre Docente en esta vista) --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 border border-indigo-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                                Docente
                                            </span>
                                        </td>

                                        {{-- Teléfono con link a WhatsApp --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            @if ($admin->phone)
                                                <a href="https://wa.me/{{ $admin->phoneWithPrefix() }}"
                                                   target="_blank"
                                                   class="text-green-600 hover:text-green-800 underline">
                                                    {{ $admin->phone }}
                                                </a>
                                            @else
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>

                                        {{-- Botón ver detalle --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.users.show', $admin) }}"
                                               class="text-indigo-600 hover:text-indigo-900 transition">
                                                Ver detalle →
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Estado vacío: no hay docentes registrados --}}
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            <p class="text-slate-500 font-medium">No hay docentes registrados aún</p>
                                            <a href="{{ route('admin.admins.create') }}"
                                               class="mt-3 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                                Crear el primero
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
