<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Ventas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
</head>

<body class="antialiased bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="w-full fixed top-0 z-40 bg-white shadow-lg">
        <div class="max-w-7xl mx-auto py-4 px-6 flex justify-between items-center">
            <a href="{{ url('/') }}"><h1 class="text-2xl font-bold text-primary tracking-tight">Sistema de Ventas</h1></a>

            @auth
                <a href="{{ url('/dashboard') }}" class="flex items-center gap-1 text-sm font-medium text-primary hover:text-blue-800 transition">
                    Ir al panel
                </a>
            @else
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="flex items-center gap-1 text-sm font-medium text-primary hover:text-blue-800 transition">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}" class="flex items-center gap-1 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                        Registrarme
                    </a>
                </div>
            @endauth
        </div>
    </header>

    <!-- HERO -->
<section class="pt-36 pb-20 px-6 text-center bg-gradient-to-r from-blue-600 to-primary text-white shadow-lg" data-aos="fade-up">
    <h2 class="text-5xl font-extrabold drop-shadow mb-6" data-aos="fade-down">Administra tus ventas fácilmente</h2>
    <p class="max-w-2xl mx-auto text-lg opacity-90" data-aos="fade-up" data-aos-delay="200">
        Controla productos, clientes y transacciones desde una sola plataforma.
    </p>

    <div class="mt-10" data-aos="zoom-in" data-aos-delay="400">
        @auth
            <a href="/dashboard" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl shadow-xl hover:bg-indigo-700 transition transform hover:scale-110 hover:shadow-2xl duration-300">
                Ir al panel de ventas
            </a>
        @else
            <a href="/register" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl shadow-xl hover:bg-indigo-700 transition transform hover:scale-110 hover:shadow-2xl duration-300">
                Comenzar ahora
            </a>
        @endauth
    </div>
</section>

    <!-- FEATURES -->
    <section class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 mt-20 px-6">

        <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4" /></svg></div>
                <h3 class="text-xl font-bold text-primary">Gestión de Productos</h3>
            </div>
            <p class="text-gray-600">Control total sobre inventario, precios y categorías.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="250">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 10h18M4 14h6" /></svg></div>
                <h3 class="text-xl font-bold text-primary">Registro de Ventas</h3>
            </div>
            <p class="text-gray-600">Procesa ventas rápidamente y almacena cada transacción.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z" /></svg></div>
                <h3 class="text-xl font-bold text-primary">QR por Producto</h3>
            </div>
            <p class="text-gray-600">Genera y descarga códigos QR únicos para cada producto.</p>
        </div>

    </section>

    <!-- FOOTER -->
    <footer class="mt-20 py-10 text-center text-gray-500">
        © {{ date('Y') }} Mi Venta — Todos los derechos reservados.
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true
            });
        });
    </script>

</body>
</html>
