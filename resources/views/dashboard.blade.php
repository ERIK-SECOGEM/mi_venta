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
                        d="M18 18v-1a3 3 0 00-3-3H9a3 3 0 00-3 3v1m12 0a3 3 0 01-3 3H9a3 3 0 01-3-3m12 0v-1a6 6 0 00-6-6 6 6 0 00-6 6v1m6-12a3 3 0 110-6 3 3 0 010 6z"/>
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
                        d="M3 13l2-5h14l2 5m-2 0a4 4 0 11-8 0m8 0H5m4 0a4 4 0 108 0"/>
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
                        d="M9 17v-6m3 6V7m3 10v-4m5-5V5H4v3m16 8v2H4v-2"/>
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
