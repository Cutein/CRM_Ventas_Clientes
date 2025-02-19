<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM - Iniciar Sesión</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gradient-to-r from-blue-600 to-indigo-800 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-center mb-6">
            <svg class="h-12 w-12 text-blue-600 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-8 0v2m8-10a4 4 0 10-8 0 4 4 0 008 0z"></path>
            </svg>            
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Bienvenido al CRM</h2>
        <p class="text-gray-600 text-center mb-6">Inicia sesión para gestionar ventas y productos</p>

        @if (Route::has('login'))
            <div class="space-y-4">
                <a href="{{ route('login') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded transition">
                    Registrarse
                </a>
            </div>
        @endif
    </div>
</body>
</html>
