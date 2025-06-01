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
        Schema::create('supervisor_achievement', function (Blueprint $table) {
            $table->foreignId("id_achievement")->constrained("achievement");
            $table->string('nidn');
            $table->foreign('nidn')->references('nidn')->on('dosen');
            $table->integer("role");
            $table->foreign("role")->references("id")->on("role_supervisor");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisor_achievement');
    }
};
