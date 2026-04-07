<?php

$dir = __DIR__ . '/database/migrations';
$files = scandir($dir);

$migrations = [
    'siswas' => [
        'table' => 'siswa',
        'up' => "\$table->id();\n            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();\n            \$table->string('nisn', 20)->unique();\n            \$table->string('kelas', 10);\n            \$table->string('telepon', 20)->nullable();\n            \$table->timestamps();"
    ],
    'gurus' => [
        'table' => 'guru',
        'up' => "\$table->id();\n            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();\n            \$table->string('nip', 30)->unique();\n            \$table->string('telepon', 20)->nullable();\n            \$table->timestamps();"
    ],
    'karyawans' => [
        'table' => 'karyawan',
        'up' => "\$table->id();\n            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();\n            \$table->string('posisi', 50);\n            \$table->string('telepon', 20)->nullable();\n            \$table->timestamps();"
    ],
    'pustakawans' => [
        'table' => 'pustakawan',
        'up' => "\$table->id();\n            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();\n            \$table->string('nip', 30)->unique();\n            \$table->string('telepon', 20)->nullable();\n            \$table->timestamps();"
    ],
    'kategori_bukus' => [
        'table' => 'kategori_buku',
        'up' => "\$table->id();\n            \$table->string('nama_kategori', 100);\n            \$table->timestamps();"
    ],
    'bukus' => [
        'table' => 'buku',
        'up' => "\$table->id();\n            \$table->foreignId('kategori_id')->constrained('kategori_buku')->cascadeOnDelete();\n            \$table->string('judul');\n            \$table->string('penulis')->nullable();\n            \$table->string('penerbit')->nullable();\n            \$table->year('tahun_terbit')->nullable();\n            \$table->integer('stok')->default(0);\n            \$table->string('lokasi_rak')->nullable();\n            \$table->string('cover_image')->nullable();\n            \$table->softDeletes();\n            \$table->timestamps();"
    ],
    'peminjamen' => [
        'table' => 'peminjaman',
        'up' => "\$table->id();\n            \$table->foreignId('user_id')->constrained()->cascadeOnDelete();\n            \$table->date('tanggal_pinjam');\n            \$table->date('tenggat_waktu');\n            \$table->date('tanggal_kembali')->nullable();\n            \$table->enum('status', ['pending', 'dipinjam', 'dikembalikan', 'telat', 'ditolak'])->default('pending');\n            \$table->timestamps();"
    ],
    'detail_peminjamen' => [
        'table' => 'detail_peminjaman',
        'up' => "\$table->id();\n            \$table->foreignId('peminjaman_id')->constrained('peminjaman')->cascadeOnDelete();\n            \$table->foreignId('buku_id')->constrained('buku')->cascadeOnDelete();\n            \$table->timestamps();"
    ],
    'dendas' => [
        'table' => 'denda',
        'up' => "\$table->id();\n            \$table->foreignId('peminjaman_id')->constrained('peminjaman')->cascadeOnDelete();\n            \$table->integer('jumlah_denda');\n            \$table->enum('status_bayar', ['belum_lunas', 'lunas'])->default('belum_lunas');\n            \$table->timestamps();"
    ]
];

foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        foreach ($migrations as $oldTable => $data) {
            if (strpos($file, 'create_' . $oldTable . '_table') !== false) {
                $content = file_get_contents($dir . '/' . $file);
                $content = preg_replace("/Schema::create\('{$oldTable}', function \(Blueprint \\$table\) \{.*?\}/s", "Schema::create('{$data['table']}', function (Blueprint \$table) {\n            {$data['up']}\n        })", $content);
                $content = preg_replace("/Schema::dropIfExists\('{$oldTable}'\);/", "Schema::dropIfExists('{$data['table']}');", $content);
                file_put_contents($dir . '/' . $file, $content);
                echo "Modified $file\n";
            }
        }
    }
}
