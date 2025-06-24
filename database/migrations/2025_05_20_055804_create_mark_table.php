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
            $table->foreign("nim")->references("nim")->on("mahasiswa")->onDelete('cascade');
            $table->double("ipk");
            $table->timestamp("updated_at");
            $table->string("updated_by");
            $table->foreign("updated_by")->references("nip")->on("admin");
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
