<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar vehículo') }}
        </h2>
    </x-slot>

    {{-- AOS CSS (si no está ya en tu layout) --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>

    <div class="max-w-3xl mx-auto py-8 px-4">
        @include('vehicle._form', ['vehicle' => $vehicle])
    </div>

    {{-- AOS Script (si no lo incluyes ya en tu layout) --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script> document.addEventListener('DOMContentLoaded', function(){ AOS.init({ duration: 700 }); }); </script>

    {{-- Script Vista Previa + Barra Progreso + Loading --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('imagenes');
        const dropzone = document.getElementById('dropzone');
        const preview = document.getElementById('preview');
        const form = document.getElementById('vehiculoForm');
        const progressContainer = document.getElementById('progress-container');
        const progressBar = document.getElementById('progress-bar');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        if (!input || !dropzone || !form) return;

        // abrir diálogo al click en dropzone
        dropzone.addEventListener('click', () => input.click());

        // drag & drop handlers (prevent default to allow drop)
        ['dragenter','dragover','dragleave','drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => e.preventDefault());
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        });

        input.addEventListener('change', () => {
            handleFiles(input.files);
        });

        function handleFiles(fileList) {
            preview.innerHTML = '';

            const files = Array.from(fileList || []);
            if (files.length === 0) return;

            if (files.length > 5) {
                alert('Máximo 5 imágenes');
                input.value = '';
                return;
            }

            // validate sizes and types
            for (const f of files) {
                if (!f.type.startsWith('image/')) {
                    alert('Sólo se permiten archivos de imagen.');
                    input.value = '';
                    preview.innerHTML = '';
                    return;
                }
                if (f.size > 2 * 1024 * 1024) {
                    alert('Cada imagen debe ser menor a 2MB.');
                    input.value = '';
                    preview.innerHTML = '';
                    return;
                }
            }

            // show previews
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'rounded-xl w-full h-32 object-cover shadow-md border';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }

        // Unified submit handler: show loading + fake progress then submit
        form.addEventListener('submit', function (e) {
            // if user didn't select images, allow form submit (server-side will validate)
            // prevent default to show progress & loading
            e.preventDefault();

            // basic client-side check of file count/size
            const files = input.files ? Array.from(input.files) : [];
            if (files.length > 5) {
                alert('Máximo 5 imágenes permitidas.');
                return;
            }
            for (const f of files) {
                if (f.size > 2 * 1024 * 1024) {
                    alert('Cada imagen debe ser menor o igual a 2MB.');
                    return;
                }
            }

            // show progress UI
            if (progressContainer) progressContainer.classList.remove('hidden');

            // disable submit button + show loader
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            }
            if (btnText) btnText.classList.add('hidden');
            if (btnLoading) btnLoading.classList.remove('hidden');

            // Simulated progress (replace with real XHR upload if needed)
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.floor(Math.random() * 15) + 5; // increment randomly for realism
                if (progress > 100) progress = 100;
                if (progressBar) progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    // finally submit the form for real
                    form.submit();
                }
            }, 250);
        });
    });
    </script>
    
</x-app-layout>