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
    <body class="font-sans antialiased">
        <!-- Contenedor de notificaciones -->
        <div x-data="{ message: '', type: '' }"
            x-on:notificar.window="message = $event.detail.message; type = $event.detail.type; setTimeout(() => message = '', 3000)">
            <template x-if="message">
                <div :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'" class="text-white p-3 rounded">
                    <span x-text="message"></span>
                </div>
            </template>
        </div>
   
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="p-4 h-screen bg-gradient-to-r from-blue-600 to-indigo-800">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
