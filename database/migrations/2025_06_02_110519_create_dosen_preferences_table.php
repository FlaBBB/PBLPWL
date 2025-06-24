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
        Schema::create('dosen_preferences', function (Blueprint $table) {
            $table->string('nidn');
            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->unsignedBigInteger('id_tag');
            $table->foreign('id_tag')->references('id')->on('tag')->onDelete('cascade');

            $table->primary(['nidn', 'id_tag']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_preferences');
    }
};
