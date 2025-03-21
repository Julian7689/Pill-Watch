<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pill Watch</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-blue-50 dark:bg-gray-900 text-gray-900 dark:text-white flex flex-col items-center justify-center min-h-screen p-6 lg:p-8 font-[Instrument Sans]">
        <header class="w-full max-w-4xl text-right mb-6">
            @if (Route::has('login'))
                <nav class="flex justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-all">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
    </body>
</html>