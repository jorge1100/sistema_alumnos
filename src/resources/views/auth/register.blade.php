<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-indigo-800 to-violet-900 px-4 py-8">

        <div class="w-full max-w-lg">
            <!-- Logo arriba -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mx-auto shadow-xl">
                    DA
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white">Crear cuenta</h1>
                <p class="mt-1 text-indigo-200 text-sm">Registrate como alumno en el sistema</p>
            </div>

            <!-- Form card -->
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 p-8">

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- === SECCIÓN: DATOS PERSONALES === -->
                    <div class="mb-6">
                        <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Datos personales
                        </h3>

                        <!-- Nombre -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nombre completo')" class="text-slate-700 font-semibold text-sm mb-1.5" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <x-text-input id="name" class="block w-full pl-10 bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Juan Pérez" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-sm mb-1.5" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                                </div>
                                <x-text-input id="email" class="block w-full pl-10 bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="juan@email.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                        </div>
                    </div>

                    <!-- === SECCIÓN: CONTACTO === -->
                    <div class="mb-6">
                        <h3 class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Contacto (opcional)
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Teléfono -->
                            <div>
                                <x-input-label for="phone" :value="__('Teléfono')" class="text-slate-700 font-semibold text-sm mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <x-text-input id="phone" class="block w-full pl-10 bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" type="text" name="phone" :value="old('phone')" placeholder="+54 9 351 1234567" />
                                </div>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xs" />
                            </div>

                            <!-- Red profesional -->
                            <div>
                                <x-input-label for="professional_url" :value="__('LinkedIn / GitHub')" class="text-slate-700 font-semibold text-sm mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                    <x-text-input id="professional_url" class="block w-full pl-10 bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" type="url" name="professional_url" :value="old('professional_url')" placeholder="https://linkedin.com/in/..." />
                                </div>
                                <x-input-error :messages="$errors->get('professional_url')" class="mt-2 text-xs" />
                            </div>
                        </div>
                    </div>

                    <!-- === SECCIÓN: FOTO DE PERFIL === -->
                    <div class="mb-6">
                        <h3 class="text-xs font-bold text-rose-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Foto de perfil <span class="text-rose-500">*</span>
                        </h3>

                        <div class="relative">
                            <input id="photo" name="photo" type="file" accept="image/*" required
                                class="block w-full text-sm text-slate-600
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-xl file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700
                                    file:cursor-pointer file:transition
                                    hover:file:bg-indigo-100
                                    bg-slate-50 border border-slate-200 rounded-xl
                                    focus:ring-indigo-500 focus:border-indigo-500
                                    cursor-pointer"
                            />
                        </div>
                        <p class="mt-1.5 text-xs text-slate-500">JPG o PNG. Máximo 2MB. Es obligatoria.</p>
                        <x-input-error :messages="$errors->get('photo')" class="mt-2 text-xs" />
                    </div>

                    <!-- === SECCIÓN: CONTRASEÑA === -->
                    <div class="mb-6">
                        <h3 class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Contraseña
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Contraseña')" class="text-slate-700 font-semibold text-sm mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    </div>
                                    <x-text-input id="password" class="block w-full pl-10 bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-slate-700 font-semibold text-sm mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <x-text-input id="password_confirmation" class="block w-full pl-10 bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repetí la contraseña" />
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
                            </div>
                        </div>
                    </div>

                    <!-- Botón -->
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        {{ __('Crear cuenta') }}
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">¿Ya tenés cuenta?</span>
                    </div>
                </div>

                <!-- Link a login -->
                <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition border border-slate-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    {{ __('Iniciar sesión') }}
                </a>

            </div>

            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-indigo-200">
                UTN — Técnicatura Universitaria en Programación · Programación IV
            </p>
        </div>
    </div>
</x-guest-layout>