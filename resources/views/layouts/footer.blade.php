<footer class="bg-brand-blue text-white py-10 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Brand & Copyright -->
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('images/logosmkn9.png') }}" class="h-8 w-auto filter drop-shadow-md"
                        alt="Logo SMKN 9 Surakarta">
                    <span class="font-bold text-2xl tracking-tight text-white">SIPUSTAKA<span
                            class="text-brand-yellow">9</span></span>
                </div>
                <p class="text-blue-200 text-sm mb-4">
                    SIPUSTAKA9 adalah sistem informasi perpustakaan berbasis web yang dikembangkan untuk mendukung
                    pengelolaan dan layanan perpustakaan di SMKN 9 Surakarta secara lebih efektif dan terintegrasi.
                </p>
                <p class="text-blue-300 text-sm">
                    &copy; {{ date('Y') }} Perpustakaan SMK Negeri 9 Surakarta. <br>Hak Cipta Dilindungi.
                </p>
            </div>

            <!-- Address -->
            <div class="col-span-1 md:col-span-1">
                <h3 class="text-lg font-semibold text-brand-yellow mb-4">Alamat</h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand-light flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-blue-100 text-sm leading-relaxed">
                            <strong>SMK Negeri 9 Surakarta</strong><br>
                            Jl. Tarumanegara I, Banyuanyar, Kec. Banjarsari, <br>
                            Kota Surakarta, Jawa Tengah 57137
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact & Social -->
            <div class="col-span-1 md:col-span-1">
                <h3 class="text-lg font-semibold text-brand-yellow mb-4">Kontak</h3>
                <div class="space-y-3 pl-0">
                    <!-- Phone -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-light flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <p class="text-blue-100 text-sm">
                            Telepon: (0271) 716320
                        </p>
                    </div>
                    <!-- Email -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-light flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-blue-100 text-sm">
                            Email: info@smkn9-solo.sch.id
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>