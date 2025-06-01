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
            $table->foreignId("id_achievement")->constrained("achievement")->onDelete("cascade");
            $table->string("nim");
            $table->foreign("nim")->references("nim")->on("mahasiswa")->onDelete("cascade");
            $table->enum("role", [
                "LEADER",
                "MEMBER",
                "PERSONAL"
            ]);
            $table->foreignId("id_tag")->contrained("tag")->onDelete("cascade");
            $table->timestamps();
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
