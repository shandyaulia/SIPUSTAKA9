<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPUSTAKA9 - Katalog Buku Online</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer">
                        <img src="{{ asset('images/logosmkn9.png') }}" class="h-10 w-auto" alt="Logo SMKN 9 Surakarta">
                        <span class="font-bold text-2xl text-brand-dark tracking-tight">SIPUSTAKA<span class="text-brand-yellow">9</span></span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-brand-blue transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-brand-blue transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-brand-blue text-white px-5 py-2.5 rounded-full hover:bg-blue-900 transition-all shadow-md hover:shadow-lg">Daftar</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-brand-blue overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-0 -left-10 w-72 h-72 bg-brand-light rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-10 w-72 h-72 bg-brand-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-24 sm:py-32 flex flex-col items-center text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6">
                Temukan Jendela <br/><span class="text-brand-yellow">Dunia Anda</span>
            </h1>
            <p class="mt-4 max-w-2xl text-lg md:text-xl text-blue-100 mb-10">
                Akses ribuan koleksi buku digital dan fisik kami. Pinjam dan reservasi buku kapan saja, di mana saja dengan SIPUSTAKA9.
            </p>
            
            <!-- Unified Search Bar -->
            <form action="{{ route('home') }}" method="GET" class="w-full max-w-3xl">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-gray-400 group-focus-within:text-brand-blue transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-12 pr-4 py-4 rounded-full border-0 ring-1 ring-inset ring-gray-100 bg-white text-gray-900 shadow-xl focus:ring-2 focus:ring-inset focus:ring-brand-yellow sm:text-lg transition-all" placeholder="Cari judul buku atau penulis...">
                    <button type="submit" class="absolute inset-y-2 right-2 flex items-center px-6 bg-brand-yellow text-brand-dark font-bold rounded-full hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-yellow transition-colors shadow-md">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900 border-l-4 border-brand-yellow pl-3">Katalog Buku Terbaru</h2>
        </div>

        @if($buku->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($buku as $item)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 flex flex-col h-full group">
                        <a href="{{ route('opac.show', $item->id) }}" class="h-64 bg-gray-100 relative overflow-hidden flex items-center justify-center block">
                            @if($item->cover_image)
                                <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="text-gray-300 w-24 h-24 group-hover:scale-105 transition-transform duration-500">
                                    <svg fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4z" opacity=".1"/><path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5V4h14v16z"/><path d="M7 6h10v2H7zM7 10h10v2H7zM7 14h7v2H7z"/></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-xs font-bold px-3 py-1 rounded-full text-brand-blue shadow-sm">
                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                            </div>
                        </a>
                        <a href="{{ route('opac.show', $item->id) }}" class="block p-5 flex-grow flex flex-col">
                            <div>
                                <h3 class="font-bold text-lg text-gray-900 mb-1 leading-tight group-hover:text-brand-blue transition-colors">{{ $item->judul }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $item->penulis }} &bull; {{ $item->tahun_terbit }}</p>
                            </div>
                        </a>
                        <div class="px-5 pb-5 flex flex-col justify-end h-full">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-md {{ $item->stok > 0 ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                                    {{ $item->stok > 0 ? 'Tersedia (' . $item->stok . ')' : 'Dipinjam' }}
                                </span>
                                
                                @auth
                                    @if($item->stok > 0)
                                    <form action="{{ route('peminjaman.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="buku_id" value="{{ $item->id }}">
                                        <button type="submit" class="bg-brand-blue hover:bg-blue-900 text-white text-xs font-bold py-1.5 px-3 rounded shadow-sm hover:shadow transition-all" onclick="return confirm('Ajukan pinjaman untuk buku ini?')">Pinjam</button>
                                    </form>
                                    @else
                                    <button disabled class="bg-gray-300 text-gray-500 text-xs font-bold py-1.5 px-3 rounded cursor-not-allowed">Habis</button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 flex justify-center">
                {{ $buku->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900">Buku tidak ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba gunakan kata kunci pencarian yang berbeda.</p>
            </div>
        @endif
    </main>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
