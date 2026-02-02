<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis conversaciones') }}
        </h2>
    </x-slot>
    <div class="max-w-5xl mx-auto p-6 space-y-4">

        @forelse($conversations as $chat)
            @if($chat->has_unread)
            <a href="{{ route('chats.show', $chat) }}"
               class="block bg-white p-4 rounded-lg shadow hover:bg-indigo-50 transition">

                <p class="font-semibold">
                    {{ $chat->client_name }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ $chat->vehicle->marca }} {{ $chat->vehicle->submarca }}
                </p>
            </a>
            @else
                <p class="text-gray-500">No hay mensajes sin leer.</p>
            @endif
        @empty
            <p class="text-gray-500">No hay mensajes aún.</p>
        @endforelse

    </div>
</x-app-layout>