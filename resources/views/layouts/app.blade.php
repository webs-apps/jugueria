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
    <body class="font-sans antialiased bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen">
        <div class="min-h-screen">
            <!-- Page Heading -->
            @isset($header)
                <div class="relative">
                    <!-- Separator line -->
                    <div class="h-px bg-gradient-to-r from-transparent via-green-200/50 to-transparent"></div>
                    
                    <!-- Page header with distinct styling -->
                    <header class="bg-gradient-to-r from-green-50/80 via-emerald-50/80 to-teal-50/80 backdrop-blur-md shadow-xl border-b-2 border-green-300/30">
                        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                            <div class="relative">
                                <!-- Background decoration -->
                                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-green-200/20 to-emerald-200/20 rounded-full blur-xl"></div>
                                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-gradient-to-tr from-emerald-200/20 to-teal-200/20 rounded-full blur-xl"></div>
                                </div>
                                
                                <!-- Header content -->
                                <div class="relative z-10">
                                    {{ $header }}
                                </div>
                            </div>
                        </div>
                    </header>
                </div>
            @endisset

                <!-- Page Content -->
                <main class="relative">
                    <!-- Background decoration -->
                    <div class="absolute inset-0 overflow-hidden pointer-events-none">
                        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-green-300/20 to-emerald-300/20 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-emerald-300/20 to-teal-300/20 rounded-full blur-3xl"></div>
                    </div>
                    <div class="relative z-10">
                        {{ $slot }}
                    </div>
                </main>

                <!-- Sistema de Notificaciones -->
                <x-notification-system />
            </div>
        </body>
</html>
