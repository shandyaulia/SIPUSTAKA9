<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->text('deskripsi')->nullable();
            $table->string('kode_buku')->nullable();
            $table->string('edisi')->nullable();
            $table->string('isbn')->nullable();
            $table->dropColumn('lokasi_rak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'kode_buku', 'edisi', 'isbn']);
            $table->string('lokasi_rak')->nullable();
        });
    }
};
