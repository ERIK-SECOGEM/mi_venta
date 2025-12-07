<form action="{{ $vehicle->exists ? route('vehicle.update', $vehicle) : route('vehicle.store') }}" method="POST"
        enctype="multipart/form-data"
        id="vehiculoForm"
        class="bg-white shadow-md rounded-xl p-6 space-y-5"
        data-aos="fade-up">
    @csrf
    @if(!empty($vehicle) && $vehicle->exists)
        @method('PUT')
    @endif

    {{-- Marca --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
        <input type="text" name="marca" value="{{ old('marca', $vehicle->marca ?? '') }}" required
            class="w-full rounded-lg @error('marca') border-red-500 @else border-gray-300 @enderror focus:ring-indigo-500 focus:border-indigo-500">
            @error('marca')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
    </div>

    {{-- Modelo --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Modelo</label>
        <input type="text" name="modelo" value="{{ old('marca', $vehicle->modelo ?? '') }}" required
            class="w-full rounded-lg @error('modelo') border-red-500 @else border-gray-300 @enderror focus:ring-indigo-500 focus:border-indigo-500">
            @error('modelo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
    </div>

    {{-- Precio y Año --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Precio MXN</label>
            <input type="number" step="0.01" min="0" name="precio" value="{{ old('precio', $vehicle->precio ?? '') }}" required
                class="w-full rounded-lg @error('precio') border-red-500 @else border-gray-300 @enderror focus:ring-indigo-500 focus:border-indigo-500">
                @error('precio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
            <input type="number" min="1900" max="2099" name="anio" value="{{ old('anio', $vehicle->anio ?? '') }}" required
                class="w-full rounded-lg @error('anio') border-red-500 @else border-gray-300 @enderror focus:ring-indigo-500 focus:border-indigo-500">
                @error('anio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
        </div>
    </div>

    {{-- Descripción --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <textarea name="descripcion" rows="3" required
            class="w-full rounded-lg @error('descripcion') border-red-500 @else border-gray-300 @enderror focus:border-indigo-500">{{ old('descripcion', $vehicle->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
    </div>

    {{-- Upload images --}}
    <div class="space-y-4">
        <label class="text-gray-700 font-semibold flex gap-2 items-center">
            <x-heroicon-o-camera class="w-6 h-6 text-indigo-600" />
            Imágenes del vehículo
        </label>

        <div id="dropzone"
                class="cursor-pointer border-2 border-dashed border-indigo-400 rounded-2xl bg-indigo-50 
                    px-6 py-10 text-center hover:bg-indigo-100 transition">
            <p class="text-indigo-600 font-semibold">Arrastra o haz clic para subir</p>
            <p class="text-gray-500 text-sm">Máximo 5 imágenes | 2MB c/u</p>

            <input type="file" name="imagenes[]" id="imagenes" multiple accept="image/*"
                class="hidden">
        </div>

        {{-- Preview --}}
        <div id="preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>

        @if ($errors->has('imagenes') || $errors->has('imagenes.*'))
            <div class="text-red-500 text-sm">
                @error('imagenes')
                    <p>{{ $message }}</p>
                @enderror
                @foreach ($errors->get('imagenes.*') as $imageErrors)
                    @foreach ($imageErrors as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endforeach
            </div>
        @endif

        {{-- Progress Bar --}}
        <div class="hidden" id="progress-container">
            <p class="text-gray-600 text-sm mb-1">Subiendo imágenes...</p>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div id="progress-bar" class="bg-indigo-600 h-3 rounded-full transition-all" style="width:0%"></div>
            </div>
        </div>
    </div>

    {{-- Botones --}}
    <div class="flex justify-between gap-3 mt-6">

        {{-- Cancelar --}}
        <a href="{{ route('vehicle.index') }}"
        class="w-1/2 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700
                font-medium text-sm transition transform hover:scale-105
                flex justify-center items-center gap-2">
            <x-heroicon-o-x-mark class="w-4 h-4" />
            Cancelar
        </a>

        {{-- Publicar con Loading --}}
        <button type="submit" id="submitBtn"
                class="w-1/2 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white
                    font-semibold text-sm transition transform hover:scale-105
                    flex justify-center items-center gap-2">
            <span id="btnText" class="inline-flex items-center gap-2">
                <x-heroicon-o-check class="w-4 h-4" />
                {{ $vehicle->exists ? 'Actualizar' : 'Guardar' }}
            </span>
            <span id="btnLoading" class="hidden items-center gap-2">
                <svg class="animate-spin w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                    <path class="opacity-75" stroke-width="4" stroke-linecap="round" d="M4 12a8 8 0 018-8"></path>
                </svg>
                {{ $vehicle->exists ? 'Actualizando...' : 'Guardando...' }}
            </span>
        </button>

    </div>

</form>
    