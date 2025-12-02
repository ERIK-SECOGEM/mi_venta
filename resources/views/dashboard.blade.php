<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- ADMIN --}}
            @if($vista === 'administrador')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Usuarios Registrados</h2>
                    
                    <div class="text-5xl font-extrabold text-blue-600">
                        {{ $usuarios }}
                    </div>

                    <p class="mt-2 text-gray-500">Usuarios generales (excluye administradores).</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
