<x-guest-layout>
    {{-- Mensaje explicativo para recuperar la contraseña --}}
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu contraseña? No te preocupes. Indicanos tu dirección de email y te enviaremos un enlace para restablecerla y elegir una nueva.') }}
    </div>

    {{-- Estado de la sesión (mensajes de éxito/error) --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Campo: Dirección de email --}}
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar enlace de recuperación') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
