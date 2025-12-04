<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Asesoría y Tutoría - UPT</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .upt-gradient {
                background: linear-gradient(135deg, #C1272D 0%, #8B1F23 100%);
            }
        </style>
    </head>
    <body class="antialiased" style="background-color: #f5f5f5;">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="upt-gradient shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <h1 class="text-white text-2xl font-bold">Sistema de Asesoría y Tutoría</h1>
                        </div>
                        <nav class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-white text-red-800 rounded-md font-semibold hover:bg-gray-100 transition">
                                    Ir al Panel
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 text-white border border-white rounded-md hover:bg-white hover:text-red-800 transition">
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-red-800 rounded-md font-semibold hover:bg-gray-100 transition">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold mb-4" style="color: #800000;">
                            Ficha de Registro de Atenciones de Asesoría y Tutoría
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Sistema integral para el registro y seguimiento de atenciones de consejería académica
                            de la Universidad Privada de Tacna
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #800000;">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2" style="color: #800000;">Asesoría Académica</h3>
                            <p class="text-gray-600">Registro de consultas sobre planes de estudio, materias y orientación académica</p>
                        </div>

                        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #800000;">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2" style="color: #800000;">Tutoría Personalizada</h3>
                            <p class="text-gray-600">Seguimiento individualizado del progreso y desarrollo profesional del estudiante</p>
                        </div>

                        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #800000;">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2" style="color: #800000;">Reportes y Estadísticas</h3>
                            <p class="text-gray-600">Generación de informes detallados para análisis y toma de decisiones</p>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center">
                        @guest
                            <p class="text-gray-600 mb-4">¿Eres parte de la comunidad UPT? Inicia sesión para acceder al sistema</p>
                            <a href="{{ route('login') }}" class="inline-block px-8 py-3 text-white rounded-md font-semibold text-lg transition" style="background-color: #800000;">
                                Iniciar Sesión
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-3 text-white rounded-md font-semibold text-lg transition" style="background-color: #800000;">
                                Ir al Panel de Control
                            </a>
                        @endguest
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-6" style="background-color: #333;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-gray-400">
                        © {{ date('Y') }} Universidad Privada de Tacna - Sistema de Asesoría y Tutoría
                    </p>
                    <p class="text-gray-500 text-sm mt-2">
                        Escuela Profesional de Ingeniería de Sistemas
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
