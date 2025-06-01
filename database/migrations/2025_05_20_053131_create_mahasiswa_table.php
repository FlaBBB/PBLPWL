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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string("nim")->primary();
            $table->foreignId("id_user")->constrained("user");
            $table->string("name");
            $table->string("phone_number");
            $table->text("city");
            $table->text('district');
            $table->text('subdistrict');
            $table->text('address');
            $table->string("prodi");
            $table->integer("grade");
            $table->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
