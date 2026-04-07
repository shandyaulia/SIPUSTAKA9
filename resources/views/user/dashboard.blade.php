<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Area Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome & Quick Status -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center justify-between p-6 border border-gray-100">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Halo, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-500 mt-1">Selamat datang di perpustakaan. Mari baca buku baru hari ini.</p>
                </div>
                <div>
                    <a href="{{ route('home') }}" class="bg-brand-blue hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-full shadow-md transition-colors inline-block">Cari Buku (OPAC)</a>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Peminjaman Aktif -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start">
                    <div class="w-12 h-12 bg-blue-50 text-brand-blue rounded-full flex items-center justify-center mr-4 mt-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Buku Sedang Dipinjam</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{\App\Models\Peminjaman::where('user_id', auth()->id())->whereIn('status', ['dipinjam', 'telat'])->count()}}</p>
                        <a href="{{ route('peminjaman.index') }}" class="text-sm text-brand-blue hover:underline mt-2 inline-block">Lihat riwayat peminjaman &rarr;</a>
                    </div>
                </div>
                
                <!-- Tagihan / Denda -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start">
                    <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mr-4 mt-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-grow">
                        @php
                            $dendaUser = \App\Models\Denda::whereHas('peminjaman', function($q) {
                                $q->where('user_id', auth()->id());
                            })->where('status_bayar', 'belum_lunas')->sum('jumlah_denda');
                        @endphp
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tagihan Denda</p>
                        <p class="text-3xl font-bold text-red-600 mt-1">Rp {{ number_format($dendaUser, 0, ',', '.') }}</p>
                        <a href="{{ route('denda.index') }}" class="text-sm text-red-600 hover:underline mt-2 inline-block">Lihat denda &rarr;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
