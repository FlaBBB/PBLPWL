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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->char('password', 60);
            $table->enum('role', [
                'MAHASISWA',
                'DOSEN',
                'ADMIN'
            ]);
            $table->string('photo_profile')->nullable();
            $table->string('email', 100)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
