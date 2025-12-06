<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar vehículo') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4">

        <form action="{{ route('vehicle.store') }}" method="POST"
              enctype="multipart/form-data"
              class="bg-white shadow-md rounded-xl p-6 space-y-5"
              data-aos="fade-up">
            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Vehículo</label>
                <input type="text" name="nombre" required
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Precio y Año --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                    <input type="number" step="0.01" min="0" name="precio" required
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                    <input type="number" min="1900" max="2099" name="anio" required
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" rows="3" required
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            {{-- Imagenes --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <x-heroicon-o-camera class="w-5 h-5 text-indigo-600" />
                    Fotos del vehículo (máx. 5)
                </label>

                <input type="file" name="imagenes[]" id="imagenes" multiple accept="image/*"
                       required class="text-sm">

                <div id="preview"
                     class="grid grid-cols-3 gap-2 mt-3"></div>
            </div>

            {{-- Botón --}}
            <button type="submit"
                class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-center text-sm font-semibold transition transform hover:scale-[1.01] flex items-center justify-center gap-2">
                <x-heroicon-o-check class="w-5 h-5"/>
                Publicar
            </button>

        </form>
    </div>

    <script>
        const input = document.getElementById('imagenes');
        const preview = document.getElementById('preview');

        input.addEventListener("change", () => {
            preview.innerHTML = "";

            if (input.files.length > 5) {
                alert("Solo puedes subir máximo 5 imágenes.");
                input.value = "";
                return;
            }

            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "rounded-lg w-full h-24 object-cover border shadow";
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

</x-app-layout>