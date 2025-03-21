<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PillWatch') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-600 to-indigo-800 min-h-screen flex items-center justify-center p-6">
        <div class="w-full sm:max-w-lg mt-6 px-8 py-10 bg-white dark:bg-gray-800 shadow-2xl backdrop-blur-lg rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Título de la aplicación -->
            <h1 class="text-3xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-400 dark:to-indigo-500 mt-2 mb-8">
                PillWatch
            </h1>

            {{ $slot }}
        </div>
    </body>
</html>
