<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Tarjeta de información del perfil -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <div class="flex items-center mb-6">
                        <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="Foto de perfil" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300 mr-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Teléfono:</span>
                            @if (auth()->user()->phone)
                                <a href="https://wa.me/{{ auth()->user()->phoneWithPrefix() }}" target="_blank" class="ml-2 text-green-600 hover:text-green-800 hover:underline">
                                    {{ auth()->user()->phone }} (WhatsApp)
                                </a>
                            @else
                                <span class="ml-2 text-gray-400">No especificado</span>
                            @endif
                        </div>

                        <div>
                            <span class="text-sm font-medium text-gray-500">Red profesional:</span>
                            @if (auth()->user()->professional_url)
                                <a href="{{ auth()->user()->professional_url }}" target="_blank" class="ml-2 text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ auth()->user()->professional_url }}
                                </a>
                            @else
                                <span class="ml-2 text-gray-400">No especificado</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Formulario de edición -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Cambiar contraseña -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar cuenta -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
