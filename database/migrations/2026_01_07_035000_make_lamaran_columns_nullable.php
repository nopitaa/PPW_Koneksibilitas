<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw ALTER statements so this works on an existing DB without doctrine/dbal
        // Drop NOT NULL constraints for fields that are filled later in multi-step form
        $statements = [
            "ALTER TABLE lamaran ALTER COLUMN pendidikan DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN nama_institusi DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN jurusan DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN th_start DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN th_end DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN alat_bantu DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN cv DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN resume DROP NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN portofolio DROP NOT NULL;",
        ];

        foreach ($statements as $sql) {
            try {
                DB::statement($sql);
            } catch (\Exception $e) {
                // ignore if column missing or already nullable
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Before setting NOT NULL, ensure there are no NULLs
        $fixes = [
            "UPDATE lamaran SET pendidikan = '' WHERE pendidikan IS NULL;",
            "UPDATE lamaran SET nama_institusi = '' WHERE nama_institusi IS NULL;",
            "UPDATE lamaran SET jurusan = '' WHERE jurusan IS NULL;",
            "UPDATE lamaran SET th_start = 0 WHERE th_start IS NULL;",
            "UPDATE lamaran SET th_end = 0 WHERE th_end IS NULL;",
            "UPDATE lamaran SET alat_bantu = '' WHERE alat_bantu IS NULL;",
            "UPDATE lamaran SET cv = '' WHERE cv IS NULL;",
            "UPDATE lamaran SET resume = '' WHERE resume IS NULL;",
            "UPDATE lamaran SET portofolio = '' WHERE portofolio IS NULL;",
        ];

        foreach ($fixes as $sql) {
            try {
                DB::statement($sql);
            } catch (\Exception $e) {
            }
        }

        $statements = [
            "ALTER TABLE lamaran ALTER COLUMN pendidikan SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN nama_institusi SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN jurusan SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN th_start SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN th_end SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN alat_bantu SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN cv SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN resume SET NOT NULL;",
            "ALTER TABLE lamaran ALTER COLUMN portofolio SET NOT NULL;",
        ];

        foreach ($statements as $sql) {
            try {
                DB::statement($sql);
            } catch (\Exception $e) {
            }
        }
    }
};
