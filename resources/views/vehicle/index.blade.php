<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Vehículos') }}
        </h2>
    </x-slot>

    <div class="py-6" data-aos="fade-up">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-300 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('vehicle.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center gap-2 transition">
                    <x-heroicon-o-plus class="w-4 h-4" />
                    Nuevo Vehículo
                </a>
            </div>

            @if($vehicles->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 transition hover:shadow-xl"
                            data-aos="zoom-in" data-aos-delay="100">

                            @if($vehicle->imagenes->first())
                                <img src="{{ asset('storage/' . $vehicle->imagenes->first()->ruta) }}"
                                    class="w-full h-40 object-cover rounded-md mb-3">
                            @else
                                <div class="w-full h-40 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center text-gray-400">
                                    <x-heroicon-o-photo class="w-10 h-10" />
                                </div>
                            @endif

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $vehicle->marca }} - {{ $vehicle->modelo }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Año: {{ $vehicle->anio }}
                            </p>

                            <div class="mt-3 flex justify-between items-center">
                                <span class="font-semibold text-green-600 dark:text-green-400">
                                    ${{ number_format($vehicle->precio, 2) }}
                                </span>

                                <a href="{{ route('vehicle.edit', $vehicle) }}"
                                    class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 transition">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                    Editar
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $vehicles->links() }}
                </div>
            @else
                <div class="text-center py-10 text-gray-600 dark:text-gray-300" data-aos="fade-up">
                    <x-heroicon-o-exclamation-circle class="w-12 h-12 mx-auto mb-3" />
                    No hay vehículos registrados todavía.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>