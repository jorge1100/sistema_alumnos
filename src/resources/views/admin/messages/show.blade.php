<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mensaje de Contacto
                </h2>
            </div>
            <div class="flex items-center gap-2">
                @if (!$message->is_read)
                    <span class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                        Nuevo
                    </span>
                @else
                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Leído - {{ $message->read_at->format('d/m/Y H:i') }}
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $message->name }}</dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="mailto:{{ $message->email }}" class="text-indigo-600 hover:text-indigo-900 hover:underline flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $message->email }}
                                </a>
                            </dd>
                        </div>

                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Asunto</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $message->subject }}</dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Recibido</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $message->created_at->format('d/m/Y H:i') }}</dd>
                        </div>

                        @if ($message->is_read)
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Leído el</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $message->read_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        @endif
                    </dl>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Mensaje</dt>
                        <dd class="prose prose-sm max-w-none bg-gray-50 p-4 rounded-lg">
                            {{ $message->message }}
                        </dd>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200 flex items-center gap-4">
                        <a href="{{ route('admin.messages.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                            ← Volver a la lista
                        </a>

                        @if (!$message->is_read)
                            <form action="{{ route('admin.messages.show', $message) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                    Marcar como leído
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline ml-auto" onsubmit="return confirm('¿Eliminar este mensaje definitivamente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
