<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900 border-b border-gray-100">
                    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Judul -->
                            <div class="md:col-span-2">
                                <label for="judul" class="block text-sm font-bold text-gray-700 mb-2">Judul Buku <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('judul', $buku->judul) }}" required>
                                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="kategori_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                                <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}" {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">Ketersediaan Stok <span class="text-red-500">*</span></label>
                                <input type="number" name="stok" id="stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('stok', $buku->stok) }}" min="0" required>
                                @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Penulis -->
                            <div>
                                <label for="penulis" class="block text-sm font-bold text-gray-700 mb-2">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('penulis', $buku->penulis) }}">
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <label for="penerbit" class="block text-sm font-bold text-gray-700 mb-2">Penerbit</label>
                                <input type="text" name="penerbit" id="penerbit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('penerbit', $buku->penerbit) }}">
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <label for="tahun_terbit" class="block text-sm font-bold text-gray-700 mb-2">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') + 1 }}">
                            </div>

                            <!-- Kode Buku -->
                            <div>
                                <label for="kode_buku" class="block text-sm font-bold text-gray-700 mb-2">Kode Buku</label>
                                <input type="text" name="kode_buku" id="kode_buku" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('kode_buku', $buku->kode_buku) }}">
                            </div>

                            <!-- Edisi -->
                            <div>
                                <label for="edisi" class="block text-sm font-bold text-gray-700 mb-2">Edisi / Cetakan</label>
                                <input type="text" name="edisi" id="edisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('edisi', $buku->edisi) }}">
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-bold text-gray-700 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('isbn', $buku->isbn) }}">
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi / Sinopsis</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                            </div>

                            <!-- Cover Image -->
                            <div class="md:col-span-2 mt-2">
                                <label for="cover_image" class="block text-sm font-bold text-gray-700 mb-2">Update Cover Buku</label>
                                @if($buku->cover_image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Current Cover" class="w-24 h-auto rounded shadow">
                                    </div>
                                @endif
                                <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-brand-yellow hover:file:bg-yellow-100" accept="image/*">
                                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah cover. Format: JPG, PNG maksimal 2MB.</p>
                                @error('cover_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <button type="submit" class="bg-brand-yellow hover:bg-yellow-500 text-brand-dark font-semibold py-2 px-6 rounded-lg shadow-md transition-colors text-sm">
                                Update Data Buku
                            </button>
                            <a href="{{ route('buku.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
