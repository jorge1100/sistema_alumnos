{{-- ====================================================================
    VISTA: Listado de Alumnos
    Ruta: GET /admin/users
    Controlador: UserController@index
    Descripción: Muestra una tabla con todos los usuarios que NO son
                 administradores (alumnos). Permite ver el detalle de
                 cada alumno y acceder a su teléfono por WhatsApp.
======================================================================== --}}

<x-app-layout>
    {{-- ================================================================
        ENCABEZADO DE LA PÁGINA
    ================================================================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Listado de Alumnos') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Usuarios registrados con rol de alumno
                </p>
            </div>
        </div>
    </x-slot>

    {{-- ================================================================
        CONTENIDO PRINCIPAL
    ================================================================= --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ============================================================
                MENSAJE DE ÉXITO
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
                TABLA DE ALUMNOS
            ============================================================== --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Alumnos registrados</h3>

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
                                @forelse ($users as $user)
                                    <tr class="hover:bg-slate-50 transition">
                                        {{-- Foto de perfil --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ $user->profilePhotoUrl() }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                        </td>

                                        {{-- Nombre --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                            {{ $user->name }}
                                        </td>

                                        {{-- Email --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $user->email }}
                                        </td>

                                        {{-- Badge de rol --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($user->isAdmin())
                                                <span class="px-2.5 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 border border-indigo-200">
                                                    Docente
                                                </span>
                                            @else
                                                <span class="px-2.5 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                    Alumno
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Teléfono con link a WhatsApp --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            @if ($user->phone)
                                                <a href="https://wa.me/{{ $user->phoneWithPrefix() }}" target="_blank" class="text-green-600 hover:text-green-800 underline">
                                                    {{ $user->phone }}
                                                </a>
                                            @else
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>

                                        {{-- Botón ver detalle --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600 hover:text-indigo-900 transition">
                                                Ver detalle →
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Estado vacío --}}
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                            <p class="text-slate-500 font-medium">No hay alumnos registrados aún</p>
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
