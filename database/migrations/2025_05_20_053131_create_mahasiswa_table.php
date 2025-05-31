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
            $table->foreignId("id_user")->constrained("user")->onDelete("cascade");
            $table->string("name");
            $table->string("phone_number")->unique()->nullable();
            $table->text("city")->nullable();
            $table->text('district')->nullable();
            $table->text('subdistrict')->nullable();
            $table->text('address')->nullable();
            $table->string("prodi");
            $table->unsignedInteger("grade")->default(1);
            $table->timestamps();
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
