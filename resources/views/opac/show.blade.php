<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $buku->judul }} - SIPUSTAKA9</title>
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
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3 cursor-pointer">
                        <img src="{{ asset('images/logosmkn9.png') }}" class="h-10 w-auto" alt="Logo SMKN 9 Surakarta">
                        <span class="font-bold text-2xl text-brand-dark tracking-tight">SIPUSTAKA<span class="text-brand-yellow">9</span></span>
                    </a>
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

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-brand-blue hover:underline mb-8">
            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Katalog
        </a>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                
                <!-- Book Cover Side -->
                <div class="bg-gray-50 flex items-center justify-center p-12 border-r border-gray-100 relative">
                    <div class="relative w-64 h-96 group">
                        <!-- Shadow effect for book -->
                        <div class="absolute inset-0 bg-black/10 transform translate-x-3 translate-y-3 blur-md rounded-lg"></div>
                        
                        @if($buku->cover_image)
                            <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="{{ $buku->judul }}" class="relative w-full h-full object-cover rounded-md border border-gray-200">
                        @else
                            <div class="relative w-full h-full bg-white rounded-md border border-gray-200 flex items-center justify-center text-gray-300">
                                <svg fill="currentColor" class="w-24 h-24" viewBox="0 0 24 24"><path d="M4 4h16v16H4z" opacity=".1"/><path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5V4h14v16z"/><path d="M7 6h10v2H7zM7 10h10v2H7zM7 14h7v2H7z"/></svg>
                            </div>
                        @endif
                        
                        <div class="absolute -right-2 top-4 w-4 bg-gray-200 h-[calc(100%-2rem)] flex shadow-inner border-y border-r border-gray-300 rounded-r opacity-60">
                            <!-- Pages effect -->
                            <div class="w-px bg-gray-400 mx-px h-full"></div>
                            <div class="w-px bg-gray-300 mx-px h-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Book Details Side -->
                <div class="md:col-span-2 p-8 md:p-12 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-blue-50 text-brand-blue text-xs font-bold px-3 py-1 rounded-full border border-blue-100">
                                {{ $buku->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $buku->stok > 0 ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                                {{ $buku->stok > 0 ? 'Tersedia (' . $buku->stok . ')' : 'Stok Habis' }}
                            </span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 leading-tight">{{ $buku->judul }}</h1>
                        <p class="text-lg text-gray-500 mb-8 font-medium">Oleh <span class="text-gray-800">{{ $buku->penulis }}</span> &bull; {{ $buku->tahun_terbit }}</p>
                        
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Penerbit</p>
                                <p class="text-sm font-medium text-gray-800">{{ $buku->penerbit ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Tahun Terbit</p>
                                <p class="text-sm font-medium text-gray-800">{{ $buku->tahun_terbit }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Lokasi Rak</p>
                                <p class="text-sm font-medium text-gray-800">{{ $buku->lokasi_rak ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="prose prose-sm md:prose-base text-gray-600 mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-3 border-l-4 border-brand-yellow pl-3">Deskripsi Buku</h3>
                            <p class="leading-relaxed">
                                {{ $buku->deskripsi ?? 'Belum ada deskripsi / sinopsis untuk buku ini.' }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                        @auth
                            @if($buku->stok > 0)
                            <form action="{{ route('peminjaman.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                <button type="submit" class="bg-brand-blue hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5" onclick="return confirm('Ajukan pinjaman untuk buku ini?')">
                                    Ajukan Pinjaman
                                </button>
                            </form>
                            @else
                            <button disabled class="bg-gray-100 text-gray-400 font-bold py-3 px-8 rounded-xl cursor-not-allowed">
                                Stok Habis
                            </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="bg-brand-yellow hover:bg-yellow-400 text-brand-dark font-bold py-3 px-8 rounded-xl shadow-md transition-all">
                                Login untuk Meminjam
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
