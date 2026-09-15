<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualizá tu información personal y foto de perfil.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Foto de perfil actual -->
        <div>
            <x-input-label :value="__('Foto de perfil actual')" />
            <div class="mt-2">
                <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="Foto de perfil" class="w-24 h-24 rounded-full object-cover border-2 border-gray-300">
            </div>
        </div>

        <!-- Cambiar foto -->
        <div class="mt-4">
            <x-input-label for="photo" :value="__('Cambiar foto de perfil')" />
            <input id="photo" name="photo" type="file" accept="image/*" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
            <p class="mt-1 text-xs text-gray-500">JPG o PNG. Máximo 50MB.</p>
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Tu email no está verificado.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Hacé clic acá para reenviar el email de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Se envió un nuevo link de verificación.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="phone" :value="__('Teléfono')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" placeholder="+54 9 351 1234567" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- Red profesional -->
        <div>
            <x-input-label for="professional_url" :value="__('Red profesional (LinkedIn, GitHub, etc.)')" />
            <x-text-input id="professional_url" name="professional_url" type="url" class="mt-1 block w-full" :value="old('professional_url', $user->professional_url)" placeholder="https://..." />
            <x-input-error class="mt-2" :messages="$errors->get('professional_url')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
