<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">Contacto</h2>
                <p class="text-sm text-slate-500 mt-1">Envíanos un mensaje y te responderemos lo antes posible.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contacto.send') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="mt-1 block w-full rounded-xl border border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 sm:text-sm px-4 py-3 transition">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full rounded-xl border border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 sm:text-sm px-4 py-3 transition">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Asunto</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="mt-1 block w-full rounded-xl border border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 sm:text-sm px-4 py-3 transition">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label>
                            <textarea name="message" id="message" rows="5" required
                                class="mt-1 block w-full rounded-xl border border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 sm:text-sm px-4 py-3 transition">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full inline-flex justify-center py-3 px-4 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                Enviar mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>