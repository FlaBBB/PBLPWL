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
        Schema::create('mark', function (Blueprint $table) {
            $table->string("nim");
            $table->foreign("nim")->references("nim")->on("mahasiswa")->onDelete("cascade");
            $table->double("ipk");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mark');
    }
};
