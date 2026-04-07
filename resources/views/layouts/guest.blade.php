<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIPUSTAKA9 - Login') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased overflow-hidden selection:bg-brand-yellow selection:text-brand-dark">
        <div class="min-h-screen flex w-full relative bg-brand-blue justify-center items-center">
            
            <!-- Abstract Background Shapes -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
                <div class="absolute top-1/4 -right-24 w-96 h-96 bg-brand-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-24 left-1/3 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
            </div>

            <!-- Login Card -->
            <div class="z-10 w-full max-w-md px-10 py-12 bg-white/95 backdrop-blur-xl shadow-2xl rounded-3xl border border-white/20 transform transition-all duration-500 hover:shadow-brand-blue/50 mx-4">
                <div class="flex flex-col items-center mb-8">
                    <a href="/" class="group">
                        <img src="{{ asset('images/logosmkn9.png') }}" class="h-24 w-auto drop-shadow-md group-hover:scale-105 transition-transform duration-300" alt="Logo SMKN 9 Surakarta">
                    </a>
                    <h2 class="mt-6 text-2xl font-extrabold text-brand-dark tracking-tight">Selamat Datang</h2>
                    <p class="text-sm text-gray-500 mt-2 text-center leading-relaxed">Masuk ke <b>SIPUSTAKA9</b> untuk mengakses seluruh layanan peminjaman buku Anda.</p>
                </div>

                {{ $slot }}
            </div>
            
        </div>
    </body>
</html>
