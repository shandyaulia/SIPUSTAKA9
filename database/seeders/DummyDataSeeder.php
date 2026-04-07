<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KategoriBuku;
use App\Models\Buku;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Dummy (Admin & Anggota)
        $admin = User::firstOrCreate(
            ['email' => 'admin@sipustaka9.com'],
            [
                'name' => 'Budi Pustakawan',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }

        $user1 = User::firstOrCreate(
            ['email' => 'siswa1@sipustaka9.com'],
            [
                'name' => 'Ahmad Fathan',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$user1->hasRole('User')) {
            $user1->assignRole('User');
        }

        $user2 = User::firstOrCreate(
            ['email' => 'guru1@sipustaka9.com'],
            [
                'name' => 'Siti Nurhaliza, S.Pd',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$user2->hasRole('User')) {
            $user2->assignRole('User');
        }

        $kategoriList = [
            'Generalities (Karya Umum)',
            'Philosopy and Psychology (Filsafat dan Psikologi)',
            'Religion (Agama)',
            'Social Science (Ilmu-ilmu Sosial)',
            'Languange (Bahasa)',
            'Natural Science and Mathematics (Ilmu-ilmu Alam dan Matematika)',
            'Technology and Applied Science (Teknologi dan Ilmu-ilmu terapan)',
            'The Art, Fine and Sport (Kesenian, Hiburan dan Olahraga)',
            'Literature and Rhetoric (Kesusastraan)',
            'Geography and History (Geografi dan Sejarah)'
        ];

        $kategoriIds = [];
        foreach ($kategoriList as $nama) {
            $k = KategoriBuku::firstOrCreate(['nama_kategori' => $nama]);
            $kategoriIds[] = $k->id;
        }

        // 3. Buat Buku
        $books = [
            [
                'kategori_id' => $kategoriIds[0],
                'judul' => 'Pengantar Pemrograman Laravel 10',
                'penulis' => 'Taylor Otwell',
                'penerbit' => 'O\'Reilly',
                'tahun_terbit' => 2023,
                'stok' => 5,
                'lokasi_rak' => 'IT-01',
            ],
            [
                'kategori_id' => $kategoriIds[1],
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'stok' => 3,
                'lokasi_rak' => 'NV-04',
            ],
            [
                'kategori_id' => $kategoriIds[1],
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => 1980,
                'stok' => 2,
                'lokasi_rak' => 'NV-01',
            ],
            [
                'kategori_id' => $kategoriIds[2],
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'KPG',
                'tahun_terbit' => 2011,
                'stok' => 4,
                'lokasi_rak' => 'SJ-02',
            ],
            [
                'kategori_id' => $kategoriIds[3],
                'judul' => 'Matematika untuk SMA/MA Kelas XII',
                'penulis' => 'Sukino',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2021,
                'stok' => 50,
                'lokasi_rak' => 'PL-12',
            ],
            [
                'kategori_id' => $kategoriIds[4],
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2018,
                'stok' => 10,
                'lokasi_rak' => 'PD-05',
            ]
        ];

        foreach ($books as $b) {
            Buku::firstOrCreate(['judul' => $b['judul']], $b);
        }
    }
}
