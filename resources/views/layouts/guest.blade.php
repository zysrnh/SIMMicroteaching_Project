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
    <body class="font-sans text-gray-900 antialiased bg-gray-50 min-h-screen relative flex items-center justify-center selection:bg-indigo-500/30 selection:text-indigo-900">
        
        <div class="relative z-10 w-full max-w-md px-6 py-12 flex flex-col items-center">
            
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex flex-col items-center">
                    <div class="bg-white p-2 rounded shadow-sm mb-4 border border-gray-200">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo IAI Persis" class="w-16 h-16 object-contain" />
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">SIM Microteaching</h1>
                    <p class="text-gray-500 font-medium text-xs mt-1 uppercase tracking-widest">Institut Agama Islam Persis</p>
                </a>
            </div>

            <!-- Login Card -->
            <div class="w-full bg-white shadow-sm border border-gray-200 rounded overflow-hidden p-8 sm:p-10">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-xs text-gray-500 font-medium tracking-wide">
                &copy; {{ date('Y') }} IAI Persis. All rights reserved.
            </div>
            
        </div>
    </body>
</html>
