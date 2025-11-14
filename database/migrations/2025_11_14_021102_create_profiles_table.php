<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Kalau nanti pakai auth, bisa tambahkan user_id dan relasi
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name')->nullable();                // Ruby Chan, dll
            $table->string('subtitle')->nullable();            // (kita kosongkan dulu)
            $table->text('about')->nullable();                 // Tentang saya
            $table->json('skills')->nullable();                // Simpan array skill
            $table->string('avatar_path')->nullable();         // foto profil
            $table->string('cv_path')->nullable();             // file CV
            $table->string('resume_path')->nullable();         // file Resume
            $table->string('portfolio_path')->nullable();      // file Portofolio
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
