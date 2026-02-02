<x-app-layout>
<div class="max-w-4xl mx-auto p-6 space-y-4">

    <h2 class="font-bold text-lg">
        {{ $conversation->vehicle->marca }} {{ $conversation->vehicle->submarca }}
    </h2>

    <div class="bg-white rounded-lg p-4 space-y-3 h-96 overflow-y-auto">

        @foreach($conversation->messages as $msg)
            <div class="flex {{ $msg->sender_type === 'vendedor' ? 'justify-end' : 'justify-start' }}">
                <div class="px-4 py-2 rounded-lg text-sm
                    {{ $msg->sender_type === 'vendedor'
                        ? 'bg-indigo-600 text-white'
                        : 'bg-gray-200' }}">
                    {{ $msg->message }}
                </div>
            </div>
        @endforeach

    </div>

    <form method="POST" action="{{ route('chats.reply', $conversation) }}"
          class="flex gap-2">
        @csrf
        <input name="message"
               class="flex-1 border rounded-lg p-2"
               placeholder="Escribe tu respuesta...">

        <button class="bg-indigo-600 text-white px-4 rounded-lg">
            Enviar
        </button>
    </form>

</div>
</x-app-layout>