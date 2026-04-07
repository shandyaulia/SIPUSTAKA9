<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900 border-b border-gray-100">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="nama_kategori" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('nama_kategori') }}" required placeholder="Contoh: Fiksi, Sains, Sejarah">
                            @error('nama_kategori')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="bg-brand-blue hover:bg-blue-900 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors text-sm">
                                Simpan Kategori
                            </button>
                            <a href="{{ route('kategori.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
