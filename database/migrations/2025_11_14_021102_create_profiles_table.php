<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            /**
             * Relasi ke tabel users
             * NOTE:
             * - PK users = user_id (bukan id)
             * - Karena itu TIDAK boleh pakai ->constrained()
             */
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->unique('user_id');

            $table->string('name')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('about')->nullable();
            $table->json('skills')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('resume_path')->nullable();
            $table->string('portfolio_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
