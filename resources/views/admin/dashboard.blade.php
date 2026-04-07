<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Chart Panel -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold mb-6 text-brand-dark flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    Grafik Peminjaman Buku (Tahun {{ date('Y') }})
                </h3>
                <div class="relative w-full" style="height: 350px;">
                    <canvas id="peminjamanChart"></canvas>
                </div>
            </div>

            <!-- Stats overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 flex items-center p-6">
                    <div class="w-12 h-12 bg-blue-50 text-brand-blue rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Buku</p>
                        <p class="text-2xl font-bold text-gray-900">{{\App\Models\Buku::count()}}</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 flex items-center p-6">
                    <div class="w-12 h-12 bg-yellow-50 text-brand-yellow rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Anggota</p>
                        <p class="text-2xl font-bold text-gray-900">{{\App\Models\User::role('User')->count()}}</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 flex items-center p-6">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">{{\App\Models\Peminjaman::where('status', 'dipinjam')->count()}}</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 flex items-center p-6">
                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Menunggu Aproval</p>
                        <p class="text-2xl font-bold text-gray-900">{{\App\Models\Peminjaman::where('status', 'pending')->count()}}</p>
                    </div>
                </div>
            </div>

            <!-- Main Panel -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Akses Cepat Pengelolaan</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('buku.index') }}" class="block p-4 bg-gray-50 rounded border border-gray-200 hover:bg-brand-blue hover:text-white transition-colors">
                            <span class="block font-bold">Kelola Buku</span>
                            <span class="text-sm opacity-80">Tambah/Edit Koleksi</span>
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="block p-4 bg-gray-50 rounded border border-gray-200 hover:bg-brand-blue hover:text-white transition-colors">
                            <span class="block font-bold">Peminjaman</span>
                            <span class="text-sm opacity-80">Validasi & Pengembalian</span>
                        </a>
                        <a href="{{ route('denda.index') }}" class="block p-4 bg-gray-50 rounded border border-gray-200 hover:bg-brand-blue hover:text-white transition-colors">
                            <span class="block font-bold">Denda</span>
                            <span class="text-sm opacity-80">Kelola Tagihan</span>
                        </a>
                        @role('Super Admin')
                        <a href="{{ route('users.index') }}" class="block p-4 bg-gray-50 rounded border border-gray-200 hover:bg-brand-blue hover:text-white transition-colors">
                            <span class="block font-bold">User Management</span>
                            <span class="text-sm opacity-80">Hak Akses & Pengguna</span>
                        </a>
                        @endrole
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('peminjamanChart');
                const dataValues = {!! json_encode($chartValues ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!};
                
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Total Peminjaman',
                            data: dataValues,
                            backgroundColor: '#3B82F6', // brand-light
                            hoverBackgroundColor: '#0B3B60', // brand-blue
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
