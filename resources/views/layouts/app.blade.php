<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --upt-red: #C1272D;
                --upt-dark: #1a1a1a;
                --upt-gray: #666666;
                --upt-light: #f5f5f5;
            }
        </style>
    </head>
    <body class="font-sans antialiased" style="background-color: #f5f5f5;">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="shadow-md" style="background: linear-gradient(135deg, #C1272D 0%, #8B1F23 100%);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
