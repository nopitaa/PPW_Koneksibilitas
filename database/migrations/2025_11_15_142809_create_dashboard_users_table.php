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
        Schema::create('dashboard_users', function (Blueprint $table) {
            $table->id('dashboard_user_id');
            $table->foreignId('user_id')->constrained('users', 'user_id'); //harus pakai constraines
            $table->text('foto_profil');
            $table->string('jenis_disabilitas');
            $table->string('tentang');
            $table->text('cv');
            $table->text('portofolio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_users');
    }
};
