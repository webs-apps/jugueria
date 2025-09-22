<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Fondo con gradiente y efectos -->
        <div class="min-h-screen relative overflow-hidden">
            <!-- Fondo con gradiente -->
            <div class="absolute inset-0 bg-gradient-to-br from-green-400 via-emerald-500 to-teal-600"></div>
            
            <!-- Efectos decorativos -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
            </div>
            
            <!-- Contenido principal -->
            <div class="relative z-10 min-h-screen flex flex-col justify-center items-center px-4 py-12">
                <!-- Logo y título -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-md rounded-3xl shadow-2xl border border-white/30 mb-6">
                        <span class="text-white text-4xl">👼</span>
                    </div>
                    <h1 class="text-4xl font-bold text-white mb-2">{{ \App\Models\User::first()?->nombre_negocio ?? 'Mi Ángel' }}</h1>
                    <p class="text-white/80 text-lg">{{ \App\Models\User::first()?->slogan ?? 'Juguería & Smoothies' }}</p>
                </div>

                <!-- Formulario de login -->
                <div class="w-full max-w-md">
                    <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
