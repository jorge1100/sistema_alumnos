<x-guest-layout>
    {{-- Mensaje de bienvenida a la verificación de email --}}
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de email haciendo clic en el enlace que te enviamos? Si no recibiste el email, te enviaremos otro con gusto.') }}
    </div>

    {{-- Mensaje de confirmación cuando se reenvió el enlace --}}
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Se envió un nuevo enlace de verificación a la dirección de email que proporcionaste al registrarte.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        {{-- Formulario para reenviar el email de verificación --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Reenviar email de verificación') }}
                </x-primary-button>
            </div>
        </form>

        {{-- Formulario para cerrar sesión --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Cerrar sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>
