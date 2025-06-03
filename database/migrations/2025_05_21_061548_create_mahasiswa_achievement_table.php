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
        Schema::create('mahasiswa_achievement', function (Blueprint $table) {
            $table->foreignId("id_achievement")->constrained("achievement");
            $table->string("nim");
            $table->foreign("nim")->references("nim")->on("mahasiswa");
            $table->enum("role", [
                "LEADER",
                "MEMBER",
                "PERSONAL"
            ]);
            $table->unsignedBigInteger("id_tag");
            $table->foreign("id_tag")->references("id")->on("tag");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_achievement');
    }
};
