<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ubah kolom dokumen_legalitas menjadi nullable dan tipe string (path file).
     */
    public function up(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            // Ubah ke string (path file) dan nullable
            $table->string('dokumen_legalitas')->nullable()->change();
        });
    }

    /**
     * Kembalikan ke NOT NULL jika rollback.
     */
    public function down(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->text('dokumen_legalitas')->nullable(false)->change();
        });
    }
};
