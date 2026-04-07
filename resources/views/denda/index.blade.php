<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Tagihan Denda Keterlambatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-bold">Daftar Denda</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No Transaksi</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Peminjam</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jumlah Denda</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status Bayar</th>
                                @role('Super Admin|Admin')
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi Admin</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($denda as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="#" class="text-brand-blue hover:underline">#TRX-{!! sprintf('%04d', $item->peminjaman->id) !!}</a>
                                        <div class="text-xs text-gray-500 mt-1">Kembali: {{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali)->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ $item->peminjaman->user->name ?? 'User Terhapus' }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->peminjaman->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600">
                                        Rp {{ number_format($item->jumlah_denda, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($item->status_bayar == 'belum_lunas')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Belum Lunas</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                                        @endif
                                    </td>
                                    
                                    @role('Super Admin|Admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($item->status_bayar == 'belum_lunas')
                                            <form action="{{ route('denda.update', $item->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa anggota telah membayar denda ini?');">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_bayar" value="lunas">
                                                <button type="submit" class="bg-brand-blue hover:bg-blue-900 text-white px-3 py-1.5 rounded transition-colors shadow-sm font-semibold flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Bayar (Lunas)
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Selesai diproses</span>
                                        @endif
                                    </td>
                                    @endrole
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50/50">Tidak ada data tagihan denda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $denda->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
