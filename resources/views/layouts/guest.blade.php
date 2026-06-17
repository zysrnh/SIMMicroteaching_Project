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
    <body class="font-sans text-primary-900 antialiased bg-slate-50 relative overflow-hidden">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 left-0 w-full h-96 bg-primary-600 rounded-b-[4rem] sm:rounded-b-[8rem] opacity-90 z-0"></div>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-12 sm:pt-0 relative z-10">
            <div class="text-center flex flex-col items-center mb-6">
                <a href="/">
                    <div class="bg-white p-3 rounded-2xl shadow-sm mb-4 inline-block">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo IAI Persis" class="w-20 h-20 object-contain rounded-xl" />
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-white tracking-tight">SIM Microteaching</h1>
                <p class="text-primary-100 font-medium text-sm mt-1">Institut Agama Islam Persis</p>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white shadow-[0_20px_40px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden sm:rounded-3xl transition-all duration-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.12)]">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-sm text-primary-600/80 font-medium">
                &copy; {{ date('Y') }} IAI Persis. All rights reserved.
            </div>
        </div>
    </body>
</html>
