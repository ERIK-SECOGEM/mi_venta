<x-report-layout>

<div class="max-w-5xl mx-auto rounded-2xl shadow-xl bg-white overflow-hidden">

    {{-- Carrusel con Skeleton + Swipe --}}
    <div class="relative h-80 sm:h-[20rem] bg-gray-200 overflow-hidden">

        {{-- Skeleton de carga --}}
        <div id="imageSkeleton" class="absolute inset-0 animate-pulse bg-gray-300"></div>

        {{-- Imagen principal --}}
        <img id="mainImage"
            src="{{ $vehicle->images->first() ? Storage::url($vehicle->images->first()->path) : '' }}"
            class="w-full h-44 md:h-48 object-cover group-hover:scale-105 transition duration-300">

        {{-- Miniaturas --}}
        @if($vehicle->images->count() > 1)
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-3 bg-white/80 backdrop-blur-md px-3 py-2 rounded-full shadow-lg">
            @foreach($vehicle->images as $img)
                <img
                    onclick="setMainImage('{{ Storage::url($img->path) }}', {{ $loop->index }})"
                    src="{{ Storage::url($img->path) }}"
                    class="thumb w-14 h-14 object-cover rounded-md cursor-pointer opacity-70 hover:opacity-100 ring-2 ring-transparent hover:ring-indigo-600 transition"
                    data-index="{{ $loop->index }}"
                >
            @endforeach
        </div>
        @endif
    </div>

    {{-- Información --}}
    <div class="p-8 space-y-6">

        {{-- Título + Precio --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $vehicle->marca }} {{ $vehicle->modelo }}
            </h1>
            <div class="text-3xl font-extrabold text-indigo-700">
                ${{ number_format($vehicle->precio, 0) }} MXN
            </div>
        </div>

        {{-- Badges de detalles --}}
        <div class="flex flex-wrap gap-3 text-sm font-medium">
            <span class="px-4 py-1 bg-indigo-100 text-indigo-800 rounded-full">
                Año {{ $vehicle->anio }}
            </span>
            <span class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full">
                {{ $vehicle->kilometraje ?? '0' }} km
            </span>
            <span class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full">
                {{ $vehicle->combustible ?? 'Gasolina' }}
            </span>
            <span class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full">
                {{ $vehicle->transmision ?? 'Manual' }}
            </span>
        </div>

        {{-- Descripción --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Descripción</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $vehicle->descripcion }}
            </p>
        </div>

        {{-- CTA --}}
        

    </div>

    {{-- Footer --}}
    <div class="bg-gray-50 border-t text-center text-sm text-gray-500 py-3">
        {{ config('app.name') }} — Ficha generada por QR
    </div>
</div>

{{-- Script carrusel --}}
<script>
let images = [
    @foreach($vehicle->images as $img)
        "{{ Storage::url($img->path) }}",
    @endforeach
];
let currentIndex = 0;
const mainImg = document.getElementById("mainImage");
const skeleton = document.getElementById("imageSkeleton");

function loadImage(src) {
    skeleton.classList.remove("hidden");
    mainImg.style.opacity = "0";

    const tmpImg = new Image();
    tmpImg.src = src;

    tmpImg.onload = () => {
        mainImg.src = src;
        skeleton.classList.add("hidden");
        mainImg.style.opacity = "1";
    };
}

function setMainImage(src, index) {
    currentIndex = index;
    highlightThumb();
    loadImage(src);
}

function highlightThumb() {
    document.querySelectorAll(".thumb").forEach(t => t.classList.remove("ring-indigo-600", "opacity-100"));
    const active = document.querySelector(`.thumb[data-index="${currentIndex}"]`);
    if (active) active.classList.add("ring-indigo-600", "opacity-100");
}

// Swipe en móviles
let startX = 0;
mainImg.addEventListener("touchstart", e => startX = e.touches[0].clientX);
mainImg.addEventListener("touchend", e => {
    let endX = e.changedTouches[0].clientX;
    let diff = startX - endX;

    if (Math.abs(diff) > 50) {
        if (diff > 0) nextImage();
        else prevImage();
    }
});

function nextImage() {
    if (currentIndex < images.length - 1) currentIndex++;
    else currentIndex = 0;
    changeImage();
}

function prevImage() {
    if (currentIndex > 0) currentIndex--;
    else currentIndex = images.length - 1;
    changeImage();
}

function changeImage() {
    highlightThumb();
    loadImage(images[currentIndex]);
}

// Primera carga ya con skeleton
loadImage(mainImg.src);
highlightThumb();
</script>

</x-report-layout>