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
        Schema::create('competition_tag', function (Blueprint $table) {
            $table->unsignedBigInteger("id_competition");
            $table->foreign("id_competition")->references("id")->on("competition");
            $table->unsignedBigInteger("id_tag");
            $table->foreign("id_tag")->references("id")->on("tag");

            $table->primary(['id_competition', 'id_tag']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_tag');
    }
};
