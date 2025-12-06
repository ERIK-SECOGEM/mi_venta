<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>

    <div class="px-2 sm:px-4 lg:px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

        {{-- ADMIN --}}
        @role('administrador')
        <div 
            class="bg-white shadow-lg rounded-xl p-5 text-center border border-gray-100"
            data-aos="fade-up"
            data-aos-duration="700"
        >
            <div class="flex justify-center mb-2">
                <!-- Heroicon: Users -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke-width="2" stroke="currentColor" 
                    class="w-7 h-7 text-blue-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 
                        14.998 0A17.933 17.933 0 0 1 
                        12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                </svg>
            </div>

            <h2 class="text-sm font-semibold text-gray-700">Usuarios Registrados</h2>

            <div class="text-4xl font-extrabold text-blue-600 my-1">
                {{ $usuarios }}
            </div>

            <p class="text-xs text-gray-500">Excluye administradores</p>
        </div>
        @endrole



        {{-- VENDEDOR --}}
        @role('vendedor')
        <div 
            class="bg-white shadow-lg rounded-xl p-5 text-center border border-gray-100"
            data-aos="fade-up"
            data-aos-duration="700"
        >
            <div class="flex justify-center mb-2">
                <!-- Heroicon: Truck -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor"
                    class="w-7 h-7 text-green-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 
                        4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 
                        2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 
                        0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                </svg>
            </div>

            <h2 class="text-sm font-semibold text-gray-700">Vehículos Disponibles</h2>

            <div class="text-4xl font-extrabold text-green-600 my-1">
                {{ $vehiculos }}
            </div>

            <p class="text-xs text-gray-500">Sin contar vendidos</p>
        </div>
        @endrole

        {{-- EJEMPLO EXTRA: Reportes --}}
        <div 
            class="bg-white shadow-lg rounded-xl p-5 text-center border border-gray-100"
            data-aos="fade-up"
            data-aos-duration="700"
        >
            <div class="flex justify-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke-width="2" stroke="currentColor" 
                    class="w-7 h-7 text-purple-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 
                        6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 
                        0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 
                        4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 
                        1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/>
                </svg>
            </div>

            <h2 class="text-sm font-semibold text-gray-700">
                Reportes
            </h2>

            <div class="text-4xl font-extrabold text-purple-600 my-1 leading-none">
                {{ $reportes ?? 0 }}
            </div>

            <p class="text-xs text-gray-500">Actividad del sistema</p>
        </div>

    </div>
</x-app-layout>
