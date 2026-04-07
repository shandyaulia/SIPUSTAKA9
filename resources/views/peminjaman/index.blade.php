<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Manajemen Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Table Aktif -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 mb-8">
                <div class="p-6 text-gray-900 border-b border-gray-100 bg-blue-50/50">
                    <h3 class="text-lg font-bold text-brand-dark flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Transaksi Aktif & Menunggu
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Peminjam</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Buku</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tenggat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                @role('Super Admin|Admin')
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi Admin</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($peminjaman as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #TRX-{!! sprintf('%04d', $item->id) !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ $item->user->name ?? 'User Terhapus' }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <ul class="list-disc pl-4">
                                            @foreach($item->detailPeminjaman as $detail)
                                                <li>{{ $detail->buku->judul ?? 'Buku Tidak Diketahui' }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>Mulai: <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span></div>
                                        <div>Tenggat: <span class="font-medium text-red-600">{{ \Carbon\Carbon::parse($item->tenggat_waktu)->format('d M Y') }}</span></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($item->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu Approval</span>
                                        @elseif($item->status == 'dipinjam')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sedang Dipinjam</span>
                                        @elseif($item->status == 'telat')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Melewati Tenggat</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    
                                    @role('Super Admin|Admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($item->status == 'pending')
                                            <div class="flex gap-2">
                                                <form action="{{ route('peminjaman.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="dipinjam">
                                                    <button type="submit" class="bg-brand-blue hover:bg-blue-900 text-white px-3 py-1 rounded text-xs transition-colors shadow-sm">Setujui</button>
                                                </form>
                                                <form action="{{ route('peminjaman.update', $item->id) }}" method="POST" onsubmit="return confirm('Tolak peminjaman ini?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="ditolak">
                                                    <button type="submit" class="bg-red-100 text-red-800 hover:bg-red-200 px-3 py-1 rounded text-xs transition-colors">Tolak</button>
                                                </form>
                                            </div>
                                        @elseif($item->status == 'dipinjam' || $item->status == 'telat')
                                            <form action="{{ route('peminjaman.update', $item->id) }}" method="POST" onsubmit="return confirm('Konfirmasi buku telah dikembalikan? Denda akan otomatis tercatat jika melewati tenggat.');">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="dikembalikan">
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition-colors shadow-sm">Buku Dikembalikan</button>
                                            </form>
                                        @endif
                                    </td>
                                    @endrole
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50/50">Tidak ada peminjaman aktif saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $peminjaman->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
