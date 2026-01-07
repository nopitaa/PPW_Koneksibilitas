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
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id('lamaran_id');
            $table->foreignId('user_id')->constrained('users', 'user_id'); 
            $table->foreignId('lowongan_id')->nullable()->constrained('lowongan', 'lowongan_id')->nullOnDelete(); 
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('nomor_hp');
            $table->string('alamat_lengkap');
            $table->string('email');
            $table->string('pendidikan');
            $table->string('nama_institusi');
            $table->string('jurusan');
            $table->year('th_start');
            $table->year('th_end');
            $table->string('alat_bantu');
            $table->text('cv');
            $table->text('resume');
            $table->text('portofolio');
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};
