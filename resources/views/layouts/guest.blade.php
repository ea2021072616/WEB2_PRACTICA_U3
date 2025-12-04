<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistema de Asesoría y Tutoría - UPT</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .upt-gradient {
                background: linear-gradient(135deg, #C1272D 0%, #8B1F23 100%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-color: #f5f5f5;">
            <div class="mb-4">
                <a href="/" class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2" style="background-color: #800000;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold" style="color: #800000;">Sistema de Asesoría y Tutoría</span>
                    <span class="text-sm text-gray-500">Universidad Privada de Tacna</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-lg" style="border-top: 4px solid #800000;">
                {{ $slot }}
            </div>

            <p class="mt-6 text-sm text-gray-500">
                © {{ date('Y') }} Universidad Privada de Tacna
            </p>
        </div>
    </body>
</html>
