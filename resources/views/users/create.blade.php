<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-brand-yellow pl-3">
            {{ __('Tambah Pengguna Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900 border-b border-gray-100">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('name') }}" required>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" value="{{ old('email') }}" required>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Peran / Role -->
                            <div class="md:col-span-2">
                                <label for="role" class="block text-sm font-bold text-gray-700 mb-2">Hak Akses (Role) <span class="text-red-500">*</span></label>
                                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" required>
                                    <option value="">-- Pilih Peran --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Super Admin (Manajemen User), Admin (Manajemen Buku & Peminjaman), User (Anggota Perpustakaan).</p>
                                @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi <span class="text-red-500">*</span></label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" required>
                                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-blue focus:ring-brand-blue sm:text-sm" required>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <button type="submit" class="bg-brand-blue hover:bg-blue-900 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors text-sm">
                                Simpan Akun
                            </button>
                            <a href="{{ route('users.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
